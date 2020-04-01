<?php
class Router
{
	private $controller;
	private $GETRequest;
    private $controllersClassesArr;

	public function __construct($_GETRequest)
    {
        $this->GETRequest = $_GETRequest;

        // Fill the array with the names of the classes
        $this->controllersClassesArr = array();
        $this->controllersClassesArr[] = "UserController";
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
  
        $this->controller = new $this->GETRequest["class"]($this->GETRequest["parameters"]);

        if($this->controller->methodExistsCheck($this->GETRequest["method"]))
        {
            call_user_func(array($this->controller, $this->GETRequest["method"]));
            return true;
        }
            
        return false;
    }
}