<?php
// Lấy thông tin tài khoản cần sửa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = pdo_query_one("SELECT * FROM users WHERE user_id = ?", $id);
}

// Khi submit form sửa tài khoản
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $role = $_POST['role'];

    // Gọi hàm cập nhật tài khoản
    update_user($id, $username, $email, $phone, $address, $role);

    header('Location: index.php?act=manage_users');
    exit();
}
?>

<h2>Sửa tài khoản</h2>
<form method="post">
    <label>Username:</label>
    <input type="text" name="username" value="<?= $user['username'] ?>" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= $user['email'] ?>" required><br>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?= $user['phone'] ?>" required><br>

    <label>Address:</label>
    <input type="text" name="address" value="<?= $user['address'] ?>"><br>

    <label>Role:</label>
    <select name="role">
        <option value="0" <?= $user['role'] == 0 ? 'selected' : '' ?>>User</option>
        <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>Admin</option>
    </select><br>

    <button type="submit" name="submit">Cập nhật</button>
</form>
