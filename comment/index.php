<?php
// require login
include('../shared/_required-login.php');

// connect db
include('../db/connect-db.php');

// initial SQL statement
$sql = "SELECT * FROM `comments` WHERE 1";
$result = mysqli_query($conn, $sql);

$user_id = '';
$article_id = '';
$comment = '';
$create_at = '';

// filter conditions
if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    $user_id =  $_GET['user_id'];
    $sql .= " AND user_id = '$user_id'";
}

if (isset($_GET['article_id']) && !empty($_GET['article_id'])) {
    $article_id =  $_GET['article_id'];
    $sql .= " AND article_id = '$article_id'";
}

if (isset($_GET['comment']) && !empty($_GET['comment'])) {
    $comment =  $_GET['comment'];
    $sql .= " AND comment LIKE '%$comment%'";
}

if (isset($_GET['create_at']) && !empty($_GET['create_at'])) {
    $create_at = $_GET['create_at'];
    $sql .= " AND create_at LIKE '%$create_at%'";
}

// order result
$sql .= " ORDER BY cmt_id";

// -- pagination
$page = 1;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
}
$limit = 2; // no. cars per page
$offset = ($page-1)*$limit;

// count total results
$sqlCount = "SELECT COUNT(*) AS noResults FROM ($sql) AS filteredResults";
$resultCount = mysqli_query($conn, $sqlCount);
$noResults = mysqli_fetch_assoc($resultCount)['noResults'];
$noPages = ceil($noResults / $limit);

// limit and offset for pagination
$sql .= " LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

// process results
$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result
mysqli_free_result($resultCount);
mysqli_free_result($result);

// close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <div class="container mt-5">
        <?php include('../shared/_navbar.php'); ?> 

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>
        <br/><br/>
        <h1>All Comments</h1>
        <a class="btn btn-success" href="create.php">Create a new comment</a>
        <br/><br/>
        <form action="" method="get">
        <div class="row my-3">
            <div class="col-3">
                <input class="form-control" type="text" name="user_id" placeholder="User ID" value="<?php echo $user_id; ?>">
            </div>
            <div class="col-3">
                <input class="form-control" type="text" name="article_id" placeholder="Article ID" value="<?php echo $article_id; ?>">
            </div>
            <div class="col-3">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </div>
        </form>

        <?php if (empty($comments)): ?>
            <p>No data.</p>
        <?php else: ?>
            <table class="table table-bordered table-striped table-hover">
                <tr class="table-primary">
                    <th>ID</th>
                    <th>User</th>
                    <th>Article</th>
                    <th>Comment</th>
                    <th>Day</th>
                    <th>Actions</th>
                </tr>

                <?php foreach ($comments as $cmt) : ?>
                    <tr class="align-middle text-center">
                        <td><?php echo htmlspecialchars($cmt['cmt_id']); ?></td>
                        <td><?php echo htmlspecialchars($cmt['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($cmt['article_id']); ?></td>
                        <td><?php echo htmlspecialchars($cmt['comment']); ?></td>
                        <td><?php echo htmlspecialchars($cmt['create_at']); ?></td>
                        <td>
                            <a href="edit.php?cmt_id=<?php echo $cmt['cmt_id']; ?>">
                                <img src="../assets/edit_icon.png" alt="Edit" width="20" height="20">
                            </a>
                            <form class="d-inline" action="delete.php?cmt_id=<?php echo $cmt['cmt_id']; ?>" method="POST">
                                <button class="btn" onclick="return confirm('Are you sure?');">
                                    <img src="../assets/delete_icon1.png" alt="Delete" width="20" height="20">
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page-1; ?>&user_id=<?php echo htmlspecialchars($user_id); ?>&article_id=<?php echo htmlspecialchars($article_id); ?>&comment=<?php echo htmlspecialchars($comment); ?>&create_at=<?php echo htmlspecialchars($create_at); ?>">Previous</a></li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $noPages; $i++): ?>
                        <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>&user_id=<?php echo htmlspecialchars($user_id); ?>&article_id=<?php echo htmlspecialchars($article_id); ?>&comment=<?php echo htmlspecialchars($comment); ?>&create_at=<?php echo htmlspecialchars($create_at); ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $noPages): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page+1; ?>&user_id=<?php echo htmlspecialchars($user_id); ?>&article_id=<?php echo htmlspecialchars($article_id); ?>&comment=<?php echo htmlspecialchars($comment); ?>&create_at=<?php echo htmlspecialchars($create_at); ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</body>
</html>
