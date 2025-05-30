<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require __DIR__ . '/../../../config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

$section = 'orders';

// Debug
// var_dump($section, $order); exit;

include_once __DIR__ . '/../Layout/Adminheader.php';
?>
<body>
    <div class="wrapper">
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <div class="logo-header" data-background-color="dark">
                    <a href="<?= $baseURL ?>admin" class="logo">
                        <img src="<?= $base ?>assets/images/logo.png" alt="navbar brand" class="navbar-brand" height="50" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                        <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
                    </div>
                    <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
                </div>
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item <?= $section === 'home' ? 'active' : '' ?>">
                            <a href="<?= $baseURL ?>admin/dashboard"><i class="fas fa-home"></i><p>Dashboard</p></a>
                        </li>
                        <li class="nav-item <?= $section === 'products' ? 'active' : '' ?>">
                            <a href="<?= $baseURL ?>admin/product"><i class="fas fa-list"></i><p>Danh sách sản phẩm</p></a>
                        </li>
                        <li class="nav-item <?= $section === 'create' ? 'active' : '' ?>">
                            <a href="<?= $baseURL ?>admin/create"><i class="fas fa-plus"></i><p>Thêm sản phẩm</p></a>
                        </li>
                        <li class="nav-item <?= $section === 'users' ? 'active' : '' ?>">
                            <a href="<?= $baseURL ?>admin/user"><i class="fas fa-users"></i><p>Người dùng</p></a>
                        </li>
                        <li class="nav-item <?= $section === 'orders' ? 'active' : '' ?>">
                            <a href="<?= $baseURL ?>admin/orders"><i class="fas fa-shopping-cart"></i><p>Đơn hàng</p></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="dark">
                        <a href="<?= $baseURL ?>admin" class="logo">
                            <img src="<?= $base ?>assets/images/logo.png" alt="navbar brand" class="navbar-brand" height="50" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                            <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
                        </div>
                        <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
                    </div>
                </div>
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1"><i class="fa fa-search search-icon"></i></button>
                                </div>
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div>
                        </nav>
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar d-none d-lg-block">
                                <a class="nav-link" href="#" role="button">Hi, <?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></a>
                            </li>
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="<?= $base ?>assets/admin/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold"><?= htmlspecialchars($_SESSION['username']) ?></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="<?= $base ?>assets/admin/img/avatar.jpg" alt="image profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></h4>
                                                    <p class="text-muted"><?= htmlspecialchars($_SESSION['email'] ?? 'admin@example.com') ?></p>
                                                    <a href="#" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">My Profile</a>
                                            <a class="dropdown-item" href="#">Action Setting</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="<?= $baseURL ?>user/logout">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="container">
                <div class="page-inner">
                    <?php if (isset($_SESSION['message'])): ?>
                        <div class="alert alert-<?= $_SESSION['message_type'] ?? 'info' ?> alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($_SESSION['message']) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
                    <?php endif; ?>
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-warning d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">Chi Tiết Đơn Hàng #<?= htmlspecialchars($order['id'] ?? '') ?></h4>
                            <div class="ms-auto d-flex gap-2">
                                <a href="<?= $baseURL ?>admin/orders" class="btn btn-light btn-sm"><i class="fas fa-arrow-left"></i> Quay lại</a>
                                <button class="btn btn-primary btn-sm" onclick="window.print()"><i class="fas fa-print"></i> In</button>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card shadow-sm mb-3">
                                        <div class="card-header">
                                            <h5 class="mb-0">Thông Tin</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Ngày đặt:</strong> <?= htmlspecialchars(date('d/m/Y H:i', strtotime($order['order_date'] ?? ''))) ?></p>
                                            <p><strong>Tổng tiền:</strong> <span class="text-success"><?= number_format($order['total'] ?? 0, 0, ',', '.') ?> VNĐ</span></p>
                                            <p><strong>Trạng thái:</strong>
                                                <?php
                                                $statusMap = [
                                                    'pending' => 'Đặt hàng',
                                                    'completed' => 'Hoàn thành',
                                                    'canceled' => 'Hủy'
                                                ];
                                                $status = htmlspecialchars($order['status'] ?? '');
                                                $displayStatus = $statusMap[$status] ?? $status;
                                                $badgeClass = $status === 'pending' ? 'badge-warning' : ($status === 'completed' ? 'badge-success' : 'badge-danger');
                                                ?>
                                                <span class="badge <?= $badgeClass ?>"><?= $displayStatus ?></span>
                                            </p>
                                            <form action="<?= $baseURL ?>admin/updateOrderStatus" method="POST" class="mt-2">
                                                <input type="hidden" name="OrderID" value="<?= htmlspecialchars($order['id'] ?? '') ?>" />
                                                <div class="input-group input-group-sm">
                                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                                        <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Đặt hàng</option>
                                                        <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                                                        <option value="canceled" <?= $status === 'canceled' ? 'selected' : '' ?>>Hủy</option>
                                                    </select>
                                                </div>
                                            </form>
                                            <p class="mt-2"><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($order['payment_method'] ?? '') ?></p>
                                        </div>
                                    </div>

                                    <?php if (!empty($order['billing_info'])): ?>
                                        <?php $billing_info = is_array($order['billing_info']) ? $order['billing_info'] : (json_decode($order['billing_info'], true) ?? []); ?>
                                        <div class="card shadow-sm mb-3">
                                            <div class="card-header">
                                                <h5 class="mb-0">Thông Tin Thanh Toán</h5>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Người nhận:</strong> <?= htmlspecialchars($billing_info['name'] ?? 'N/A') ?></p>
                                                <p><strong>Email:</strong> <?= htmlspecialchars($billing_info['email'] ?? 'N/A') ?></p>
                                                <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($billing_info['phone'] ?? 'N/A') ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($order['shipping_address'])): ?>
                                        <?php $shipping_address = is_array($order['shipping_address']) ? $order['shipping_address'] : (json_decode($order['shipping_address'], true) ?? []); ?>
                                        <div class="card shadow-sm">
                                            <div class="card-header">
                                                <h5 class="mb-0">Địa Chỉ Giao Hàng</h5>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($shipping_address['address'] ?? 'N/A') ?></p>
                                                <p><strong>Thành phố:</strong> <?= htmlspecialchars($shipping_address['city'] ?? 'N/A') ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-8">
                                    <div class="card shadow-sm">
                                        <div class="card-header">
                                            <h5 class="mb-0">Sản Phẩm</h5>
                                        </div>
                                        <div class="card-body">
                                            <?php if (empty($order['items'])): ?>
                                                <p class="text-muted">Không có sản phẩm nào trong đơn hàng.</p>
                                            <?php else: ?>
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
                                                            <?php foreach ($order['items'] as $item): ?>
                                                                <tr>
                                                                    <td><?= htmlspecialchars($item['product_name'] ?? $item['featured_product_name'] ?? 'Không xác định') ?></td>
                                                                    <td><?= htmlspecialchars($item['quantity'] ?? 0) ?></td>
                                                                    <td><?= number_format($item['price'] ?? 0, 0, ',', '.') ?> VNĐ</td>
                                                                    <td><?= number_format(($item['quantity'] ?? 0) * ($item['price'] ?? 0), 0, ',', '.') ?> VNĐ</td>
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
            </div>

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item"><a class="nav-link" href="http://www.themekita.com">ThemeKita</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Licenses</a></li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        2025, made with <i class="fa fa-heart heart text-danger"></i> by
                        <a href="http://www.themekita.com">ThemeKita</a>
                    </div>
                    <div>
                        Distributed by <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="<?= $base ?>assets/admin/js/core/jquery-3.7.1.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/core/popper.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/core/bootstrap.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/kaiadmin.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/setting-demo.js"></script>
    <script src="<?= $base ?>assets/admin/js/demo.js"></script>
</body>
</html>

<style>
.card { border-radius: 8px; }
.card-header { background-color: #fff3cd; border-bottom: 2px solid #ffca2c; }
.card-header h4 { font-size: 1.8rem; color: #333; text-transform: uppercase; }
.table-hover tbody tr:hover { background-color: #f8f9fa; }
.badge { font-size: 0.9em; padding: 0.5em 1em; }
.badge-warning { background-color: #ffc107; color: #212529; }
.badge-success { background-color: #28a745; color: #fff; }
.badge-danger { background-color: #dc3545; color: #fff; }
.btn-light { display: flex; align-items: center; gap: 5px; }
@media print { .btn, .no-print, .form-action { display: none; } }
.alert { margin-bottom: 1rem; }
.form-select { font-size: 0.875rem; }
</style>