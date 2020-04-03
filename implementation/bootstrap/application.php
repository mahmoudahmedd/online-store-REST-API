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
        
        $parameters = "";
        if(isset($_REQUEST["parameters"]))
            $parameters = $_REQUEST["parameters"];

        $requestUrl = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

        //print_r($requestUrl);
        //print_r($_REQUEST);

        $router = new Router();

        if(!$router->route($requestUrl, $_SERVER['REQUEST_METHOD'], $parameters))
        {
            echo View::exception();
            exit();
        }
    }
}