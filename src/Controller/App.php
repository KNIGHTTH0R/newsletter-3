<?php

namespace Newsletter\Controller;

use Newsletter\Model\Database;
use Newsletter\Model\Validate;

class App
{
    public static $successImageVisibility = 'hidden';        // 'hidden' | 'visible'
    public static $display_form = true;
    public static $title = "Subscribe to newsletter";
    public static $description = "Get the latest news and promotions.";
    public static $message = "";
    public static $text_placeholder = "Type your email address here…";
    public static $email = "";
    public static $error_message = "";

    public static function getStyle($homeDir)
    {
        require('config/settings.php');
        
        if ($homeDir == "/") {
            return $homeDir . $cssFileName;
        } elseif ($homeDir == "") {
            return $homeDir . "/" . $cssFileName; 
        } elseif (substr($homeDir, -1) == '/') {
            return $homeDir . $cssFileName;
        } else {
            return $homeDir . "/" . $cssFileName;
        }
    }
    
    public static function display($view)
    {
        require('template/'.$view.'.php');
    }

    public static function redirect($uri)
    {
        header('Location: ' . $uri);
    }

    public static function submit($data, $fromVue)
    {
        require('config/db.php');
        $db = new Database();

        $validate = new Validate($data);        // Send data for validation        
        $result = $validate->validateForm();        // Start validation and save bool to variable

            if ($result) {        // Save to database if validation successful

                if ($fromVue) {        // Data comes from Vue app - JavaScript enabled
                    $db->insert($data['email']);
                } else {        // Data comes from HTML form - JavaScript disabled - Vue not available
                    $db->insert($data['email']);
                    self::$successImageVisibility = 'visible';
                    self::$display_form = false;
                    self::$title = "Thanks for subscribing!";
                    self::$description = "You have successfully subscribed to our email listing.";
                    self::display('main');
                }

            } else {        // Display validation error
                self::$message = $validate->error;
                self::$email = $data['email'];        // Save input field value  
                self::display('main');
            }
        
    }

}