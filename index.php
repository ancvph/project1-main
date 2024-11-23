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
            default:
                include "./view/home.php";
                break;
        }
    }else{
        include "./view/home.php";
    }
    include "./view/footer.php";
?>