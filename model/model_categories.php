<?php
    function list_all_categories(){
        $sql ="select * from categories ";
        $list_categories = pdo_query($sql);
        return $list_categories;
    }



    function insert_categories($category_name){
        $sql = "insert into categories(category_name) values('$category_name')";
        pdo_execute($sql);
    }


    function delete_categories($category_id){
        $sql = "delete from categories where category_id=".$_GET['category_id'];
        pdo_execute($sql);
    }


    function insert_one_categories($category_id){
        $sql = "select * from categories where category_id=".$_GET['category_id'];
        $update_categories = pdo_query_one($sql);
        return $update_categories;
    }
    function update_categories($category_id,$category_name){
        $sql = "update categories set category_name = '$category_name' where category_id =". $category_id;
        pdo_execute($sql);
    }


    function list_all_categories_home(){
        $sql ="select * from categories ";
        $list_categories = pdo_query($sql);
        return $list_categories;
    }
?>