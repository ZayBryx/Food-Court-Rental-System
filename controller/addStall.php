<?php
require('../includes/connectDB.php');
session_start();

if (!isset($_SESSION['admin_id']) || !$_SESSION['isLoggedIn']) {
    header('Location: /index.php');
    exit(); 
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /admin_stall.php");
    exit(); 
}

$name = $_POST['name'];
$price = $_POST['price'];


$query = "INSERT INTO stall (name, price) VALUES ('$name', $price)";
$result = mysqli_query($connection, $query);

if ($result) {
    header("Location: /admin_stall.php?successMsg=Stall added successfully");
} else {
    header("Location: /admin_stall.php?errorMsg=Failed to add stall ". mysqli_error($connection));
}
?>
