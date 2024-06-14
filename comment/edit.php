<?php
// connect to database
include('../db/connect-db.php');

// Initialize variable
$cmt = null;

// get cate by id
if (isset($_GET['cmt_id']) && !empty($_GET['cmt_id'])) {
    $cmt_id = mysqli_real_escape_string($conn, $_GET['cmt_id']);
    $sql = "SELECT * FROM `comments` WHERE `cmt_id` = $cmt_id";
    $result = mysqli_query($conn, $sql);
    $cmt = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
}

// close connection
mysqli_close($conn);

// -- TODO: handle post data
if ($_POST) {
    // -- get user data
    $user_id = $_POST['user_id'];
    $article_id = $_POST['article_id'];
    $comment = $_POST['comment'];
    $create_at = $_POST['create_at'];

    // connect db
    include('../db/connect-db.php');
    
    // update db
    $sql = "UPDATE `comments` 
            SET `user_id` = '$user_id', `article_id` = '$article_id', `comment` = '$comment', `create_at` = '$create_at'
            WHERE `cmt_id` = " . $_POST['cmt_id'];

    $result = mysqli_query($conn, $sql);
    // expected always successful
    
    // close connection
    mysqli_close($conn);

    // redirect to view all comments
    header('location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
     <!-- bootstrap css -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
    
    <div class="container mt-5">
    <?php include('../shared/_navbar.php'); ?>
    <br/> <br/>
        <h1>Edit a Comment</h1>
        <?php if ($cmt): ?>
        <form action="" method="post">
            <input type="hidden" name="cmt_id" value="<?php echo htmlspecialchars($cmt['cmt_id']); ?>">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Article ID</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Day</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($cmt['cmt_id']); ?></th>
                        <td><input type="text" class="form-control border-0" name="user_id" value="<?php echo htmlspecialchars($cmt['user_id']); ?>"></td>
                        <td><input type="text" class="form-control border-0" name="article_id" value="<?php echo htmlspecialchars($cmt['article_id']); ?>"></td>
                        <td><input type="text" class="form-control border-0" name="comment" value="<?php echo htmlspecialchars($cmt['comment']); ?>"></td>
                        <td><input type="datetime-local" class="form-control border-0" name="create_at" value="<?php echo htmlspecialchars($cmt['create_at']); ?>"></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <?php else: ?>
            <p>Comment not found.</p>
        <?php endif; ?>
    </div>

</body>

</html>
