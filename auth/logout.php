<?php
session_start();

// clear session
session_destroy();

// redirect to login
header('location: ../users/all-user.php');