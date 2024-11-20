<?php 
    $title = "Food Court Rental System | Deposit";
    require('template/header.php');
    require('template/user_nav.php');
    require('includes/connectDB.php'); 

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT balance FROM user WHERE user_id = $user_id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $balance = $row['balance'];
?>

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Deposit Money</h2>
            <?php if(isset($_GET['errorMsg'])){
                echo '<div class="alert alert-danger" role="alert">'. $_GET['errorMsg']. '</div>';
            }

            if(isset($_GET['successMsg'])){
                echo '<div class="alert alert-success" role="alert">'. $_GET['successMsg'] . '</div>';
            }
    ?>
            <p>Your current balance: <b><?php echo $balance; ?></b></p>
            <form action="/Rental-Food-Court/controller/userDeposit.php" method="POST">
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount to Deposit</label>
                    <input type="text" class="form-control" id="amount" name="amount" required>
                </div>
                <button type="submit" class="btn btn-primary">Deposit</button>
            </form>
        </div>
    </div>
</main>

<?php require('template/footer.php'); ?>
