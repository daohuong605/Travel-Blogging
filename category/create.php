<?php
// require login
include('../shared/_required-login.php');

// connect db
include('../db/connect-db.php');

// query for all categories
//$sql = "SELECT * FROM `categories` WHERE 1 "; 
//$result = mysqli_query($conn, $sql);
//$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// initial values
$cate_id = '';
if (isset($_GET['cate_id'])) {
    $cate_id = $_GET['cate_id'];
}

$cate_name = '';
$description = '';
$image = '';


$errors = []; // [input => error message]

if ($_POST) {
    // -- get user data
    if (isset($_POST['cate_name'])) {
        $cate_name = $_POST['cate_name'];
    }
    if (isset($_POST['description'])) {
        $description = $_POST['description'];
    }

    $fileImage = $_FILES['fileImage'];
    // print_r($fileImage); 

 // -- validate data
    if (empty($cate_name)) {
        $errors['cate_name'] = 'Category name is required!';
    }
    if (empty($description)) {
        $errors['description'] = 'Description is required!';
    }

    if (empty($fileImage['name'])) {
        $errors['fileImage'] = 'Image is required!';
    }

    // if no errors
    if (empty($errors)) {
        // move uploaded file from /tmp to /uploads -
        $image = '../uploads/'.$fileImage['name'];
        move_uploaded_file($fileImage['tmp_name'], $image);

        // insert into db

        $sql = "INSERT INTO `categories` (`cate_id`, `cate_name`, `description`, `image`) 
                VALUES (NULL, '$cate_name', '$description', '$image'); ";

        $result = @mysqli_query($conn, $sql);
        // expected always successful
        
        // close connection
        @mysqli_close($conn);

        // redirect to view all article
        header("location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body class="container">

    <?php include('../shared/_navbar.php'); ?>
    <br/> <br/> <br/>
    <h1>Create a new category</h1>
    
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label class="form-label" for="cate_name">Category Name</label>
            <input class="form-control" type="text" name="cate_name" id="cate_name" value="<?php echo $cate_name; ?>">

            <?php if(isset($errors['cate_name'])): ?>
                <p class="text-danger"><?php echo $errors['cate_name']; ?></p>
            <?php endif ?>
        </div>

        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <input class="form-control" type="text" name="description" id="description" value="<?php echo $description; ?>">

            <?php if(isset($errors['description'])): ?>
                <p class="text-danger"><?php echo $errors['description']; ?></p>
            <?php endif ?>
        </div>

        <div class="form-group">
            <label class="form-label" for="fileImage">File Image</label>
            <input class="form-control" type="file" name="fileImage" id="fileImage">
            
            <?php if (isset($errors['fileImage'])): ?>
                <p class="text-danger"><?php echo $errors['fileImage']; ?></p>
            <?php endif; ?>

        </div> 


        <div>
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
    </body>
</html>