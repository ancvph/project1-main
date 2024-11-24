<div class="container">
    <h1>Trang danh sách sản phẩm</h1>
    <a href="./index.php?act=add_products"><button type="button" class="btn btn-primary m-2">Thêm sản phẩm</button></a>

    <form action="index.php?act=products" class="form m-2" method="post">
        <input type="text" name="key">

        <select name="category_id">

            <option value="" selected>Tất cả</option>
            <?php
                    foreach($list_categories as $category){
                        extract($category);
                        echo '<option value="'.$category_id.'">'.$category_name.'</option>';
                    }
                ?>

        </select>
        <input type="submit" name="search" value="Search">

    </form>

    <table class="table table-striped" border="2">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Ảnh sản phẩm</th>
                <th scope="col">Danh mục</th>
                <th scope="col">Giá</th>
                <th scope="col">Lượng hàng tồn kho</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Ngày đăng</th>
                <th scope="col">Mô tả</th>

                <th scope="col">Chuyển hướng</th>
            </tr>
            <img src="" alt="">
        </thead>
        <tbody>

            <?php                                                                                    
            foreach ($list_products as $product){
                extract($product);
                $update = "./index.php?act=fix_products&product_id=".$product_id;
                $delete = "./index.php?act=delete_products&product_id=".$product_id;

                $path_url ="../upload/".$image_url;
                if(is_file($path_url)){
                    $img = '<img src="'.$path_url.'" alt="" width="70">';
                }else{
                    $img = "No Photo";
                }
                
                echo '<tr>
                        <th scope="row">'.$product_id.'</th>
                        <td>'.$product_name.'</td>
                        <td>'.$img.'</td>
                        <td>
                            Danh mục
                        </td>
                        <td>'.$price.'</td>
                        <td>'.$stock_quantity.'</td>
                        <td>'.$created_at.'</td>
                        <td>'.$updated_at.'</td>
                        <td>'.$description.'</td>

                        <td>
                            <a href="'.$update.'"><button type="button" class="btn btn-danger mb-2">Sửa</button></a>
                            <a href="'.$delete.'"><button type="button" class="btn btn-warning">Xoá</button></a>
                        </td>
                        </tr>';
                        }
                        ?>


        </tbody>
    </table>
</div>