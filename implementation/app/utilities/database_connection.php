<?php

// Singleton to connect db.
class DatabaseConnector
{
  // Hold the class instance.
  private static $instance = null;
  private $conn;
  
  private $host;
  private $username;
  private $password;
  private $dbName;
   
  // The db connection is established in the private constructor.
  private function __construct()
  {
    $this->host     = $GLOBALS['configs']["connections"]["mysql"]["host"];
    $this->username = $GLOBALS['configs']["connections"]["mysql"]["username"];
    $this->password = $GLOBALS['configs']["connections"]["mysql"]["password"];
    $this->dbName   = $GLOBALS['configs']["connections"]["mysql"]["db_name"];

    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbName);
  }
  
  public static function getInstance()
  {
    if(!self::$instance)
    {
      self::$instance = new DatabaseConnector();
    }
   
    return self::$instance;
  }
  
  public function getConnection()
  {
    return $this->conn;
  }
}