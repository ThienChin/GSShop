<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

include_once './App/Views/Layout/Homeheader.php';
?>

<section id="order-history">
    <div class="container">
        <h2>Lịch sử mua hàng</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($orders)): ?>
            <p>Bạn chưa có đơn hàng nào.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#<?= htmlspecialchars($order['id']) ?></td>
                            <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($order['order_date']))) ?></td>
                            <td><?= number_format($order['total'], 0, ',', '.') ?> VNĐ</td>
                            <td>
                                <?php
                                $status = htmlspecialchars($order['status']);
                                $statusClass = match ($status) {
                                    'Đặt hàng' => 'badge bg-warning',
                                    'completed' => 'badge bg-success',
                                    'canceled' => 'badge bg-danger',
                                    'pending' => 'badge bg-secondary',
                                    default => 'badge bg-info'
                                };
                                ?>
                                <span class="<?= $statusClass ?>"><?= $status ?></span>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="showOrderDetails(<?= $order['id'] ?>)">Xem chi tiết</button>
                                <div id="order-details-<?= $order['id'] ?>" style="display: none;" class="order-details mt-3 p-3 bg-light rounded">
                                    <h4>Chi tiết đơn hàng #<?= htmlspecialchars($order['id']) ?></h4>
                                    <p><strong>Thông tin thanh toán:</strong> 
                                        <?php
                                        $billing = $order['billing_info'];
                                        echo htmlspecialchars("{$billing['name']} - {$billing['phone']}" . (!empty($billing['email']) ? " - {$billing['email']}" : ''));
                                        ?>
                                    </p>
                                    <p><strong>Địa chỉ giao hàng:</strong> 
                                        <?php
                                        $shipping = $order['shipping_address'];
                                        echo htmlspecialchars("{$shipping['address']}, {$shipping['city']}");
                                        ?>
                                    </p>
                                    <h5>Sản phẩm:</h5>
                                    <ul class="list-group">
                                        <?php 
                                        $seenItems = []; // Theo dõi các mục đã hiển thị
                                        foreach ($order['items'] as $item): 
                                            $itemKey = ($item['product_id'] ?? 'fp_' . $item['featuredproduct_id']) . '_' . $item['price'];
                                            if (!in_array($itemKey, $seenItems)):
                                                $seenItems[] = $itemKey;
                                        ?>
                                            <li class="list-group-item">
                                                <strong><?= htmlspecialchars($item['product_name'] ?? $item['featured_product_name'] ?? 'Sản phẩm không xác định') ?></strong> 
                                                - Số lượng: <?= htmlspecialchars($item['quantity']) ?> 
                                                - Giá: <?= number_format($item['price'], 0, ',', '.') ?> VNĐ
                                            </li>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>

<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="companyinfo">
                        <h2><span>GS</span>Shop</h2>
                        <p>Cung cấp PC, laptop và phụ kiện chất lượng cao với giá cạnh tranh.</p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="address">
                        <img src="<?= $base ?>assets/images/home/map.png" alt="Bản đồ GSShop" />
                        <p>123 Đường Lê Lợi, Quận 1, TP. Hồ Chí Minh, Việt Nam</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Dịch vụ</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="">Hỗ trợ trực tuyến</a></li>
                            <li><a href="<?= $baseURL ?>user/contact">Liên hệ</a></li>
                            <li><a href="<?= $baseURL ?>order/history">Tình trạng đơn hàng</a></li>
                            <li><a href="">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Sản phẩm</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="">Laptop</a></li>
                            <li><a href="">PC</a></li>
                            <li><a href="">Tai nghe</a></li>
                            <li><a href saugestions="">Bàn phím</a></li>
                            <li><a href="">Chuột</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Chính sách</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="">Điều khoản sử dụng</a></li>
                            <li><a href="">Chính sách bảo mật</a></li>
                            <li><a href="">Chính sách hoàn trả</a></li>
                            <li><a href="">Hệ thống thanh toán</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Về GSShop</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="">Thông tin công ty</a></li>
                            <li><a href="">Tuyển dụng</a></li>
                            <li><a href="">Vị trí cửa hàng</a></li>
                            <li><a href="">Chương trình liên kết</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>Nhận thông tin</h2>
                        <form action="#" class="searchform">
                            <input type="text" placeholder="Nhập email của bạn..." />
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-arrow-circle-o-right"></i>
                            </button>
                            <p>Đăng ký để nhận ưu đãi và tin tức mới nhất từ GSShop.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2025 GSShop. All rights reserved.</p>
                <p class="pull-right">Designed by GSShop Team</p>
            </div>
        </div>
    </div>
</footer>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="<?= $base ?>assets/js/jquery.js"></script>
<script src="<?= $base ?>assets/js/bootstrap.min.js"></script>
<script src="<?= $base ?>assets/js/jquery.scrollUp.min.js"></script>
<script src="<?= $base ?>assets/js/price-range.js"></script>
<script src="<?= $base ?>assets/js/jquery.prettyPhoto.js"></script>
<script src="<?= $base ?>assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
<script>
    // Kiểm tra trạng thái đăng nhập và cập nhật menu
    document.addEventListener('DOMContentLoaded', function () {
        const username = "<?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '' ?>";
        if (username) {
            const menu = document.querySelector(".shop-menu ul");
            if (menu) {
                const loginLink = menu.querySelector('a[href="<?= $baseURL ?>user/login"]');
                if (loginLink) {
                    loginLink.innerHTML = `<i class="fa fa-user"></i> ${username}`;
                    loginLink.href = "#";
                    loginLink.onclick = function () {
                        window.location.href = "<?= $baseURL ?>user/logout";
                    };
                }
            }
        }
    });

    // Hàm hiển thị/ẩn chi tiết đơn hàng
    function showOrderDetails(orderId) {
        const detailsDiv = document.getElementById(`order-details-${orderId}`);
        detailsDiv.style.display = detailsDiv.style.display === 'none' ? 'block' : 'none';
    }
</script>
</body>
</html>