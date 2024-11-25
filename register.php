<?php
require_once 'model/pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO users (username, password_hash, email, phone, address, role, created_at) 
            VALUES (?, ?, ?, ?, ?, 0, NOW())"; // role mặc định là 0 (người dùng)

    try {
        pdo_execute($sql, $username, $password, $email, $phone, $address);
        echo "<script>alert('Đăng ký thành công! Vui lòng đăng nhập.');</script>";
        header("Location: login.php");
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./view/css/register.css">
</head>
<body>
    <div class="register-container">
        <!-- Left Section -->
        <div class="register-left">
            <h2>Register with <br> Clock</h2>
        </div>

        <!-- Right Section -->
        <div class="register-right">
            <h1>CASIO</h1>
            <p>Enter the information you entered while registering</p>
            <form action="register.php" method="POST">
                <input type="text" name="username" class="form-control" placeholder="User name" required>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
                <input type="text" name="address" class="form-control" placeholder="Address" required>
                <button type="submit" class="btn btn-register">Register</button>
            </form>
            <p class="text-muted mt-3">
                Already have an account? 
                <a href="login.php">Login</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
