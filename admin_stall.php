<?php 
    $title = "Food Court Rental System | Admin Dashboard";
    require('template/header.php');
    require('template/admin_nav.php');
    require('includes/connectDB.php');
    // session_start();

    // if(!(isset($_SESSION['admin_id']) || $_SESSION['isLoggedIn'])){
    //     header('Location: /index.php');
    // }
?>

<main class="container mt-5">
    <h2 class="text-center mb-4">Stalls</h2>
    
    <div class="d-flex flex-row-reverse justify-content-between align-items-center">
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addStallModal">
        Add Stall
    </button>
    <?php if(isset($_GET['errorMsg'])){
                echo '<div class="alert alert-danger" role="alert">'. $_GET['errorMsg']. '</div>';
            }

            if(isset($_GET['successMsg'])){
                echo '<div class="alert alert-success" role="alert">'. $_GET['successMsg'] . '</div>';
            }
    ?>
    
    
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Stall ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Available</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT * FROM stall";
                $result = mysqli_query($connection, $sql);

                while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $row['stall_id']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['price']?></td>
                <td><?php echo $row['available'] ? "Yes" : "No"?></td>
                <td>
                    <a href="/edit_stall.php?stall_id=<?php echo $row['stall_id']?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="/controller/deleteStall.php?stall_id=<?php echo $row['stall_id']?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>

            <?php 
                }
            ?>
        </tbody>
    </table>
</main>

<div class="modal fade" id="addStallModal" tabindex="-1" aria-labelledby="addStallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStallModalLabel">Add Stall</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/controller/addStall.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Stall Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require('template/footer.php'); ?>
