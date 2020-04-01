<?php

class Router
{
	private $controller;
	private $GETRequest;
    private $controllersClassesArr;
    private $controllersMethodsArr;

	public function __construct($_GETRequest)
    {
        $this->GETRequest = $_GETRequest;

        // Fill the array with the names of the classes
        $this->controllersClassesArr = array();
        $this->controllersClassesArr[] = "UserController";

        // Fill the array with the names of the methods
        $this->controllersMethodsArr = array();
        $this->controllersMethodsArr[] = "login";
        $this->controllersMethodsArr[] = "register";
        $this->controllersMethodsArr[] = "getAllUsers";
    }

    public function route()
    {
    	if(!array_key_exists("class", $this->GETRequest))
    	{
        	return false;
    	}

        if(!array_key_exists("method", $this->GETRequest))
        {
            return false;
        }

        if(!array_key_exists("parameters", $this->GETRequest))
        {
            return false;
        }

        if(!in_array($this->GETRequest["class"], $this->controllersClassesArr))
        {
            return false;
        }

        if(!in_array($this->GETRequest["method"], $this->controllersMethodsArr))
        {
            return false;
        }

        if(method_exists($this->GETRequest["class"], $this->GETRequest["method"]))
        {
            $this->controller = new $this->GETRequest["class"]($this->GETRequest["parameters"]);
            call_user_func(array($this->controller, $this->GETRequest["method"]));
            
            return true;
        }
            
        return false;
    }
}