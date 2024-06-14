<?php
// require login
include('../shared/_required-login.php');

// connect db
include('../db/connect-db.php');

// query for all users
$sql = "SELECT * FROM `categories` WHERE 1 "; 
$result = mysqli_query($conn, $sql);


// -- apply filter
// initial data
$cate_name = '';
$description = '';


if (isset($_GET['cate_name']) && !empty($_GET['cate_name'])) {
    $cate_name = $_GET['cate_name'];
    
    $sql .= " AND cate_name LIKE '%$cate_name%'";
}
if (isset($_GET['description']) && !empty($_GET['description'])) {
    $description = $_GET['description'];
    
    $sql .= " AND description LIKE '%$description%'";
}


// order result
$sql .= " ORDER BY cate_id  ";

// -- pagination
$page = 1;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
}
$limit = 2; // no. cars per page
$offset = ($page-1)*$limit;

// -- count no.cars
$sqlCount = "SELECT COUNT(*) AS noResults FROM ($sql) AS filteredResults";
$result = mysqli_query($conn, $sqlCount);
$noResults = mysqli_fetch_assoc($result)['noResults'];
$noPages = ceil($noResults/$limit);

$sql .= " LIMIT $limit OFFSET $offset ";

$result = @mysqli_query($conn, $sql);

// process results
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
// print_r($cars[1]);

// free result
@mysqli_free_result($result);

// close connection
@mysqli_close($conn);

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

<body>
    <div class="container mt-5">
    <?php include('../shared/_navbar.php'); ?> 

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_GET['success']; ?>
        </div>
    <?php endif; ?>
    <br/> <br/>
    <h1>All Categories</h1>
    <a class="btn btn-success" href="create.php">Create a new category</a> <br/> <br/>
    <form action="" method="get">
        <div class="row my-3">
            <div class="col-3">
                <input class="form-control" type="text" name="cate_name" placeholder="Category name" value="<?php echo $cate_name; ?>">
            </div>
            <div class="col-3">
                <input class="form-control" type="text" name="description" placeholder="Description" value="<?php echo $description; ?>">
            </div>
            <div class="col-3">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </div>
    </form>

    <?php if (empty($categories)): ?>
        <p>No data.</p>
    <?php else: ?>
        <table class="table table-bordered table-striped table-hover ">
            <tr class="table-primary">
                <th>ID</th>
                <th>Image</th>
                <th>Category name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($categories as $cate) : ?>
                <tr>
                    <td class="align-middle text-center"><?php echo $cate['cate_id']; ?></td>
                    <td width="200">
                        <img class="img-fluid" src="<?php echo $cate['image']; ?>">
                    </td>
                    <td class="align-middle text-center"><?php echo $cate['cate_name']; ?></td>
                    <td class="align-middle text-center"><?php echo $cate['description']; ?></td>
                    <td class="align-middle text-center">
                    <a href="edit.php?cate_id=<?php echo $cate['cate_id']; ?>">
                        <img src="../assets/edit_icon.png" alt="Edit" width="20" height="20">
                    </a>
                        <form class="d-inline" action="delete.php?cate_id=<?php echo $cate_id['cate_id']; ?>" method="POST" onsubmit="return confirm('Are you sure?');">
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
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page-1; ?>&cate_name=<?php echo $cate_name; ?>&description=<?php echo $description; ?>">Previous</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $noPages; $i++): ?>
                    <li class="page-item"><a class="page-link <?php echo $page == $i ? 'active' : ''; ?>" href="?page=<?php echo $i; ?>&cate_name=<?php echo $cate_name; ?>&description=<?php echo $description; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>

                <?php if ($page < $noPages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page+1; ?>&cate_name=<?php echo $cate_name; ?>&description=<?php echo $description; ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>

    <?php endif; ?>
    </div>
</body>
</html>