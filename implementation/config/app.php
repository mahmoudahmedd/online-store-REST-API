<?php
return
[
    // Application name
    "name" => "Online Store API",

    // Application description
    "description" => "",

    // Application version
    "version" => "1.0.0",

    // Application URL
    "url" => "http://localhost/pro/",

    // Application e-mail
    "email" => "",

    /**
     *  Default Database Connection Name
     *  Here you may specify which of the database connections below you wish
     *  to use as your default connection for all database work.
     */
    "default_connection" => "mysql",

    /**
     *  Database Connections
     *  Here are each of the database connections setup for your application.
     *  to use as your default connection for all database work.
     */
    "connections" => 
    [
        "mysql" => 
        [
            "host"     => "localhost",
            "username" => "root",
            "password" => "",
            "db_name"  => "online_store_database",
        ],
    ],
];