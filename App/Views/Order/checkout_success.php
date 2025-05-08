<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Đặt hàng thành công tại GS-Shop. Cảm ơn bạn đã mua sắm với chúng tôi!">
    <meta name="author" content="GSShop">
    <title>Đặt Hàng Thành Công | GS-Shop</title>
    <link href="<?= $base ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/price-range.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/main.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/responsive.css" rel="stylesheet">
    <style>
        .success-container {
            text-align: center;
            padding: 50px 0;
        }
        .success-icon {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .success-container h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }
        .success-container p {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }
        .order-summary {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin: 20px auto;
            max-width: 800px;
        }
        .order-summary h3 {
            font-size: 20px;
            margin-bottom: 15px;
        }
        .order-summary ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .order-summary ul li {
            font-size: 16px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }
        .order-items table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .order-items th, .order-items td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .btn-continue {
            background-color: #fe980f;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .btn-continue:hover {
            background-color: #e68a00;
            color: #fff;
        }
    </style>
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
    <header id="header">
        <div class="header_top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href=""><i class="fa fa-phone"></i> +84 123 456 789</a></li>
                                <li><a href=""><i class="fa fa-envelope"></i> info@gsshop.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="https://facebook.com/GSShop"><i class="fa fa-facebook"></i></a></li>
                                <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                <li><a href=""><i class="fa fa-linkedin"></i></a></li>
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
                            <a href="<?= $baseURL ?>home/index"><img src="<?= $base ?>assets/images/home/logo.png" alt="GSShop Logo" /></a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href=""><i class="fa fa-user"></i> Tài khoản</a></li>
                                <li><a href=""><i class="fa fa-star"></i> Yêu thích</a></li>
                                <li><a href="<?= $baseURL ?>order/checkout"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <li><a href="<?= $baseURL ?>cart/cart"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                <li><a href="<?= $baseURL ?>user/login"><i class="fa fa-lock"></i> Đăng nhập</a></li>
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
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Chuyển đổi điều hướng</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="<?= $baseURL ?>home/index">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="<?= $baseURL ?>product/index">Danh sách sản phẩm</a></li>
                                        <li><a href="<?= $baseURL ?>product/detail">Chi tiết sản phẩm</a></li> 
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
                            <input type="text" placeholder="Tìm kiếm sản phẩm..."/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="success">
        <div class="container">
            <div class="success-container">
                <i class="fa fa-check-circle success-icon"></i>
                <h2>Đặt hàng thành công!</h2>
                <p>Cảm ơn bạn đã mua sắm tại GS-Shop. Đơn hàng của bạn đã được ghi nhận và sẽ sớm được xử lý.</p>
                
                <div class="order-summary">
                    <h3>Tóm tắt đơn hàng</h3>
                    <ul>
                        <li><span>Số đơn hàng:</span> <span>#<?= $order['id'] ?></span></li>
                        <li><span>Tổng tiền:</span> <span><?= number_format($order['total'], 0, ',', '.') ?> VNĐ</span></li>
                        <li><span>Phương thức thanh toán:</span> <span>
                            <?= $order['payment_method'] === 'cod' ? 'Thanh toán khi nhận hàng' : 
                               ($order['payment_method'] === 'bank' ? 'Chuyển khoản ngân hàng' : 'Ví MoMo') ?>
                        </span></li>
                        <li><span>Ngày đặt hàng:</span> <span><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></span></li>
                        <li><span>Người nhận:</span> <span><?= htmlspecialchars($order['billing_info']['name'] ?? 'N/A') ?></span></li>
                        <li><span>Email:</span> <span><?= htmlspecialchars($order['billing_info']['email'] ?? 'N/A') ?></span></li>
                        <li><span>Số điện thoại:</span> <span><?= htmlspecialchars($order['billing_info']['phone'] ?? 'N/A') ?></span></li>
                        <li><span>Địa chỉ giao hàng:</span> <span><?= htmlspecialchars(($order['shipping_address']['address'] ?? 'N/A') . ', ' . ($order['shipping_address']['city'] ?? 'N/A')) ?></span></li>
                    </ul>
                    <div class="order-items">
                        <h3>Chi tiết sản phẩm</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order['items'] as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['product_name'] ?? $item['featured_product_name'] ?? 'N/A') ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</td>
                                        <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> VNĐ</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <a href="<?= $baseURL ?>home/index" class="btn-continue">Tiếp tục mua sắm</a>
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
                            <p>Cung cấp PC, laptop và phụ kiện chất lượng cao với giá cạnh tranh.</p>
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
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
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
                    <p class="pull-left">Copyright © 2025 GSShop. All rights reserved.</p>
                    <p class="pull-right">Thiết kế bởi GSShop Team</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?= $base ?>assets/js/jquery.js"></script>
    <script src="<?= $base ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= $base ?>assets/js/jquery.scrollUp.min.js"></script>
    <script src="<?= $base ?>assets/js/price-range.js"></script>
    <script src="<?= $base ?>assets/js/jquery.prettyPhoto.js"></script>
    <script src="<?= $base ?>assets/js/main.js"></script>
</body>
</html>