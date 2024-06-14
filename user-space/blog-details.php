<?php
// Require login
include('../shared/_required-admin.php');

// Include database connection
include('../db/connect-db.php');

// Get article ID from query string
$article_id = $_GET['article_id'] ?? 0;

// Validate article ID
if (!is_numeric($article_id) || $article_id <= 0) {
    // Invalid article ID, redirect to 404 page
    header('location: 404.php');
    exit();
}

// Fetch article from database
$sql = "SELECT * FROM `articles` WHERE `article_id` = $article_id";
$result = mysqli_query($conn, $sql);

// Check if query executed successfully
if (!$result) {
    // Query execution failed, display error
    echo 'Error: ' . mysqli_error($conn);
    exit();
}

// Fetch article data
$article = mysqli_fetch_assoc($result);

// Check if article exists
if (!$article) {
    // Article not found, redirect to 404 page
    header('location: 404.php');
    exit();
}

// Display article details (update HTML structure as needed)
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
    <title><?php echo htmlspecialchars($article['title']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #333;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
        }
        img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }
    </style>
    <!-- Add additional CSS and JS links as needed -->
</head>
<body>
    <?php include('header.php')?>
    <div class="container">
        <!-- Display article details -->
        <h1><?php echo htmlspecialchars($article['title']); ?></h1>
        <p><?php echo htmlspecialchars($article['content']); ?></p>
        <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
        <!-- Add additional article details as needed -->
    </div>
    <?php include('comment.php')?>
    <?php include('footer.php')?>
</body>
</html>
