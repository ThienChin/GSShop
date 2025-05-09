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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GSShop - Liên hệ để mua PC, Laptop, Phụ kiện công nghệ">
    <meta name="author" content="GSShop">
    <title>Liên hệ | GSShop</title>
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
                                <li><a href="#"><i class="fa fa-phone"></i> +84 123 456 789</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@gsshop.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
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
                            <a href="<?= $baseURL ?>home/index"><img src="<?= $baseURL ?>assets/images/home/logo.png" alt="GSShop"></a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-user"></i> Tài khoản</a></li>
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
                                <span class="sr-only">Toggle navigation</span>
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
                                        <li><a href="<?= $baseURL ?>cart/cart">Giỏ hàng</a></li>
                                        <li><a href="<?= $baseURL ?>user/login">Đăng nhập</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?= $baseURL ?>user/contact" class="active">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <input type="text" placeholder="Tìm kiếm sản phẩm"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">        
                <div class="col-sm-12">                             
                    <h2 class="title text-center">Liên hệ <strong>GSShop</strong></h2>                                   
                    <div id="gmap" class="contact-map"></div>
                </div>                
            </div>      
            <div class="row">   
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Gửi tin nhắn</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Họ và tên">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="subject" class="form-control" required="required" placeholder="Chủ đề">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Tin nhắn của bạn"></textarea>
                            </div>                        
                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi" style="background-color: #ff6200; border-color: #e55a00;">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h2 class="title text-center">Thông tin liên hệ</h2>
                        <address>
                            <p>GSShop</p>
                            <p>123 Nguyễn Huệ, Quận 1, TP.HCM, Việt Nam</p>
                            <p>Điện thoại: +84 123 456 789</p>
                            <p>Email: <a href="mailto:info@gsshop.com">info@gsshop.com</a></p>
                        </address>
                        <div class="social-networks">
                            <h2 class="title text-center">Mạng xã hội</h2>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>                
            </div>  
        </div>  
    </div>

    <footer id="footer">
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Dịch vụ</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Hỗ trợ trực tuyến</a></li>
                                <li><a href="contact-us.html">Liên hệ</a></li>
                                <li><a href="#">Trạng thái đơn hàng</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Sản phẩm</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="shop.html">Laptop</a></li>
                                <li><a href="shop.html">PC</a></li>
                                <li><a href="shop.html">Phụ kiện</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Nhận thông tin</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Địa chỉ email của bạn" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Nhận thông tin mới nhất từ GSShop!</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Bản quyền © 2025 GSShop. Mọi quyền được bảo lưu.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?= $base ?>assets/js/jquery.js"></script>
    <script src="<?= $base ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="js/gmaps.js"></script>
    <script src="<?= $base ?>assets/js/contact.js"></script>
    <script src="<?= $base ?>assets/js/price-range.js"></script>
    <script src="<?= $base ?>assets/js/jquery.scrollUp.min.js"></script>
    <script src="<?= $base ?>assets/js/jquery.prettyPhoto.js"></script>
    <script src="<?= $base ?>assets/js/main.js"></script>
    <script>
    (function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'93432984cccf675f',t:'MTc0NTMwNDM2Ni4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();
    </script>
</body>
</html>