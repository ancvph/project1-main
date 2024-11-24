<div class="container">
    <h1>Add category</h1>

    <form action="index.php?act=add_categories" method="post">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="ID" name="category_id" disabled>

        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Danh mục" name="category_name">
            <label for="category">Danh mục</label>
        </div>


        <input type="submit" name="add_submit" value="Thêm danh mục" class="btn btn-primary m-2">

    </form>
    <?php 
        if(isset($notifications) && $notifications !="" ){
            echo $notifications ;
        }
    ?>
</div>