<?php
// Kết nối đến cơ sở dữ liệu
require_once 'pdo.php';

// Thêm sản phẩm vào bảng cart_items
function add_to_cart_items($cart_id, $product_id, $quantity, $created_at) {
    $conn = pdo_get_connection();

    // Kiểm tra lại cart_id trước khi thêm
    $sql_check = "SELECT COUNT(*) FROM cart WHERE cart_id = :cart_id";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->execute([':cart_id' => $cart_id]);
    $cart_exists = $stmt_check->fetchColumn();

    if (!$cart_exists) {
        throw new Exception("Cart ID does not exist: $cart_id");
    }

    // Nếu hợp lệ, thêm vào bảng cart_items
    $sql = "INSERT INTO cart_items (cart_id, product_id, quantity, created_at) 
            VALUES (:cart_id, :product_id, :quantity, :created_at)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':cart_id' => $cart_id,
        ':product_id' => $product_id,
        ':quantity' => $quantity,
        ':created_at' => $created_at
    ]);
}



// Xóa sản phẩm khỏi bảng cart_items
function delete_cart_item($cart_id, $product_id) {
    $conn = pdo_get_connection();
    $sql = "DELETE FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':cart_id' => $cart_id,
        ':product_id' => $product_id
    ]);
}

// Xóa toàn bộ sản phẩm trong giỏ hàng (nếu cần)
function clear_cart($cart_id) {
    $conn = pdo_get_connection();
    $sql = "DELETE FROM cart_items WHERE cart_id = :cart_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':cart_id' => $cart_id]);
}

// Lấy tất cả sản phẩm trong giỏ hàng
function get_cart_items($cart_id) {
    $conn = pdo_get_connection();
    $sql = "SELECT * FROM cart_items WHERE cart_id = :cart_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':cart_id' => $cart_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function ensure_cart_exists($user_id) {
    $conn = pdo_get_connection();

    // Kiểm tra xem giỏ hàng đã tồn tại chưa
    $sql = "SELECT cart_id FROM cart WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':user_id' => $user_id]);
    $cart = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cart) {
        // Nếu giỏ hàng đã tồn tại, trả về cart_id
        return $cart['cart_id'];
    } else {
        // Nếu chưa tồn tại, tạo mới giỏ hàng
        $sql = "INSERT INTO cart (user_id, created_at) VALUES (:user_id, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);

        // Trả về cart_id vừa tạo
        return $conn->lastInsertId();
    }
}
?>
