<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng đến login.php
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
};
    include "./model/pdo.php";
    include "./model/model_products.php";
    include "./model/model_categories.php";
    include "./view/header.php";
    include "./global.php";



     //kiểm tra xem mảng có tồn tại không
    if(!isset($_SESSION["carts"])){
        $_SESSION["carts"] = [];
    }

    
    $load_categories = list_all_categories_home();
    $load_products = list_all_products_home();
    if(isset($_GET['act']) && ($_GET['act']!="") ){
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
                if(isset($_GET["product_id"]) && $_GET["product_id"]>0){
                    $product_id = $_GET["product_id"];
                    $detail = load_one_products($product_id);
                    include "./view/detail.php"; 
                }
                // else{
                //     include "./view/product.php";

                // }
                 break;

            //thêm vào giỏ hàng
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
                
                case 'delete_cart': 
                    if(isset($_GET["id_cart"])){
                        array_slice($_SESSION["carts"],$_GET["id_cart"],1);
                    }else{
                        $_SESSION["carts"] = [];
                    }
                    header('Location:./index.php?act=cart');
                    
                    
                    break;
            default:
                include "./view/home.php";
                break;
        }
    }else{
        include "./view/home.php";
    }
    include "./view/footer.php";
?>