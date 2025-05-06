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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Mua PC, laptop và phụ kiện chất lượng tại GS-Shop. Giá tốt, giao hàng nhanh."
    />
    <meta name="author" content="GSShop" />
    <title>Trang chủ | GS-Shop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
    <!-- CSS Boostrap -->
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
                    <a href=""
                      ><i class="fa fa-envelope"></i>
                      <span
                        class="__cf_email__"
                        data-cfemail="5d1a0e0e35322d1d3a303c3431733e3230"
                        >[email protected]</span
                      ></a
                    >
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="social-icons pull-right">
                <ul class="nav navbar-nav">
                  <li>
                    <a href="https://facebook.com/GSShop"
                      ><i class="fa fa-facebook"></i
                    ></a>
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
                <a href="<?= $baseURL ?>home/index"
                  ><img src="<?= $base ?>assets/images/home/logo.png" alt="GSShop Logo"
                /></a>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="shop-menu pull-right">
                <ul class="nav navbar-nav">
                  <li>
                    <a href=""><i class="fa fa-user"></i> Tài khoản</a>
                  </li>
                  <li>
                    <a href=""><i class="fa fa-star"></i> Yêu thích</a>
                  </li>
                  <li>
                    <a href="<?= $baseURL ?>order/checkout"
                      ><i class="fa fa-crosshairs"></i> Thanh toán</a
                    >
                  </li>
                  <li>
                    <a href="<?= $baseURL ?>cart/cart"
                      ><i class="fa fa-shopping-cart"></i> Giỏ hàng</a
                    >
                  </li>
                  <li>
                    <?php if (isset($_SESSION['username'])): ?>
                      <a href="<?= $baseURL ?>user/logout">
                        <i class="fa fa-user"></i> <?= htmlspecialchars($_SESSION['username']) ?>
                      </a>
                    <?php else: ?>
                      <a href="<?= $baseURL ?>user/login">
                        <i class="fa fa-lock"></i> Đăng nhập
                      </a>
                    <?php endif; ?>
                  </li>
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
                    <a href="<?= $baseURL ?>home/index">Trang chủ</a>
                  </li>
                  <li class="dropdown <?php echo (strpos($current_page, 'product') !== false || $current_page == 'cart' || $current_page == 'checkout' || $current_page == 'login') ? 'active' : ''; ?>">
                    <a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                    <ul role="menu" class="sub-menu">
                        <li class="<?php echo (strpos($current_page, 'product/index') !== false) ? 'active' : ''; ?>">
                            <a href="<?= $baseURL ?>product/index">Danh sách sản phẩm</a>
                        </li>
                        <li class="<?php echo (strpos($current_page, 'product/detail') !== false) ? 'active' : ''; ?>">
                            <a href="<?= $baseURL ?>product/detail">Chi tiết sản phẩm</a>
                        </li>
                        <li class="<?php echo ($current_page == 'checkout') ? 'active' : ''; ?>">
                            <a href="<?= $baseURL ?>order/checkout">Thanh toán</a>
                        </li>
                        <li class="<?php echo ($current_page == 'cart') ? 'active' : ''; ?>">
                            <a href="<?= $baseURL ?>cart/cart">Giỏ hàng</a>
                        </li>
                        <li class="<?php echo ($current_page == 'login') ? 'active' : ''; ?>">
                            <a href="<?= $baseURL ?>user/login">Đăng nhập</a>
                        </li>
                    </ul>
                  </li>
                  <li class="<?php echo ($current_page == 'contact') ? 'active' : ''; ?>">
                    <a href="<?= $baseURL ?>user/contact">Liên hệ</a>
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