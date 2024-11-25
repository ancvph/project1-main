<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập và có vai trò admin hay không
if (!isset($_SESSION['username']) || $_SESSION['role'] != '1') {
    header("Location: login.php"); // Chuyển hướng về trang đăng nhập nếu không phải admin
    exit();
}

// Nội dung của trang admin
echo "Chào mừng admin, " . $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Admin</title>
</head>
<body>
<h1>Chào mừng Admin: 
    <?php 
    echo isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : "Người dùng không xác định"; 
    ?>
</h1>
    <a href="../logout.php">Đăng xuất</a>
</body>
</html>
