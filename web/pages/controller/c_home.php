<?php

if(isset($_POST['init'])){
        //reecriture des routes
        $route = preg_replace("/home/","init",file_get_contents("web/module/route.php"));
        //dump($route);
        file_put_contents("web/module/route.php", $route);
}