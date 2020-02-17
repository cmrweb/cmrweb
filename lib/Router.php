<?php
class Router
{
    private static $url;
    function __construct()
    {
        if (isset($_GET['url'])) {
            self::$url = explode('/', $_GET['url']);
        }
    }
    public static function route($routes)
    {
        if(!in_array(self::$url[0],array_keys($routes))){   
            require "web/pages/erreur.php";
        }else
        foreach ($routes as $route => $file) {
            if ($file) {
                if (self::$url[0] == "{$route}" && empty(self::$url[1])) {
                    $html = new Html();
                    $dev = $_ENV['APP_ENV'] == "dev" ? true : false;
                    require "web/pages/controller/c_$file.php";
                    require "web/pages/$file.php";
                } elseif (self::$url[0] == "{$route}" && !empty(self::$url[1])) {
                    $html = new Html();
                    $dev = $_ENV['APP_ENV'] == "dev" ? true : false;
                    $id = self::$url[1];
                    require "web/pages/controller/c_$file.php";
                    require "web/pages/$file.php";
                }
            } else {
                if (self::$url[0] == "{$route}" && empty(self::$url[1])) {
                    $html = new Html();
                    $dev = $_ENV['APP_ENV'] == "dev" ? true : false;
                    require "web/pages/$route.php";
                }
            }
        }
    }
}