<?php

class UserDA extends DataAccessObject
{
	public function __construct($_db)
	{
		$this->db = $_db;
		$this->tableName = "users";
	}

	public function getTableName()
	{
		return $this->tableName;
	}

	public function select($_array)
	{
		$i = 0;
		$arrayCount = count($_array);
		$query = "SELECT * FROM `" . $this->tableName . "` WHERE ";


		foreach($_array as $key => $value)
		{
			$value = $this->db->real_escape_string($value);
			

			if(++$i === $arrayCount) 
			{
				$query .= '`' . $key . '` = \'' . $value . "'";
			}
			else
			{
				$query .= '`' . $key . '` = \'' . $value . "' AND ";
			}
		}

        // If the query can't be executed (e.g: use of special characters in inputs)
        if(!$result = $this->db->query($query)) 
        {
            return 0;
        }

        $user = $result->fetch_assoc();

        return $user;
	}

	public function selectAll()
	{
		$query = "SELECT * FROM `" . $this->tableName;

        // If the query can't be executed (e.g: use of special characters in inputs)
        if(!$result = $this->db->query($query)) 
        {
            return 0;
        }

        while ($data = $result->fetch_assoc())
		{
		    $users[] = $data;
		}

        return $users;
	}

	public function insert($user)
	{
		$query = sprintf(
						"INSERT INTO `" . $this->tableName . "` 
						(`username`, `phone_number`, `email`, `password`, `user_type`, `full_name`, `avatar_url`, `access_token`) 
						VALUES 
						('%s', '%s', '%s', '%s', '%s','%s', '%s', '%s');", 
						$this->db->real_escape_string($user->username), 
						$this->db->real_escape_string($user->phoneNumber), 
						$this->db->real_escape_string($user->email), 
						$this->db->real_escape_string($user->password), 
						$this->db->real_escape_string($user->userType), 
						$this->db->real_escape_string($user->fullName), 
						$this->db->real_escape_string($user->avatarUrl),
						$this->db->real_escape_string($user->accessToken)
					);

        return $this->db->query($query);
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



// $aa = new UserDA(DatabaseConnector::getInstance()->getConnection());


// $aso_arr = array( 
//     "username"=>"test",  
//     "user_iad"=>10, 
//     "phone_number"=>"test"
// ); 
  



// if($aa->select($aso_arr)){

// 	echo "string";	
// }

// if($instance)
// 	echo "string";



?>