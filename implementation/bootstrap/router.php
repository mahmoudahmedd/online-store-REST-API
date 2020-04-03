<?php
class Router
{
	private $controller;
    private $controllersClassesArr;

    private $messageBody;
    private $requestMethod;

	public function __construct()
    {
        // Fill the array with the names of the classes
        $this->controllersClassesArr = array();
        $this->controllersClassesArr[] = "UserController";
    }

    public function route($_requestUrl, $_requestMethod, $_messageBody)
    {
        $this->messageBody = $_messageBody;
        $this->requestMethod = $_requestMethod;

        if(!in_array($_requestUrl[0], $this->controllersClassesArr))
        {
            return false;
        }

        $this->controller = new $_requestUrl[0]($_messageBody);

        switch ($this->requestMethod) 
        {
            case "GET":
            if(isset($_requestUrl[1]) && !empty($_requestUrl[1]) && ctype_digit($_requestUrl[1])) 
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
            if(isset($_requestUrl[1]) && !empty($_requestUrl[1]) && !ctype_digit($_requestUrl[1]))
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
            // $this->controller->delete($_messageBody);
            break;
            case "PUT":
            return false;
            // $this->controller->update($_messageBody);
            break;
            default:
            return false;
        }
    
        return false;
    }
}