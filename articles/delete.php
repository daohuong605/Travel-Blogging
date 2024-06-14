<?php
// -- get id
if (isset($_GET['article_id']) && is_numeric($_GET['article_id'])) {
    $article_id = $_GET['article_id'];
} else {
    die('Invalid or missing article ID.');
}

// -- delete article with id from db
// connect db
include('../db/connect-db.php');
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// delete from db
$article_id = mysqli_real_escape_string($conn, $article_id);
$sql = "DELETE FROM `articles` WHERE `article_id` = $article_id"; // Corrected SQL query
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

// close connection
mysqli_close($conn);

// -- redirect to view all articles
header('Location: ../articles/view.php');
exit;

