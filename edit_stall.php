<?php 
    $title = "Food Court Rental System | Admin Dashboard";
    require('template/header.php');
    require('template/admin_nav.php');
    require('includes/connectDB.php');
    // session_start();

    // if(!(isset($_SESSION['admin_id']) || $_SESSION['isLoggedIn'])){
    //     header('Location: /index.php');
    // }

    if(!(isset($_GET['stall_id']))){
        header("Location: /dashboard.php?errorMsg=Undefine Stall Id");
    }

    $stall_id = $_GET['stall_id'];

    $sql = "SELECT * FROM stall WHERE stall_id = '$stall_id'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) === 0) {
        header("Location: /admin_stall.php?errorMsg=Stall not found");
        exit();
    }

    $row = mysqli_fetch_assoc($result);

?>

<main class="container mt-5">
    <h2 class="text-center mb-4">Edit Stall</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/controller/editStall.php" method="POST">
                <input type="hidden" name="stall_id" value="<?php echo $stall_id; ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="available" name="available" <?php echo $row['available'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="available">Available</label>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</main>



<?php require('template/footer.php');?>