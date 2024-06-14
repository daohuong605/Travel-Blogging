<?php
// Require login
include('../shared/_required-login.php');

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get article data
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $cate_id = $_POST['cate_id'];
    $create_at = $_POST['create_at'];

    // Get image data
    $fileImage = $_FILES['fileImage'];

    // Validate image
    if (empty($fileImage['name'])) {
        $errors['fileImage'] = 'Image is required!';
    }

    // If no errors, proceed
    if (empty($errors)) {
        // Move uploaded file from /tmp to /uploads 
        $image = '../uploads/' . $fileImage['name'];
        move_uploaded_file($fileImage['tmp_name'], $image);

        // Include database connection
        include('../db/connect-db.php');

        // Insert into database
        $sql = "INSERT INTO `articles` (`article_id`, `user_id`, `title`, `content`, `cate_id`, `create_at`, `image`) 
                VALUES (NULL,'$user_id', '$title', '$content', '$cate_id', '$create_at', '$image')";

        if (mysqli_query($conn, $sql)) {
            // Redirect to view all articles
            header('location: view.php');
            exit(); // Stop script execution after redirection
        } else {
            // Display error message
            $errors['database'] = 'Error: ' . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Article</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <?php include('../shared/_navbar.php'); ?>
    <br/> <br/> <br/>

    <h1 class="mt-4">Create a new Article</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="form-label" for="user_id">User ID</label>
            <input class="form-control" type="text" name="user_id" id="user_id">
        </div>
        <div class="form-group">
            <label class="form-label" for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title">
        </div>
        <div class="form-group">
            <label class="form-label" for="content">Content</label>
            <input class="form-control" type="text" name="content" id="content">
        </div>
        <div class="form-group">
            <label class="form-label" for="cate_id">Category ID</label>
            <input class="form-control" type="text" name="cate_id" id="cate_id">
        </div>
        <div class="form-group">
            <label class="form-label" for="create_at">Create at</label>
            <input class="form-control" type="datetime-local" name="create_at" id="create_at">
        </div>
        <div class="form-group">
            <label class="form-label" for="fileImage">File Image</label>
            <input class="form-control" type="file" name="fileImage" id="fileImage">
            <?php if (isset($errors['fileImage'])): ?>
                <p class="text-danger"><?php echo $errors['fileImage']; ?></p>
            <?php endif; ?>
        </div>
        <button class="btn btn-primary">Save</button>
        <?php if (isset($errors['database'])): ?>
            <p class="text-danger"><?php echo $errors['database']; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
