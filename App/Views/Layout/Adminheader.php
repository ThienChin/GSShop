<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

// Lấy URL hiện tại
$current_page = basename($_SERVER['REQUEST_URI']);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Quản lý sản phẩm và đơn hàng tại GS-Shop Admin Panel.">
    <meta name="author" content="GSShop">
    <title>Admin Panel | GS-Shop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
    <!-- CSS Bootstrap -->
    <link href="<?= $base ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- CSS Core Theme -->
    <link href="<?= $base ?>assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= $base ?>assets/css/prettyPhoto.css" rel="stylesheet" />
    <link href="<?= $base ?>assets/css/price-range.css" rel="stylesheet" />
    <link href="<?= $base ?>assets/css/animate.css" rel="stylesheet" />
    <link href="<?= $base ?>assets/css/main.css" rel="stylesheet" />
    <link href="<?= $base ?>assets/css/responsive.css" rel="stylesheet" />
    <link href="<?= $base ?>assets/css/login.css" rel="stylesheet" />
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <header id="header">
        <div class="header_top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li>
                                    <a href=""><i class="fa fa-phone"></i> +84 123 456 789</a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-envelope"></i> admin@gsshop.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="https://facebook.com/GSShop"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-middle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="<?= $baseURL ?>admin/index">
                                <img src="<?= $base ?>assets/images/home/logo.png" alt="GSShop Admin Logo" />
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="<?= $baseURL ?>admin/profile"><i class="fa fa-user"></i> Tài khoản</a>
                                </li>
                                <li>
                                    <a href="<?= $baseURL ?>admin/orders"><i class="fa fa-list"></i> Đơn hàng</a>
                                </li>
                                <?php if (isset($_SESSION['UserLogin']) && $_SESSION['UserLogin'] == 'admin'): ?>
                                    <li>
                                        <a href="<?= $baseURL ?>admin/logout">
                                            <i class="fa fa-user"></i> <?= htmlspecialchars($_SESSION['UserLogin']) ?>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="<?= $baseURL ?>admin/login">
                                            <i class="fa fa-lock"></i> Đăng nhập
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button
                                type="button"
                                class="navbar-toggle"
                                data-toggle="collapse"
                                data-target=".navbar-collapse"
                            >
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li class="<?php echo ($current_page == 'index' || $current_page == '') ? 'active' : ''; ?>">
                                    <a href="<?= $baseURL ?>admin/index">Dashboard</a>
                                </li>
                                <li class="dropdown <?php echo (strpos($current_page, 'product') !== false) ? 'active' : ''; ?>">
                                    <a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li class="<?php echo (strpos($current_page, 'product/list') !== false) ? 'active' : ''; ?>">
                                            <a href="<?= $baseURL ?>admin/product">Danh sách sản phẩm</a>
                                        </li>
                                        <li class="<?php echo (strpos($current_page, 'product/add') !== false) ? 'active' : ''; ?>">
                                            <a href="<?= $baseURL ?>admin/create">Thêm sản phẩm</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <input type="text" placeholder="Tìm kiếm sản phẩm..." />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>
</html>