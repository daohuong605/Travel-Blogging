<?php
// Require login
include('../shared/_required-login.php');

// - - get user data
$id = $_GET['id'];

// -- get user$user by id
//connect to db
include('../db/connect-db.php');

//get user$user by id
$sql = "SELECT * FROM `users` WHERE id = '$id'";
$result = @mysqli_query($conn, $sql);

$user = @mysqli_fetch_assoc($result);

// free result
@mysqli_free_result($result);


$errors = [];

if ($_POST){
    // -- get user data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $yob = $_POST['yob'];
    $city = $_POST['city'];
    $fileImage = $_FILES['fileImage'];

    // $image_path = $user['image'];

    // check if not submitted
    if ($fileImage && $fileImage['error'] == 0) {
        // Move uploaded file from temporary folder to /uploads folder
        $image_path = '../' . basename($fileImage['name']);
        move_uploaded_file($fileImage['tmp_name'], $image_path);
    }

    // validate data
    if (!is_numeric($phone)) {
        $errors['phone'] = 'Error phone number!';
    }
    if (!is_numeric($yob)) {
        $errors['yob'] = 'Error year of birth!';
    }

    //if no errors
    if (empty($errors)) {

        $sql = "UPDATE `users` 
                SET `username` = '$username', `password` = '$password', `name` = '$name', 
                `email` = '$email', `phone` = '$phone', `yob` = '$yob', `city` = '$city', `image` = '$image_path'
                WHERE `users`.`id` = $id ";

        $result = @mysqli_query($conn, $sql);
        // expected always successful

        if ($result) {
            // Redirect to view all user
            header('location: all-user.php');
            exit(); // Stop script execution after redirection
        } else {
            // Display error message
            $errors['database'] = 'Error: ' . mysqli_error($conn);
        }
        // close connection
        @mysqli_close($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
    <div class="container mt-5">
    <?php include('../shared/_navbar.php'); ?>
    <br/>
    <h1>Edit user</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label class="form-label" for="username">Username</label>
            <input class="form-control" type="text" name="username" id="username" value="<?php echo $user['username']; ?>">
        </div>
        <div>
            <label class="form-label" for="password">Password</label>
            <input class="form-control" type="text" name="password" id="password" value="<?php echo $user['password']; ?>">
        </div>
        <div>
            <label class="form-label" for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" value="<?php echo $user['name']; ?>">
        </div>
        <div>
            <label class="form-label" for="email">Email</label>
            <input class="form-control" type="text" name="email" id="email" value="<?php echo $user['email']; ?>">
        </div>
        <div>
            <label class="form-label" for="phone">Phone</label>
            <input class="form-control" type="text" name="phone" id="phone" value="<?php echo $user['phone']; ?>">
        </div>
        <div>
            <label class="form-label" for="yob">Yob</label>
            <input class="form-control" type="text" name="yob" id="yob" value="<?php echo $user['yob']; ?>">
        </div>
        <div>
            <label class="form-label" for="city">City</label>
            <input class="form-control" type="text" name="city" id="city" value="<?php echo $user['city']; ?>">
        </div>
        <div class="form-group">
            <label class="form-label" for="fileImage">File Image</label>
            <input class="form-control" type="file" name="fileImage" id="fileImage">
            
            <?php if (isset($errors['fileImage'])): ?>
                <p class="text-danger"><?php echo $errors['fileImage']; ?></p>
            <?php endif; ?>
        </div>
        <br/>
        <button class="btn btn-primary" type="submit">Save</button>
    </form>
    </div>
</body>

</html>