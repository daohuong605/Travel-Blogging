<?php
// -- delete cmt with id from db
// connect db
include('../db/connect-db.php');


// initial values
$cmt_id = '';
if (isset($_GET['cmt_id'])) {
    $cmt_id = $_GET['cmt_id'];
}
// delete from db
$sql = "DELETE FROM `comments` WHERE `comments`.`cmt_id` = '$cmt_id'";
$result = @mysqli_query($conn, $sql);
// expected always successful

// close connection
mysqli_close($conn);

// -- redirect to view all categories
header("location:../comment/index.php");
