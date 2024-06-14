<?php
// connect to database
include('../db/connect-db.php');

// get cate by id
$sql = "SELECT * FROM `categories` WHERE 1 "; 
$result = @mysqli_query($conn, $sql);

$cate = mysqli_fetch_assoc($result);

// close connection
mysqli_close($conn);

// -- handle post data
if ($_POST) {
    // -- get user data
    $cate_name = $_POST['cate_name'];
    $description = $_POST['description'];
    $fileImage = $_FILES['image'];

    // Initialize an empty image path
    $image_path = $cate['image'];

    // Handle new image upload
    if ($fileImage && $fileImage['error'] == 0) {
        // Move uploaded file from temporary folder to /uploads folder
        $image_path = '../uploads/' . basename($fileImage['name']);
        move_uploaded_file($fileImage['tmp_name'], $image_path);
    }

    // connect db
    include('../db/connect-db.php');

    // update db
    $sql = "UPDATE `categories` 
            SET `cate_name` = '$cate_name', `description` = '$description', `image` = '$image_path'
            WHERE `cate_id` = " . $cate['cate_id'];

    $result = mysqli_query($conn, $sql);

    // expected always successful
    
    // close connection
    mysqli_close($conn);

    // redirect to view all cars
    header('location: ../category/index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body> 
    <div class="container mt-5">
        <?php include('../shared/_navbar.php'); ?>
        <br/> <br/>
        <h1>Edit a category</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">Category ID</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Current Image</th>
                        <th scope="col">New Image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $cate['cate_id']; ?></th>
                        <td><input type="text" class="form-control border-0" name="cate_name" value="<?php echo $cate['cate_name']; ?>"></td>
                        <td><input type="text" class="form-control border-0" name="description" value="<?php echo $cate['description']; ?>"></td>
                        <td> 
                            <?php if (!empty($cate['image'])) : ?>
                                <img src="<?php echo $cate['image']; ?>" width="200px" alt="Current Image">
                            <?php endif; ?>
                        </td>
                        <td><input type="file" class="form-control-file" name="image"></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</body>

</html>
