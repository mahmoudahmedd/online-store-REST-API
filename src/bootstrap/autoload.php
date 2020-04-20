<?php
//error_reporting(0);
$configs = $actions = array();

// Config dir
$configs = require_once(ROOT . DS . "config" . DS . "app.php");

// Models dir
require_once(ROOT . DS . "app" . DS . "models" . DS . "model.php");

// Views dir
require_once(ROOT . DS . "app" . DS . "views" . DS . "view.php");

// Utilities dir
require_once(ROOT . DS . "app" . DS . "utilities" . DS . "database_connection.php");
require_once(ROOT . DS . "app" . DS . "utilities" . DS . "data_access_object.php");
require_once(ROOT . DS . "app" . DS . "utilities" . DS . "authorizer.php");
require_once(ROOT . DS . "app" . DS . "utilities" . DS . "authenticator.php");

// Controllers dir
require_once(ROOT . DS . "app" . DS . "controllers" . DS . "controller.php");
require_once(ROOT . DS . "app" . DS . "controllers" . DS . "user_controller.php");