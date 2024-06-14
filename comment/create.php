<?php
// require login
include('../shared/_required-login.php');

// connect db
include('../db/connect-db.php');

// query for all categories
$sql = "SELECT * FROM `comments` WHERE 1"; 
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// initial values
$cmt_id = '';
if (isset($_GET['cmt_id'])) {
    $cmt_id = $_GET['cmt_id'];
}

$user_id = '';
$article_id = '';
$comment = '';
$create_at = '';

$errors = []; // [input => error message]

if ($_POST) {
    // -- get user data
    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
    }

    if (isset($_POST['article_id'])) {
        $article_id = $_POST['article_id'];
    }
    if (isset($_POST['comment'])) {
        $comment = $_POST['comment'];
    }
    if (isset($_POST['create_at'])) {
        $create_at = $_POST['create_at'];
    }

    // -- validate data
    if (empty($user_id)) {
        $errors['user_id'] = 'user_id is required!';
    }

    if (empty($article_id)) {
        $errors['article_id'] = 'article_id is required!';
    }

    if (empty($comment)) {
        $errors['comment'] = 'comment is required!';
    }
    if (empty($create_at)) {
        $errors['create_at'] = 'create_at is required!';
    }

    // TODO: validate more...

    // if no errors
    if (empty($errors)) {
        // insert into db using prepared statement
        $sql = "INSERT INTO `comments` (`cmt_id`, `user_id`, `article_id`, `comment`, `create_at`) 
                VALUES (NULL, '$user_id', '$article_id', '$comment', '$create_at'); ";

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
    <title>Comments</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<br>
<br>
<br>
<body class="container">
    <?php include('../shared/_navbar.php'); ?>

    <h1>Create a new Comment</h1>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label class="form-label" for="user_id">User ID</label>
            <input class="form-control" type="text" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

            <?php if (isset($errors['user_id'])): ?>
                <p class="text-danger"><?php echo htmlspecialchars($errors['user_id']); ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label class="form-label" for="article_id">article_id</label>
            <input class="form-control" type="text" name="article_id" id="article_id" value="<?php echo $article_id; ?>">

            <?php if (isset($errors['article_id'])): ?>
                <p class="text-danger"><?php echo htmlspecialchars($errors['article_id']); ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label class="form-label" for="comment">Comment</label>
            <input class="form-control" type="text" name="comment" id="comment" value="<?php echo $comment; ?>">
            
            <?php if (isset($errors['comment'])): ?>
                <p class="text-danger"><?php echo htmlspecialchars($errors['comment']); ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label class="form-label" for="create_at">Create_at</label>
            <input class="form-control" type="datetime-local" name="create_at" id="create_at" value="<?php echo $create_at; ?>">

            <?php if (isset($errors['create_at'])): ?>
                <p class="text-danger"><?php echo htmlspecialchars($errors['create_at']); ?></p>
            <?php endif; ?>
        </div>
        <br/>

        <button class="btn btn-primary">Save</button>
    </form>
</body>

</html>
