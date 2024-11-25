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
                    <input type="hidden" name="total_price" value="<?php echo $sum; ?>">
                    <button type="submit" name="submit_payment" class="btn btn-primary">Thanh Toán</button>
                </form>
            </div>