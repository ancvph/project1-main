<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập và có vai trò admin hay không
if (!isset($_SESSION['username']) || $_SESSION['role'] != '1') {
    header("Location: login.php"); // Chuyển hướng về trang đăng nhập nếu không phải admin
    exit();
}

// Nội dung của trang admin
    $hi_admin = "Xin chào boss: " . $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Admin</title>
</head>

<body>
    <div class="container">
        <h1> <?php 
        echo $hi_admin;
    ?></h1>
        <a href="../logout.php" style="text-decoration: none; color:black">
            <h3>Đăng xuất</h3>
        </a>
    </div>
</body>

</html>