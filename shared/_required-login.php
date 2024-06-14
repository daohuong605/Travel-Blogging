<?php
// Bắt đầu hoặc tiếp tục một phiên làm việc
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra nếu không có người dùng đăng nhập
if (!isset($_SESSION['username'])) {
    // Chuyển hướng người dùng đến trang đăng nhập
    header('location: ../auth/login.php');
    exit();
}
?>
