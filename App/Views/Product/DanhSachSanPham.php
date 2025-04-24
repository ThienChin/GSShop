<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Chỉ khởi động session nếu chưa có session nào chạy
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];
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
    <title>Danh Sách Sản Phẩm | GS-Shop</title>
    <link href="<?= $base ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/price-range.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/main.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/responsive.css" rel="stylesheet">
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
    /></head
  ><!--/head-->

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
                        >[email&#160;protected]</span
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
                <a href="index.html"
                  ><img src="images/home/logo.png" alt="GSShop Logo"
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
                    <a href="checkout.html"
                      ><i class="fa fa-crosshairs"></i> Thanh toán</a
                    >
                  </li>
                  <li>
                    <a href="cart.html"
                      ><i class="fa fa-shopping-cart"></i> Giỏ hàng</a
                    >
                  </li>
                  <li>
                    <a href="login.html"
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
                  <li><a href="index.html">Trang chủ</a></li>
                  <li class="dropdown">
                    <a href="#" class="active"
                      >Sản phẩm<i class="fa fa-angle-down"></i
                    ></a>
                    <ul role="menu" class="sub-menu">
                      <li>
                        <a href="shop.html" class="active"
                          >Danh sách sản phẩm</a
                        >
                      </li>
                      <li>
                        <a href="product-details.html">Chi tiết sản phẩm</a>
                      </li>
                      <li><a href="checkout.html">Thanh toán</a></li>
                      <li><a href="cart.html">Giỏ hàng</a></li>
                      <li><a href="login.html">Đăng nhập</a></li>
                    </ul>
                  </li>
                  <li><a href="contact-us.html">Liên hệ</a></li>
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

    <section id="advertisement">
      <div class="container" style="text-align: center">
        <img
          src="images/home/shipping.png"
          alt="Khuyến mãi GSShop"
          style="height: 150px; width: 620px"
        />
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <div class="left-sidebar">
              <h2>Danh mục</h2>
              <div class="panel-group category-products" id="accordian">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a
                        data-toggle="collapse"
                        data-parent="#accordian"
                        href="#laptops"
                      >
                        <span class="badge pull-right"
                          ><i class="fa fa-plus"></i
                        ></span>
                        Laptop
                      </a>
                    </h4>
                  </div>
                  <div id="laptops" class="panel-collapse collapse">
                    <div class="panel-body">
                      <ul>
                        <li><a href="">Laptop Gaming</a></li>
                        <li><a href="">Laptop Văn phòng</a></li>
                        <li><a href="">Ultrabook</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a
                        data-toggle="collapse"
                        data-parent="#accordian"
                        href="#pcs"
                      >
                        <span class="badge pull-right"
                          ><i class="fa fa-plus"></i
                        ></span>
                        PC
                      </a>
                    </h4>
                  </div>
                  <div id="pcs" class="panel-collapse collapse">
                    <div class="panel-body">
                      <ul>
                        <li><a href="">PC Gaming</a></li>
                        <li><a href="">PC Đồ họa</a></li>
                        <li><a href="">PC Văn phòng</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a
                        data-toggle="collapse"
                        data-parent="#accordian"
                        href="#accessories"
                      >
                        <span class="badge pull-right"
                          ><i class="fa fa-plus"></i
                        ></span>
                        Phụ kiện
                      </a>
                    </h4>
                  </div>
                  <div id="accessories" class="panel-collapse collapse">
                    <div class="panel-body">
                      <ul>
                        <li><a href="">Tai nghe</a></li>
                        <li><a href="">Bàn phím</a></li>
                        <li><a href="">Chuột</a></li>
                        <li><a href="">Màn hình</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="brands_products">
                <h2>Thương hiệu</h2>
                <div class="brands-name">
                  <ul class="nav nav-pills nav-stacked">
                    <li>
                      <a href=""> <span class="pull-right">(50)</span>Dell</a>
                    </li>
                    <li>
                      <a href=""> <span class="pull-right">(30)</span>HP</a>
                    </li>
                    <li>
                      <a href=""> <span class="pull-right">(20)</span>ASUS</a>
                    </li>
                    <li>
                      <a href="">
                        <span class="pull-right">(15)</span>Logitech</a
                      >
                    </li>
                    <li>
                      <a href=""> <span class="pull-right">(10)</span>Lenovo</a>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="price-range">
                <h2>Khoảng giá</h2>
                <div class="well">
                  <input
                    type="text"
                    class="span2"
                    value=""
                    data-slider-min="0"
                    data-slider-max="100"
                    data-slider-step="5"
                    data-slider-value="[10,80]"
                    id="sl2"
                  /><br />
                  <b>0 triệu</b> <b class="pull-right">100 triệu</b>
                </div>
              </div>

              <div class="shipping text-center">
                <img
                  src="images/home/shipping.png"
                  alt="Khuyến mãi GSShop"
                  style="height: 250px; width: 250px"
                />
              </div>
            </div>
          </div>

          <div class="col-sm-9 padding-right">
            <div class="features_items">
              <h2 class="title text-center">Sản Phẩm Nổi Bật</h2>
              <div class="col-sm-4">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img
                        src="images/products/dell-xps13.jpg"
                        alt="Laptop Dell XPS 13"
                      />
                      <h2>25,000,000 VNĐ</h2>
                      <p>Laptop Dell XPS 13</p>
                      <a href="cart.html" class="btn btn-default add-to-cart"
                        ><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a
                      >
                    </div>
                    <div class="product-overlay">
                      <div class="overlay-content">
                        <h2>25,000,000 VNĐ</h2>
                        <p>Laptop Dell XPS 13</p>
                        <a href="cart.html" class="btn btn-default add-to-cart"
                          ><i class="fa fa-shopping-cart"></i>Thêm vào giỏ
                          hàng</a
                        >
                      </div>
                    </div>
                  </div>
                  <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                      <li>
                        <a href=""
                          ><i class="fa fa-plus-square"></i>Yêu thích</a
                        >
                      </li>
                      <li>
                        <a href="product-details.html"
                          ><i class="fa fa-plus-square"></i>Xem chi tiết</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img
                        src="images/products/asus-rog-pc.jpg"
                        alt="PC Gaming ASUS ROG"
                      />
                      <h2>35,000,000 VNĐ</h2>
                      <p>PC Gaming ASUS ROG</p>
                      <a href="cart.html" class="btn btn-default add-to-cart"
                        ><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a
                      >
                    </div>
                    <div class="product-overlay">
                      <div class="overlay-content">
                        <h2>35,000,000 VNĐ</h2>
                        <p>PC Gaming ASUS ROG</p>
                        <a href="cart.html" class="btn btn-default add-to-cart"
                          ><i class="fa fa-shopping-cart"></i>Thêm vào giỏ
                          hàng</a
                        >
                      </div>
                    </div>
                  </div>
                  <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                      <li>
                        <a href=""
                          ><i class="fa fa-plus-square"></i>Yêu thích</a
                        >
                      </li>
                      <li>
                        <a href="product-details.html"
                          ><i class="fa fa-plus-square"></i>Xem chi tiết</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img
                        src="images/products/logitech-gprox.jpg"
                        alt="Tai nghe Logitech G Pro X"
                      />
                      <h2>3,500,000 VNĐ</h2>
                      <p>Tai nghe Logitech G Pro X</p>
                      <a href="cart.html" class="btn btn-default add-to-cart"
                        ><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a
                      >
                    </div>
                    <div class="product-overlay">
                      <div class="overlay-content">
                        <h2>3,500,000 VNĐ</h2>
                        <p>Tai nghe Logitech G Pro X</p>
                        <a href="cart.html" class="btn btn-default add-to-cart"
                          ><i class="fa fa-shopping-cart"></i>Thêm vào giỏ
                          hàng</a
                        >
                      </div>
                    </div>
                  </div>
                  <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                      <li>
                        <a href=""
                          ><i class="fa fa-plus-square"></i>Yêu thích</a
                        >
                      </li>
                      <li>
                        <a href="product-details.html"
                          ><i class="fa fa-plus-square"></i>Xem chi tiết</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <ul class="pagination">
                <li class="active"><a href="">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li>
                  <a href=""><i class="fa fa-angle-double-right"></i></a>
                </li>
              </ul>
            </div>
          </div>
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

    <script
      data-cfasync="false"
      src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"
    ></script>
    <script src="<?= $base ?>assets/js/jquery.js"></script>
    <script src="<?= $base ?>assets/js/price-range.js"></script>
    <script src="<?= $base ?>assets/js/jquery.scrollUp.min.js"></script>
    <script src="<?= $base ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= $base ?>assets/js/jquery.prettyPhoto.js"></script>
    <script src="<?= $base ?>assets/js/main.js"></script>
    <script>
      (function () {
        function c() {
          var b = a.contentDocument || a.contentWindow.document;
          if (b) {
            var d = b.createElement("script");
            d.innerHTML =
              "window.__CF$cv$params={r:'930c975209e3adf4',t:'MTc0NDczMjE0Ny4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
            b.getElementsByTagName("head")[0].appendChild(d);
          }
        }
        if (document.body) {
          var a = document.createElement("iframe");
          a.height = 1;
          a.width = 1;
          a.style.position = "absolute";
          a.style.top = 0;
          a.style.left = 0;
          a.style.border = "none";
          a.style.visibility = "hidden";
          document.body.appendChild(a);
          if ("loading" !== document.readyState) c();
          else if (window.addEventListener)
            document.addEventListener("DOMContentLoaded", c);
          else {
            var e = document.onreadystatechange || function () {};
            document.onreadystatechange = function (b) {
              e(b);
              "loading" !== document.readyState &&
                ((document.onreadystatechange = e), c());
            };
          }
        }
      })();
    </script>
  </body>
</html>
