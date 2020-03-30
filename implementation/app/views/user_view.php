<?php

class UserView extends View
{
	public function renderArray($_users)
	{
		// putting data to JSONObject 
		$data["status"] = "ok";
		$data["data"] = $_users;

		return json_encode($data, JSON_PRETTY_PRINT);
	}
}
