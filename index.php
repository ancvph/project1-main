<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng đến login.php
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "./model/pdo.php";
include "./model/model_products.php";
include "./model/model_categories.php";
include "./view/header.php";
include "./global.php";
include "./model/model_orders.php";
require_once './model/cart_model.php';

// Kiểm tra giỏ hàng đã có sản phẩm chưa
if (!isset($_SESSION["carts"])) {
    $_SESSION["carts"] = [];
}

$load_categories = list_all_categories_home();
$load_products = list_all_products_home();

// Kiểm tra người dùng đã đăng nhập hay chưa và có 'user_id' trong session
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    echo '<script>alert("Bạn cần đăng nhập để thực hiện thanh toán!"); window.location.href = "login.php";</script>';
    exit();
}

if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {
        case 'home':
            include "./view/home.php";
            break;
        case 'product':
            include "./view/product.php";
            break;
        case 'contact':
            include "./view/contact.php";
            break;
        case 'about':
            include "./view/about.php";
            break;
        case 'detail':
            if (isset($_GET["product_id"]) && $_GET["product_id"] > 0) {
                $product_id = $_GET["product_id"];
                $detail = load_one_products($product_id);
                include "./view/detail.php";
            }
            break;

        // Thêm vào giỏ hàng
        case 'cart':
            if (isset($_POST["addtocart"]) && $_POST["addtocart"]) {
                $product_id = $_POST["product_id"];
                $product_name = $_POST["product_name"];
                $price = $_POST["price"];
                $image_url = $_POST["image_url"];
                $quantity = 1;
                
                // Lấy hoặc tạo giỏ hàng cho người dùng
                $cart_id = ensure_cart_exists($_SESSION['user_id']);
        
                // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
                $product_exists = false;
                foreach ($_SESSION["carts"] as &$cart_product) {
                    if ($cart_product[0] == $product_id) {
                        $cart_product[4] += $quantity;
                        $cart_product[5] = $cart_product[4] * $cart_product[2];
                        $product_exists = true;

                        // Đẩy cập nhật lên bảng cart_items
                        add_to_cart_items($cart_id, $product_id, $cart_product[4], date("Y-m-d H:i:s"));
                        break;
                    }
                }

                // Nếu sản phẩm chưa tồn tại, thêm vào session và bảng cart_items
                if (!$product_exists) {
                    $total = $quantity * $price;
                    $cart_product = [$product_id, $product_name, $price, $image_url, $quantity, $total];
                    array_push($_SESSION["carts"], $cart_product);

                    add_to_cart_items($cart_id, $product_id, $quantity, date("Y-m-d H:i:s"));
                }
            }
        
            include "./view/carts/add_to_cart.php";
            break;

        // Xóa sản phẩm khỏi giỏ hàng
        case 'delete_cart':
            $cart_id = ensure_cart_exists($_SESSION['user_id']); // Đảm bảo giỏ hàng tồn tại cho người dùng
            if (isset($_GET["id_cart"])) {
                $product_id = $_SESSION["carts"][$_GET["id_cart"]][0]; // Lấy product_id từ session
                delete_cart_item($cart_id, $product_id); // Xóa khỏi bảng cart_items
                array_splice($_SESSION["carts"], $_GET["id_cart"], 1); // Xóa khỏi session
            } else {
                $_SESSION["carts"] = [];
                clear_cart($cart_id); // Xóa toàn bộ sản phẩm khỏi bảng cart_items
            }
            header('Location: ./index.php?act=cart');
            break;
        
        // Thanh toán
        // Thanh toán
case 'checkout':
    if (isset($_POST['submit_payment'])) {
        $customer_name = $_POST['customer_name'];
        $customer_phone = $_POST['customer_phone'];
        $shipping_address = $_POST['shipping_address'];
        $payment_method = $_POST['payment_method']; // Nhận hình thức thanh toán

        // Tính tổng tiền từ giỏ hàng
        $total_price = 0;
        if (isset($_SESSION['carts']) && count($_SESSION['carts']) > 0) {
            foreach ($_SESSION['carts'] as $cart_item) {
                $total_price += $cart_item[2] * $cart_item[4];  // Giả sử [2] là giá và [4] là số lượng
            }
        }

        // Kiểm tra thông tin thanh toán
        if (!empty($customer_name) && !empty($customer_phone) && !empty($shipping_address) && !empty($payment_method)) {
            $status = 'Pending';
            $user_id = $_SESSION['user_id'];

            // Lấy kết nối PDO
            $conn = pdo_get_connection(); // Đảm bảo bạn lấy kết nối PDO ở đây

            // Lưu thông tin đơn hàng vào bảng `orders`
            $sql = "INSERT INTO orders (user_id, customer_name, customer_phone, shipping_address, total_price, payment_method, status, created_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
            pdo_execute($sql, $user_id, $customer_name, $customer_phone, $shipping_address, $total_price, $payment_method, $status);

            // Lấy ID của đơn hàng vừa tạo
            $order_id = $conn->lastInsertId(); // Sử dụng đối tượng $conn đã kết nối với cơ sở dữ liệu

            // Lưu các sản phẩm trong giỏ hàng vào bảng `order_items`
            foreach ($_SESSION['carts'] as $cart_item) {
                $product_id = $cart_item[0];  // Giả sử [0] là product_id
                $quantity = $cart_item[4];    // Giả sử [4] là số lượng
                $price = $cart_item[2];       // Giả sử [2] là giá sản phẩm
                
                // Chèn sản phẩm vào bảng order_items
                $sql_items = "INSERT INTO order_items (order_id, product_id, quantity, price_at_order)
                              VALUES (?, ?, ?, ?)";
                pdo_execute($sql_items, $order_id, $product_id, $quantity, $price);
            }

            // Thông báo và chuyển hướng
            echo '<script>alert("Thanh toán thành công! Hình thức thanh toán: ' . $payment_method . '"); window.location.href = "index.php?act=home";</script>';
        } else {
            echo '<script>alert("Vui lòng điền đầy đủ thông tin thanh toán và chọn hình thức thanh toán!");</script>';
        }
    }

    include "./view/carts/thanhToan.php";
    break;

        

        case 'order_history':
            // Lấy danh sách đơn hàng theo user_id từ session
            $user_id = $_SESSION['user_id'];
            $orders = get_orders_by_user($user_id);
            include "./view/history.php";
            break;
        case 'order_detail':
            if (isset($_GET['order_id']) && $_GET['order_id'] > 0) {
                $order_id = $_GET['order_id'];
                // Lấy thông tin đơn hàng
                $order = get_order_by_id($order_id);
                $order_items = get_order_items($order_id);
                
                // Khởi tạo biến tổng giá
                $total_price = 0;
        
                foreach ($order_items as $item) {
                    $total_price += $item['price'] * $item['quantity'];
                }
        
                include "./view/order_detail.php";
            } else {
                echo '<script>alert("Đơn hàng không tồn tại!"); window.location.href = "index.php?act=order_history";</script>';
            }
            break;

        default:
            include "./view/home.php";
            break;
    }
} else {
    include "./view/home.php";
}

include "./view/footer.php";
?>
