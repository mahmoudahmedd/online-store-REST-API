<?php
class Router
{
	private $controller;
    private $controllersClassesArr;

    private $requestUrl;
    private $requestMethod;
    private $arguments;

	public function __construct()
    {
        // Fill the array with the names of the classes
        $this->controllersClassesArr = array();
        $this->controllersClassesArr[] = "UserController";
    }

    public function route($_requestUrl, $_requestMethod, $_arguments)
    {
        $this->requestUrl = $_requestUrl;
        $this->requestMethod = $_requestMethod;
        $this->arguments = $_arguments;

        if(!in_array($this->requestUrl[0], $this->controllersClassesArr))
        {
            return false;
        }

        $this->controller = new $this->requestUrl[0]($_arguments);

        switch ($this->requestMethod) 
        {

            case "GET":
            if(isset($this->requestUrl[1]) && !empty($this->requestUrl[1]) && ctype_digit($this->requestUrl[1])) 
            {
                return false;
                //echo "true - num";
                //$this->controller->get($_requestUrl[1]);
            } 
            else
            {
                //echo "false";
                $this->controller->getAll();
            }
            break;
            case "POST":
            if(isset($this->requestUrl[1]) && !empty($this->requestUrl[1]) && !ctype_digit($this->requestUrl[1]))
            {
                $this->controller->login();
            }
            else
            {
                $this->controller->create();
            }
            break;
            case "DELETE":
            return false;
            // $this->controller->delete($_arguments);
            break;
            case "PUT":
            return false;
            // $this->controller->update($_arguments);
            break;
            default:
            return false;
        }
    
        return false;
    }
}