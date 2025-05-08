<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

// Lấy tham số section từ URL
$section = isset($_GET['section']) ? $_GET['section'] : 'home';

// Sử dụng các biến từ controller (được truyền từ AdminController)
$totalProducts = isset($totalProducts) ? $totalProducts : 0;
$totalUsers = isset($totalUsers) ? $totalUsers : 0;
$totalOrders = isset($totalOrders) ? $totalOrders : 0;
$totalRevenue = isset($totalRevenue) ? $totalRevenue : 0;
$earnings = isset($earnings) ? $earnings : array_fill(0, 12, ['month' => '', 'total' => 0]);
$orderStatusCounts = isset($orderStatusCounts) ? $orderStatusCounts : [];
$topProducts = isset($topProducts) ? $topProducts : [];
$productList = isset($productList) ? $productList : [];
$userList = isset($userList) ? $userList : [];
$orderList = isset($orderList) ? $orderList : [];
$order = isset($order) ? $order : [];
$totalPages = isset($totalPages) ? $totalPages : 1;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$recentOrderStats = isset($recentOrderStats) ? $recentOrderStats : [];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="<?= $base ?>assets/admin/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="<?= $base ?>assets/admin/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["<?= $base ?>assets/admin/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= $base ?>assets/admin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= $base ?>assets/admin/css/plugins.min.css" />
    <link rel="stylesheet" href="<?= $base ?>assets/admin/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?= $base ?>assets/admin/css/demo.css" />
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="<?= $baseURL ?>admin" class="logo">
              <img
                src="<?= $base ?>assets/admin/img/kaiadmin/logo_light.svg"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item <?= $section === 'home' ? 'active' : '' ?>">
                <a href="<?= $baseURL ?>admin/index">
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item <?= $section === 'products' ? 'active' : '' ?>">
                <a href="<?= $baseURL ?>admin/product">
                  <i class="fas fa-list"></i>
                  <p>Danh sách sản phẩm</p>
                </a>
              </li>
              <li class="nav-item <?= $section === 'create' ? 'active' : '' ?>">
                <a href="<?= $baseURL ?>admin/create">
                  <i class="fas fa-plus"></i>
                  <p>Thêm sản phẩm</p>
                </a>
              </li>
              <li class="nav-item <?= $section === 'users' ? 'active' : '' ?>">
                <a href="<?= $baseURL ?>admin/user">
                  <i class="fas fa-users"></i>
                  <p>Người dùng</p>
                </a>
              </li>
              <li class="nav-item <?= $section === 'orders' ? 'active' : '' ?>">
                <a href="<?= $baseURL ?>admin/orders">
                  <i class="fas fa-shopping-cart"></i>
                  <p>Đơn hàng</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="<?= $baseURL ?>admin" class="logo">
                <img
                  src="<?= $base ?>assets/admin/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pe-1">
                      <i class="fa fa-search search-icon"></i>
                    </button>
                  </div>
                  <input
                    type="text"
                    placeholder="Search ..."
                    class="form-control"
                  />
                </div>
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li
                  class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none"
                >
                  <a
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-expanded="false"
                    aria-haspopup="true"
                  >
                    <i class="fa fa-search"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                      <div class="input-group">
                        <input
                          type="text"
                          placeholder="Search ..."
                          class="form-control"
                        />
                      </div>
                    </form>
                  </ul>
                </li>
                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                    <div class="avatar-sm">
                      <img
                        src="<?= $base ?>assets/admin/img/profile.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold">Hizrian</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <img
                              src="<?= $base ?>assets/img/profile.jpg"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div>
                          <div class="u-text">
                            <h4>Hizrian</h4>
                            <p class="text-muted">hello@example.com</p>
                            <a
                              href="profile.html"
                              class="btn btn-xs btn-secondary btn-sm"
                              >View Profile</a
                            >
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="#">My Balance</a>
                        <a class="dropdown-item" href="#">Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Logout</a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
            <?php if ($section === 'home') : ?>
              <!-- Nội dung dashboard với biểu đồ cải tiến -->
              <div
                class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
              >
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
                          <div
                            class="icon-big text-center icon-primary bubble-shadow-small"
                          >
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
                          <div
                            class="icon-big text-center icon-info bubble-shadow-small"
                          >
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
                          <div
                            class="icon-big text-center icon-success bubble-shadow-small"
                          >
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
                          <div
                            class="icon-big text-center icon-secondary bubble-shadow-small"
                          >
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
                          <a
                            href="#"
                            class="btn btn-label-success btn-round btn-sm me-2"
                          >
                            <span class="btn-label">
                              <i class="fa fa-download"></i>
                            </span>
                            Xuất
                          </a>
                          <a href="#" class="btn btn-label-info btn-round btn-sm">
                            <span class="btn-label">
                              <i class="fa fa-print"></i>
                            </span>
                            In
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
              <!-- Biểu đồ thống kê đơn hàng gần đây -->
              <div class="row mt-4">
                <div class="col-md-12">
                  <div class="card card-round">
                    <div class="card-header bg-warning">
                      <div class="card-head-row">
                        <div class="card-title fw-bold">Thống kê đơn hàng (7 ngày gần nhất)</div>
                        <div class="card-tools">
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
            <?php elseif ($section === 'create') : ?>
              <!-- Nội dung từ create.php -->
              <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                  <h4 class="mb-0">Thêm sản phẩm mới</h4>
                </div>
                <div class="card-body">
                  <form action="<?= $baseURL ?>admin/create" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                      <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="name" name="name" required placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group mb-3">
                      <label for="price" class="form-label">Giá (VNĐ) <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="price" name="price" placeholder="Nhập giá sản phẩm">
                    </div>
                    <div class="form-group mb-4">
                      <label for="image" class="form-label">Hình ảnh <span class="text-danger">*</span></label>
                      <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                      <small class="form-text text-muted">Chọn file ảnh định dạng PNG, JPG hoặc JPEG.</small>
                    </div>
                    <div class="d-flex gap-2">
                      <button type="submit" class="btn btn-primary px-4">Thêm sản phẩm</button>
                      <a href="<?= $baseURL ?>admin/product" class="btn btn-outline-secondary px-4">Hủy</a>
                    </div>
                  </form>
                </div>
              </div>
              <script>
                document.getElementById('price').addEventListener('input', function(e) {
                  let value = e.target.value.replace(/\D/g, '');
                  if (value) {
                    value = parseInt(value).toLocaleString('vi-VN', { style: 'decimal' });
                  }
                  e.target.value = value;
                });
              </script>
            <?php elseif ($section === 'orders') : ?>
              <!-- Nội dung từ orders.php -->
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Danh Sách Đơn Hàng</h2>
                <a href="<?= $baseURL ?>admin" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại Dashboard</a>
              </div>
              <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">Tất Cả Đơn Hàng</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                      <thead class="table-dark">
                        <tr>
                          <th>#</th>
                          <th>Ngày Đặt</th>
                          <th>Tổng Tiền</th>
                          <th>Trạng Thái</th>
                          <th>Hành Động</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (empty($orderList)) : ?>
                          <tr>
                            <td colspan="5" class="text-center text-muted">Không có đơn hàng nào.</td>
                          </tr>
                        <?php else : ?>
                          <?php foreach ($orderList as $item) : ?>
                            <tr>
                              <td><?= htmlspecialchars($item['id']) ?></td>
                              <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($item['order_date']))) ?></td>
                              <td><?= number_format($item['total'], 0, ',', '.') ?> VNĐ</td>
                              <td>
                                <?php
                                $status = htmlspecialchars($item['status']);
                                $badgeClass = $status === 'pending' ? 'badge-warning' : ($status === 'completed' ? 'badge-success' : 'badge-danger');
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                              </td>
                              <td>
                                <a href="<?= $baseURL ?>admin/orderDetail?id=<?= htmlspecialchars($item['id']) ?>" class="btn btn-sm btn-info" title="Xem chi tiết">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <form action="<?= $baseURL ?>admin/deleteOrder" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này?');">
                                  <input type="hidden" name="OrderID" value="<?= htmlspecialchars($item['id']) ?>" />
                                  <button type="submit" class="btn btn-sm btn-danger" title="Xóa đơn hàng">
                                    <i class="fas fa-trash"></i>
                                  </button>
                                </form>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                  <?php if ($totalPages > 1) : ?>
                    <nav aria-label="Page navigation" class="mt-4">
                      <ul class="pagination justify-content-center">
                        <?php if ($page > 1) : ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= $baseURL ?>admin/orders?page=<?= $page - 1 ?>" aria-label="Previous">
                              <span aria-hidden="true">«</span>
                            </a>
                          </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                          <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                            <a class="page-link" href="<?= $baseURL ?>admin/orders?page=<?= $i ?>"><?= $i ?></a>
                          </li>
                        <?php endfor; ?>
                        <?php if ($page < $totalPages) : ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= $baseURL ?>admin/orders?page=<?= $page + 1 ?>" aria-label="Next">
                              <span aria-hidden="true">»</span>
                            </a>
                          </li>
                        <?php endif; ?>
                      </ul>
                    </nav>
                  <?php endif; ?>
                </div>
              </div>
              <style>
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
              </style>
            <?php elseif ($section === 'users') : ?>
              <!-- Nội dung từ user.php -->
              <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">Danh sách người dùng</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Họ tên</th>
                          <th>Tên đăng nhập</th>
                          <th>Số điện thoại</th>
                          <th>Xóa</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (empty($userList)) : ?>
                          <tr>
                            <td colspan="5" class="text-center text-muted">Không có người dùng nào.</td>
                          </tr>
                        <?php else : ?>
                          <?php foreach ($userList as $user) : ?>
                            <tr>
                              <td><?= htmlspecialchars($user['id']) ?></td>
                              <td><?= htmlspecialchars($user['fullname']) ?></td>
                              <td><?= htmlspecialchars($user['username']) ?></td>
                              <td><?= htmlspecialchars($user['phone']) ?></td>
                              <td>
                                <form action="<?= $baseURL ?>admin/deleteUser" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc muốn xóa người dùng này?');">
                                  <input type="hidden" name="UserID" value="<?= htmlspecialchars($user['id']) ?>" />
                                  <button type="submit" style="border: none; background: none; cursor: pointer; font-size: 16px; padding: 5px;" title="Xóa người dùng">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                  </button>
                                </form>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                  <?php if ($totalPages > 1) : ?>
                    <nav aria-label="Page navigation" class="mt-4">
                      <ul class="pagination justify-content-center">
                        <?php if ($page > 1) : ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= $baseURL ?>admin/user?page=<?= $page - 1 ?>" aria-label="Previous">
                              <span aria-hidden="true">«</span>
                            </a>
                          </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                          <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                            <a class="page-link" href="<?= $baseURL ?>admin/user?page=<?= $i ?>"><?= $i ?></a>
                          </li>
                        <?php endfor; ?>
                        <?php if ($page < $totalPages) : ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= $baseURL ?>admin/user?page=<?= $page + 1 ?>" aria-label="Next">
                              <span aria-hidden="true">»</span>
                            </a>
                          </li>
                        <?php endif; ?>
                      </ul>
                    </nav>
                  <?php endif; ?>
                </div>
              </div>
            <?php elseif ($section === 'order_detail') : ?>
              <!-- Nội dung từ order_detail.php -->
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Chi Tiết Đơn Hàng #<?= htmlspecialchars($order['id'] ?? 'N/A') ?></h2>
                <div>
                  <a href="<?= $baseURL ?>admin/orders" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
                  <button class="btn btn-primary" onclick="window.print()"><i class="fas fa-print"></i> In đơn hàng</button>
                </div>
              </div>
              <?php if (empty($order)) : ?>
                <div class="alert alert-danger">Không tìm thấy đơn hàng!</div>
              <?php else : ?>
                <div class="row">
                  <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                      <div class="card-header bg-info text-white">
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
                        <p><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($order['payment_method'] ?? 'N/A') ?></p>
                      </div>
                    </div>
                    <?php if ($order['billing_info']) : ?>
                      <div class="card shadow-sm mb-4">
                        <div class="card-header bg-light">
                          <h5 class="mb-0">Thông Tin Thanh Toán</h5>
                        </div>
                        <div class="card-body">
                          <p><strong>Tên:</strong> <?= htmlspecialchars($order['billing_info']['name'] ?? 'N/A') ?></p>
                          <p><strong>Email:</strong> <?= htmlspecialchars($order['billing_info']['email'] ?? 'N/A') ?></p>
                          <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($order['billing_info']['phone'] ?? 'N/A') ?></p>
                        </div>
                      </div>
                    <?php endif; ?>
                    <?php if ($order['shipping_address']) : ?>
                      <div class="card shadow-sm">
                        <div class="card-header bg-light">
                          <h5 class="mb-0">Địa Chỉ Giao Hàng</h5>
                        </div>
                        <div class="card-body">
                          <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['shipping_address']['address'] ?? 'N/A') ?></p>
                          <p><strong>Thành phố:</strong> <?= htmlspecialchars($order['shipping_address']['city'] ?? 'N/A') ?></p>
                          <?php if (isset($order['shipping_address']['zip'])) : ?>
                            <p><strong>Mã bưu điện:</strong> <?= htmlspecialchars($order['shipping_address']['zip']) ?></p>
                          <?php endif; ?>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
                  <div class="col-md-8">
                    <div class="card shadow-sm">
                      <div class="card-header bg-primary text-white">
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
              <?php endif; ?>
              <style>
                .card-header {
                  font-weight: 500;
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
                @media print {
                  .btn, .no-print {
                    display: none;
                  }
                }
              </style>
            <?php elseif ($section === 'products') : ?>
              <!-- Nội dung từ product.php -->
              <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">Danh sách sản phẩm</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Hình ảnh</th>
                          <th>Tên sản phẩm</th>
                          <th>Giá</th>
                          <th>Xóa</th>
                          <th>Sửa</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (empty($productList)) : ?>
                          <tr>
                            <td colspan="6" class="text-center text-muted">Không có sản phẩm nào.</td>
                          </tr>
                        <?php else : ?>
                          <?php foreach ($productList as $item) : ?>
                            <tr>
                              <td><?= htmlspecialchars($item['id']) ?></td>
                              <td><img class="card-img-top" src="<?= htmlspecialchars($assets . $item['image']) ?>" style="max-width: 100px;" alt="Hình sản phẩm" /></td>
                              <td><?= htmlspecialchars($item['name']) ?></td>
                              <td><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</td>
                              <td>
                                <form action="<?= $baseURL ?>admin/delete" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                  <input type="hidden" name="ProductID" value="<?= htmlspecialchars($item['id']) ?>" />
                                  <button type="submit" style="border: none; background: none; cursor: pointer; font-size: 16px; padding: 5px;" title="Xóa sản phẩm">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                  </button>
                                </form>
                              </td>
                              <td>
                                <a href="<?= $baseURL ?>admin/edit?id=<?= htmlspecialchars($item['id']) ?>" class="btn btn-sm btn-warning" title="Sửa sản phẩm">
                                  <i class="fas fa-edit"></i>
                                </a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                  <?php if ($totalPages > 1) : ?>
                    <nav aria-label="Page navigation" class="mt-4">
                      <ul class="pagination justify-content-center">
                        <?php if ($page > 1) : ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= $baseURL ?>admin/product?page=<?= $page - 1 ?>" aria-label="Previous">
                              <span aria-hidden="true">«</span>
                            </a>
                          </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                          <li class="page-item <?= $i === 'active' ? 'active' : '' ?>">
                            <a class="page-link" href="<?= $baseURL ?>admin/product?page=<?= $i ?>"><?= $i ?></a>
                          </li>
                        <?php endfor; ?>
                        <?php if ($page < $totalPages) : ?>
                          <li class="page-item">
                            <a class="page-link" href="<?= $baseURL ?>admin/product?page=<?= $page + 1 ?>" aria-label="Next">
                              <span aria-hidden="true">»</span>
                            </a>
                          </li>
                        <?php endif; ?>
                      </ul>
                    </nav>
                  <?php endif; ?>
                </div>
              </div>
            <?php else : ?>
              <div class="alert alert-warning">Không tìm thấy trang yêu cầu.</div>
            <?php endif; ?>
          </div>
        </div>

        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="http://www.themekita.com">
                    ThemeKita
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"> Help </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"> Licenses </a>
                </li>
              </ul>
            </nav>
            <div class="copyright">
              2024, made with <i class="fa fa-heart heart text-danger"></i> by
              <a href="http://www.themekita.com">ThemeKita</a>
            </div>
            <div>
              Distributed by
              <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
            </div>
          </div>
        </footer>
      </div>
    </div>

    <!-- Core JS Files -->
    <script src="<?= $base ?>assets/admin/js/core/jquery-3.7.1.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/core/popper.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?= $base ?>assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="<?= $base ?>assets/admin/js/plugin/chart.js/chart.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="<?= $base ?>assets/admin/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="<?= $base ?>assets/admin/js/setting-demo.js"></script>
    <script src="<?= $base ?>assets/admin/js/demo.js"></script>

    <?php if ($section === 'home') : ?>
      <script>
        // Biểu đồ doanh thu theo tháng
        var revenueChart = new Chart(document.getElementById("revenueChart"), {
          type: 'line',
          data: {
            labels: <?= json_encode(array_column($earnings, 'month')) ?>,
            datasets: [{
              label: "Doanh thu (VNĐ)",
              borderColor: "#177dff",
              backgroundColor: "rgba(23, 125, 255, 0.2)",
              pointBackgroundColor: "#177dff",
              pointBorderColor: "#fff",
              data: <?= json_encode(array_column($earnings, 'total')) ?>,
              fill: true
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: { display: true, position: 'top' },
            scales: {
              x: { grid: { display: false } },
              y: {
                grid: { color: "#e7eaf0" },
                ticks: {
                  callback: function(value) {
                    return value.toLocaleString('vi-VN') + ' VNĐ';
                  }
                }
              }
            },
            plugins: {
              tooltip: {
                callbacks: {
                  label: function(context) {
                    return context.dataset.label + ': ' + context.parsed.y.toLocaleString('vi-VN') + ' VNĐ';
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
              backgroundColor: ["#ffc107", "#28a745", "#dc3545"],
              data: <?= json_encode(array_column($orderStatusCounts, 'count')) ?>
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: { display: false },
            scales: {
              x: { grid: { display: false } },
              y: { grid: { color: "#e7eaf0" }, beginAtZero: true }
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
              backgroundColor: ["#177dff", "#ffc107", "#28a745", "#dc3545", "#6f42c1"],
              data: <?= json_encode(array_column($topProducts, 'quantity')) ?>
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: { position: 'right' },
            plugins: {
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

        // Biểu đồ thống kê đơn hàng 7 ngày gần nhất
        var recentOrdersChart = new Chart(document.getElementById("recentOrdersChart"), {
          type: 'bar',
          data: {
            labels: <?= json_encode(array_column($recentOrderStats, 'order_day')) ?>,
            datasets: [{
              label: "Số đơn hàng",
              backgroundColor: "#177dff",
              data: <?= json_encode(array_column($recentOrderStats, 'order_count')) ?>
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: { display: true, position: 'top' },
            scales: {
              x: { grid: { display: false } },
              y: {
                grid: { color: "#e7eaf0" },
                beginAtZero: true,
                ticks: {
                  stepSize: 1,
                  callback: function(value) {
                    return Number(value).toFixed(0); // Hiển thị số nguyên
                  }
                }
              }
            },
            plugins: {
              tooltip: {
                callbacks: {
                  label: function(context) {
                    return context.dataset.label + ': ' + context.parsed.y + ' đơn';
                  }
                }
              }
            }
          }
        });
      </script>
    <?php endif; ?>
  </body>
</html>