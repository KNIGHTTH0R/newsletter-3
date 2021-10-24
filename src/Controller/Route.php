<?php

namespace Newsletter\Controller;

class Route
{

    public static function set($route, $action)
    {
        $uri = $_SERVER['REQUEST_URI'];
        require('config/settings.php');        // Get home directory

        if (trim(str_replace($homeDir, "", $uri), "/") == trim($route, "/")) {        // Remove home directory from URI, remove slash symbols
            $action->__invoke();        // Run functions if route fits
        }
    }

    public static function trimSlash($str)
    {
        if($str !== '/' && substr($str, -1) == '/') {       // If slash is not the only char
            return substr($str, 0, -1);        // Remove trailing slash from address
        } else {
            return $str;
        }
    }
}