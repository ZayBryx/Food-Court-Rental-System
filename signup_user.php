<?php 
    $title = "Food Court Rental System | Signup User";
    require('template/header.php');
    require('template/nav.php');
?>

<main class="container mt-5">
    <h2 class="text-center mb-4">Sign Up User</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
        <?php if(isset($_GET['errorMsg'])){
                echo '<div class="alert alert-danger" role="alert">'. $_GET['errorMsg']. '</div>';
            }
            ?>
            <form action="/controller/registerUser.php" method="POST">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</main>



<?php require('template/footer.php'); ?>