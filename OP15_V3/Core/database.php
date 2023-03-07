<?php
$server = "localhost";
$database = "script";
$username = 'root';
$password = "";

function openConnection()
{
    global $server, $username, $password, $database;
    $connection = new mysqli($server, $username, $password, $database);
    return $connection;
}

function getQuery($sql)
{
    $connection = openConnection();
    $result = $connection -> query($sql);
    $result = $result -> fetch_all();
    $connection -> close();
    return $result;
}

function submitData($sql)
{
    $connection = openConnection();
    $connection -> query($sql);
    $connection -> close();
}