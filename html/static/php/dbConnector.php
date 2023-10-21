<?php 
    function connectDB() {
        // connection to DB
        $dbHostname = "db";
        $dbname = "postgres";
        $dbUsername = "postgres";
        $dbPassword = "password";
    
        $dsn = "pgsql:host=$dbHostname;dbname=$dbname";
        $db = new PDO($dsn, $dbUsername, $dbPassword);
        return $db;
    }