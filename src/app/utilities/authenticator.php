<?php

class Authenticator
{
	private $dataAccessObject;
	private $user;

	/**
	* Authenticate
	*
	* @return boolean
	*/
	public function authenticate($_arguments)
	{
		$this->dataAccessObject = new DataAccessObject("users");

		if(!isset($_arguments) || empty($_arguments) || !is_array($_arguments))
		    return false;

		if(!array_key_exists("access_token", $_arguments))
		    return false;

		$arr = array("access_token" => $_arguments["access_token"]);
		$user = $this->dataAccessObject->select($arr);

		if($user)
		{
			$this->user = $user;
			return true;
		}
		else
			return false;
	}

	public function getUser()
	{
		return $this->user;
	}

}