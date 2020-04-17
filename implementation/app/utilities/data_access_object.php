<?php

class DataAccessObject
{
	public $db = null;
	public $tableName;
	public $columns = array();

	public function __construct($_tableName)
	{
		$this->tableName = $GLOBALS['configs']["tables"][$_tableName];
        $this->columns = $GLOBALS['configs']["columns"][$_tableName];
		$this->db = DatabaseConnector::getInstance()->getConnection();
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
		    $arr[] = $data;
		}

        return $arr;
	}

	public function insert($_array)
	{
		//print_r(array_keys($_array));
		//print_r($this->columns);
		//echo $query;

		if(array_keys($_array) != $this->columns)
			return false;

		$query = sprintf("INSERT INTO `" . $this->tableName . "` (%s) VALUES (\"%s\")", 
						implode(',',array_keys($_array)),
						implode('","',array_values($_array)));

        return $this->db->query($query);
	}	

	public function getTableName()
	{
		return $this->tableName;
	}

	public function getColumns()
	{
		return $this->columns;
	}
}