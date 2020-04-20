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
            $_GET['arguments']
        */
        
        // print_r($_SERVER['PATH_INFO']);
        // print_r($_REQUEST);

        // $test = new Authorizer();
        // $test->authorize($user, UserType::ADMINISTRATOR);

        $arguments = "";
        if(isset($_REQUEST["arguments"]))
            $arguments = $_REQUEST["arguments"];

        $requestUrl = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

        $router = new Router();

        if(!$router->route($requestUrl, $_SERVER['REQUEST_METHOD'], $arguments))
        {
            http_response_code(404);

            // putting data to JSONObject 
            $data = array("status" => "exception", "message" => "unsupported request. Please read the API documentation.");
            echo json_encode($data, JSON_PRETTY_PRINT);

            exit();
        }
    }
}