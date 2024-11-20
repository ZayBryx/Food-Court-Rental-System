<?php 
    $title = "Food Court Rental System | Admin Dashboard";
    require('template/header.php');
    require('template/admin_nav.php');
    require('includes/connectDB.php');

    $sql = "SELECT 
                t.transaction_id,
                t.stall_id,
                CONCAT(u.first_name, ' ', u.last_name) AS name,
                t.years_contract,
                t.start_date,
                t.paid,
                t.amount_paid,
                t.total_price,
                t.transaction_date
            FROM 
                transaction t
            JOIN 
                user u ON t.user_id = u.user_id";

    $result = mysqli_query($connection, $sql);

    if (!$result) {
        $error_message = "Error executing query: " . mysqli_error($connection);
        $transactions = [];
    } else {
        $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?>

<main class="container mt-5">
    <h2 class="text-center mb-4">Transactions</h2>
    <?php 
    if (isset($_GET['errorMsg'])) {
        echo '<div class="alert alert-danger" role="alert">'. htmlspecialchars($_GET['errorMsg']) . '</div>';
    }

    if (isset($_GET['successMsg'])) {
        echo '<div class="alert alert-success" role="alert">'. htmlspecialchars($_GET['successMsg']) . '</div>';
    }

    if (isset($error_message)) {
        echo '<div class="alert alert-danger" role="alert">'. htmlspecialchars($error_message) . '</div>';
    }
    ?>

    <table class="table">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Stall ID</th>
                <th>User Name</th>
                <th>Years Contract</th>
                <th>Paid</th>
                <th>Balance</th>
                <th>Total Price</th>
                <th>Start Date</th>
                <th>Transaction Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($transactions)) { ?>
                <tr>
                    <td colspan="10" class="text-center">No transactions found.</td>
                </tr>
            <?php } else { 
                foreach ($transactions as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['transaction_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['stall_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['years_contract']); ?></td>
                        <td><?php echo $row['paid'] ? 'Yes' : 'No'; ?></td>
                        <td><?php echo htmlspecialchars($row['balance']); ?></td>
                        <td><?php echo htmlspecialchars($row['total_price']); ?></td>
                        <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['transaction_date']); ?></td>
                        <td>
                            <a href="/Rental-Food-Court/edit_transaction.php?transaction_id=<?php echo htmlspecialchars($row['transaction_id']); ?>" class="btn btn-primary btn-sm">Update</a>
                            <a href="/Rental-Food-Court/controller/deleteTransaction.php?transaction_id=<?php echo htmlspecialchars($row['transaction_id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
            <?php } } ?>
        </tbody>
    </table>
</main>

<?php require('template/footer.php'); ?>
