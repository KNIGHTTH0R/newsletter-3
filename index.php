<?php


use Newsletter\Controller\App;
use Newsletter\Controller\Route;

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

Route::set('/', function() {
    App::display('main');
});

Route::set('/submit', function() {
    if (json_decode(file_get_contents('php://input'))) {        // Data from Vue app
       
        $data = json_decode(file_get_contents('php://input'), true);        // Get data from Axios POST
        App::submit($data, true);

    } elseif (isset($_POST['email'])) {        // Data from PHP form        
       
        $data = $_POST;
        App::submit($data, false);

    } else {

        header('Location: /');        // Redirect to home if no data posted

    }
});

Route::set('/admin', function() {
    App::display('admin');
});