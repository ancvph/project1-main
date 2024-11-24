<?php
    if(is_array($update_products)){
        extract($update_products);
    }

    $path_url ="../upload/".$image_url;
    if(is_file($path_url)){
        $img = '<img src="'.$path_url.'" alt="" width="70">';
    }else{
        $img = "No Photo";
    }
                
?>


<div class="container">
    <h1>Update product</h1>

    <form action="index.php?act=update_products" method="post" enctype="multipart/form-data">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="ID" name="product_id" value="<?=$product_id?>"
                disabled>
            <input type="hidden" name="product_id" value="<?=$product_id?>">

        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Sản phẩm" name="product_name"
                value="<?=$product_name?>">
            <label for="product">Sản phẩm</label>
        </div>
        <div class="form-floating mb-3">
            <!-- <input type="text" class="form-control" placeholder="Sản phẩm" name="product_name"> -->

            <select name="category_id" id="">
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
            <input type="text" class="form-control" placeholder="giá" name="price" value="<?=$price?>">
            <label for="price">Giá sản phẩm</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="lượng hàng" name="stock_quantity"
                value="<?=$stock_quantity?>">
            <label for="stock_quantity">Lượng hàng tồn kho</label>
        </div>
        <div class="form-floating mb-3">
            <input type="date" class="form-control" placeholder="ngày tạo" name="created_at" value="<?=$created_at?>">
            <label for="created_at">Ngày tạo</label>
        </div>
        <div class="form-floating mb-3">
            <input type="date" class="form-control" placeholder="ngày đăng" name="updated_at" value="<?=$updated_at?>">
            <label for="updated_at">Ngày đăng</label>
        </div>
        <div class="form-floating mb-3">
            <input type="file" class="form-control" placeholder="đường dẫn ảnh" name="image_url"
                value="<?=$image_url?>">
            <div class="show_img m-2">
                <?=$img?>
            </div>
            <label for="image_url">Ảnh sản phẩm</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" placeholder="Mô tả" name="description" value="<?=$description?>">
            <label for="product">Mô tả</label>
        </div>


        <input type="submit" name="update_submit" value="Cập nhật sản phẩm" class="btn btn-primary m-2">

    </form>

</div>