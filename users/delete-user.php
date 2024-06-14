<?php
// -- get id
$id = $_GET['id'];

// -- delete car with id from db
// connect dc
include('../db/connect-db.php');

//delete from db
$sql = "DELETE FROM `users` WHERE `users`.`id` = $id";
$result = @mysqli_query($conn, $sql);
// expected always successful

// close connection
@mysqli_close($conn);

// -- redirect to view all cars
header('location: all-user.php');