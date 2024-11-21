<?php
    session_start();
    require('../includes/connectDB.php');

    // Redirect to login page if user is not logged in
    if(!(isset($_SESSION['isLoggedIn'], $_SESSION['user_id']) && $_SESSION['isLoggedIn'])) {
        header('Location: /login_user.php');
        exit(); 
    }
    
    // Redirect to user profile page if form is not submitted
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: /user_profile.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $amount = $_POST['amount'];

    if (empty($amount)) {
        header("Location: /user_profile.php?errorMsg=Balance is required");
        exit();
    }

    $query_current = "SELECT balance FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($connection, $query_current);

    if(!$result){
        die("Query Error". mysqli_error($connection));
        exit();
    }

    $row = mysqli_fetch_assoc($result);

    $current_balance = $row['balance'];
    $new_balance = $amount + $current_balance;


    $sql = "UPDATE user SET balance = '$new_balance' WHERE user_id = '$user_id'";
    $result = mysqli_query($connection, $sql);

    if(!$result){
        die("Query Error". mysqli_error($connection));
        exit();
    }

    header("Location: /user_deposit.php?successMsg=Successfully deposit");

?>