<?php
session_start();
// Get article ID from URL parameter
$article_id = $_GET['article_id'];

// Include database connection
include('../db/connect-db.php');

// Get article by ID
$sql = "SELECT * FROM articles WHERE article_id = '$article_id'";
$result = mysqli_query($conn, $sql);

// Fetch article data
$article = mysqli_fetch_assoc($result);

// Free result
mysqli_free_result($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $cate_id = $_POST['cate_id'];
    $create_at = $_POST['create_at'];
    $fileImage = $_FILES['image'];

    // Initialize an empty image path
    $image_path = $article['image'];

    // Handle image upload if a new image is provided
    if ($fileImage && $fileImage['error'] == 0) {
        // Move uploaded file to the /uploads directory
        $image_path = '../uploads/' . basename($fileImage['name']);
        move_uploaded_file($fileImage['tmp_name'], $image_path);
    }

    // Update the article in the database
    $sql = "UPDATE `articles` 
            SET `user_id` = '$user_id', `title` = '$title', `content` = '$content', `cate_id` = '$cate_id', `create_at` = '$create_at', `image` = '$image_path'
            WHERE `article_id` = '$article_id'";

    $result = mysqli_query($conn, $sql);

    // Close connection
    mysqli_close($conn);

    // Redirect to view all articles page
    header('Location: view.php');
    exit;
} else {
    // Close connection when not handling form submission
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include('../shared/_navbar.php'); ?>
    <br/><br/><br/>

    <h1>Edit Article</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="table-primary">
                    <th scope="col">Article ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Category ID</th>
                    <th scope="col">Create at</th>
                    <th scope="col">Current Image</th>
                    <th scope="col">New Image</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?php echo htmlspecialchars($article['article_id']); ?></th>
                    <td><input type="text" class="form-control border-0" name="user_id" value="<?php echo htmlspecialchars($article['user_id']); ?>"></td>
                    <td><input type="text" class="form-control border-0" name="title" value="<?php echo htmlspecialchars($article['title']); ?>"></td>
                    <td><textarea class="form-control border-0" name="content"><?php echo htmlspecialchars($article['content']); ?></textarea></td>
                    <td><input type="text" class="form-control border-0" name="cate_id" value="<?php echo htmlspecialchars($article['cate_id']); ?>"></td>
                    <td><input type="datetime-local" class="form-control border-0" name="create_at" value="<?php echo htmlspecialchars($article['create_at']); ?>"></td>
                    <td>
                        <?php if (!empty($article['image'])) : ?>
                            <img src="<?php echo htmlspecialchars($article['image']); ?>" width="200px" alt="Current Image">
                        <?php endif; ?>
                    </td>
                    <td><input type="file" class="form-control-file" name="image"></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Update Article</button>
    </form>
</body>
</html>
