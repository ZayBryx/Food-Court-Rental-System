<?php 
    $title = "Food Court Rental System | Login User";
    require('template/header.php');
    require('template/nav.php');
    
?>

<main class="container mt-5">
    <h2 class="text-center mb-4">Login</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
        <?php if(isset($_GET['errorMsg'])){
                echo '<div class="alert alert-danger" role="alert">'. $_GET['errorMsg']. '</div>';
            }
            ?>
            <form action="/Rental-Food-Court/controller/checkUser.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</main>


<?php require('template/footer.php'); ?>