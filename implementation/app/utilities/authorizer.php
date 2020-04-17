<?php

class Authorizer
{
	private $dataAccessObject;
	
	/**
	* Authorize
	*
	* @return boolean
	*/
	public function authorize($_user, $_userType)
	{
        if($_user && $_user['user_type'] == $_userType)
        	return true;
        else
        	return false;
	}
}