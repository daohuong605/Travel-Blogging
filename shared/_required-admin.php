<?php
session_start();

// check if logged in = isset($_SESSION['username'])
if (!isset($_SESSION['username']) || $_SESSION['role']!='admin') {
    header('location: ../user-space/index.php');
    exit();
}