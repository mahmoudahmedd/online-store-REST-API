<?php
class UserController extends Controller
{
    public function __construct($_parameters)
    {
        $this->parameters = $_parameters;

        $this->model = new UserModel();
        $this->view = new UserView();
        $this->dataAccess = new UserDA(DatabaseConnector::getInstance()->getConnection());
    }

    public function login()
    {
        if(empty($this->parameters) || !isset($this->parameters) || !is_array($this->parameters))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("email", $this->parameters))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("password", $this->parameters))
        {
            echo $this->view->exception();
            exit();
        }

        $this->model->email = $this->parameters["email"];
        $this->model->password = hash('sha256', $this->parameters["password"]);

        $asoArr = array("email" => $this->model->email, "password" => $this->model->password); 

        $userData = $this->dataAccess->select($asoArr);

        if($userData)
        {
            $this->model->accessToken = $userData["access_token"];
            echo $this->view->renderObject("access_token", $this->model->accessToken);
        }
        else
        {
            echo $this->view->fail();
        }

        exit();
    }

    public function create()
    {
        if(empty($this->parameters) || 
           !isset($this->parameters) || 
           !is_array($this->parameters))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("username", $this->parameters))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("phone_number", $this->parameters))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("email", $this->parameters))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("password", $this->parameters))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("user_type", $this->parameters) || !UserType::isValidValue($this->parameters["user_type"]))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("full_name", $this->parameters))
        {
            echo $this->view->exception();
            exit();
        }

        if(!array_key_exists("avatar_url", $this->parameters))
        {
            echo $this->view->exception();
            exit();
        }

        if(empty($this->parameters["full_name"]) ||
           empty($this->parameters["phone_number"]) || 
           empty($this->parameters["password"])) 
        {
            echo $this->view->fail();
            exit();
        }

        if($this->usernameExist($this->parameters["username"])) 
        {
            echo $this->view->fail();
            exit();
        }

        if($this->phoneNumberExist($this->parameters["phone_number"])) 
        {
            echo $this->view->fail();
            exit();
        }

        if($this->emailExist($this->parameters["email"])) 
        {
            echo $this->view->fail();
            exit();
        }

        if (!filter_var($this->parameters["email"], FILTER_VALIDATE_EMAIL)) {
            echo $this->view->fail();
            exit();
        }

        if(strlen($this->parameters["password"]) < 6) 
        {
            echo $this->view->fail();
            exit();
        }

        if(!ctype_digit($this->parameters["phone_number"]) || strlen($this->parameters["phone_number"]) != 11) 
        {
            echo $this->view->fail();
            exit();
        }

        $operators = array("010", "011", "012", "015");
        if(!in_array(substr($this->parameters["phone_number"], 0, 3), $operators)) 
        {
            echo $this->view->fail();
            exit();
        }

        if(strlen($this->parameters["full_name"]) <= 5 || strlen($this->parameters["full_name"]) >= 33) 
        {
            echo $this->view->fail();
            exit();
        }

        $this->model->username = $this->parameters["username"];
        $this->model->phoneNumber = $this->parameters["phone_number"];
        $this->model->email = $this->parameters["email"];
        $this->model->password = hash('sha256', $this->parameters["password"]);
        $this->model->userType = $this->parameters["user_type"];
        $this->model->fullName = filter_var($this->parameters["full_name"], FILTER_SANITIZE_STRING);
        $this->model->avatarUrl = $this->parameters["avatar_url"];
        $this->model->accessToken = hash('sha256', rand() . $this->parameters["phone_number"] . rand());


        if($this->dataAccess->insert($this->model))
        {
            echo $this->view->renderObject("access_token", $this->model->accessToken);
        }
        else
        {
            echo $this->view->fail();
        }

        exit();
    }

    function getAll()
    {
        $data = $this->dataAccess->selectAll();

        foreach ($data as $user) 
        {
            unset($user["password"]); 
            unset($user["access_token"]); 
            $users[] = $user;
        }

        echo $this->view->renderArray($users);
        exit();
    }

    private function phoneNumberExist($_phoneNumber) 
    {
        $asoArr = array("phone_number" => $_phoneNumber);
        return $this->dataAccess->select($asoArr);
    }

    private function emailExist($_email) 
    {
        $asoArr = array("email" => $_email);
        return $this->dataAccess->select($asoArr);
    }

    private function usernameExist($_username) 
    {
        $asoArr = array("username" => $_username);
        return $this->dataAccess->select($asoArr);
    }
}