<div class="container">
    <h1>Trang danh sách đơn hàng</h1>
    <!-- <a href="./index.php?act=add_products"><button type="button" class="btn btn-primary m-2">Thêm sản phẩm</button></a> -->

    <!-- <form action="index.php?act=products" class="form m-2" method="post">
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

    </form> -->

    <table class="table table-striped" border="2">
        <thead>
            <tr>
                <th scope="col">ID đơn hàng</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Giá đơn hàng</th>
                <th scope="col">Trạng thái đơn hàng</th>

                <th scope="col">Địa chỉ</th>
                <th scope="col">Hình thức thanh toán</th>


                <!-- <th scope="col">Chuyển hướng</th> -->
            </tr>
            <img src="" alt="">
        </thead>
        <tbody>

            <?php                                                                                    
            foreach ($list_orders as $order){
                extract($order);
                $update = "./index.php?act=fix_orders&order_id=".$order_id;
                $delete = "./index.php?act=delete_orders&order_id=".$order_id;

                // $path_url ="../upload/".$image_url;
                // if(is_file($path_url)){
                //     $img = '<img src="'.$path_url.'" alt="" width="70">';
                // }else{
                //     $img = "No Photo";
                // }
                
                echo '<tr>
                            <th scope="row">'.$order_id.'</th>
                            <td>'.$customer_name.'</td>
                            <td>'.number_format($total_price,0,',','.').' VNĐ</td>
                            <td>'.$status.'</td>
                            
                            <td>'.$shipping_address.'</td>
                            <td>'.$payment_method.'</td>
                            <td><a href="index.php?act=order_detail&order_id='.$order_id.'">Chi tiết</a></td>
                        
                        </tr>';
                        }
                        ?>


        </tbody>
        <!-- <td>
            <a href="'.$update.'"><button type="button" class="btn btn-danger mb-2">Sửa</button></a>
            <a href="'.$delete.'"><button type="button" class="btn btn-warning">Xoá</button></a>
        </td> -->
    </table>
</div>