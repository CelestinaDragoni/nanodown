# Changelog

## Version 1.0.1
- **Bugfix**: Encoding fixed for escaped HTML characters to accurately represent their ASCII equivalent. Caused broken HREFs and image SRCs with `-` and other escape characters.
- **Bugfix**: Typo on acid test markdown.
- **Bugfix**: Remove rendering links and images inside `<pre></pre>` tags. Should no longer happen.
- **Enhancement**: Charts added to readme to add clarity to the benchmark results.
- **Enhancement**: Remove pass by reference for `Nanodown::convertFromString(String $markdown)`, does not impact memory or performance otherwise. Also, makes the function much easier to use.
- **Enhancement**: Converted acid test rendered benchmark screenshots to jpeg to make them easier to view on github.
- **Enhancement**: Benchmarks forked into another document for ease of reading. Also some clarity made around which feature sets I used for other libraries.
- **Enhancement**: Readme reformat/cleanup.
- **Enhancement**: Development playground enhancement to be pretty and useful!

## Version 1.0.0
- Initial Features
