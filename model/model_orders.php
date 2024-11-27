<?php
    function list_all_orders(){
        $sql ="SELECT * from orders";
        

        $list_orders = pdo_query($sql);
        return $list_orders;
    }


?>