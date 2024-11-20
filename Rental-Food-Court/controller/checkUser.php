<?php
    require('../includes/connectDB.php');

    // Check if form is not submitted
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: /Rental-Food-Court/index.php");
        exit();
    }

    // Collect form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validation: Check if username and password are provided
    if (empty($username) || empty($password)) {
        header("Location: /Rental-Food-Court/index.php?errorMsg=Please provide both username and password");
        exit();
    }

    // Validate user credentials
    $check_user_query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connection, $check_user_query);

    // Check if user exists and credentials are correct
    if (mysqli_num_rows($result) == 1) {
        // Fetch user details
        $user_data = mysqli_fetch_assoc($result);
        
        // Start session and store user data
        session_start();
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['user_id'] = $user_data['user_id'];
        $_SESSION['first_name'] = $user_data['first_name'];

        header("Location: /Rental-Food-Court/user_rent.php");
        exit();
    } else {
        header("Location: /Rental-Food-Court/index.php?errorMsg=Invalid username or password");
        exit();
    }
?>
