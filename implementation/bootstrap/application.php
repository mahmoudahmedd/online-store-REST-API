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

        $a = new Router($_GET); 
        $a->mapRoute();
    }
}