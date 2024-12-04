<div class="container mt-3">
    <div class="row">
        <div class="col-2">

        </div>
        <div class="col">
            <form action="index.php?act=update_orders_status" method="post">
                <input type="hidden" name="order_id" value="<?= $order_id ?>">
                <div class="card">

                    <?php
                    extract($order_detail);
                ?>
                    <div class="card-header">
                        <h4>Mã đơn hàng: <?= $order_id?></h4>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Tên khách hàng: <?= $customer_name?></h3>
                        <h5 class="card-title">Số điện thoại: <?= $customer_phone?></h5>
                        <h5 class="card-title">Địa chỉ nhận hàng: <?= $shipping_address?></h5>
                        <h5 class="card-title">Tổng tiền: <?=  number_format($total_price,0,',','.')?> VNĐ</h5>
                        <h5 class="card-title">Hình thức thanh toán: <?= $payment_method?></h5>
                        <h5 class="card-title">Ngày tạo đơn: <?= $created_at?></h5>
                        <h5 class="card-title">Trạng thái đơn hàng:
                            <select name="status" id="" required>
                                <option value="Đã đặt hàng">Đã đặt hàng</option>

                                <option value="Đang vận chuyển">Đang vận chuyển</option>

                                <option value="Đã giao">Đã giao</option>


                            </select>
                        </h5>



                        <!-- <a href="index.php?act=orders" class="btn btn-primary">Danh sách đơn hàng</a> -->
                        <input type="submit" name="update_status" value="Danh sách đơn hàng"
                            class="btn btn-primary m-2">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-2">

        </div>
    </div>

</div>