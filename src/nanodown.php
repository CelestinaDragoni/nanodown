<?php

/**
 * Nanodown - Small, Performant, and Memory Efficient Markdown Library for PHP
 * Written by: Celestina Dragoni
 * GitHub: https://github.com/CelestinaDragoni
 */
class Nanodown
{
    /** In HTML/Raw Flag **/
    private $_inRaw = false;

    /** In Code Block Flag **/
    private $_inPre = false;

    /** In Table Block Flag **/
    private $_inTable = false;

    /** In List Block Flag **/
    private $_inList = false;

    /** In Quote Block Flag **/
    private $_inQuote = false;

    /** Edge Case Surrounding Tables and Blockquotes **/
    private $_inQuoteTable = false;

    /** HTML Buffer **/
    private $_html = '';

    /** Escape Characters for Markdown and HTML **/
    private $_escape = [
        'sanitize' => [
            '<'  => '&lt;',
            '>'  => '&gt;',
            '"'  => '&quot;',
            '\'' => '&apos;',
            "\n" => '',
            "\r" => '',
            "\0" => '',
            '\*' => '&#42;',
            '\_' => '&#95;',
            '\`' => '&#96;',
            '\{' => '&#123;',
            '\}' => '&#125;',
            '\[' => '&#91;',
            '\]' => '&#93;',
            '\(' => '&#40;',
            '\)' => '&#41;',
            '\#' => '&#35;',
            '\~' => '&#126;',
            '\|' => '&#124;',
            '\=' => '&#61;',
            '\^' => '&#94;',
            '\-' => '&#45;',
            '\+' => '&#43;',
            '\:' => '&#58;',
        ],
        'code' => [
            '*' => '&#42;',
            '_' => '&#95;',
            '`' => '&#96;',
            '{' => '&#123;',
            '}' => '&#125;',
            '[' => '&#91;',
            ']' => '&#93;',
            '(' => '&#40;',
            ')' => '&#41;',
            '#' => '&#35;',
            '~' => '&#126;',
            '|' => '&#124;',
            '=' => '&#61;',
            '^' => '&#94;',
            '-' => '&#45;',
            '+' => '&#43;',
            ':' => '&#58;',
        ],
    ];

    /** Generic Regexes **/
    private $_regex = [
        'tokens' => [
            '/^##### (.*?)$/',
            '/^#### (.*?)$/',
            '/^### (.*?)$/',
            '/^## (.*?)$/',
            '/^# (.*?)$/',
            '/^---/',
            '/^\: (.*?)$/',
            '/[*_]{3}(.*?)[*_]{3}/',
            '/[*_]{2}(.*?)[*_]{2}/',
            '/[*_]{1}(.*?)[*_]{1}/',
            '/\~\~(.*?)\~\~/',
            '/\^(.*?)\^/',
            '/\~(.*?)\~/',
            '/\=\=(.*?)\=\=/',
        ],
        'replace' => [
            '<h5>$1</h5>',
            '<h4>$1</h4>',
            '<h3>$1</h3>',
            '<h2>$1</h2>',
            '<h1>$1</h1>',
            '<hr/>',
            '<span>$1</span>',
            '<em><strong>$1</strong></em>',
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<s>$1</s>',
            '<sup>$1</sup>',
            '<sub>$1</sub>',
            '<mark>$1</mark>',
        ],
    ];

    /** Specific Regex Strings for Links and Images **/
    private $_regexLinks = [
        '/(\!)\[(.*?)\]\((.*?)\)/',
        '/\[(.*?)\]\((.*?)\)/',
        '/(&lt;)(http|https|ftp|sftp|gemini|gopher|git|tel|email)\:(\/?\/?)(.*?)&gt;/',
        '/(^|\s)(http|https|ftp|sftp|gemini|gopher|git|tel|email)\:(\/?\/?)(.*?)($|\s)/',
    ];

    /**
     * Singleton Constructor
     * @return Nanodown
     */
    public static function getInstance() : \Nanodown
    {
        static $instance = false;
        return $instance ? $instance : $instance = new \Nanodown();
    }

    /**
     * Converts markdown string to an HTML string.
     * @param String $markdown Markdown Input
     * @return String HTML Output
     */
    public function convertFromString(String $markdown) : String
    {
        $this->_reset();

        // String stream saves memory consumption.
        if ($stream = fopen('php://memory','r+')) {
            fwrite($stream, $markdown);
            rewind($stream);
            while(!feof($stream)) {
                $line = fgets($stream);
                $this->_parse($line);
                $this->_html .= "$line\n";
            }
            fclose($stream);
        }

        return $this->_dealloc();
    }

    /**
     * Converts markdown from file to an HTML string.
     * @param String $filename Markdown File Location
     * @return String HTML Output
     */
    public function convertFromFile(String $filename) : String
    {
        $this->_reset();

        if (!file_exists($filename) && !is_readable($filename)) {
            return '';
        }

        if ($file = fopen($filename, "r")) {
            while(!feof($file)) {
                $line = fgets($file);
                $this->_parse($line);
                $this->_html .= "$line\n";
            }
            fclose($file);
        }

        return $this->_dealloc();
    }

    /**
     * Writes to local string and returns. Deallocs HTML variable from class. (PHP Optimization)
     * @return String
    */
    private function _dealloc() : String
    {
        $html = $this->_html;
        $this->_html = '';
        return $html;
    }

    /**
     * Reset class variables on new conversion process.
     * @return Void
     */
    private function _reset() : Void
    {
        $this->_html = '';
        $this->_inRaw = false;
        $this->_inPre = false;
        $this->_inTable = false;
        $this->_inList = false;
        $this->_inQuote = false;
        $this->_inQuoteTable = false;
    }

    /**
     * Parse markdown line and convert into HTML
     * @param String $line
     * @return Void
     */
    private function _parse(String &$line) : Void
    {
        $this->_raw($line);
        if ($this->_inRaw) {
            return;
        }

        $this->_sanitize($line);
        $this->_quote($line);
        $this->_pre($line);
        $this->_code($line);
        $this->_links($line);
        $this->_table($line);
        $this->_list($line);
        $this->_regex($line);
        $this->_endline($line);
    }

    /**
     * Sanitize markdown line from HTML injections and breakage. (Best we can here).
     * @param String $line Markdown Line
     * @return Void
     */
    private function _sanitize(String &$line) : Void
    {
        $line = strtr($line, $this->_escape['sanitize']);
    }

    /**
     * Regular Expression Handler for Generic Inline Markdown Tags
     * @param String $line Markdown Line
     * @return Void
     */
    private function _regex(String &$line) : Void
    {
        if ($this->_inPre) {
            return;
        }

        // Run Regular Expressions
        $line = preg_replace(
            $this->_regex['tokens'],
            $this->_regex['replace'],
            $line
        );
    }

    /**
     * Generates and Escapes Links and Images
     * @param String $line
     * @return Void
     */
    private function _links(String &$line) : Void
    {
        if ($this->_inPre) {
            return;
        }

        $line = preg_replace_callback(
            $this->_regexLinks,
            function ($matches) {
                $url = '';
                $label = '';
                $space = '';
                $length = count($matches);

                if ($length === 6) {
                    $url = $matches[2] . ':' . $matches[3] . $matches[4];
                    $label = $url;
                    $space = ' ';
                } else if ($length === 5) {
                    $url = $matches[2] . ':' . $matches[3] . $matches[4];
                    $label = $url;
                    $space = ' ';
                } else if ($length === 4) {
                    $url = $matches[3];
                    $label = $matches[2];
                } else if ($length === 3) {
                    $url = $matches[2];
                    $label = $matches[1];
                }

                $url = strtr($url, $this->_escape['code']);
                $label = strtr($label, $this->_escape['code']);

                if ($length === 4) {
                    return "$space<img src=\"$url\" alt=\"$label\"/>$space";
                }

                return "$space<a href=\"$url\">$label</a>$space";
            },
            $line
        );
    }

    /**
     * Renders Raw Content like HTML
     * @param String $line
     * @return void
     */
    private function _raw(String &$line) : Void
    {
        if (strpos($line, '^^^^^') !== 0) {
            return;
        }

        $line = '';
        $this->_inRaw = !$this->_inRaw;
    }

    /**
     * Renders Quote Blocks
     * @param String $line
     * @return Void
     */
    private function _quote(String &$line) : Void
    {
        $isQuote = (strpos($line, '&gt;') === 0);

        // Nope
        if (!$this->_inQuote && !$isQuote) {
            return;
        }

        // Exiting Quote Block
        if ($this->_inQuote && !$isQuote) {
            if ($this->_inTable) {
                $this->_inQuoteTable = true;
            } else {
                $this->_html .= "</blockquote>\n";
            }
            $this->_inQuote = false;
            return;
        }

        // Entering Quote Block
        if (!$this->_inQuote && $isQuote) {
            $this->_html .= "<blockquote>\n";
            $this->_inQuote = true;
        }

        // Truncate Quote Syntax From Line
        $line = substr($line, 5);
    }

    /**
     * Renders Pre-Formatted Code Blocks
     * @param String $line Markdown Line
     * @return Void
     */
    private function _pre(String &$line) : Void
    {
        if (strpos($line, '```') !== 0) {
            return;
        }

        if ($this->_inPre) {
            $this->_inPre = false;
            $line = '</pre>';
        } else {
            $this->_inPre = true;
            $line = '<pre>';
        }
    }

    /**
     * Renders Inline Code Blocks
     * @param String $line
     * @return Void
     */
    private function _code(String &$line) : Void
    {
        $line = preg_replace_callback(
            '/\`(.*?)\`/',
            function ($matches) {
                $matches[1] = strtr($matches[1], $this->_escape['code']);
                return "<code>{$matches[1]}</code>";
            },
            $line
        );
    }

    /**
     * Renders Table
     * @param String $line
     * @return Void
     */
    private function _table(String &$line) : Void
    {
        // Static Column Count
        static $length = -1;

        // Don't Run Table Logic When...
        if ($this->_inPre) {
            return;
        }

        $isTable = strpos($line, '|') === 0;
        $isDiv = strpos($line, '|-') === 0;

        // Not a Table
        if (!$this->_inTable && !$isTable) {
            return;
        }

        // Exiting Exising Table
        if ($this->_inTable && !$isTable) {
            $length = -1;
            $this->_html .= $this->_inQuoteTable ? "</table></blockquote>\n" : "</table>\n";
            $this->_inTable = false;
            $this->_inQuoteTable = false;
            return;
        }

        // Check for Table Split/Alignment (Unsupported Syntax)
        if ($isTable && $isDiv) {
            $line = '';
            return;
        }

        // Get Column Data
        $data = [];
        if ($isTable) {
            $data = explode(
                '|',
                ltrim(rtrim($line, '|'), '|'),
            );
            if ($length === -1) {
                $length = count($data);
            }
        }

        // Default Column Tag Type
        $tag = 'td';

        // Entering Table
        if (!$this->_inTable) {
            $this->_html .= "<table>\n";
            $this->_inTable = true;
            $tag = 'th';
        }

        // Build Columns
        $cols = '';
        for ($i = 0; $i < $length; $i++) {
            if (isset($data[$i])) {
                $cols .= "<$tag>{$data[$i]}</$tag>";
            } else {
                $cols .= "<$tag>&nbsp;</$tag>";
            }
        }

        // Write Line
        $line = "<tr>$cols</tr>";
    }

    /**
     * Renders Lists and Nested Lists Using Flattened Recursion
     * Note: I hate all of this, but...
     * @param String $line
     * @return Void
     */
    private function _list(String &$line) : Void
    {
        static $nested = [];
        static $indent = -1;

        // Don't Run Table Logic When...
        if ($this->_inPre || $this->_inTable) {
            return;
        }

        // Line Buffer
        $buffer = '';

        // Line Item w/o Indent
        $item = ltrim($line);

        // Indent Autodetect
        $tab = strlen($line) - strlen($item);

        // Invalid List Format
        if (!$this->_inList && $tab > 0) {
            return;
        }

        // Check For List
        $isOL = preg_match('/^[0-9]{1,}\. /', $item);
        $isUL = preg_match('/^[\+\*\-]{1} /', $item);
        $isLI = $isOL || $isUL;

        // Exit
        if (!$isLI  && !$this->_inList) {
            return;
        }

        // Close List
        if (!$isLI && $this->_inList) {
            // Close Remaining Tags
            foreach (array_reverse($nested) as &$nest) {
                $key = $nest[0];
                $buffer .= "</li></$key>";
            }

            // Write To Line Before
            $this->_html .= "$buffer\n";

            // Reset
            $indent = -1;
            $nested = [];
            $this->_inList = false;
            return;
        }

        // Start List
        if ($isLI && !$this->_inList) {
            $indent = -1;
            $nested = [];
            $this->_inList = true;
        }

        // Set Tab Length
        if ($indent === -1 && $tab > 0) {
            $indent = $tab;
        }

        // Determine Depth
        $depth = intval(floor($tab / $indent));

        // Get Maximum Depth
        $imax  = count($nested) - 1;

        // Check Valid Depth
        if (!isset($nested[$depth])) {
            if ($depth > count($nested)) {
                $depth = $imax;
            }

            // Write Nested
            if (!isset($nested[$depth])) {
                $nested[] = [
                    (($isOL) ? 'ol' : 'ul'),
                    0
                ];
            }
        }

        // Close Existing Tags and Pop Off
        if ($depth < $imax) {
            foreach (array_reverse($nested) as &$nest) {
                $imax = count($nested) - 1;

                if ($imax === $depth) {
                    break;
                }

                $key = $nest[0];
                $buffer .= "</li></$key>";
                array_pop($nested);
            }
        }

        // List Logic
        if ($nested[$depth][1] === 0) {
            $buffer .= "<{$nested[$depth][0]}>";
        } else {
            $buffer .= "</li>";
        }

        // Write Item
        if ($isOL) {
            $buffer .= preg_replace('/^[0-9]{1,}\. (.*?)$/', '<li>$1', $item);
        } else {
            $buffer .= preg_replace('/^[\+\*\-]{1} (.*?)$/', '<li>$1', $item);
        }

        // Increase Line Count
        $nested[$depth][1]++;

        // Write Line
        $line = $buffer;
    }

    /**
     * Determine If Content Is Paragraph Worthy
     * @param String $line
     * @return Void
     */
    private function _endline(String &$line) : Void
    {
        // These set, ignore
        if (
            $this->_inPre ||
            $this->_inTable ||
            $this->_inList ||
            $this->_inRaw
        ) {
            return;
        }

        // Blank line, Ignore
        if (trim($line) === '') {
            return;
        }

        // Done as a memory saving method of detection.
        if (
            (strpos($line, '<h') === 0) ||
            (strpos($line, '<div') === 0) ||
            (strpos($line, '<pre') === 0) ||
            (strpos($line, '</pre') === 0)
        ) {
            return;
        }

        // Wrap in paragraph.
        $line = "<p>$line</p>";
    }
}
