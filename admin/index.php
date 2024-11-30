<?php

    include "./header.php";
    include "../model/pdo.php";
    include "../model/model_categories.php";
    include "../model/model_products.php";
    include "../model/model_orders.php";
    if(isset($_GET['act'])){
        $act = $_GET['act'];
        switch ($act) {
            //catergories
            //in ra danh sách danh mục
            case 'categories':
                # code...
                $list_categories = list_all_categories();
                
                include "./categories/list_categories.php";
                break;


            //thêm danh mục
            case 'add_categories':
                # code...
                if(isset($_POST["add_submit"]) && $_POST["add_submit"]){
                    $category_name = $_POST["category_name"];
                    
                    insert_categories($category_name);
                    
                    $notifications = "Thêm thành công";
                }
                include "./categories/add_categories.php";
                break;


            
            //sửa danh mục

            case 'fix_categories':
                # code...
                if(isset($_GET['category_id']) && $_GET['category_id'] >0){
                    $update_categories = insert_one_categories($_GET['category_id']);
                }
                include "./categories/update_categories.php";
                break;


            //cập nhật danh mục
            case 'update_categories':
           
                if(isset($_POST["update_submit"]) && $_POST["update_submit"]){
                    $category_id = $_POST["category_id"];

                    $category_name = $_POST["category_name"];
                    

                    update_categories($category_id,$category_name);
                    // $notifications = "Thêm thành công";
                }
                
                $list_categories = list_all_categories();
                include "./categories/list_categories.php";
                break;

            //xoá danh mục
            case 'delete_categories':
                # code...
                
                if(isset($_GET['category_id']) ){
                    delete_categories($_GET['category_id']);

                }
                
                $list_categories = list_all_categories();
                
                include "./categories/list_categories.php";
                break;



            
                
                
                //products

            // in ra danh sách sản phẩm
            case 'products':
                # code...

                if(isset($_POST["search"]) && $_POST["search"]){
                    $key = $_POST["key"];
                    $category_id = $_POST["category_id"];
                }else{
                    $key = "";
                    $category_id = 0;
                }
                $list_categories = list_all_categories();
                $list_products = list_all_products($key,$category_id);
                include "./products/list_products.php";
                break;
                
           
                
            

            //thêm sản phẩm
            case 'add_products':
                # code...
                if(isset($_POST["add_submit"]) && $_POST["add_submit"]){
                    
                    $product_name = $_POST["product_name"];
                    $description = $_POST["description"];
                    $price = $_POST["price"];
                    $stock_quantity = $_POST["stock_quantity"];
                    $created_at = $_POST["created_at"];
                    $updated_at = $_POST["updated_at"];
                    $image_url = $_FILES["image_url"]["name"];
                    $category_id = $_POST["category_id"];
                    $target_dir = "../upload/";
                    $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
                    if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file)) {
                        // echo "The file ". htmlspecialchars( basename( $_FILES["image_url"]["name"])). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }

                    if($price >0 && $stock_quantity >0){
                        insert_products($category_id,$product_name,$description,$price,$stock_quantity,$created_at,$updated_at,$image_url);
                    }else{
                        echo "Chọn danh mục khác";
                    }
                    
                    $notifications = "Thêm thành công";
                }
                $list_categories = list_all_categories();
                include "./products/add_products.php";
                break;


            //xoá sản phẩm

            case 'delete_products':
                # code...
                
                if(isset($_GET['product_id']) && $_GET['product_id'] >0){
                    delete_products($_GET['product_id']);

                }
                
                
                $list_products = list_all_products($key,$category_id);
                
                include "./products/list_products.php";
                break;
                


             //sửa sản phẩm

            case 'fix_products':
                # code...
                if(isset($_GET['product_id']) && $_GET['product_id'] >0){
                    $update_products = insert_one_products($_GET['product_id']);
                }
                $list_categories = list_all_categories();
                include "./products/update_products.php";
                break;


            //cập nhật sản phẩm
            case 'update_products':
                if (isset($_POST["update_submit"]) && $_POST["update_submit"]) {
                    // Kiểm tra dữ liệu đầu vào từ form
                    $product_id = $_POST["product_id"] ?? null; // Đảm bảo product_id được truyền
                    $product_name = htmlspecialchars(trim($_POST["product_name"]));
                    $description = htmlspecialchars(trim($_POST["description"]));
                    $price = floatval($_POST["price"]);
                    $stock_quantity = intval($_POST["stock_quantity"]);
                    $created_at = $_POST["created_at"];
                    $updated_at = $_POST["updated_at"];
                    $category_id = intval($_POST["category_id"]);
            
                    // Xử lý ảnh
                    $image_url = $_FILES["image_url"]["name"];
                    $target_dir = "../upload/";
                    $target_file = $target_dir . basename($image_url);
            
                    if (!empty($image_url)) {
                        if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file)) {
                            // File đã được tải lên thành công
                        } else {
                            echo "Có lỗi xảy ra khi tải lên file.";
                        }
                    }
            
                    // Kiểm tra điều kiện và cập nhật sản phẩm
                    if ($price > 0 && $stock_quantity > 0 && !empty($product_id)) {
                        update_products($product_id, $category_id, $product_name, $description, $price, $stock_quantity, $created_at, $updated_at, $image_url);
                    } else {
                        echo "Vui lòng kiểm tra lại dữ liệu nhập vào.";
                    }
                }
            
                // Kiểm tra tham số tìm kiếm (key)
                $key = $_POST['key'] ?? ''; // Lấy giá trị key từ form tìm kiếm nếu có
            
                // Lấy danh sách sản phẩm
                $list_products = list_all_products($key, $category_id);
                include "./products/list_products.php";
                break;
            
            

                case 'orders':
                    # code...
    
                    $list_orders = list_all_orders();
                    include "./orders/list_orders.php";
                    break;
                    

            //không tìm thấy trang => trỏ về trang chủ admin
            default:
                # code...
                include "./admin.php";
                break;
        }
    }else{
        include "./admin.php";

    }
?>