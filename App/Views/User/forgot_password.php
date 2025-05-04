<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

// Hiển thị thông báo nếu có
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Khôi phục mật khẩu tài khoản tại GS-Shop."
    />
    <meta name="author" content="GSShop" />
    <title>Quên Mật Khẩu | GS-Shop</title>
    <link href="<?= $base ?>assets/css/bootstrap.min.css" rel="stylesheet" />
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
    <link rel="shortcut icon" href="images/ico/favicon.ico" />
    <link
      rel="apple-touch-icon-precomposed"
      sizes="144x144"
      href="images/ico/apple-touch-icon-144-precomposed.png"
    />
    <link
      rel="apple-touch-icon-precomposed"
      sizes="114x114"
      href="images/ico/apple-touch-icon-114-precomposed.png"
    />
    <link
      rel="apple-touch-icon-precomposed"
      sizes="72x72"
      href="images/ico/apple-touch-icon-72-precomposed.png"
    />
    <link
      rel="apple-touch-icon-precomposed"
      href="images/ico/apple-touch-icon-57-precomposed.png"
    />
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
                        data-cfemail="1764626767786563177064647f7867396179"
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
                    <a href="https://x.com/GSShop"><i class="fa fa-x"></i></a>
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
                    <a href="<?= $baseURL ?>cart/checkout"
                      ><i class="fa fa-crosshairs"></i> Thanh toán</a
                    >
                  </li>
                  <li>
                    <a href="<?= $baseURL ?>cart/cart"
                      ><i class="fa fa-shopping-cart"></i> Giỏ hàng</a
                    >
                  </li>
                  <li>
                    <a href="<?= $baseURL ?>user/login"
                      ><i class="fa fa-lock"></i> Đăng nhập</a
                    >
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
                  <span class="sr-only">Chuyển đổi điều hướng</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
              </div>
              <div class="mainmenu pull-left">
                <ul class="nav navbar-nav collapse navbar-collapse">
                  <li><a href="<?= $baseURL ?>home/index">Trang chủ</a></li>
                  <li class="dropdown">
                    <a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                    <ul role="menu" class="sub-menu">
                      <li><a href="<?= $baseURL ?>product/index">Danh sách sản phẩm</a></li>
                      <li>
                        <a href="<?= $baseURL ?>product/detail">Chi tiết sản phẩm</a>
                      </li>
                      <li><a href="<?= $baseURL ?>order/checkout">Thanh toán</a></li>
                      <li><a href="<?= $baseURL ?>cart/cart">Giỏ hàng</a></li>
                      <li><a href="<?= $baseURL ?>user/login">Đăng nhập</a></li>
                    </ul>
                  </li>
                  <li><a href="<?= $baseURL ?>user/contact">Liên hệ</a></li>
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

    <section id="form">
      <div class="form-container">
        <div class="forgot-password-form">
          <h2>Khôi phục mật khẩu</h2>
          <?php if ($message): ?>
            <div class="success-message" style="display: block; color: green; text-align: center;">
              <?= htmlspecialchars($message) ?>
            </div>
          <?php endif; ?>
          <?php if ($error): ?>
            <div class="error-message" style="display: block; color: red; text-align: center;">
              <?= htmlspecialchars($error) ?>
            </div>
          <?php endif; ?>
          <form id="forgot-password-form" action="<?= $baseURL ?>user/forgot_password" method="POST">
            <div class="form-group">
              <label for="forgot-phone">Nhập số điện thoại</label>
              <input
                type="tel"
                placeholder="Nhập số điện thoại"
                required
                id="forgot-phone"
                name="phone"
              />
              <div class="error-message" id="forgot-phone-error"></div>
            </div>
            <button type="submit" class="btn-login">Gửi yêu cầu</button>
          </form>
          <p class="login-link">
            Quay lại <a href="<?= $baseURL ?>user/login">Đăng nhập</a>
          </p>
        </div>
      </div>
    </section>

    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
              <div class="companyinfo">
                <h2><span>GS</span>Shop</h2>
                <p>
                  Cung cấp PC, laptop và phụ kiện chất lượng cao với giá cạnh
                  tranh.
                </p>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="address">
                <img src="images/home/map.png" alt="Bản đồ GSShop" />
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
                  <li><a href="contact-us.html">Liên hệ</a></li>
                  <li><a href="">Tình trạng đơn hàng</a></li>
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
                  <li><a href="">Bàn phím</a></li>
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
            <p class="pull-left">
              Copyright © 2025 GSShop. All rights reserved.
            </p>
            <p class="pull-right">Thiết kế bởi GSShop Team</p>
          </div>
        </div>
      </div>
    </footer>

    <script src="<?= $base ?>assets/js/jquery.js"></script>
    <script src="<?= $base ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= $base ?>assets/js/jquery.scrollUp.min.js"></script>
    <script src="<?= $base ?>assets/js/jquery.prettyPhoto.js"></script>
    <script src="<?= $base ?>assets/js/main.js"></script>
    <script>
      // Kiểm tra định dạng số điện thoại
      function validatePhone(phone) {
        const re = /^[0-9]{10,11}$/;
        return re.test(phone);
      }

      // Xóa thông báo lỗi
      function clearErrors() {
        document.querySelectorAll(".error-message").forEach((el) => {
          el.style.display = "none";
          el.textContent = "";
        });
      }

      // Xử lý form quên mật khẩu
      document
        .getElementById("forgot-password-form")
        .addEventListener("submit", function (event) {
          event.preventDefault();
          clearErrors();
          const phone = document.getElementById("forgot-phone").value;
          let hasError = false;

          if (!validatePhone(phone)) {
            document.getElementById("forgot-phone-error").textContent =
              "Vui lòng nhập số điện thoại hợp lệ (10-11 số).";
            document.getElementById("forgot-phone-error").style.display = "block";
            hasError = true;
          }

          if (!hasError) {
            this.submit(); // Gửi form đến UserController
          }
        });
    </script>
  </body>
</html>