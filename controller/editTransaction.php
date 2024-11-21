<?php
    session_start();
    require('../includes/connectDB.php');

    // Check if user is logged in
    if (!isset($_SESSION['admin_id']) || !$_SESSION['isLoggedIn']) {
        header('Location: /index.php');
        exit(); 
    }

    // Check if transaction_id is provided
    if (!isset($_GET['transaction_id'])) {
        header("Location: /dashboard.php?errorMsg=Undefined Transaction ID");
        exit();
    }

    $transaction_id = $_GET['transaction_id'];

    // Retrieve transaction details from database
    $sql = "SELECT * FROM transaction WHERE transaction_id = $transaction_id";
    $result = mysqli_query($connection, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {
        header("Location: /admin_transaction.php?errorMsg=Transaction not found");
        exit();
    }

    $transaction = mysqli_fetch_assoc($result);

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve form data
        $years_contract = $_POST['years_contract'];
        $paid = $_POST['paid'];
        $balance = $_POST['balance'];
        $total_price = $_POST['total_price'];
        $start_date = $_POST['start_date'];

        // Update transaction in database
        $update_sql = "UPDATE transaction SET years_contract = '$years_contract', paid = '$paid', balance = '$balance', total_price = '$total_price', start_date = '$start_date' WHERE transaction_id = $transaction_id";
        $update_result = mysqli_query($connection, $update_sql);

        if ($update_result) {
            // Redirect back to admin dashboard with success message
            header("Location: /admin_transaction.php?successMsg=Transaction updated successfully");
            exit();
        } else {
            // Handle error if update fails
            header("Location: /edit_transaction.php?transaction_id=$transaction_id&errorMsg=Failed to update transaction");
            exit();
        }
    }
?>
