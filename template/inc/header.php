<?php
use Pineapple\Controller\App;
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
</head>