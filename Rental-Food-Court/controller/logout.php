<?php 
    session_start();
    $_SESSION = array();
    session_destroy();
    header('Location: /Rental-Food-Court/index.php');
    exit();
?>