<div class="container">
    <h2>Giỏ hàng</h2>

    <!-- Kiểm tra nếu giỏ hàng có sản phẩm không -->
    <?php if (empty($_SESSION["carts"])): ?>
        <p>Giỏ hàng của bạn hiện đang trống. Hãy thêm sản phẩm vào giỏ hàng.</p>
    <?php else: ?>
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
                $sum = 0;
                $i = 0;
                foreach ($_SESSION["carts"] as $cart) {
                    $img = $path_url . $cart[3];
                    $total = $cart[2] * $cart[4];
                    $sum += $total;

                    // Xử lý nút xóa sản phẩm bằng form POST
                    $delete_product = '
                    <form action="index.php?act=delete_cart" method="POST" style="display:inline;">
                        <input type="hidden" name="id_cart" value="' . $i . '">
                        <button type="submit" class="btn btn-warning">Xoá</button>
                    </form>';

                    echo '<tr>
                            <td><img src="' . $img . '" alt="Product Image" style="width: 50px;"></td>
                            <td>' . $cart[1] . '</td>
                            <td>' . number_format($cart[2], 0, ',', '.') . ' VND</td>     
                            <td>' . $cart[4] . '</td>
                            <td>' . number_format($total, 0, ',', '.') . ' VND</td>
                            <td>' . $delete_product . '</td>
                        </tr>';
                    $i++;
                }
                ?>

                <!-- Hiển thị tổng đơn hàng -->
                <tr>
                    <td colspan="4">Tổng đơn hàng</td>
                    <td><strong><?php echo number_format($sum, 0, ',', '.') . ' VND'; ?></strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Nút thanh toán và chọn thêm mặt hàng -->
        <div class="d-flex justify-content-end">
            <a href="index.php?act=checkout" class="btn btn-primary">Thanh Toán</a>
        </div>
        <div class="d-flex justify-content-end">
            <a href="index.php?act=home" class="btn btn-primary">Chọn thêm mặt hàng</a>
        </div>
    <?php endif; ?>
</div>
