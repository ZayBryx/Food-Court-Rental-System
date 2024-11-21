<?php 
    $title = "Food Court Rental System | User Profile";
    require('template/header.php');
    require('template/user_nav.php');
    require('includes/connectDB.php');

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user WHERE user_id = $user_id";
    $result = mysqli_query($connection, $sql);

    if(!$result){
        die('Query Error '. mysqli_error($connection));
    }

    $row = mysqli_fetch_assoc($result);
?>

<main class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
            <?php if(isset($_GET['errorMsg'])){
                echo '<div class="alert alert-danger" role="alert">'. $_GET['errorMsg']. '</div>';
            }

            if(isset($_GET['successMsg'])){
                echo '<div class="alert alert-success" role="alert">'. $_GET['successMsg'] . '</div>';
            }
    ?>
                <div class="card-body">
                    <h5 class="card-title">User Profile</h5>
                    <p class="card-text">Here you can view and manage your profile details.</p>
                    <ul class="list-group">
                        <li class="list-group-item"><b>First Name: </b><?php echo $row['first_name'] ?></li>
                        <li class="list-group-item"><b>Last Name: </b><?php echo $row['last_name'] ?></li>
                        <li class="list-group-item"><b>Email: </b><?php echo $row['email'] ?></li>
                        <li class="list-group-item"><b>Username: </b><?php echo $row['username'] ?></li>
                    </ul>
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                    <a href="/controller/logout.php" class="btn btn-danger mt-3">Logout</a>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/controller/updateUser.php" method="post">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $row['first_name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $row['last_name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="email" value="<?php echo $row['username'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require('template/footer.php') ?>;
