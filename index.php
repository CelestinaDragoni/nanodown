<?php

    require('src/nanodown.php');
    $html = '';
    if (isset($_GET['readme'])) {
        $html = \Nanodown::getInstance()->convertFromFile('./readme.md');
    } else {
        $html = \Nanodown::getInstance()->convertFromFile('./docs/acid.md');
        $html = str_replace('image.png', 'docs/image.png', $html);
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nanodown Example</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 16px;
            padding: 20px;
            background: #EEE;
        }
        section {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
            background :#FFF;
        }
        section hr {
            border-top: 1px solid #CCC;
        }
        section blockquote {
            padding: 20px;
            border-left: 5px solid #EEE;
            opacity: .5;
        }
        section code {
            background: #EEE;
        }
        section pre {
            padding: 10px;
            background: #EEE;
            overflow: scroll;
        }
        section table {
            border: 1px solid #CCC;
            border-collapse: collapse;
        }
        section table tr td, section table tr th {
            padding: 10px;
            border: 1px solid #CCC;
        }
        section span {
            display: block;
            margin-left: 20px;
            font-family: monospace;
        }
        section img {
            max-width: 100%;
        }
    </style>
</head>
<body>
<section>

<?= $html ?>

</section>
</body>
</html>


