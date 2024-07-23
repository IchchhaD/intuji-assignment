<?php

function dbConnect()
{
    try
    {
        $connect = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connect;
    }
    catch(PDOException $e)
    {
        die("Could not connect to the database: " . $e->getMessage());
    }
}

?>