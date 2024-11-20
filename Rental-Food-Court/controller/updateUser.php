<?php
require('../includes/connectDB.php');
session_start();

// Redirect to login page if user is not logged in
if(!(isset($_SESSION['isLoggedIn'], $_SESSION['user_id']) && $_SESSION['isLoggedIn'])) {
    header('Location: /Rental-Food-Court/login_user.php');
    exit(); 
}

// Redirect to user profile page if form is not submitted
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /Rental-Food-Court/user_profile.php");
    exit();
}

// Get user id from session
$user_id = $_SESSION['user_id'];

// Get form data
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$email = $_POST['email'] ?? '';
$username = $_POST['username'] ?? '';

// Validate form data
if (empty($first_name) || empty($last_name) || empty($email)) {
    header("Location: /Rental-Food-Court/user_profile.php?errorMsg=All fields are required");
    exit();
}

// Update user details in the database
$query = "UPDATE user SET first_name='$first_name', last_name='$last_name', email='$email', username ='$username' WHERE user_id='$user_id'";
$result = mysqli_query($connection, $query);

// Check if update was successful
if ($result) {
    header("Location: /Rental-Food-Court/user_profile.php?successMsg=Profile updated successfully");
} else {
    header("Location: /Rental-Food-Court/user_profile.php?errorMsg=Failed to update profile");
}
?>
