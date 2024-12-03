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
    include "./model/model_cart.php";
    include "./view/header.php";
    include "./global.php";
    include "./model/model_orders.php";

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
                if(isset($_POST["addtocart"]) && $_POST["addtocart"]){
                    $product_id = $_POST["product_id"];
                    $product_name = $_POST["product_name"];
                    $price = $_POST["price"];
                    $image_url = $_POST["image_url"];
                    $quantity = 1;
                    $total = $quantity * $price;

                    $cart_product =[$product_id,$product_name,$price,$image_url,$quantity,$total];
                    array_push($_SESSION["carts"],$cart_product);
                }
                include "./view/carts/add_to_cart.php"; 
                break;

        // Xóa sản phẩm khỏi giỏ hàng
        case 'delete_cart':
            if (isset($_GET["cart_items_id"])) {
                array_splice($_SESSION["carts"], $_GET["cart_items_id"], 1);
            } else {
                $_SESSION["carts"] = [];
            }
            header('Location:./index.php?act=cart');
            break;

        // Thanh toán

        
        case 'checkout':
    // Xử lý khi người dùng chọn sản phẩm
    if (isset($_POST["check_choose_product"])) {
        if (isset($_POST["choose_product"]) && !empty($_POST["choose_product"])) {
            $selected_products = $_POST["choose_product"];

            // Lọc sản phẩm được chọn từ giỏ hàng
            $selected_carts = [];
            $total_price = 0;

            foreach ($selected_products as $index) {
                // Đảm bảo chỉ số hợp lệ và tồn tại trong giỏ hàng
                if (isset($_SESSION["carts"][$index])) {
                    $selected_carts[] = $_SESSION["carts"][$index];
                    $total_price += $_SESSION["carts"][$index][2] * $_SESSION["carts"][$index][4]; // Giá x Số lượng
                }
            }

            // Nếu có sản phẩm hợp lệ
            if (!empty($selected_carts)) {
                // Lưu thông tin sản phẩm được chọn để sử dụng trong form thanh toán
                $_SESSION["selected_carts"] = $selected_carts;
                $_SESSION["selected_total_price"] = $total_price;

                // Chuyển đến trang thanh toán
                header('Location: index.php?act=checkout');
                exit();
            } else {
                echo '<script>alert("Không có sản phẩm hợp lệ để thanh toán!");</script>';
            }
        } else {
            echo '<script>alert("Vui lòng chọn ít nhất một sản phẩm!");</script>';
        }
    }

    // Xử lý khi người dùng thực hiện thanh toán
    if (isset($_POST['submit_payment'])) {
        $customer_name = $_POST['customer_name'];
        $customer_phone = $_POST['customer_phone'];
        $shipping_address = $_POST['shipping_address'];
        $payment_method = $_POST['payment_method']; // Nhận hình thức thanh toán
        $total_price = $_SESSION["selected_total_price"] ?? 0;

        // Kiểm tra thông tin thanh toán
        if (!empty($customer_name) && !empty($customer_phone) && !empty($shipping_address) && !empty($payment_method)) {
            $status = 'Pending';
            $user_id = $_SESSION['user_id'];

            // Lưu thông tin đơn hàng vào bảng `orders`
            $sql = "INSERT INTO orders (user_id, customer_name, customer_phone, shipping_address, total_price, payment_method, status, created_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
            pdo_execute($sql, $user_id, $customer_name, $customer_phone, $shipping_address, $total_price, $payment_method, $status);

            // Xóa các sản phẩm đã thanh toán khỏi giỏ hàng
            foreach ($_SESSION["selected_carts"] as $selected_cart) {
                $key = array_search($selected_cart, $_SESSION["carts"]);
                if ($key !== false) {
                    unset($_SESSION["carts"][$key]);
                }
            }
            $_SESSION["carts"] = array_values($_SESSION["carts"]); // Re-index array
            unset($_SESSION["selected_carts"], $_SESSION["selected_total_price"]);

            // Thông báo và chuyển hướng
            echo '<script>alert("Thanh toán thành công! Hình thức thanh toán: ' . $payment_method . '"); window.location.href = "index.php?act=home";</script>';
            exit();
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