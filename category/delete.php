<?php
// -- get id
$cate_id = $_GET['cate_id'];

// -- delete cate with id from db
// connect db
include('../db/connect-db.php');

// delete from db
$cate_id = mysqli_real_escape_string($conn, $cate_id);
$sql = "DELETE FROM `categories` WHERE `cate_id` = $cate_id";
$result = @mysqli_query($conn, $sql);
// expected always successful

// close connection
@mysqli_close($conn);

// -- redirect to view all categories
header("location:../category/index.php");