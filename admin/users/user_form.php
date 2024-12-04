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



<div class="container my-3">

    <div class="row">
        <div class="col-2">

        </div>
        <div class="col">
            <h2>Thêm tài khoản</h2>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">USERNAME:</label>
                    <input type="text" name="username" required class="form-control" placeholder="username">

                </div>
                <div class="mb-3">
                    <label class="form-label">PASSWORD:</label>
                    <input type="password" name="password" required class="form-control" placeholder="password">

                </div>
                <div class="mb-3">
                    <label class="form-label">EMAIL:</label>
                    <input type="email" name="email" required class="form-control" placeholder="email">

                </div>
                <div class="mb-3">
                    <label class="form-label">PHONE:</label>
                    <input type="text" name="phone" required class="form-control" placeholder="phone">

                </div>
                <div class="mb-3">
                    <label class="form-label">ADDRESS:</label>
                    <input type="text" name="address" required class="form-control" placeholder="address">

                </div>


                <select class="form-select" aria-label="ROLE" name="role">ROLE:
                    <option selected>ROLE</option>
                    <option value="1">User</option>
                    <option value="2">Admin</option>

                </select>
                <button type="submit" name="submit" class="btn btn-primary mt-3">Thêm tài khoản</button>
            </form>
        </div>
        <div class="col-3">

        </div>
    </div>
</div>