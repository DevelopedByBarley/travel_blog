<?php
function getConnection()
{
    $serverName = "localhost";
    $username = "Barley";
    $password = "Csak1enter";
    $dbName = "travel_blog";

    try {
        $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
