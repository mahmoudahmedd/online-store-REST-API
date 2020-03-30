<?php

class Router
{
	private $controller;
	private $GETRequest;

	public function __construct($_GETRequest)
    {
        $this->GETRequest = $_GETRequest;
    }

    private function checkRoutingClass()
    {
    	if(!array_key_exists("class", $this->GETRequest))
    	{
        	return false;
    	}

        if($this->GETRequest["class"] == "user")
        {
            $this->controller = new UserController($this->GETRequest["parameters"]);
            return true;
        }
            
        return false;
    }
    
    public function mapRoute()
    {
    	$data = array("status" => "exception", "message" => "unsupported get request. Please read the API documentation.");
        if($this->checkRoutingClass())
        {
            if($this->GETRequest["method"] == "register")
            {
                $this->controller->register();
            }
            else if($this->GETRequest["method"] == "login")
            {
                $this->controller->login();
            }
            else if($this->GETRequest["method"] == "get_all_users")
            {
                $this->controller->getAllUsers();
            }
            else
            {
                echo json_encode($data, JSON_PRETTY_PRINT);
        		exit();
            }
        }
        else
        {
			
        	echo json_encode($data, JSON_PRETTY_PRINT);
        	exit();
        }
    }
}