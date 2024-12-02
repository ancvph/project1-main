<?php
// Khi submit form thêm tài khoản
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Băm mật khẩu
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $role = $_POST['role'];

    // Gọi hàm thêm tài khoản
    add_user($username, $password, $email, $phone, $address, $role);

    header('Location: index.php?act=manage_users');
    exit();
}
?>

<h2>Thêm tài khoản</h2>
<form method="post">
    <label>Username:</label>
    <input type="text" name="username" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Phone:</label>
    <input type="text" name="phone" required><br>

    <label>Address:</label>
    <input type="text" name="address"><br>

    <label>Role:</label>
    <select name="role">
        <option value="0">User</option>
        <option value="1">Admin</option>
    </select><br>

    <button type="submit" name="submit">Thêm tài khoản</button>
</form>
