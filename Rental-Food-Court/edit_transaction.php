<?php 
    $title = "Food Court Rental System | Admin Dashboard";
    require('template/header.php');
    require('template/admin_nav.php');
    require('includes/connectDB.php');
    // session_start();

    // if(!(isset($_SESSION['admin_id']) || $_SESSION['isLoggedIn'])){
    //     header('Location: /Rental-Food-Court/index.php');
    // }

    if(!(isset($_GET['transaction_id']))){
        header("Location: /Rental-Food-Court/dashboard.php?errorMsg=Undefine Stall Id");
    }

    $transaction_id = $_GET['transaction_id'];

    $sql = "SELECT * FROM transaction WHERE transaction_id = $transaction_id";
    $result = mysqli_query($connection, $sql);

    if(!$result){
        die("Query Error". mysqli_error($connection));
        exit();
    }

    $transaction = mysqli_fetch_assoc($result);
?>

<main class="container mt-5">
    <h2 class="text-center mb-4">Edit Transaction</h2>

    <form action="/Rental-Food-Court/controller/editTransaction.php?transaction_id=<?php echo $transaction_id; ?>" method="POST">
        <div class="mb-3">
            <label for="years_contract" class="form-label">Years Contract</label>
            <input type="text" class="form-control" id="years_contract" name="years_contract" value="<?php echo $transaction['years_contract']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="paid" class="form-label">Paid</label>
            <select class="form-select" id="paid" name="paid" required>
                <option value="1" <?php echo ($transaction['paid'] == 1) ? 'selected' : ''; ?>>Yes</option>
                <option value="0" <?php echo ($transaction['paid'] == 0) ? 'selected' : ''; ?>>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="balance" class="form-label">Balance</label>
            <input type="number" class="form-control" id="balance" name="balance" min="0" step="100" value="<?php echo $transaction['balance']; ?>" max="<?php echo $transaction['total_price']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="total_price" class="form-label">Total Price</label>
            <input type="number" class="form-control" id="total_price" min="0" step="100" name="total_price" value="<?php echo $transaction['total_price']; ?>"  required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $transaction['start_date']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Transaction</button>
    </form>
</main>

<?php require('template/footer.php'); ?>