<div class="container">
    <h1>Add product</h1>

    <form action="index.php?act=add_products" method="post" enctype="multipart/form-data">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="ID" name="product_id" disabled>

        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Sản phẩm" name="product_name">
            <label for="product">Sản phẩm</label>
        </div>
        <div class="form-floating mb-3">
            <!-- <input type="text" class="form-control" placeholder="Sản phẩm" name="product_name"> -->

            <select name="category_id">

                <option value="">Danh mục</option>
                <?php
                    foreach($list_categories as $category){
                        extract($category);
                        echo '<option value="'.$category_id.'">'.$category_name.'</option>';
                    }
                ?>

            </select>

        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="giá" name="price">
            <label for="price">Giá sản phẩm</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="lượng hàng" name="stock_quantity">
            <label for="stock_quantity">Lượng hàng tồn kho</label>
        </div>
        <div class="form-floating mb-3">
            <input type="date" class="form-control" placeholder="ngày tạo" name="created_at">
            <label for="created_at">Ngày tạo</label>
        </div>
        <div class="form-floating mb-3">
            <input type="date" class="form-control" placeholder="ngày đăng" name="updated_at">
            <label for="updated_at">Ngày đăng</label>
        </div>
        <div class="form-floating mb-3">
            <input type="file" class="form-control" placeholder="đường dẫn ảnh" name="image_url">
            <label for="image_url">Ảnh sản phẩm</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Mô tả" name="description">
            <label for="product">Mô tả</label>
        </div>


        <input type="submit" name="add_submit" value="Thêm sản phẩm" class="btn btn-primary m-2">

    </form>
    <?php 
        if(isset($notifications) && $notifications !="" ){
            echo $notifications ;
        }
    ?>
</div>