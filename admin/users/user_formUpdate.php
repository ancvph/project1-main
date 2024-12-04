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




<div class="container my-3">

    <div class="row">
        <div class="col-2">

        </div>
        <div class="col">
            <h2>Sửa tài khoản</h2>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">USERNAME:</label>
                    <input type="text" name="username" required class="form-control" placeholder="username"
                        value="<?= $user['username'] ?>">

                </div>

                <div class="mb-3">
                    <label class="form-label">EMAIL:</label>
                    <input type="email" name="email" required class="form-control" placeholder="email"
                        value="<?= $user['email'] ?>">

                </div>
                <div class="mb-3">
                    <label class="form-label">PHONE:</label>
                    <input type="text" name="phone" required class="form-control" placeholder="phone"
                        value="<?= $user['phone'] ?>">

                </div>
                <div class="mb-3">
                    <label class="form-label">ADDRESS:</label>
                    <input type="text" name="address" required class="form-control" placeholder="address"
                        value="<?= $user['address'] ?>">

                </div>


                <select class="form-select" aria-label="ROLE" name="role">ROLE:
                    <option selected>ROLE</option>
                    <option value="1" <?= $user['role'] == 0 ? 'selected' : '' ?>>User</option>
                    <option value="2" <?= $user['role'] == 1 ? 'selected' : '' ?>>Admin</option>

                </select>
                <button type="submit" name="submit" class="btn btn-primary mt-3">Thêm tài khoản</button>
            </form>
        </div>
        <div class="col-3">

        </div>
    </div>
</div>