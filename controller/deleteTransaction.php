<?php
    session_start();
    require('../includes/connectDB.php');

    // Check if user is logged in
    if (!isset($_SESSION['admin_id']) || !$_SESSION['isLoggedIn']) {
        header('Location: /login_admin.php');
        exit(); 
    }

    // Check if transaction_id is provided
    if (!isset($_GET['transaction_id'])) {
        header("Location: /admin_transaction.php?errorMsg=Transaction ID is missing");
        exit();
    }

    $transaction_id = $_GET['transaction_id'];

    // Validate transaction_id
    // Here, you can implement additional validation if needed

    // Delete transaction from database
    $sql = "DELETE FROM transaction WHERE transaction_id = $transaction_id";
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        // Handle error if deletion fails
        header("Location: /admin_transaction.php?errorMsg=Failed to delete transaction");
        exit();
    }

    // Redirect to admin transactions page with success message
    header("Location: /admin_transaction.php?successMsg=Transaction deleted successfully");
?>
