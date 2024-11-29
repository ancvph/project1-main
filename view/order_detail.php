<?php
// Lấy thông tin đơn hàng và các sản phẩm trong đơn hàng
$order_id = $_GET['order_id']; // Giả sử order_id được truyền qua URL
$order = get_order_by_id($order_id);
$order_items = get_order_items($order_id);

// Tính tổng tiền của đơn hàng
$total_price = 0;
foreach ($order_items as $item) {
    $total_price += $item['quantity'] * $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <div class="order-details">
            <h1 class="order-title text-center">Chi Tiết Đơn Hàng</h1>
            <div class="row">
                <!-- Sản phẩm trong đơn hàng -->
                <div class="col-md-8 order-items">
                    <h4 class="text-primary">Sản phẩm</h4>
                    <?php foreach ($order_items as $item) { ?>
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?= $item['image_url'] ?>" alt="Product Image" class="me-3" style="width: 50px;">
                        <div>
                            <h5><?= $item['product_name'] ?></h5>
                            <p>Số lượng: <?= $item['quantity'] ?> | Giá: <?= number_format($item['price'], 0, ',', '.') ?>đ</p>
                            <p>Thành tiền: <?= number_format($item['quantity'] * $item['price'], 0, ',', '.') ?>đ</p>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="order-total">Tổng cộng: <?= number_format($total_price, 0, ',', '.') ?>đ</div>
                </div>

                <!-- Thông tin đơn hàng -->
                <div class="col-md-4 order-summary">
                    <h4 class="text-primary">Thông tin đơn hàng</h4>
                    <p><strong>Mã đơn hàng:</strong> <?= $order['order_id'] ?></p>
                    <p><strong>Ngày đặt:</strong> <?= $order['created_at'] ?></p>
                    <p><strong>Trạng thái:</strong> <?= $order['status'] ?></p>
                    <p><strong>Phương thức thanh toán:</strong> <?= $order['payment_method'] ?></p>
                    <p><strong>Phí vận chuyển:</strong> 0đ</p>
                    <p><strong>Tổng tiền:</strong> <?= number_format($total_price, 0, ',', '.') ?>đ</p>
                    <a href="index.php?act=order_history" class="btn btn-primary">Quay lại Lịch Sử Đơn Hàng</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
