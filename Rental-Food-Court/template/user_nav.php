<?php
    session_start();

    if(!(isset($_SESSION['user_id']) && $_SESSION['isLoggedIn'])) {
        header("Location: /Rental-Food-Court/index.php?errorMsg=Unathorized");
        exit();
    }
?>

<nav class="navbar navbar-expand-lg navbar-light bg-primary p-3">
    <div class="container-fluid">
        <a class="navbar-brand text-white font-cooper" href="/Rental-Food-Court/user_rent.php"><b>Food Court Rental</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php 
                            if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
                                echo '<i class="fa-solid fa-user"></i>';
                                // Display user's first name
                                echo $_SESSION['first_name'];
                            } else {
                                // Redirect to login page if user is not logged in
                                header('Location: /Rental-Food-Court/login_user.php');
                                exit(); 
                            }
                        ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/Rental-Food-Court/user_profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="/Rental-Food-Court/user_deposit.php">Deposit</a></li>
                        <li><a class="dropdown-item" href="/Rental-Food-Court/user_transaction.php">Transaction</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/Rental-Food-Court/controller/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
