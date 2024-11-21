<?php
    session_start();

    if(!(isset($_SESSION['admin_id']) && $_SESSION['isLoggedIn'])) {
        header("Location: /login_admin.php?errorMsg=Unathorized");
        exit();
    }
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/admin_stall.php">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/admin_stall.php">Stalls</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin_transaction.php">Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/controller/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
