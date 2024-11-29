<h2>Lịch Sử Đơn Hàng</h2>

<?php if (!empty($orders)): ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Mã Đơn Hàng</th>
                <th>Ngày Đặt</th>
                <th>Tổng Tiền</th>
                <th>Phương Thức Thanh Toán</th>
                <th>Trạng Thái</th>
                <th>Chi Tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['order_id'] ?></td>
                    <td><?= date("d/m/Y H:i:s", strtotime($order['created_at'])) ?></td>
                    <td><?= number_format($order['total_price']) ?> VNĐ</td>
                    <td><?= $order['payment_method'] ?></td>
                    <td><?= $order['status'] ?></td>
                    <td>
                        <a href="index.php?act=order_detail&order_id=<?= $order['order_id'] ?>">Xem Chi Tiết</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Bạn chưa có đơn hàng nào.</p>
<?php endif; ?>
