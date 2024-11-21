<?php 
    $title = "Food Court Rental System | User Transactions";
    require('template/header.php');
    require('template/user_nav.php');
    require('includes/connectDB.php');

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT balance FROM user WHERE user_id = '$user_id'";
    $result = mysqli_query($connection, $sql);
    $balance = mysqli_fetch_assoc($result);
?>

<main class="container mt-5">
    <h2 class="text-center mb-4">User Transactions History</h2>
    <?php if(isset($_GET['errorMsg'])){
                echo '<div class="alert alert-danger" role="alert">'. $_GET['errorMsg']. '</div>';
            }

            if(isset($_GET['successMsg'])){
                echo '<div class="alert alert-success" role="alert">'. $_GET['successMsg'] . '</div>';
            }
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>Years Contract</th>
                <th>Start Date</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>Paid</th>
                <th>Balance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM transaction WHERE user_id = '$user_id'";
                $result = mysqli_query($connection, $sql);

                if(mysqli_num_rows($result) === 0){
                    echo "<tr><td colspan='8'>No transactions found</td></tr>";
                }
                    while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td> <?php echo $row['years_contract'] ?></td>
                <td> <?php echo $row['start_date'] ?></td>
                <td> <?php echo $row['total_price'] ?></td>
                <td> <?php echo $row['payment_method'] ?></td>
                <td> <?php echo $row['paid']? "Yes" : "No" ?></td>
                <td> <?php echo $row['amount_paid'] ?></td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal<?php echo $row['transaction_id'] ?>">
                        Pay with Balance
                    </button>
                </td>
            </tr>

            <div class="modal fade" id="paymentModal<?php echo $row['transaction_id'] ?>" tabindex="-1" aria-labelledby="paymentModalLabel<?php echo $row['transaction_id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel<?php echo $row['transaction_id'] ?>">Payment Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to pay <?php echo $row['total_price'] ?> using your balance?</p>
                <p>Your current balance: <?php echo $balance['amount_paid'] ?></p>
                <form action="/controller/handlePayment.php?transaction_id=<?php echo $row['transaction_id'] ?>&total_price=<?php echo $row['total_price'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount to Pay:</label>
                        <input type="number" class="form-control" id="amount" name="amount" max="<?php echo $row['balance'] ?>" step="100" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Confirm Payment</button>
            </div>
            </form>
        </div>
    </div>
</div>

            <?php }?>
        </tbody>
    </table>
</main>

<?php require('template/footer.php'); ?>
