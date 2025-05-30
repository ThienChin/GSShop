<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require __DIR__ . '/../../../config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

$section = 'home';

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
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                            <h6 class="op-7 mb-2">Quản lý cửa hàng</h6>
                        </div>
                        <div class="ms-md-auto py-2 py-md-0">
                            <a href="#" class="btn btn-label-info btn-round me-2">Quản lý</a>
                            <a href="#" class="btn btn-primary btn-round">Thêm khách hàng</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Khách truy cập</p>
                                                <h4 class="card-title"><?= $totalUsers ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Thành viên</p>
                                                <h4 class="card-title"><?= $totalUsers ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                                <i class="fas fa-luggage-cart"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Doanh thu</p>
                                                <h4 class="card-title"><?= number_format($totalRevenue, 0, ',', '.') ?> VNĐ</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                <i class="far fa-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Đơn hàng</p>
                                                <h4 class="card-title"><?= $totalOrders ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-round">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Doanh thu theo tháng (<?= date('Y') ?>)</div>
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                                                <span class="btn-label"><i class="fa fa-download"></i></span> Xuất
                                            </a>
                                            <a href="#" class="btn btn-label-info btn-round btn-sm">
                                                <span class="btn-label"><i class="fa fa-print"></i></span> In
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container" style="min-height: 375px">
                                        <canvas id="revenueChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-round">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Đơn hàng theo trạng thái</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container" style="min-height: 200px">
                                        <canvas id="orderStatusChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-round">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Top 5 sản phẩm bán chạy</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container" style="min-height: 200px">
                                        <canvas id="topProductsChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card card-round">
                                <div class="card-header bg-warning">
                                    <div class="card-head-row">
                                        <div class="card-title fw-bold">Thống kê đơn hàng</div>
                                        <div class="card-tools d-flex align-items-center gap-2">
                                            <select id="timeRange" class="form-select form-select-sm" onchange="updateChart()">
                                                <option value="day" <?= $timeRange === 'day' ? 'selected' : '' ?>>24 giờ</option>
                                                <option value="week" <?= $timeRange === 'week' ? 'selected' : '' ?>>7 ngày</option>
                                                <option value="month" <?= $timeRange === 'month' ? 'selected' : '' ?>>30 ngày</option>
                                            </select>
                                            <a href="<?= $baseURL ?>admin/orders" class="btn btn-light btn-sm">
                                                <i class="fas fa-arrow-right"></i> Xem tất cả
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container" style="min-height: 300px">
                                        <canvas id="recentOrdersChart"></canvas>
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
    <script src="<?= $base ?>assets/admin/js/plugin/chart.js/chart.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/kaiadmin.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/setting-demo.js"></script>
    <script src="<?= $base ?>assets/admin/js/demo.js"></script>

    <script>
        // Debug dữ liệu
        console.log('orderStatusCounts:', <?= json_encode($orderStatusCounts) ?>);
        console.log('recentOrderStats:', <?= json_encode($recentOrderStats) ?>);

        // Biểu đồ doanh thu theo tháng
        var revenueChart = new Chart(document.getElementById("revenueChart"), {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($earnings, 'month')) ?>,
                datasets: [{
                    label: "Doanh thu (VNĐ)",
                    borderColor: "#2196f3",
                    backgroundColor: "rgba(33, 150, 243, 0.2)",
                    pointBackgroundColor: "#2196f3",
                    pointBorderColor: "#fff",
                    data: <?= json_encode(array_column($earnings, 'total')) ?>,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y.toLocaleString('vi-VN') + ' VNĐ';
                            }
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: {
                        grid: { color: "#e7eaf0" },
                        beginAtZero: true,
                        min: 0,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('vi-VN') + ' VNĐ';
                            }
                        }
                    }
                }
            }
        });

        // Biểu đồ đơn hàng theo trạng thái
        var orderStatusChart = new Chart(document.getElementById("orderStatusChart"), {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($orderStatusCounts, 'status')) ?>,
                datasets: [{
                    label: "Số đơn hàng",
                    backgroundColor: ["#ff9800", "#4caf50", "#ef5350"],
                    data: <?= json_encode(array_column($orderStatusCounts, 'count')) ?>
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' đơn';
                            }
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: {
                        grid: { color: "#e7eaf0" },
                        beginAtZero: true,
                        min: 0,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                return Number(value).toFixed(0);
                            }
                        }
                    }
                }
            }
        });

        // Biểu đồ top 5 sản phẩm bán chạy
        var topProductsChart = new Chart(document.getElementById("topProductsChart"), {
            type: 'doughnut',
            data: {
                labels: <?= json_encode(array_column($topProducts, 'name')) ?>,
                datasets: [{
                    label: "Số lượng bán",
                    backgroundColor: ["#2196f3", "#ff9800", "#4caf50", "#ef5350", "#ab47bc"],
                    data: <?= json_encode(array_column($topProducts, 'quantity')) ?>
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + ' sản phẩm';
                            }
                        }
                    }
                }
            }
        });

        // Biểu đồ thống kê đơn hàng
        var recentOrdersChart = new Chart(document.getElementById("recentOrdersChart"), {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($recentOrderStats, 'order_day')) ?>,
                datasets: [{
                    label: "Số đơn hàng",
                    backgroundColor: "#2196f3",
                    data: <?= json_encode(array_column($recentOrderStats, 'order_count')) ?>
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' đơn';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            callback: function(value, index, values) {
                                return new Date(this.getLabelForValue(value)).toLocaleDateString('vi-VN', { day: 'numeric', month: 'numeric' });
                            }
                        }
                    },
                    y: {
                        grid: { color: "#e7eaf0" },
                        beginAtZero: true,
                        min: 0,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                return Number(value).toFixed(0);
                            }
                        }
                    }
                }
            }
        });

        // Cập nhật biểu đồ khi thay đổi time range
        function updateChart() {
            const timeRange = document.getElementById('timeRange').value;
            window.location.href = '<?= $baseURL ?>admin/dashboard?time_range=' + timeRange;
        }
    </script>
</body>
</html>

<style>
.card-round {
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
.card-header {
    padding: 1.5rem;
}
.card-title {
    font-size: 1.4rem;
    font-weight: 600;
}
.chart-container {
    position: relative;
}
.form-select-sm {
    padding: 0.3rem 0.5rem;
    font-size: 0.85rem;
    border-radius: 6px;
}
.btn-light {
    border-color: #fff;
    color: #fff;
}
.btn-light:hover {
    background-color: #fff;
    color: #333;
}
</style>