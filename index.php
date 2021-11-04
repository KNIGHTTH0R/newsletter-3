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

$request = trim($_SERVER['REQUEST_URI'], "/");    // Trim trailing slashes if exists

switch ($homeDir . $request) {
    case $homeDir:
    case '/':
        App::display('main');
        break;
    case '/admin':
        App::display('admin');
        break;
    case '/submit':
        App::submit();
        break;
    default:
        echo "404";
        break;
}