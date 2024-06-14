<?php
    session_start(); // if new -> create new key, else use key -> $_SESSION

    $errors = [];

   // TODO: handle login
   if (!empty($_POST)) {

    // -- get user data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // -- validate user data
    // -- get user with username
    // connect db
    include('../db/connect-db.php');

    // query user with username
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result); // <- null if no result

    // close connection
    mysqli_close($conn);

    // if !exist 
    if (!$user) {
        // invalid username
        $errors['username'] = 'Invalid username!';
    } else {
        // if password not match 
        if ($user['password'] != $password) {
            // invalid password
            $errors['password'] = 'Invalid password!';
        } else {
            // -- log user in
            // $_SESSION['userid'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // -- redirect user
            header('location: ../view.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    
</head>
<body class="container">
    
    <?php include('../shared/_navbar.php'); ?>

    <h1>Login</h1>

    <form action="" method="POST">
        <div class="form-group">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" type="text" name="username" id="username">

            <?php if (isset($errors['username'])): ?>
                <p class="text-danger"><?php echo $errors['username']; ?></p>
            <?php endif; ?>

        </div>
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
            
            <?php if (isset($errors['password'])): ?>
                <p class="text-danger"><?php echo $errors['password']; ?></p>
            <?php endif; ?>

        </div>

        <button class="btn btn-primary" type="submit">Login</button>
    </form>
    
</body>
</html>