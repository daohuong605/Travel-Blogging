<?php
session_start();

// Include database connection
include('../db/connect-db.php');

// Require login
include('../shared/_required-login.php');

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (isset($_SESSION['user_id'])) {
        // Get article data
        $user_id = $_SESSION['user_id'];
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $cate_id = trim($_POST['cate_id']);

        // Get image data
        $fileImage = $_FILES['fileImage'];

        // Validate title and category
        if (empty($title)) {
            $errors['title'] = 'Title is required!';
        }

        if (empty($cate_id)) {
            $errors['cate_id'] = 'Category is required!';
        }

        // Validate image
        if (empty($fileImage['name'])) {
            $errors['fileImage'] = 'Image is required!';
        } else {
            // Check if the file is an image
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = pathinfo($fileImage['name'], PATHINFO_EXTENSION);

            if (!in_array($fileExtension, $allowedExtensions)) {
                $errors['fileImage'] = 'Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.';
            }
        }

        // If no errors, proceed
        if (empty($errors)) {
            // Move uploaded file from /tmp to /uploads 
            $image = '../uploads/' . basename($fileImage['name']);
            if (!move_uploaded_file($fileImage['tmp_name'], $image)) {
                $errors['fileImage'] = 'Failed to upload image!';
            } else {
                // Get current timestamp
                $create_at = date("Y-m-d H:i:s");

                // Insert into database using prepared statements
                $stmt = $conn->prepare("INSERT INTO `articles` (`user_id`, `title`, `content`, `cate_id`, `create_at`, `image`) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('ississ', $user_id, $title, $content, $cate_id, $create_at, $image);

                if ($stmt->execute()) {
                    // Fetch the last inserted ID
                    $article_id = $stmt->insert_id;
                    // Redirect to article details page
                    header("Location: blog-details.php?article_id=$article_id");
                    exit(); // Stop script execution after redirection
                } else {
                    // Display database error
                    $errors['database'] = 'Error: ' . $stmt->error;
                }

                $stmt->close();
            }
        }
    } else {
        // Redirect to login page if user is not logged in
        header('location: ../user-space/blog-details.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Create Article</title>
</head>
<style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #000; /* Changed text color to black */
        }
        .testbox {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            width: 100%;
            padding: 20px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.25);
        }
        input, select, textarea {
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            color: #333;
        }
        .btn-block {
            margin-top: 10px;
            text-align: center;
        }
        button {
            width: 150px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #ccc;
            font-size: 16px;
            color: #000;
            cursor: pointer;
        }
        button:hover {
            background: #aaa;
        }
    </style>
    <script>
        // JavaScript to keep the session alive
        function keepSessionAlive() {
            setInterval(function() {
                fetch('keep_session_alive.php');
            }, 600000); // Send a request every 10 minutes
        }
        document.addEventListener('DOMContentLoaded', keepSessionAlive);
    </script>
<body>
    <!-- Include header.php -->
    <?php include("header.php"); ?>

    <section class="create-article" id="create-article">
        <div class="container mt-4">
            <div class="testbox">
                <div class="form-container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <div class="mb-3">
                                <label for="cate_id" class="form-label">Category<span>*</span></label>
                                <input id="cate_id" type="text" name="cate_id" class="form-control" />
                                <?php if (isset($errors['cate_id'])): ?>
                                    <div class="text-danger"><?php echo $errors['cate_id']; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title<span>*</span></label>
                                <input id="title" type="text" name="title" class="form-control" />
                                <?php if (isset($errors['title'])): ?>
                                    <div class="text-danger"><?php echo $errors['title']; ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <input id="content" name="content" rows="3" class="form-control"></input>
                            </div>
                            <div class="mb-3">
                                <label for="fileImage" class="form-label">Image<span>*</span></label>
                                <input id="fileImage" type="file" name="fileImage" class="form-control" />
                                <?php if (isset($errors['fileImage'])): ?>
                                    <div class="text-danger"><?php echo $errors['fileImage']; ?></div>
                                <?php endif; ?>
                            </div>
                        </fieldset>
                        <div class="btn-block">
                            <button type="submit">Create</button>
                        </div>
                    </form>
                    <?php if (isset($errors['database'])): ?>
                        <div class="text-danger"><?php echo $errors['database']; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Include footer.php -->
    <?php include('footer.php'); ?>
</body>
</html>
