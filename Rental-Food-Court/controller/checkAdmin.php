<?php 
    require('../includes/connectDB.php');
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result) <= 0){
        header('Location: ../login_admin.php?errorMsg=Invalid Username or Password');
        exit();
    }

    $row = mysqli_fetch_assoc($result);

    $_SESSION['isLoggedIn'] = true;
    $_SESSION['first_name'] = $row['fisrt_name'];
    $_SESSION['admin_id'] = $row['admin_id'];

    header("Location: ../admin_stall.php");
?>