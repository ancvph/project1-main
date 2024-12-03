<div class="container">
    <h2>Giỏ hàng</h2>

    <form action="index.php?act=checkout" method="post">
        <table class="table table-striped" border="2">
            <thead>
                <tr>
                    <th>..</th>
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
                    $total = $cart[2] * $cart[4];
                    $sum += $total;
                    $delete_product = '<a href="/index.php?act=delete_cart&cart_items_id='.$i.'"><button type="button" class="btn btn-warning">Xoá</button></a>';
                    echo' <tr>
                            <td><input type="checkbox" name="choose_product[]" value="'.$i.'"></td>
                            <td><img src="'. $img .'" alt="Product Image" style="width: 50px;"></td>
                            <td>'.$cart[1].'</td>
                            <td>'.number_format($cart[2],0,',','.').' VNĐ</td>     
                            <td> '.$cart[4].'</td>
                            
                            <td> '.number_format($total,0,',','.').' VNĐ</td>
                            <td>'.$delete_product.'</td>
                        </tr>';
                        $i++;
                    
                }
                echo ' <tr>
                            <td colspan="4">Tổng đơn hàng</td>
                            <td>'.number_format($sum,0,',','.').' VNĐ</td>
                        </tr>';

                        
           ?>


            </tbody>
        </table>
        <div class="d-flex justify-content-end">

            <button type="submit" class="btn btn-outline-secondary m-2" name="check_choose_product">Thanh toán</button>
        </div>
        <div class="d-flex justify-content-end">
            <a href="index.php?act=home" class="btn btn-outline-success">Chọn thêm mặt hàng</a>
        </div>
    </form>

</div>