<!-- CREATE A NEW USER -->
<?php

$errors = [];

if ($_POST) {
    // -- get user data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $yob = $_POST['yob'];
    $city = $_POST['city'];

    // -- validate data
    if (empty($username)) {
        $errors['username'] = 'Username is required!';
    }
    if (empty($email)) {
        $errors['email'] = 'Email is required!';
    }
    if (empty($password)) {
        $errors['password'] = 'Password is required!';
    }

        //connect db
        include('../db/connect-db.php');

        //insert into db
        $sql= "INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `phone`, `yob`, `city`) 
        VALUES ('NULL', '$username', '$password', '$name', '$email', '$phone', '$yob', '$city');";

        $result = @mysqli_query($conn, $sql);
        //expected always successful

        //close connection
        @mysqli_close($conn);

        //redirect to view all cars
        header('location: login.php');
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Signup Page</title>
 
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
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 600px;
    width: 450px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 30px 35px;
    overflow-y: auto;
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
    height: 40px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 2px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 20px;
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
div {
  margin-top: 10px;
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

    <form action="" method="post">
        <h3>Sign up</h3>

        <label class="form-label" for="username">Username</label>
        <input class="form-control" type="text" name="username" id="username">

        <label class="form-label" for="password">Password</label>
        <input class="form-control" type="text" name="password" id="password">

        <label class="form-label" for="email">Email</label>
        <input class="form-control" type="text" name="email" id="email">

        <label class="form-label" for="phone">Phone</label>
        <input class="form-control" type="text" name="phone" id="phone">

        <label class="form-label" for="yob">Year of Birth</label>
        <input class="form-control" type="text" name="yob" id="yob">

        <label class="form-label" for="city">City</label>
        <input class="form-control" type="text" name="city" id="city">

        <button type="submit">Sign up</button>
        <div>
            <a href="login.php">I already have an account</a>
        </div>
    </form>
</body>
</html>
