<?php
    session_start();
    require('../includes/connectDB.php');

    // Check if user is logged in
    if (!isset($_SESSION['isLoggedIn'], $_SESSION['user_id']) || !$_SESSION['isLoggedIn']) {
        header('Location: /Rental-Food-Court/login_user.php');
        exit(); 
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: /Rental-Food-Court/user_transaction.php");
        exit();
    }

    // Retrieve form data
    $transaction_id = $_GET['transaction_id'];
    $total_price = $_GET['total_price'];
    $amount_paid = $_POST['amount'];


    $sql_update = "UPDATE transaction SET balance = balance - $amount_paid WHERE transaction_id = $transaction_id;";
    $result = mysqli_query($connection, $sql_update);

    if(!$result){
        die("Query Error". mysqli_error($connection));
        exit();
    }

    $sql_get = "SELECT balance, paid, user_id FROM transaction WHERE transaction_id = '$transaction_id'";
    $getResult = mysqli_query($connection, $sql_get);
    $transaction_row = mysqli_fetch_assoc($getResult);
    $user_id = $transaction_row['user_id'];

    if($transaction_row['balance'] <= 0){
        $sql_update_paid = "UPDATE transaction SET paid = 1 WHERE transaction_id = $transaction_id";
        $result_update_paid = mysqli_query($connection, $sql_update_paid);
    }

    $sql_user = "UPDATE user SET balance = balance - $amount_paid WHERE user_id = $user_id";
    $user_result = mysqli_query($connection, $sql_user);

    header('Location: /Rental-Food-Court/user_transaction.php?successMsg=Paid Successfully');

?>
