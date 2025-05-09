<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

include_once './App/Views/Layout/Adminheader.php';
?>

<div class="container mt-5 mb-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning d-flex align-items-center">
            <h4 class="mb-0 fw-bold">Chi Tiết Đơn Hàng #<?= htmlspecialchars($order['id']) ?></h4>
            <div class="ms-auto d-flex gap-2">
                <a href="<?= $baseURL ?>admin/orders" class="btn btn-light btn-sm"><i class="fas fa-arrow-left"></i> Quay lại</a>
                <button class="btn btn-primary btn-sm" onclick="window.print()"><i class="fas fa-print"></i> In đơn hàng</button>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <!-- Thông tin đơn hàng -->
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Thông Tin Đơn Hàng</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Ngày đặt:</strong> <?= htmlspecialchars(date('d/m/Y H:i', strtotime($order['order_date']))) ?></p>
                            <p><strong>Tổng tiền:</strong> <span class="text-success"><?= number_format($order['total'], 0, ',', '.') ?> VNĐ</span></p>
                            <p><strong>Trạng thái:</strong> 
                                <?php
                                $status = htmlspecialchars($order['status']);
                                $badgeClass = $status === 'pending' ? 'badge-warning' : ($status === 'completed' ? 'badge-success' : 'badge-danger');
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                            </p>
                            <p><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
                        </div>
                    </div>

                    <!-- Thông tin thanh toán -->
                    <?php if ($order['billing_info']) : ?>
                        <?php $billing = json_decode($order['billing_info'], true); ?>
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Thông Tin Thanh Toán</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Tên:</strong> <?= htmlspecialchars($billing['name']) ?></p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($billing['email']) ?></p>
                                <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($billing['phone']) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Địa chỉ giao hàng -->
                    <?php if ($order['shipping_address']) : ?>
                        <?php $shipping = json_decode($order['shipping_address'], true); ?>
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Địa Chỉ Giao Hàng</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($shipping['address']) ?></p>
                                <p><strong>Thành phố:</strong> <?= htmlspecialchars($shipping['city']) ?></p>
                                <?php if (isset($shipping['zip'])) : ?>
                                    <p><strong>Mã bưu điện:</strong> <?= htmlspecialchars($shipping['zip']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Danh sách sản phẩm -->
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Sản Phẩm Trong Đơn Hàng</h5>
                        </div>
                        <div class="card-body">
                            <?php if (empty($order['items'])) : ?>
                                <p class="text-muted">Không có sản phẩm nào trong đơn hàng.</p>
                            <?php else : ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Tên Sản Phẩm</th>
                                                <th>Số Lượng</th>
                                                <th>Giá</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($order['items'] as $item) : ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($item['product_name'] ?? $item['featured_product_name'] ?? 'Không xác định') ?></td>
                                                    <td><?= htmlspecialchars($item['quantity']) ?></td>
                                                    <td><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</td>
                                                    <td><?= number_format($item['quantity'] * $item['price'], 0, ',', '.') ?> VNĐ</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 8px;
}
.card-header {
    background-color: #fff3cd;
    border-bottom: 2px solid #ffca2c;
}
.card-header h4 {
    font-size: 1.8rem;
    color: #000;
    text-transform: uppercase;
}
.table-hover tbody tr:hover {
    background-color: #f8f9fa;
}
.badge {
    font-size: 0.9em;
    padding: 0.5em 1em;
}
.badge-warning {
    background-color: #ffc107;
    color: #212529;
}
.badge-success {
    background-color: #28a745;
    color: #fff;
}
.badge-danger {
    background-color: #dc3545;
    color: #fff;
}
.btn-light {
    display: flex;
    align-items: center;
    gap: 5px;
}
@media print {
    .btn, .no-print {
        display: none;
    }
}
</style>

<?php
include_once './App/Views/Layout/footer.php';
?>