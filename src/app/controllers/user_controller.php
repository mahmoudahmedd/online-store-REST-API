<?php
class UserController extends Controller
{
    public function __construct($_arguments)
    {
        $this->arguments = $_arguments;
        $this->model = new Model();
        $this->view = new View();
        $this->dataAccessObject = new DataAccessObject("users");

        $this->authorizer = new Authorizer();
        $this->authenticator = new Authenticator();
    }

    public function login()
    {
        if(empty($this->arguments) || !isset($this->arguments) || !is_array($this->arguments))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("username", $this->arguments) && 
           !array_key_exists("email", $this->arguments) && 
           !array_key_exists("phone_number", $this->arguments))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("password", $this->arguments))
        {
            echo $this->view->exception();
            exit();
        }

        $this->model->data["password"] = hash('sha256', $this->arguments["password"]);

        if(array_key_exists("username", $this->arguments))
        {
            $this->model->data["username"] = $this->arguments["username"];
            $asoArr = array("username" => $this->model->data["username"], "password" => $this->model->data["password"]); 
        }

        if(array_key_exists("email", $this->arguments))
        {
            $this->model->data["email"] = $this->arguments["email"];
            $asoArr = array("email" => $this->model->data["email"], "password" => $this->model->data["password"]); 
        }

        if(array_key_exists("phone_number", $this->arguments))
        {
            $this->model->data["phone_number"] = $this->arguments["phone_number"];
            $asoArr = array("phone_number" => $this->model->data["phone_number"], "password" => $this->model->data["password"]); 
        }

        $userData = $this->dataAccessObject->select($asoArr);

        if($userData)
        {
            echo $this->view->renderElement("access_token", $userData["access_token"]);
        }
        else
        {
            echo $this->view->fail();
        }

        exit();
    }

    public function create()
    {
        if(empty($this->arguments) || 
           !isset($this->arguments) || 
           !is_array($this->arguments))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("username", $this->arguments))
        {
            echo $this->view->exception();
            exit();
        }


        if(!array_key_exists("phone_number", $this->arguments))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("email", $this->arguments))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("password", $this->arguments))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("user_type", $this->arguments) || !UserType::isValidValue($this->arguments["user_type"]))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("full_name", $this->arguments))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("avatar_url", $this->arguments))
        {
            echo $this->view->exception();
            exit();
        }

        if(empty($this->arguments["full_name"]) ||
           empty($this->arguments["phone_number"]) || 
           empty($this->arguments["password"])) 
        {
            echo $this->view->fail();
            exit();
        }

        if($this->usernameExist($this->arguments["username"])) 
        {
            echo $this->view->fail();
            exit();
        }

        if($this->phoneNumberExist($this->arguments["phone_number"])) 
        {
            echo $this->view->fail();
            exit();
        }

        if($this->emailExist($this->arguments["email"])) 
        {
            echo $this->view->fail();
            exit();
        }

        if (!filter_var($this->arguments["email"], FILTER_VALIDATE_EMAIL)) {
            echo $this->view->fail();
            exit();
        }

        if(strlen($this->arguments["password"]) < 6) 
        {
            echo $this->view->fail();
            exit();
        }

        if(!ctype_digit($this->arguments["phone_number"]) || strlen($this->arguments["phone_number"]) != 11) 
        {
            echo $this->view->fail();
            exit();
        }

        $operators = array("010", "011", "012", "015");
        if(!in_array(substr($this->arguments["phone_number"], 0, 3), $operators)) 
        {
            echo $this->view->fail();
            exit();
        }

        if(strlen($this->arguments["full_name"]) <= 5 || strlen($this->arguments["full_name"]) >= 33) 
        {
            echo $this->view->fail();
            exit();
        }

        $this->model->data["username"] = $this->arguments["username"];
        $this->model->data["phone_number"] = $this->arguments["phone_number"];
        $this->model->data["email"] = $this->arguments["email"];
        $this->model->data["password"] = hash('sha256', $this->arguments["password"]);
        $this->model->data["user_type"] = $this->arguments["user_type"];
        $this->model->data["full_name"] = filter_var($this->arguments["full_name"], FILTER_SANITIZE_STRING);
        $this->model->data["avatar_url"] = $this->arguments["avatar_url"];
        $this->model->data["access_token"] = hash('sha256', rand() . $this->arguments["phone_number"] . rand());


        if($this->dataAccessObject->insert($this->model->data))
        {
            echo $this->view->renderElement("access_token", $this->model->data["access_token"]);
        }
        else
        {
            echo $this->view->fail();
        }

        exit();
    }

    function getAll()
    {
        // the process of verifying who a user is
        if(!$this->authenticator->authenticate($this->arguments))
        {
            echo $this->view->fail();
            exit();
        }

        // what you have access to
        if(!$this->authorizer->authorize($this->authenticator->getUser(), UserType::ADMINISTRATOR))
        {
            echo $this->view->fail();
            exit();
        }
        
        $data = $this->dataAccessObject->selectAll();

        foreach ($data as $user) 
        {
            //unset($user["password"]); 
            unset($user["access_token"]); 
            $users[] = $user;
        }
        //renderArray
        echo $this->view->renderElements($users);
        exit();
    }

    private function phoneNumberExist($_phoneNumber) 
    {
        $asoArr = array("phone_number" => $_phoneNumber);
        return $this->dataAccessObject->select($asoArr);
    }

    private function emailExist($_email) 
    {
        $asoArr = array("email" => $_email);
        return $this->dataAccessObject->select($asoArr);
    }

    private function usernameExist($_username) 
    {
        $asoArr = array("username" => $_username);
        return $this->dataAccessObject->select($asoArr);
    }


}