<?php

require_once(ROOT . DS . "bootstrap" . DS . "autoload.php");
require_once(ROOT . DS . "bootstrap" . DS . "router.php");

class Application 
{
    // Application constructor
    private function __construct()
    {}
    
    /**
     * Run the application
     *
     * @return void
     */
    public static function run() 
    {
        /*
            $_GET['class']
            $_GET['method']
            $_GET['parameters']
        */

        $router = new Router($_GET); 

        if(!$router->route())
        {
            echo View::exception();
            exit();
        }
    }
}