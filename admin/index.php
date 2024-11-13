<?php
    include "./header.php";
    if(isset($_GET['act'])){
        $act = $_GET['act'];
        switch ($act) {
            case 'products':
                # code...
                include "./products/list_products.php";
                break;
            case 'categories':
                # code...
                include "./categories/list_categories.php";
                break;
            
            default:
                # code...
                include "./admin.php";
                break;
        }
    }else{
        include "./admin.php";

    }
?>