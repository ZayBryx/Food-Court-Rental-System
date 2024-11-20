<?php
require('../includes/connectDB.php');
session_start();

if (!isset($_SESSION['admin_id']) || !$_SESSION['isLoggedIn']) {
    header('Location: /Rental-Food-Court/index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /Rental-Food-Court/admin_stall.php");
    exit(); 
}

$stall_id = $_POST['stall_id'];
$name = $_POST['name'];
$price = $_POST['price'];
$available = isset($_POST['available']) ? 1 : 0;

$query = "UPDATE stall SET name='$name', price='$price', available='$available' WHERE stall_id='$stall_id'";
$result = mysqli_query($connection, $query);

if ($result) {
    header("Location: /Rental-Food-Court/admin_stall.php?successMsg=Stall updated successfully");
} else {
    header("Location: /Rental-Food-Court/admin_stall.php?errorMsg=Failed to update stall");
}
?>
