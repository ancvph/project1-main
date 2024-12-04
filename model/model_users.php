<?php
// Kết nối cơ sở dữ liệu
require_once 'pdo.php';

// Lấy danh sách tất cả người dùng
function get_all_users() {
    $sql = "SELECT * FROM users";
    return pdo_query($sql);
}

// Thêm tài khoản mới
function add_user($username, $password, $email, $phone, $address, $role) {
    $created_at = date('Y-m-d H:i:s'); // Thời gian hiện tại
    $sql = "INSERT INTO users (username, password_hash, email, phone, address, role, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $username, $password, $email, $phone, $address, $role, $created_at);
}



// Xóa tài khoản
function delete_user($id) {
    $sql = "DELETE FROM users WHERE user_id = ?";
    pdo_execute($sql, $id);
}

// Lấy thông tin người dùng theo ID
function get_user_by_id($user_id) {
    $sql = "SELECT * FROM users WHERE user_id = ?";
    return pdo_query_one($sql, $user_id);
}

// Cập nhật thông tin tài khoản
function update_user($user_id, $username, $email, $role) {
    $sql = "UPDATE users SET username = ?, email = ?, role = ? WHERE user_id = ?";
    pdo_execute($sql, $username, $email, $role, $user_id);
}


?>