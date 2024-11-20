<?php 
    $title = "Food Court Rental System | Login Admin";
    require('template/header.php');
    require('template/nav.php');
    session_start();

    if(isset($_SESSION['admin_id']) && $_SESSION['isLoggedIn']) {
        header("Location: /Rental-Food-Court/admin_stall.php");
        exit();
    }
?>

<main class="container mt-5">
    <h2 class="text-center mb-4">Login Admin</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php if(isset($_GET['errorMsg'])){
                echo '<div class="alert alert-danger" role="alert">'. $_GET['errorMsg']. '</div>';
            }
            ?>
            <form action="/Rental-Food-Court/controller/checkAdmin.php" method="POST">
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