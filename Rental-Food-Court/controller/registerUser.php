<?php
    require('../includes/connectDB.php');

    // Check if form is not submitted
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: /Rental-Food-Court/signup_user.php");
        exit();
    }

    // Collect form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if(empty($first_name) || empty($last_name) || empty($username) || empty($password) || empty($confirm_password)){
        header('Location: /Rental-Food-Court/signup_user?errorMsg=Fill all fields');
        exit();
    }

    // Validation: Check if passwords match
    if ($password !== $confirm_password) {
        header("Location: /Rental-Food-Court/signup_user.php?errorMsg=Passwords do not match");
        exit();
    }

    // Validation: Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: /Rental-Food-Court/signup_user.php?errorMsg=Invalid email format");
        exit();
    }

    // Validation: Check if username is already taken
    $check_username_query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($connection, $check_username_query);
    if (mysqli_num_rows($result) > 0) {
        header("Location: /Rental-Food-Court/signup_user.php?errorMsg=Username already exists");
        exit();
    }

    // Insert user into database
    $insert_user_query = "INSERT INTO user (first_name, last_name, email, username, password) VALUES ('$first_name', '$last_name', '$email', '$username', '$password')";
    if (mysqli_query($connection, $insert_user_query)) {
        header("Location: /Rental-Food-Court/index.php?successMsg=User registered successfully");
        exit();
    } else {
        header("Location: /Rental-Food-Court/signup_user.php?errorMsg=Failed to register user");
        exit();
    }
?>
