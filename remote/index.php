<?php

    $store = filter_input(INPUT_GET, 'store', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $xml = simplexml_load_file("https://app-architekt.de/noz-digital/tante-emma/web/api?store=$store");

    // If there's and error stop here and output message
    !isset($xml->error) or exit($xml->error);

?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tante Emma</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css">
        <!--[if (lt IE 9)]><script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/min/tiny-slider.helper.ie8.js"></script><![endif]-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>

        <style>
            body {
                margin: 0;
                padding: 0;
            }

            div#images img {
                width: 300px;
                height: auto;
            }
        </style>
    </head>

    <body>
        <div id="images">
            <?php foreach(explode(',', $xml->images) as $item) { ?>
                <div><a href="<?= $xml->link ?>" target="_blank"><img src="<?= $item ?>"></a></div>
            <?php } ?>
        </div>

        <script>
            var slider = tns({
                container: '#images',
                viewportMax: 300,
                autoplay: true,
                controls: false,
                nav: false,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                autoplayButtonOutput: false,
            });
        </script>
    </body>
</html>