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
    <meta name="description" content="Thanh toán đơn hàng tại GS-Shop. Mua PC, laptop và phụ kiện chất lượng với giao hàng nhanh.">
    <meta name="author" content="GSShop">
    <title>Thanh Toán | GS-Shop</title>
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
                                <li><a href=""><i class="fa fa-phone"></i> +84 123 456 789</a></li>
                                <li><a href=""><i class="fa fa-envelope"></i> <span class="__cf_email__" data-cfemail="5d1a0e0e35322d1d3a303c3431733e3230">[email protected]</span></a></li>
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
                                <li><a href="<?= $baseURL ?>order/checkout" class="active"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
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
                                <li class="dropdown"><a href="#" class="active">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="<?= $baseURL ?>product/index">Danh sách sản phẩm</a></li>
                                        <li><a href="<?= $baseURL ?>product/detail">Chi tiết sản phẩm</a></li> 
                                        <li><a href="<?= $baseURL ?>order/checkout" class="active">Thanh toán</a></li> 
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

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="<?= $baseURL ?>home/index">Trang chủ</a></li>
                    <li><a href="<?= $baseURL ?>cart/cart">Giỏ hàng</a></li>
                    <li class="active">Thanh toán</li>
                </ol>
            </div>

            <div class="checkout-options">
                <h3>Khách hàng mới</h3>
                <p>Lựa chọn thanh toán</p>
                <ul class="nav">
                    <li>
                        <label><input type="radio" name="checkout-option" value="register" onclick="toggleForms('register')"> Đăng ký tài khoản</label>
                    </li>
                    <li>
                        <label><input type="radio" name="checkout-option" value="guest" onclick="toggleForms('guest')" checked> Thanh toán không cần đăng ký</label>
                    </li>
                    <li>
                        <a href="<?= $baseURL ?>cart/cart"><i class="fa fa-times"></i> Quay lại giỏ hàng</a>
                    </li>
                </ul>
            </div>

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="shopper-info" id="register-form" style="display: none;">
                            <p>Thông tin tài khoản</p>
                            <form id="register-form-data">
                                <input type="text" name="name" placeholder="Họ và tên *" required>
                                <input type="email" name="email" placeholder="Email *" required>
                                <input type="password" name="password" placeholder="Mật khẩu *" required>
                                <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu *" required>
                            </form>
                            <a class="btn btn-primary" href="#" onclick="submitRegister()">Đăng ký & Tiếp tục</a>
                        </div>
                        <div class="shopper-info" id="guest-form">
                            <p>Thông tin thanh toán</p>
                            <form id="guest-form-data">
                                <input type="text" name="name" placeholder="Họ và tên *" required>
                                <input type="email" name="email" placeholder="Email *" required>
                                <input type="text" name="phone" placeholder="Số điện thoại *" required>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="bill-to">
                            <p>Địa chỉ giao hàng</p>
                            <form id="billing-form">
                                <input type="text" name="address" placeholder="Địa chỉ *" required>
                                <select name="city" required>
                                    <option value="">-- Chọn Tỉnh/Thành phố --</option>
                                    <option>TP. Hồ Chí Minh</option>
                                    <option>Hà Nội</option>
                                    <option>Đà Nẵng</option>
                                    <option>Cần Thơ</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="order-message">
                            <p>Ghi chú đơn hàng</p>
                            <textarea name="message" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian giao hàng mong muốn" rows="8"></textarea>
                            <label><input type="checkbox" checked> Giao hàng đến địa chỉ thanh toán</label>
                        </div>	
                    </div>					
                </div>
            </div>

            <div class="review-payment">
                <h2>Xem lại & Thanh toán</h2>
            </div>

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Sản phẩm</td>
                            <td class="description"></td>
                            <td class="price">Đơn giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Thành tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <?php
                        $subtotal = 0;
                        if (!empty($cartItems)):
                            foreach ($cartItems as $item):
                                $total = $item['price'] * $item['quantity'];
                                $subtotal += $total;
                                $itemId = isset($item['featuredproduct_id']) ? $item['featuredproduct_id'] : $item['id'];
                        ?>
                            <tr data-id="<?= $itemId ?>">
                                <td class="cart_product">
                                    <a href="<?= $baseURL ?>product/detail/<?= $itemId ?>">
                                        <img src="<?= $assets . $item['image'] ?>" alt="<?= $item['name'] ?>" style="width: 100px;">
                                    </a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="<?= $baseURL ?>product/detail/<?= $itemId ?>"><?= $item['name'] ?></a></h4>
                                    <p>ID: <?= $itemId ?></p>
                                </td>
                                <td class="cart_price">
                                    <p><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</p>
                                </td>
                                <td class="cart_quantity">
                                    <input class="cart_quantity_input" type="text" name="quantity" value="<?= $item['quantity'] ?>" readonly size="2">
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price"><?= number_format($total, 0, ',', '.') ?> VNĐ</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="#" onclick="removeItem(<?= $itemId ?>)"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Giỏ hàng trống</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td>Tổng tiền hàng</td>
                                        <td><span id="subtotal"><?= number_format($subtotal, 0, ',', '.') ?> VNĐ</span></td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Phí vận chuyển</td>
                                        <td>Miễn phí</td>										
                                    </tr>
                                    <tr>
                                        <td>Tổng cộng</td>
                                        <td><span id="total"><?= number_format($subtotal, 0, ',', '.') ?> VNĐ</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="payment-options">
                <h3>Phương thức thanh toán</h3>
                <form id="payment-form" method="POST" action="<?= $baseURL ?>order/checkout">
                    <input type="hidden" name="name">
                    <input type="hidden" name="email">
                    <input type="hidden" name="phone">
                    <input type="hidden" name="address">
                    <input type="hidden" name="city">
                    <input type="hidden" name="notes">
                    <span>
                        <label><input type="radio" name="payment_method" value="cod" checked> Thanh toán khi nhận hàng (COD)</label>
                    </span>
                    <span>
                        <label><input type="radio" name="payment_method" value="bank"> Chuyển khoản ngân hàng</label>
                    </span>
                    <span>
                        <label><input type="radio" name="payment_method" value="momo"> Ví MoMo</label>
                    </span>
                    <button type="submit" class="btn btn-primary">Đặt hàng</button>
                </form>
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

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="<?= $base ?>assets/js/jquery.js"></script>
    <script src="<?= $base ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= $base ?>assets/js/jquery.scrollUp.min.js"></script>
    <script src="<?= $base ?>assets/js/price-range.js"></script>
    <script src="<?= $base ?>assets/js/jquery.prettyPhoto.js"></script>
    <script src="<?= $base ?>assets/js/main.js"></script>
    <script>
        // Chuyển đổi giữa đăng ký và thanh toán không đăng ký
        function toggleForms(option) {
            document.getElementById('register-form').style.display = option === 'register' ? 'block' : 'none';
            document.getElementById('guest-form').style.display = option === 'guest' ? 'block' : 'none';
        }

        // Xử lý đăng ký (mẫu)
        function submitRegister() {
            const form = document.getElementById('register-form-data');
            if (form.checkValidity()) {
                alert('Đăng ký thành công! Vui lòng tiếp tục nhập thông tin giao hàng.');
                toggleForms('guest');
            } else {
                alert('Vui lòng điền đầy đủ thông tin.');
            }
        }

        // Xử lý đặt hàng
        function placeOrder() {
            const guestForm = document.getElementById('guest-form-data');
            const billingForm = document.getElementById('billing-form');
            const paymentForm = document.getElementById('payment-form');
            const notes = document.querySelector('textarea[name="message"]').value;

            console.log('Guest Form Valid:', guestForm.checkValidity());
            console.log('Billing Form Valid:', billingForm.checkValidity());

            if (guestForm.checkValidity() && billingForm.checkValidity()) {
                paymentForm.querySelector('input[name="name"]').value = guestForm.querySelector('input[name="name"]').value;
                paymentForm.querySelector('input[name="email"]').value = guestForm.querySelector('input[name="email"]').value;
                paymentForm.querySelector('input[name="phone"]').value = guestForm.querySelector('input[name="phone"]').value;
                paymentForm.querySelector('input[name="address"]').value = billingForm.querySelector('input[name="address"]').value;
                paymentForm.querySelector('input[name="city"]').value = billingForm.querySelector('select[name="city"]').value;
                paymentForm.querySelector('input[name="notes"]').value = notes;

                console.log('Form Data:', {
                    name: paymentForm.querySelector('input[name="name"]').value,
                    email: paymentForm.querySelector('input[name="email"]').value,
                    phone: paymentForm.querySelector('input[name="phone"]').value,
                    address: paymentForm.querySelector('input[name="address"]').value,
                    city: paymentForm.querySelector('input[name="city"]').value,
                    zip: paymentForm.querySelector('input[name="zip"]').value,
                    notes: notes,
                    payment_method: paymentForm.querySelector('input[name="payment_method"]:checked').value
                });

                paymentForm.submit();
            } else {
                alert('Vui lòng điền đầy đủ thông tin bắt buộc.');
            }
        }

        // Xóa sản phẩm
        function removeItem(id) {
            if (confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                $.ajax({
                    url: '<?= $baseURL ?>cart/remove',
                    type: 'POST',
                    data: { product_id: id },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function() {
                        alert('Đã có lỗi xảy ra, vui lòng thử lại.');
                    }
                });
            }
        }

        // Gắn sự kiện submit cho form
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            placeOrder();
        });
    </script>
</body>
</html>