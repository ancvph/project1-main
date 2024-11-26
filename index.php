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
                $total = $quantity * $price;

                $cart_product = [$product_id, $product_name, $price, $image_url, $quantity, $total];
                array_push($_SESSION["carts"], $cart_product);
            }
            include "./view/carts/add_to_cart.php";
            break;

        // Xóa sản phẩm khỏi giỏ hàng
        case 'delete_cart':
            if (isset($_GET["id_cart"])) {
                array_splice($_SESSION["carts"], $_GET["id_cart"], 1);
            } else {
                $_SESSION["carts"] = [];
            }
            header('Location:./index.php?act=cart');
            break;

        // Thanh toán
        case 'checkout':
            // Xử lý thanh toán khi người dùng nhấn nút thanh toán
            if (isset($_POST['submit_payment'])) {
                $customer_name = $_POST['customer_name'];
                $customer_phone = $_POST['customer_phone'];
                $shipping_address = $_POST['shipping_address'];
                $total_price = $_POST['total_price'];

                // Kiểm tra xem thông tin thanh toán có đầy đủ không
                if (!empty($customer_name) && !empty($customer_phone) && !empty($shipping_address)) {
                    // Lưu thông tin đơn hàng vào cơ sở dữ liệu
                    $status = 'Pending';  // Trạng thái đơn hàng (chờ xử lý)
                    $user_id = $_SESSION['user_id'];  // ID người dùng (lấy từ session)

                    // Lưu thông tin đơn hàng vào bảng orders
                    $sql = "INSERT INTO orders (user_id, customer_name, customer_phone, shipping_address, total_price, status, created_at)
                            VALUES (?, ?, ?, ?, ?, ?, NOW())";
                    pdo_execute($sql, $user_id, $customer_name, $customer_phone, $shipping_address, $total_price, $status);

                    // Sau khi thanh toán thành công, chuyển hướng đến trang cảm ơn hoặc trang đơn hàng
                    echo '<script>alert("Thanh toán thành công!"); window.location.href = "index.php?act=home";</script>';
                } else {
                    echo '<script>alert("Vui lòng điền đầy đủ thông tin thanh toán!");</script>';
                }
            }

            // Nếu có sản phẩm trong giỏ hàng, hiển thị thông tin thanh toán
            if (empty($_SESSION["carts"]) || count($_SESSION["carts"]) == 0) {
                header("Location: index.php?act=cart");
                exit();
            }

            // Hiển thị giao diện thanh toán
            include "./view/carts/thanhToan.php";
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
