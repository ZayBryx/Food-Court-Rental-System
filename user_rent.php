<?php 
    $title = "Food Court Rental System";
    require('template/header.php');
    require('includes/connectDB.php');
?>
<?php require('template/user_nav.php'); ?>

<main class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2>Available Stalls:</h2>
            <div class="card-container d-flex flex-wrap gap-4">
                <?php 
                    $sql = "SELECT * FROM stall WHERE available = true";
                    $result = mysqli_query($connection, $sql);

                    if(!$result){
                        die('Query Error'. mysqli_error($connection));
                        exit();
                    }

                    if(mysqli_num_rows($result) === 0){
                        echo "<h3> No Available Stall </h3>";
                    }

                    while($row = mysqli_fetch_assoc($result)){
                ?>
                <div class="card mb-3" style="width: 30%;">
                    <img src="img/image.png" class="card-img-top" alt="<?php echo $row['name'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name'] ?></h5>
                        <p class="card-text">Price: $<?php echo $row['price'] ?> per year</p>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#rentModal<?php echo $row['stall_id']; ?>" class="btn btn-primary">Rent</a>
                    </div>
                </div>

                <div class="modal fade" id="rentModal<?php echo $row['stall_id']; ?>" tabindex="-1" aria-labelledby="rentModalLabel<?php echo $row['stall_id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rentModalLabel<?php echo $row['stall_id']; ?>">Rent Stall</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/controller/processRent.php" method="POST">
                    <input type="hidden" name="stall_id" value="<?php echo $row['stall_id']; ?>">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date:</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="years" class="form-label">Number of Years:</label>
                        <input type="number" class="form-control" id="years" name="years" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method:</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="" selected disabled>Select Payment Method</option>
                            <option value="Gcash">Gcash</option>
                            <option value="Cash">Cash</option>
                            <option value="Credit Card">Credit Card</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Rent Stall</button>
                </form>
            </div>
        </div>
    </div>
</div>
                <?php }?>
            </div>
        </div>
    </div>
</main>

<?php require('template/footer.php'); ?>
