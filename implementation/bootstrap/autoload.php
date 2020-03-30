<?php
$configs = $actions = array();

// Config dir
$configs = require_once(ROOT . DS . "config" . DS . "app.php");

// Models dir
require_once(ROOT . DS . "app" . DS . "models" . DS . "user_model.php");

// Views dir
require_once(ROOT . DS . "app" . DS . "views" . DS . "view.php");
require_once(ROOT . DS . "app" . DS . "views" . DS . "user_view.php");

// Utilities dir
require_once(ROOT . DS . "app" . DS . "utilities" . DS . "data_access_object.php");
require_once(ROOT . DS . "app" . DS . "utilities" . DS . "database_connection.php");
require_once(ROOT . DS . "app" . DS . "utilities" . DS . "user_da.php");

// Controllers dir
require_once(ROOT . DS . "app" . DS . "controllers" . DS . "controller.php");
require_once(ROOT . DS . "app" . DS . "controllers" . DS . "user_controller.php");