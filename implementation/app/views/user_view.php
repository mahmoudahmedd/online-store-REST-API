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

// $user = new UserModel();

// $user->username = "test";
// $user->phoneNumber = "test";
// $user->email = "test";
// $user->password = "test";
// $user->userType = "test";
// $user->ownerName = "test";
// $user->logo = "test";
// $user->accessToken = "test";

// $aa = new UserView();
// echo $aa->renderAll($user);