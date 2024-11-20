<?php
require('../includes/connectDB.php');
session_start();

// Redirect if not logged in as admin
if (!isset($_SESSION['admin_id']) || !$_SESSION['isLoggedIn']) {
    header('Location: /Rental-Food-Court/index.php');
    exit(); 
}

// Redirect if stall_id is not provided
if (!isset($_GET['stall_id'])) {
    header("Location: /Rental-Food-Court/admin_stall.php?errorMsg=Undefined Stall ID");
    exit();
}

$stall_id = $_GET['stall_id'];

// Delete the stall from the database
$query = "DELETE FROM stall WHERE stall_id='$stall_id'";
$result = mysqli_query($connection, $query);

// Redirect with success or error message
if ($result) {
    header("Location: /Rental-Food-Court/admin_stall.php?successMsg=Stall deleted successfully");
} else {
    header("Location: /Rental-Food-Court/admin_stall.php?errorMsg=Failed to delete stall");
}
?>
