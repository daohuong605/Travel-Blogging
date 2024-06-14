<?php
// check if session key
session_start();

$errors = [];
if (!empty($_POST)) {
    // -- get user data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // -- check if username password exist
    // connect db
    include ('../db/connect-db.php');
    
    // get user by username 
    $sql = "SELECT * FROM users 
            WHERE username='$username'";

    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        $errors['username'] = 'Invalid username'; 
    } else {
        // check password
        if ($user['password'] != $password) {
            $errors['password'] = 'Invalid password'; 
        } else {
            // -- log user in
            $_SESSION['userid'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // redirect
            if ($user['role'] == 'admin') {
                header('location: ../users/all-user.php');
            } else {
                header('location:../user-space/index.php');
            }
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Login Page</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710 ;
}


form{
    height: 520px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}
.link {
  margin-top: 20px;
}
a {
  display: block;
  text-align: center;
  margin-top: 20px;
  color: #eaf0fb;
  text-decoration: none;
  transition: color 0.3s;
}
a:hover {
  color: #ff512f;
}

    </style>
</head>
<body>
    
    <form method="post">

    <h3>Login Here</h3>

    <div>
        <label for="username">Username</label>
        <input type="text" placeholder="Enter Username" id="username" name="username">
        
        <?php if (isset($errors['username'])): ?>
            <p class="text-danger"><?php echo $errors['username']; ?></p>
        <?php endif; ?>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password">

        <?php if (isset($errors['password'])): ?>
            <p class="text-danger"><?php echo $errors['password']; ?></p>
        <?php endif; ?>
    </div>

    <button type="submit">Log In</button>
    <div class="link"><a href="signup.php">Create a new account</a></div>
    </form>
    
</body>
</html>
