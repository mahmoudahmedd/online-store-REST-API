<?php
/**
 *  @file    index.php
 *  @date    30/03/2020
 *  @version 1.0.0
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
        
// Define root path
define('ROOT', realpath(__DIR__));

// Define directory separator
define('DS', DIRECTORY_SEPARATOR); 

// Bootstrap the application and do action
require_once(ROOT . DS . "bootstrap" . DS . "application.php");

// Run the application
Application::run();