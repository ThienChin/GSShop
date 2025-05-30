<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require __DIR__ . '/../../../config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

$section = 'orders';

include_once __DIR__ . '/../Layout/Adminheader.php';
?>
<body>
    <div class="wrapper">
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <div class="logo-header" data-background-color="dark">
                    <a href="<?= $baseURL ?>home/index" class="logo">
                        <img
                            src="<?= $base ?>assets/images/home/logo.png"
                            alt="navbar brand"
                            class="navbar-brand"
                            height="100"
                            width="200"
                        />
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
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="<?= $base ?>assets/admin/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold"><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="<?= $base ?>assets/admin/img/profile.jpg" alt="image profile" class="avatar-img rounded" />
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
                                            <a class="dropdown-item" href="#">Account Setting</a>
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
                    <div class="card shadow-sm mt-5 animate__animated animate__fadeIn">
                        <div class="card-header bg-warning d-flex align-items-center">
                            <h4 class="mb-0 fw-bold text-uppercase">Danh Sách Đơn Hàng</h4>
                            <a href="<?= $baseURL ?>admin" class="btn btn-outline-light btn-sm ms-auto"><i class="fas fa-arrow-left me-2"></i>Quay lại</a>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col">Ngày Đặt</th>
                                            <th scope="col">Tổng Tiền</th>
                                            <th scope="col" class="text-center">Trạng Thái</th>
                                            <th scope="col" class="text-center">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($orderList)): ?>
                                            <tr><td colspan="5" class="text-center text-muted py-4">Không có đơn hàng nào.</td></tr>
                                        <?php else: ?>
                                            <?php foreach ($orderList as $item): ?>
                                                <tr>
                                                    <td class="text-center"><?= htmlspecialchars($item['id']) ?></td>
                                                    <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($item['order_date']))) ?></td>
                                                    <td><?= number_format($item['total'], 0, ',', '.') ?> VNĐ</td>
                                                    <td class="text-center">
                                                        <?php
                                                        $statusMap = [
                                                            'pending' => 'Đặt hàng',
                                                            'completed' => 'Hoàn thành',
                                                            'canceled' => 'Hủy'
                                                        ];
                                                        $status = htmlspecialchars($item['status']);
                                                        $displayStatus = $statusMap[$status] ?? $status;
                                                        $badgeClass = $status === 'pending' ? 'badge-warning' : ($status === 'completed' ? 'badge-success' : 'badge-danger');
                                                        ?>
                                                        <span class="badge <?= $badgeClass ?> px-3 py-2"><?= $displayStatus ?></span>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <a href="<?= $baseURL ?>admin/orderDetail?id=<?= htmlspecialchars($item['id']) ?>" class="btn btn-sm btn-info" title="Xem chi tiết"><i class="fas fa-eye"></i></a>
                                                            <form action="<?= $baseURL ?>admin/deleteOrder" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này?');">
                                                                <input type="hidden" name="OrderID" value="<?= htmlspecialchars($item['id']) ?>" />
                                                                <button type="submit" class="btn btn-sm btn-danger" title="Xóa đơn hàng"><i class="fas fa-trash"></i></button>
                                                            </form>
                                                            <form action="<?= $baseURL ?>admin/updateOrderStatus" method="POST" style="display: inline;">
                                                                <input type="hidden" name="OrderID" value="<?= htmlspecialchars($item['id']) ?>" />
                                                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                                                    <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Đặt hàng</option>
                                                                    <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                                                                    <option value="canceled" <?= $status === 'canceled' ? 'selected' : '' ?>>Hủy</option>
                                                                </select>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if ($totalPages > 1): ?>
                                <nav aria-label="Page navigation" class="mt-4">
                                    <ul class="pagination justify-content-center">
                                        <?php if ($page > 1): ?>
                                            <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">«</a></li>
                                        <?php endif; ?>
                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <li class="page-item <?= $i === $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                                        <?php endfor; ?>
                                        <?php if ($page < $totalPages): ?>
                                            <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">»</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            <?php endif; ?>
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
                        2024, made with <i class="fa fa-heart heart text-danger"></i> by
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
.card {
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
}
.card-header {
    background: linear-gradient(135deg, #ffca2c, #ffc107);
    border-bottom: none;
    padding: 1.5rem;
}
.card-header h4 {
    color: #1a1a1a;
    font-size: 1.6rem;
    letter-spacing: 0.5px;
}
.table {
    border-radius: 8px;
    overflow: hidden;
}
.table th {
    font-weight: 600;
    padding: 1rem;
}
.table td {
    padding: 1rem;
    vertical-align: middle;
}
.table-hover tbody tr:hover {
    background-color: #f1f3f5;
    transition: background-color 0.2s ease;
}
.badge {
    font-size: 0.85rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 500;
}
.badge-warning {
    background-color: #ffe082;
    color: #5c4d00;
}
.badge-success {
    background-color: #4caf50;
    color: #fff;
}
.badge-danger {
    background-color: #ef5350;
    color: #fff;
}
.btn-sm {
    padding: 0.4rem 0.8rem;
    border-radius: 6px;
    transition: all 0.2s ease;
}
.btn-info {
    background-color: #2196f3;
    border-color: #2196f3;
}
.btn-info:hover {
    background-color: #1976d2;
    border-color: #1976d2;
}
.btn-danger {
    background-color: #f44336;
    border-color: #f44336;
}
.btn-danger:hover {
    background-color: #d32f2f;
    border-color: #d32f2f;
}
.btn-outline-light {
    border-color: #fff;
    color: #fff;
}
.btn-outline-light:hover {
    background-color: #fff;
    color: #333;
}
.form-select-sm {
    padding: 0.3rem 0.5rem;
    font-size: 0.85rem;
    border-radius: 6px;
    border-color: #ced4da;
}
.pagination .page-link {
    border-radius: 6px;
    margin: 0 4px;
    padding: 0.5rem 1rem;
    transition: all 0.2s ease;
}
.pagination .page-item.active .page-link {
    background-color: #2196f3;
    border-color: #2196f3;
}
.alert {
    border-radius: 8px;
    margin-bottom: 1.5rem;
}
</style>