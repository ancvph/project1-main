<div class="container">
    <h2>Giỏ hàng</h2>
    <table class="table table-striped" border="2">
        <thead>
            <tr>

                <th scope="col">Ảnh Sản phẩm</th>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
                <th scope="col">Thao tác</th>
            </tr>

        </thead>

        <tbody>
            <?php
                $sum=0;
                $i=0;
                foreach($_SESSION["carts"] as $cart){
                    $img = $path_url.$cart[3];
                    $total = $cart[2] *$cart[4];
                    $sum += $total;
                    $delete_product = '<a href="/index.php?act=delete_cart&id_cart='.$i.'"><button type="button" class="btn btn-warning">Xoá</button></a>';
                    echo' <tr>
                            
                            <td><img src="'. $img .'" alt="Product Image" style="width: 50px;"></td>
                            <td>'.$cart[1].'</td>
                            <td> '.$cart[2].'</td>     
                            <td> '.$cart[4].'</td>
                            <td> '.$total.'</td>
                            <td>'.$delete_product.'</td>
                        </tr>';
                        $i++;
                }
                echo ' <tr>
                            <td colspan="4">Tổng đơn hàng</td>
                            <td>'.$sum.'</td>
                        </tr>';

                        
           ?>
           

        </tbody>
    </table>
    <div class="d-flex justify-content-end">
    <a href="index.php?act=checkout" class="btn btn-primary">Thanh Toán</a>
</div>
<div class="d-flex justify-content-end">
    <a href="index.php?act=home" class="btn btn-primary">Chọn thêm mặt hàng</a>
</div>
</div>