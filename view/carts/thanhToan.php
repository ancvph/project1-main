<div class="container">
    <h2>Thanh Toán</h2>

    <!-- Hiển thị thông tin giỏ hàng -->
    <h4>Thông tin giỏ hàng</h4>
    <table class="table table-striped" border="2">
        <thead>
            <tr>
                <th scope="col">Ảnh Sản phẩm</th>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
                        $sum = 0;
                        foreach ($_SESSION["carts"] as $cart) {
                            $img = $path_url . $cart[3];
                            $total = $cart[2] * $cart[4];
                            $sum += $total;
                            echo '<tr>
                                    <td><img src="' . $img . '" alt="Product Image" style="width: 50px;"></td>
                                    <td>' . $cart[1] . '</td>
                                    <td>' . $cart[2] . '</td>
                                    <td>' . $cart[4] . '</td>
                                    <td>' . $total . '</td>
                                  </tr>';
                        }
                        ?>
            <tr>
                <td colspan="4">Tổng đơn hàng</td>
                <td><?php echo $sum; ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Form thanh toán -->
    <h4>Thông tin thanh toán</h4>
    <form method="POST" action="index.php?act=checkout">
        <div class="form-group">
            <label for="customer_name">Tên khách hàng</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
        </div>
        <div class="form-group">
            <label for="customer_phone">Số điện thoại</label>
            <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
        </div>
        <div class="form-group">
            <label for="shipping_address">Địa chỉ giao hàng</label>
            <textarea class="form-control" id="shipping_address" name="shipping_address" required></textarea>
        </div>
        <h3>Chọn phương thức thanh toán</h3>
        <div>
            <input type="radio" id="payment_cod" name="payment_method" value="COD" required>
            <label for="payment_cod">Thanh toán khi nhận hàng (COD)</label>
        </div>
        <div>
            <input type="radio" id="payment_card" name="payment_method" value="Card">
            <label for="payment_card">Thanh toán qua thẻ ngân hàng</label>
        </div>
        <div>
            <input type="radio" id="payment_wallet" name="payment_method" value="Wallet">
            <label for="payment_wallet">Thanh toán qua ví điện tử</label>
        </div>
        <input type="hidden" name="total_price" value="<?php echo $sum; ?>">
        <button type="submit" name="submit_payment" class="btn btn-primary m-2">Thanh Toán</button>
    </form>
</div>