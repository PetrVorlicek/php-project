<?php 
require __DIR__."/../../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../..");
$dotenv->load();

function connectDB()
{
    // connection to DB
    $dbUsername = $_ENV["POSTGRES_USER"];
    $dbPassword = $_ENV["POSTGRES_PASSWORD"];

    $dsn = "pgsql:host=db;dbname=postgres";
    $db = new PDO($dsn, $dbUsername, $dbPassword);
    return $db;
}