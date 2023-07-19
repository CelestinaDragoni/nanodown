<?php

    /**
     * Nanodown Developer Playground
     * FOR LOCAL USE ONLY, DO NOT RUN THIS IN PRODUCTION!
     * (why do I even have to write that T_T)
     */

    // Nanodown Server Router
    if (
        $_SERVER["REQUEST_URI"] != '/' &&
        !preg_match('/\.(md)$/', $_SERVER["REQUEST_URI"])
    ) {
        return false;
    }

    // Include Nanodown
    require_once('src/nanodown.php');

    // Build Document Index
    $urls = array_merge(glob('*.md'), glob('*/*.md'));

    // Get Current Document
    $doc = ltrim($_SERVER["REQUEST_URI"], '/');
    if (empty($doc)) {
        $doc = 'readme.md';
    } else if (!file_exists($doc)) {
        $doc = false;
    }
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nanodown Playground</title>
    <link rel="icon" type="image/x-icon" href="/docs/images/favicon.ico">
    <style>
        html, body, nav, section, article, div, ul, ol, li, div, span, a, img, p, h1, h2, h3, h4, h5, hr {
            box-sizing: border-box;
        }

        body {
            background: #1e1e2e;
            color: #cdd6f4;
            font-family: sans-serif;
            padding: 0 0 0 240px;
            margin: 0;
            font-size: 18px;
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100%;
            background: #313244;
            line-height: 0;
        }

        nav img {
            background: #11111b;
            width: 100%;
            padding: 40px;
            margin: 0;

        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: block;
            margin: 0;
            padding: 0;
        }

        nav a {
            display: block;
            padding: 10px;
            color: #cdd6f4;
            text-decoration: none;
            border-bottom: 1px solid #11111b;
            transition: all .25s;
            line-height: 20px;
        }

        nav a:hover {
            background: #11111b;
        }

        nav p {
            display: block;
            padding: 10px;
            opacity: .8;
            font-size: 14px;
            line-height: 1.25em;
            margin: 0;
        }

        section {
            max-width: 960px;
            margin: 0 auto;
        }

        article {
            padding: 40px;
        }

        article h1 {
            font-size: 36px;
            padding-bottom: 10px;
        }

        article h2 {
            font-size: 30px;
        }

        article h3 {
            font-size: 26px;
        }

        article h4 {
            font-size: 22px;
        }

        article h5 {
            font-size: 18px;
        }

        article code {
            background: #181825;
            color: #a6e3a1;
            font-family: monaco, monospace;
        }

        article pre {
            background: #181825;
            color: #a6e3a1;
            font-family: monaco, monospace;
            overflow: auto;
            padding: 10px;
        }

        article img {
            max-width: 100%;
        }

        article a {
            color: #89dceb;
            transition: all .25s;
        }

        article a:hover {
            color: #74c7ec;
        }

        article mark {
            background: #f9e2af;
            color: #11111b;
        }

        article table {
            width: 100%;
            border: 1px solid #a6adc8;
            border-collapse: collapse;
            margin: 10px 0;
        }

        article table tr th{
            border: 1px solid #7f849c;
            border-bottom: 3px solid  #7f849c;
            padding: 10px;
            text-align: left;
        }

        article table tr td {
            border: 1px solid #7f849c;
            padding: 10px;
        }

        article span {
            display: block;
            padding-left: 20px;
            font-family: monaco, monospace;
        }

        article li {
            margin: 5px 0;
        }

        article blockquote {
            border-left: 5px solid #cba6f7;
            padding: 5px 20px;
            margin: 20px 0 0 40px;
            opacity: .65;
        }

        article hr {
            height: 1px;
            background-color: #7f849c;
            border: none;
        }
    </style>
</head>
<body>

<nav>
    <img src='/docs/images/logo-small.png' alt='nanodown'/>
    <ul>
        <?php foreach ($urls as $url): ?>
            <li><a href='/<?= htmlentities($url) ?>'><?= htmlentities($url) ?></a></li>
        <?php endforeach; ?>
    </ul>

    <p>
        <strong>Getting Started:</strong>
    </p>
    <p>
        Add markdown documents to the root of this checkout to see your own documents rendered using <strong>Nanodown</strong>!
    </p>
    <p>
        They will automatically show up in the sidebar as a document you can navigate to. Just make sure your documents end in <code>.md</code>
    </p>
</nav>

<section>
    <article>
    <?php if ($doc === false): ?>
        <h1>Document Not Found</h1>
        <p></p>
    <?php else: ?>
        <?= \Nanodown::getInstance()->convertFromFile($doc) ?>
    <?php endif ?>
    </article>
</section>

</body>
</html>


