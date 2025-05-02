<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

// Khởi tạo $grandTotal mặc định
$grandTotal = isset($grandTotal) ? $grandTotal : 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Xem và quản lý giỏ hàng của bạn tại GS-Shop. Mua PC, laptop và phụ kiện chất lượng với giá tốt.">
    <meta name="author" content="GSShop">
    <title>Giỏ Hàng | GS-Shop</title>
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
                                <li><a href="<?= $baseURL ?>cart/cart" class="active"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
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
                                        <li><a href="<?= $baseURL ?>order/checkout">Thanh toán</a></li> 
                                        <li><a href="<?= $baseURL ?>cart/cart" class="active">Giỏ hàng</a></li> 
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
                    <li class="active">Giỏ hàng</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <?php if (empty($cartItems)): ?>
                    <div class="alert alert-info text-center">
                        <h4>Chưa có sản phẩm nào trong giỏ hàng.</h4>
                        <p>Hãy khám phá cửa hàng của chúng tôi để thêm sản phẩm yêu thích!</p>
                        <a href="<?= $baseURL ?>home/index" class="btn btn-primary">Tiếp tục mua sắm</a>
                    </div>
                <?php else: ?>
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Sản phẩm</td>
                                <td class="price">Đơn giá</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Thành tiền</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <?php foreach ($cartItems as $item): ?>
                                <?php
                                    $itemTotal = $item['price'] * $item['quantity'];
                                    $itemId = $item['source'] === 'featured' ? $item['id'] : $item['id'];
                                ?>
                                <tr data-id="<?= $itemId ?>" data-source="<?= $item['source'] ?>">
                                    <td class="cart_description">
                                        <h4><a href="<?= $baseURL ?>product/detail/<?= $itemId ?>"><?= htmlspecialchars($item['name']) ?></a></h4>
                                    </td>
                                    <td class="cart_price">
                                        <p><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <a class="cart_quantity_up" href="#" onclick="updateQuantity(<?= $itemId ?>, '<?= $item['source'] ?>', 1)"> + </a>
                                            <input class="cart_quantity_input" type="text" name="quantity" value="<?= $item['quantity'] ?>" autocomplete="off" size="2" readonly>
                                            <a class="cart_quantity_down" href="#" onclick="updateQuantity(<?= $itemId ?>, '<?= $item['source'] ?>', -1)"> - </a>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price"><?= number_format($itemTotal, 0, ',', '.') ?> VNĐ</p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" href="#" onclick="removeItem(<?= $itemId ?>, '<?= $item['source'] ?>')"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php if (!empty($cartItems)): ?>
        <section id="do_action">
            <div class="container">
                <div class="heading">
                    <h3>Bạn muốn làm gì tiếp theo?</h3>
                    <p>Chọn nếu bạn muốn sử dụng mã giảm giá hoặc ước tính chi phí vận chuyển.</p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="chose_area">
                            <ul class="user_option">
                                <li>
                                    <input type="checkbox" id="coupon-checkbox">
                                    <label>Sử dụng mã giảm giá</label>
                                </li>
                                <li id="coupon-input" style="display: none;">
                                    <input type="text" placeholder="Nhập mã giảm giá" id="coupon-code">
                                    <button class="btn btn-default" onclick="applyCoupon()">Áp dụng</button>
                                </li>
                            </ul>
                            <ul class="user_info">
                                <li class="single_field">
                                    <label>Tỉnh/Thành phố:</label>
                                    <select>
                                        <option>TP. Hồ Chí Minh</option>
                                        <option>Hà Nội</option>
                                        <option>Đà Nẵng</option>
                                        <option>Cần Thơ</option>
                                    </select>
                                </li>
                            </ul>
                            <a class="btn btn-default update" href="#" onclick="estimateShipping()">Ước tính phí vận chuyển</a>
                            <a class="btn btn-default check_out" href="<?= $baseURL ?>order/checkout">Tiếp tục thanh toán</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul>
                                <li>Tổng tiền hàng <span id="subtotal"><?= number_format($grandTotal, 0, ',', '.') ?> VNĐ</span></li>
                                <li>Phí vận chuyển <span id="shipping">Miễn phí</span></li>
                                <li>Tổng cộng <span id="total"><?= number_format($grandTotal, 0, ',', '.') ?> VNĐ</span></li>
                            </ul>
                            <a class="btn btn-default update" href="#" onclick="updateCart()">Cập nhật</a>
                            <a class="btn btn-default check_out" href="<?= $baseURL ?>order/checkout">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

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
    <script src="<?= $base ?>assets/js/jquery.prettyPhoto.js"></script>
    <script src="<?= $base ?>assets/js/main.js"></script>
    <script>
        // Cập nhật số lượng sản phẩm
        function updateQuantity(productId, source, change) {
            $.ajax({
                url: '<?= $baseURL ?>cart/update',
                type: 'POST',
                data: {
                    product_id: productId,
                    source: source,
                    change: change
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function() {
                    alert('Đã có lỗi xảy ra, vui lòng thử lại.');
                }
            });
        }

        // Xóa sản phẩm khỏi giỏ hàng
        function removeItem(productId, source) {
            if (confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                $.ajax({
                    url: '<?= $baseURL ?>cart/remove',
                    type: 'POST',
                    data: {
                        product_id: productId,
                        source: source
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function() {
                        alert('Đã có lỗi xảy ra, vui lòng thử lại.');
                    }
                });
            }
        }

        // Hiển thị/ẩn ô nhập mã giảm giá
        document.getElementById('coupon-checkbox').addEventListener('change', function() {
            document.getElementById('coupon-input').style.display = this.checked ? 'block' : 'none';
        });

        // Áp dụng mã giảm giá (mẫu)
        function applyCoupon() {
            const code = document.getElementById('coupon-code').value;
            if (code === 'GSSHOP2025') {
                alert('Áp dụng mã giảm giá thành công! Giảm 10% tổng hóa đơn.');
            } else {
                alert('Mã giảm giá không hợp lệ.');
            }
        }

        // Ước tính phí vận chuyển (mẫu)
        function estimateShipping() {
            alert('Phí vận chuyển: Miễn phí cho tất cả đơn hàng!');
        }

        // Cập nhật giỏ hàng
        function updateCart() {
            window.location.reload();
            alert('Giỏ hàng đã được cập nhật!');
        }
    </script>
</body>
</html>