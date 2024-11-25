<?php
    function list_all_products($key,$category_id){
        $sql ="SELECT * from products where 1";
        if($key != ""){
            $sql .= " AND category_name like '%".$key."%'";
        }
         if($category_id > 0){
            $sql .= " AND category_id like '".$category_id."'";
        }
        $sql .= " order by category_id desc";

        $list_products = pdo_query($sql);
        return $list_products;
    }


    function insert_products($category_id,$product_name,$description,$price,$stock_quantity,$created_at,$updated_at,$image_url){
        $sql = "insert into products(category_id,product_name,description,price,stock_quantity,created_at,updated_at,image_url) values('$category_id','$product_name','$description','$price','$stock_quantity','$created_at','$updated_at','$image_url')";
        pdo_execute($sql);
    }


    function delete_products($product_id){
        $sql = "delete from products where product_id=".$_GET['product_id'];
        pdo_execute($sql);
    }


    function insert_one_products($product_id){
        $sql = "select * from products where product_id=".$_GET['product_id'];
        $update_products = pdo_query_one($sql);
        return $update_products;
    }

     function load_one_products($product_id){
        $sql = "select * from products where product_id=".$product_id;
        $load_products = pdo_query_one($sql);
        return $load_products;
    }

    
    function update_products($product_id,$category_id,$product_name,$description,$price,$stock_quantity,$created_at,$updated_at,$image_url){
        $sql = "update products set category_id = '$category_id, product_name = '$product_name', description = '$description', price = '$price', stock_quantity = '$stock_quantity', created_at = '$created_at', updated_at = '$updated_at', image_url = '$image_url' ' where product_id =". $product_id;
        pdo_execute($sql);
    }
             
    
    //load sản phẩm ra trang chủ
    function list_all_products_home(){
        $sql ="select * from products ";
        $list_products = pdo_query($sql);
        return $list_products;
    }

?>