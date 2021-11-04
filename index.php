<?php

use Newsletter\Controller\App;

require('vendor/autoload.php');
require('config/settings.php');

if ($isProduction) {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    error_reporting(0);
} else {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

$request = $_SERVER['REQUEST_URI'];
echo $request;
echo "<br>";
echo $homeDir;
exit();

switch ($request) {
    case $homeDir:
    case $homeDir . '/' :
        App::display('main');
        break;
    case $homeDir . '/admin':
        App::display('admin');
        break;
    case $homeDir . '/submit':
        App::submit();
        break;
    default:
        echo "404";
        break;
}