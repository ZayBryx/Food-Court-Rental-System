<?php
    session_start();
    require('../includes/connectDB.php');

    if(!(isset($_SESSION['isLoggedIn'], $_SESSION['user_id']) && $_SESSION['isLoggedIn'])) {
        header('Location: /Rental-Food-Court/login_user.php');
        exit(); 
    }

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: /Rental-Food-Court/user_transaction.php");
        exit();
    }

    if(empty($_POST['start_date']) || empty($_POST['years']) || empty($_POST['payment_method']) || empty($_POST['stall_id'])) {
        header("Location: /Rental-Food-Court/user_transaction.php?stall_id={$_POST['stall_id']}&errorMsg=All fields are required");
        exit();
    }

    $start_date = mysqli_real_escape_string($connection, $_POST['start_date']);
    $years = mysqli_real_escape_string($connection, $_POST['years']);
    $payment_method = mysqli_real_escape_string($connection, $_POST['payment_method']);
    $stall_id = mysqli_real_escape_string($connection, $_POST['stall_id']);

    $start_date_obj = new DateTime($start_date);
    $end_date_obj = clone $start_date_obj;
    $end_date_obj->modify("+{$years} years");
    $end_date = $end_date_obj->format('Y-m-d');

    $user_id = $_SESSION['user_id'];

    $sql_stall = "SELECT price FROM stall WHERE stall_id = '$stall_id'";
    $result_stall = mysqli_query($connection, $sql_stall);

    if(!$result_stall || mysqli_num_rows($result_stall) === 0) {
        header("Location: /Rental-Food-Court/user_transaction.php?stall_id={$_POST['stall_id']}&errorMsg=Stall not found");
        exit();
    }

    $row_stall = mysqli_fetch_assoc($result_stall);
    $total_price = $row_stall['price'] * $years;

    $sql_insert = "INSERT INTO transaction (stall_id, user_id, years_contract, start_date, payment_method, total_price, amount_paid) 
                    VALUES ('$stall_id', '$user_id', '$years', '$start_date', '$payment_method', '$total_price', '$total_price')";
    
    $result_insert = mysqli_query($connection, $sql_insert);

    if(!$result_insert) {
        header("Location: /Rental-Food-Court/user_transaction.php?stall_id={$_POST['stall_id']}&errorMsg=Failed to rent stall");
        exit();
    }

    header("Location: /Rental-Food-Court/user_transaction.php?successMsg=Stall rented successfully");
?>
