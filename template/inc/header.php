<?php
use Newsletter\Controller\App;
require('config/settings.php');
$cssPath = App::getStyle($homeDir);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= $cssPath; ?>" rel="stylesheet" />
    <link rel="icon" type="image/png" href="img/favicon.png" sizes="64x64">
    <title><?= $title; ?></title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-C86LM1HMQC"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-C86LM1HMQC');
    </script>

</head>