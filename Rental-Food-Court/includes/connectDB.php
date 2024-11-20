<?php 
$serverName = 'localhost';
$userName = 'root';
$password = '';
$database = "food_court_rental";

$connection = new mysqli($serverName, $userName, $password, $database);

if ($connection->connect_error){
    die("Connection Error". $conn->connect_error);
}

?>
