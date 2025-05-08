<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Đăng nhập tài khoản tại GS-Shop để mua PC, laptop và phụ kiện công nghệ chất lượng."
    />
    <meta name="author" content="GSShop" />
    <title>Đăng Nhập | GS-Shop</title>
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
    <style>
      .password-container {
        position: relative;
      }
      .password-container input {
        width: 100%;
        padding-right: 40px;
        box-sizing: border-box;
      }
      .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
      }
      .toggle-password i.fa-eye-slash {
        display: none;
      }
      .toggle-password.show i.fa-eye {
        display: none;
      }
      .toggle-password.show i.fa-eye-slash {
        display: inline;
      }
    </style>
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
                    <a href="<?= $baseURL ?>user/login" class="active"
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
                      <li><a href="<?= $baseURL ?>user/login" class="active">Đăng nhập</a></li>
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