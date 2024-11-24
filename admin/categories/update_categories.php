<?php
    if(isset($update_categories) && is_array($update_categories)){
        extract($update_categories);
    }

?>


<div class="container">
    <h1>Update category</h1>

    <form action="index.php?act=update_categories" method="post">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="ID" name="category_id" value="<?=$category_id?>"
                disabled>

            <input type="hidden" name="category_id" value="<?=$category_id?>">

        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Danh mục" name="category_name"
                value="<?=$category_name?>">
            <label for="category">Danh mục</label>
        </div>


        <input type="submit" name="update_submit" value="Sửa danh mục" class="btn btn-primary m-2">

    </form>
    <?php 
        if(isset($notifications) && $notifications !="" ){
            echo $notifications ;
        }
    ?>
</div>