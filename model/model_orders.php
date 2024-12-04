<?php


    function get_orders_by_user($user_id) {
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
        return pdo_query($sql, $user_id);
    }
    function get_order_by_id($order_id) {
        $sql = "SELECT * FROM orders WHERE order_id = ?";
        return pdo_query_one($sql, $order_id);
    }
    function get_order_items_by_order($order_id) {
        $sql = "SELECT oi.*, p.product_name, p.image_url 
                FROM order_items oi 
                JOIN products p ON oi.product_id = p.product_id 
                WHERE oi.order_id = ?";
        return pdo_query($sql, $order_id);
    }
    function get_order_items($order_id) {
        $sql = "SELECT oi.*, p.product_name, p.image_url, p.price 
                FROM order_items oi
                JOIN products p ON oi.product_id = p.product_id
                WHERE oi.order_id = ?";
        return pdo_query($sql, $order_id); // Hàm này phải trả về một mảng các sản phẩm trong đơn hàng
    }
    function list_all_orders(){
        $sql ="SELECT * from orders";
        

        $list_orders = pdo_query($sql);
        return $list_orders;
    }



    function load_one_orders($order_id){
        $sql = "select * from orders where order_id=".$order_id;
        $load_orders = pdo_query_one($sql);
        return $load_orders;
    }

    function update_orders_status($order_id,$status){
        $sql = "update orders set status = '$status' where order_id =". $order_id;
        pdo_execute($sql);
    }
?>