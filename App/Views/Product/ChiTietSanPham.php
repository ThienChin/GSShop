<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Chỉ khởi động session nếu chưa có session nào chạy
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

include_once './App/Views/Layout/header.php';

?>
    
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
                                        <a data-toggle="collapse" data-parent="#accordian" href="#laptops">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
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
                                        <a data-toggle="collapse" data-parent="#accordian" href="#pcs">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
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
                                        <a data-toggle="collapse" data-parent="#accordian" href="#accessories">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
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
                                    <li><a href=""> <span class="pull-right">(50)</span>Dell</a></li>
                                    <li><a href=""> <span class="pull-right">(30)</span>HP</a></li>
                                    <li><a href=""> <span class="pull-right">(20)</span>ASUS</a></li>
                                    <li><a href=""> <span class="pull-right">(15)</span>Logitech</a></li>
                                    <li><a href=""> <span class="pull-right">(10)</span>Lenovo</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="price-range">
                            <h2>Khoảng giá</h2>
                            <div class="well">
                                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="100" data-slider-step="5" data-slider-value="[10,80]" id="sl2"><br />
                                <b>0 triệu</b> <b class="pull-right">100 triệu</b>
                            </div>
                        </div>
                        
                        <div class="shipping text-center">
                            <img src="images/home/shipping.png" alt="Khuyến mãi GSShop" style="height: 250px; width: 250px" />
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    <div class="product-details">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="images/products/dell-xps13.jpg" alt="Laptop Dell XPS 13" />
                                <h3>ZOOM</h3>
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <a href=""><img src="images/products/asus-rog-pc.jpg" alt="PC Gaming ASUS ROG"></a>
                                        <a href=""><img src="images/products/logitech-gprox.jpg" alt="Tai nghe Logitech G Pro X"></a>
                                        <a href=""><img src="images/products/dell-xps13.jpg" alt="Laptop Dell XPS 13"></a>
                                    </div>
                                    <div class="item">
                                        <a href=""><img src="images/products/asus-rog-pc.jpg" alt="PC Gaming ASUS ROG"></a>
                                        <a href=""><img src="images/products/logitech-gprox.jpg" alt="Tai nghe Logitech G Pro X"></a>
                                        <a href=""><img src="images/products/dell-xps13.jpg" alt="Laptop Dell XPS 13"></a>
                                    </div>
                                </div>
                                <a class="left item-control" href="#similar-product" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right item-control" href="#similar-product" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information">
                                <h2>Laptop Dell XPS 13</h2>
                                <p>Web ID: XPS13-2025</p>
                                <span class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    (5/5)
                                </span>
                                <span>
                                    <span>25,000,000 VNĐ</span>
                                    <label>Số lượng:</label>
                                    <input type="number" value="1" min="1" style="width: 60px;" />
                                    <button type="button" class="btn btn-primary cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Thêm vào giỏ hàng
                                    </button>
                                    <button type="button" class="btn btn-success">
                                        Mua ngay
                                    </button>
                                </span>
                                <p><b>Tình trạng:</b> Còn hàng</p>
                                <p><b>Thương hiệu:</b> Dell</p>
                                <p><b>Thông số kỹ thuật:</b></p>
                                <ul>
                                    <li><strong>CPU:</strong> Intel Core i7-1165G7</li>
                                    <li><strong>RAM:</strong> 16GB LPDDR4x</li>
                                    <li><strong>Ổ cứng:</strong> 512GB SSD</li>
                                    <li><strong>Màn hình:</strong> 13.4" 4K Ultra HD+ (3840x2400)</li>
                                    <li><strong>Card đồ họa:</strong> Intel Iris Xe Graphics</li>
                                    <li><strong>Trọng lượng:</strong> 1.2kg</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="category-tab shop-details-tab">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li><a href="#details" data-toggle="tab">Chi tiết</a></li>
                                <li><a href="#reviews" data-toggle="tab" class="active">Đánh giá (5)</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade" id="details">
                                <p>Laptop Dell XPS 13 là lựa chọn hoàn hảo cho công việc và giải trí với thiết kế siêu mỏng nhẹ, hiệu năng mạnh mẽ và màn hình 4K sắc nét. Phù hợp cho dân văn phòng, sinh viên và những ai yêu thích sự tinh tế.</p>
                            </div>
                            <div class="tab-pane fade active in" id="reviews">
                                <div class="col-sm-12">
                                    <ul>
                                        <li><a href=""><i class="fa fa-user"></i>Khách hàng A</a></li>
                                        <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                        <li><a href=""><i class="fa fa-calendar-o"></i>15 APR 2025</a></li>
                                    </ul>
                                    <p>Sản phẩm rất nhẹ, màn hình đẹp, hiệu năng tốt. Rất đáng tiền!</p>
                                    <p><b>Viết đánh giá của bạn</b></p>
                                    <form action="#">
                                        <span>
                                            <input type="text" placeholder="Tên của bạn"/>
                                            <input type="email" placeholder="Địa chỉ email"/>
                                        </span>
                                        <textarea name="" placeholder="Đánh giá của bạn"></textarea>
                                        <b>Đánh giá: </b> 
                                        <span class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <button type="button" class="btn btn-default pull-right">
                                            Gửi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="recommended_items">
                        <h2 class="title text-center">Sản phẩm đề xuất</h2>
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">    
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/products/asus-rog-pc.jpg" alt="PC Gaming ASUS ROG" />
                                                    <h2>35,000,000 VNĐ</h2>
                                                    <p>PC Gaming ASUS ROG</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/products/logitech-gprox.jpg" alt="Tai nghe Logitech G Pro X" />
                                                    <h2>3,500,000 VNĐ</h2>
                                                    <p>Tai nghe Logitech G Pro X</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/products/dell-xps13.jpg" alt="Laptop Dell XPS 13" />
                                                    <h2>25,000,000 VNĐ</h2>
                                                    <p>Laptop Dell XPS 13</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>            
                        </div>
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
    <script src="<?= $base ?>assets/js/price-range.js"></script>
    <script src="<?= $base ?>assets/js/jquery.scrollUp.min.js"></script>
    <script src="<?= $base ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= $base ?>assets/js/jquery.prettyPhoto.js"></script>
    <script src="<?= $base ?>assets/js/main.js"></script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement("script");
                    d.innerHTML = "window.__CF$cv$params={r:'93109c846f54bcdf',t:'MTc0NDc3NDMwMy4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
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
                else if (window.addEventListener) document.addEventListener("DOMContentLoaded", c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        "loading" !== document.readyState && ((document.onreadystatechange = e), c());
                    };
                }
            }
        })();
    </script>
</body>
</html>