<?php

class DataAccessObject
{
	private $db = null;
	private $tableName;

	public function getTableName()
	{
		return $this->tableName;
	}
}