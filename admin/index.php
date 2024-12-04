<?php

    include "./header.php";
    include "../model/pdo.php";
    include "../model/model_categories.php";
    include "../model/model_products.php";
    include "../model/model_orders.php";
    include "../model/model_users.php";
    
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
                
                $key = isset($_GET['key']) ? $_GET['key'] : ""; // Gán chuỗi rỗng nếu không có giá trị.
                $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0; // Gán 0 nếu không có giá trị.
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
           
                if(isset($_POST["update_submit"]) && $_POST["update_submit"]){
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
                        // echo "Sorry, there was an error uploading your file.";
                    }

                    if($price >0 && $stock_quantity >0){
                        update_products($product_id,$category_id,$product_name,$description,$price,$stock_quantity,$created_at,$updated_at,$image_url);
                    }else{
                        echo "Chọn danh mục khác";
                    }

                    
            
                }
                
                $list_products = list_all_products($key,$category_id);
                include "./products/list_products.php";
                break;



                //danh sách đơn hàng;

            case 'orders':
                # code...

                $list_orders = list_all_orders();
                include "./orders/list_orders.php";
                break;
                
            //đơn hàng chi tiết
            case 'order_detail':
                 if (isset($_GET["order_id"]) && $_GET["order_id"] > 0) {
                    $order_id = $_GET["order_id"];
                    $order_detail = load_one_orders($order_id);
                    include "./orders/order_detail_admin.php";
                }
                
                break;

            
            //cập nhật trạng thái đơn hàng

            case 'update_orders_status':
           
                if(isset($_POST["update_status"]) && $_POST["update_status"]){
                    $order_id = $_POST["order_id"];

                    $status = $_POST["status"];
                    

                    update_orders_status($order_id,$status);
                    // $notifications = "Thêm thành công";
                }
                
                $list_orders = list_all_orders();
                include "./orders/list_orders.php";
                break;






            case 'manage_users':
                        $users = get_all_users();
                        include __DIR__ . '/users/users_list.php';

                        break;
                    
                        case 'add_user':
                            if (isset($_POST['submit'])) {
                                $username = $_POST['username'];
                                $password = $_POST['password']; 
                                $email = $_POST['email'];
                                $phone = $_POST['phone'];
                                $address = $_POST['address'];
                                $role = $_POST['role'];
                        
                                add_user($username, $password, $email, $phone, $address, $role);
                                header('Location: index.php?act=manage_users');
                                exit();
                            }
                            include __DIR__ . '/users/user_form.php';

                            break;
                        
                    
                    case 'edit_user':
                        if (isset($_GET['id']) && $_GET['id'] > 0) {
                            $user_id = $_GET['id']; // Thay đổi biến từ $id thành $user_id
                            $user = get_user_by_id($user_id); // Sử dụng hàm lấy thông tin người dùng dựa trên user_id
                        }
                    
                        if (isset($_POST['submit'])) {
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $role = $_POST['role'];
                            update_user($user_id, $username, $email, $role); // Gọi hàm với $user_id
                            header('Location: index.php?act=manage_users');
                        }
                        include __DIR__ . '/users/user_formUpdate.php';
                        break;
                    
                    case 'delete_user':
                        if (isset($_GET['id']) && $_GET['id'] > 0) {
                            $id = $_GET['id'];
                            delete_user($id);
                            header('Location: index.php?act=manage_users');
                        }
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