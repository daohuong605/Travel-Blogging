<?php
// Require login
include('../shared/_required-admin.php');

// Include database connection file
include('../db/connect-db.php');

// Define default values
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$perPage = 10; // Number of users per page

// Query for all users
$sql = "SELECT * FROM `users` ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

// Process results
if ($result) {
    $totalUsers = mysqli_num_rows($result); // Total number of users
    $noPages = ceil($totalUsers / $perPage); // Total number of pages
    $offset = ($page - 1) * $perPage; // Offset for pagination
    $sql .= " LIMIT $perPage OFFSET $offset";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // Free result
        mysqli_free_result($result);
    } else {
        $users = [];
        $error = "Error fetching users: " . mysqli_error($conn);
    }
} else {
    $users = [];
    $error = "Error fetching users: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
    <div class="container mt-5">
        <?php include('../shared/_navbar.php'); ?>
        <br />

        <p>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>

        <h1>All Users</h1>
        <form action="" method="get">
            <div class="row my-3">
                <div class="col-3">
                    <input class="form-control" type="text" name="username" placeholder="User name" value="<?php echo htmlspecialchars($_GET['username'] ?? ''); ?>">
                </div>
                <div class="col-3">
                    <input class="form-control" type="text" name="phone" placeholder="Phone" value="<?php echo htmlspecialchars($_GET['phone'] ?? ''); ?>">
                </div>
                <div class="col-3">
                    <button class="btn btn-primary" type="submit">Filter</button>
                </div>
            </div>
        </form>


        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (empty($users)) : ?>
            <p>No data.</p>
        <?php else : ?>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Year of Birth</th>
                        <th>City</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td class="align-middle text-center"><?php echo htmlspecialchars($user['id']); ?></td>
                            <td width="200">
                                <?php if (!empty($user['image'])) : ?>
                                    <img class="img-fluid" src="<?php echo $user['image']; ?>" alt="User Avatar">
                                <?php else : ?>
                                    <img class="img-fluid" src="default-avatar.png" alt="Default Avatar">
                                <?php endif; ?>
                            </td>
                            <td class="align-middle text-center"><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="align-middle text-center"><?php echo htmlspecialchars($user['name']); ?></td>
                            <td class="align-middle text-center"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="align-middle text-center"><?php echo htmlspecialchars($user['phone']); ?></td>
                            <td class="align-middle text-center"><?php echo htmlspecialchars($user['yob']); ?></td>
                            <td class="align-middle text-center"><?php echo htmlspecialchars($user['city']); ?></td>
                            <td class="align-middle text-center">
                                <a href="edit-user.php?id=<?php echo $user['id']; ?>">
                                    <img src="../assets/edit_icon.png" alt="Edit" width="20" height="20">
                                </a>
                                <form class="d-inline" action="delete-user.php?id=<?php echo $user['id']; ?>" method="POST" onsubmit="return confirm('Are you sure?');">
                                    <button type="submit" class="btn btn-link">
                                        <img src="../assets/delete_icon1.png" alt="Delete" width="20" height="20">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($page > 1) : ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $noPages; $i++) : ?>
                        <li class="page-item"><a class="page-link <?php echo $page == $i ? 'active' : ''; ?>" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>

                    <?php if ($page < $noPages) : ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</body>

</html>
