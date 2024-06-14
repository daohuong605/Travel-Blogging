<?php
// require login
include('../shared/_required-login.php');

// -- query all articles
// connect db
include('../db/connect-db.php');

// query for all articles
$sql = "SELECT * FROM `articles`";

// Initialize filter variables
$user_id = '';
$title = '';
$content = '';
$cate_id = '';
$create_at = '';

// Construct WHERE clause for filtering
$whereClause = "";

if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $whereClause .= " AND user_id LIKE '%$user_id%'";
}

if (isset($_GET["title"]) && !empty($_GET["title"])) {
    $title = $_GET["title"];
    $whereClause .= " AND title LIKE '%$title%'";
}

if (isset($_GET["content"]) && !empty($_GET['content'])) {
    $content = $_GET['content'];
    $whereClause .= " AND content LIKE '%$content%'";
}

if (isset($_GET["cate_id"]) && !empty($_GET['cate_id'])) {
    $cate_id = $_GET['cate_id'];
    $whereClause .= " AND cate_id LIKE '%$cate_id%'";
}

if (isset($_GET["create_at"]) && !empty($_GET['create_at'])) {
    $create_at = $_GET['create_at'];
    $whereClause .= " AND create_at LIKE '%$create_at%'";
}

// Append WHERE clause if filters are applied
if (!empty($whereClause)) {
    $sql .= " WHERE 1=1" . $whereClause;
}

$sql .= " ORDER BY article_id DESC";

// -- pagination
$page = 1;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
}
$limit = 2; // no. articles per page
$offset = ($page - 1) * $limit;

// -- count no.articles
$sqlCount = "SELECT COUNT(*) AS noResults FROM (" . $sql . ") AS filteredResults";
$resultCount = mysqli_query($conn, $sqlCount);

// Check for errors
if (!$resultCount) {
    die('Error: ' . mysqli_error($conn));
}

$countRow = mysqli_fetch_assoc($resultCount);
$noResults = $countRow['noResults'];
$noPages = ceil($noResults / $limit);

$sql .= " LIMIT $limit OFFSET $offset ";

$result = @mysqli_query($conn, $sql);

// Check for errors
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

// process results
$articles = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result
mysqli_free_result($result);

// close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Articles</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body class="container">
    <?php include('../shared/_navbar.php'); ?>

    <p>Welcome 
        <?php echo $_SESSION['username']; ?>!
    </p> 
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_GET['success']; ?>
        </div>
    <?php endif; ?>
    <br/> <br/>
    <h1>All Articles</h1>

    <a class="btn btn-success" href="article.php">Create a new article</a>
    <form action="" method="get">
        <div class="row my-3">
            <div class="col-3">
                <input class="form-control" type="text" name="user_id" placeholder="User ID" value="<?php echo $user_id; ?>">
            </div>
            <div class="col-3">
                <input class="form-control" type="text" name="cate_id" placeholder="Category ID" value="<?php echo $cate_id; ?>">
            </div>
            <div class="col-3">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </div>
    </form>


    <?php if (empty($articles)): ?>
        <p>No data.</p>
    <?php else: ?>
        <table class="table table-bordered table-striped table-hover">
            <tr class="table-primary align-middle text-center">
                <th>Article ID</th>
                <th>User ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Category ID</th>
                <th>Create at</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($articles as $article) : ?>
                <tr>
                    <td class="align-middle text-center"><?php echo $article['article_id']; ?></td>
                    <td class="align-middle text-center"><?php echo $article['user_id']; ?></td>
                    <td class="align-middle text-center"><?php echo $article['title']; ?></td>
                    <td class="align-middle text-center"><?php echo $article['content']; ?></td>
                    <td class="align-middle text-center"><?php echo $article['cate_id']; ?></td>
                    <td class="align-middle text-center"><?php echo $article['create_at']; ?></td>
                    <td width="200">
                        <img class="img-fluid" src="<?php echo $article['image']; ?>">
                    </td>
                    <td class="align-middle text-center">
                        <a href="../articles/edit.php?article_id=<?php echo $article['article_id']; ?>">
                            <img src="../assets/edit_icon.png" alt="Edit" width="20" height="20">
                        </a>
                        <form class="d-inline" action="../articles/delete.php?article_id=<?php echo $article['article_id']; ?>" method="POST" onsubmit="return confirm('Are you sure?');">
                            <button type="submit" class="btn btn-link">
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
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page-1; ?>&user_id=<?php echo $user_id; ?>&title=<?php echo $title; ?>">Previous</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $noPages; $i++): ?>
                    <li class="page-item"><a class="page-link <?php echo $page == $i ? 'active' : ''; ?>" href="?page=<?php echo $i; ?>&title=<?php echo $title; ?>&content=<?php echo $content; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>

                <?php if ($page < $noPages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page+1; ?>&title=<?php echo $title; ?>&content=<?php echo $content; ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        
    <?php endif; ?>
</body>

</html>
