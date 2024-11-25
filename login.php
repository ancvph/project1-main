<?php
require './model/pdo.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $sql = "SELECT * FROM users WHERE username = ?";
        $user = pdo_query_one($sql, $username);

        if ($user && $password === $user['password_hash']) {
            // Lưu thông tin người dùng vào session
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Nếu có phân quyền, lưu vai trò tại đây
            $_SESSION['user_id'] = $user['user_id'];  // Sau khi người dùng đăng nhập thành công

            // Chuyển hướng đến index.php
            if ($user['role'] == 1) { // Nếu là admin
                header("Location: ./admin/index.php");
            } else if ($user['role'] == 0) { // Nếu là user
                header("Location: index.php");
            }
            exit();
        } else {
            echo "Sai tên đăng nhập hoặc mật khẩu!";
        }
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./view/css/login.css">
</head>

<body>
    <div class="login-container">
        <!-- Left Section -->
        <div class="login-left">
            <h2>LOGIN TO <br> CASIO</h2>
        </div>

        <!-- Right Section -->
        <div class="login-right">
            <h1><b>CASIO</b></h1>

            <form action="login.php" method="POST">
                <input type="text" name="username" class="form-control" placeholder="Email / Number phone" required>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <a href="#" class="text-decoration-none d-block text-end mb-2">Forgot password?</a>
                <button type="submit" class="btn btn-login">Login</button>
            </form>
            <div class="or-divider">or</div>
            <div class="register">
                <button class="btn btn-outline-dark"><a class="text-warning" style="text-decoration: none;"
                        href="./register.php">Register</a></button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>