<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require __DIR__ . '/../../../config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

$section = 'users';

// Debug
// var_dump($section, $userList, $totalPages, $page); exit;

include_once __DIR__ . '/../Layout/Adminheader.php';
?>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
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
        <!-- End Sidebar -->

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
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>
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
                    <div class="card shadow-lg border-0 mt-5">
                        <div class="card-header bg-warning d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">Danh sách người dùng</h4>
                            <a href="<?= $baseURL ?>admin" class="btn btn-light btn-sm ms-auto"><i class="fas fa-arrow-left"></i> Quay lại</a>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Họ tên</th>
                                            <th>Tên đăng nhập</th>
                                            <th>Số điện thoại</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($userList)): ?>
                                            <tr><td colspan="5" class="text-center text-muted">Không có người dùng nào.</td></tr>
                                        <?php else: ?>
                                            <?php foreach ($userList as $user): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($user['id'] ?? '') ?></td>
                                                    <td><?= htmlspecialchars($user['fullname'] ?? 'N/A') ?></td>
                                                    <td><?= htmlspecialchars($user['username'] ?? 'N/A') ?></td>
                                                    <td><?= htmlspecialchars($user['phone'] ?? 'N/A') ?></td>
                                                    <td>
                                                        <form action="<?= $baseURL ?>admin/deleteUser" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc muốn xóa người dùng này?');">
                                                            <input type="hidden" name="UserID" value="<?= htmlspecialchars($user['id'] ?? '') ?>" />
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Xóa người dùng"><i class="fas fa-trash"></i></button>
                                                        </form>
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

    <!-- Core JS Files -->
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
.card-header h4 { font-size: 1.8rem; color: #000; text-transform: uppercase; }
.table-hover tbody tr:hover { background-color: #f8f9fa; }
.btn-light { display: flex; align-items: center; gap: 5px; }
.pagination .page-link { border-radius: 5px; margin: 0 3px; }
.pagination .page-item.active .page-link { background-color: #007bff; border-color: #007bff; }
</style>