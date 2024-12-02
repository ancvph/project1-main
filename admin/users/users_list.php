<?php
// Lấy danh sách tất cả người dùng
$users = pdo_query("SELECT * FROM users");
?>

<h2>Danh sách tài khoản</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Role</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['user_id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['phone'] ?></td>
                <td><?= $user['address'] ?></td>
                <td><?= $user['role'] == 1 ? 'Admin' : 'User' ?></td>
                <td>
                    <a href="index.php?act=edit_user&id=<?= $user['user_id'] ?>">Sửa</a> |
                    <a href="index.php?act=delete_user&id=<?= $user['user_id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?act=add_user">Thêm tài khoản</a>
