<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

// Kết nối cơ sở dữ liệu
try {
    $dbConfig = $config['db'];
    $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['name']};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<div class='container'><h2>Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage() . "</h2></div>";
    exit;
}

// Lấy và phân tích URL từ $_GET['url']
$url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
$urlParts = explode('/', $url);
$product_id = 0;

// Kiểm tra nếu URL có dạng product/detail/{id} và id là số
if (count($urlParts) >= 3 && $urlParts[0] === 'product' && $urlParts[1] === 'detail' && is_numeric($urlParts[2])) {
    $product_id = (int)$urlParts[2];
}

if ($product_id <= 0) {
    echo "<div class='container'><h2>ID sản phẩm không hợp lệ. Giá trị nhận được: $product_id</h2></div>";
    exit;
}

// Lấy thông tin sản phẩm chi tiết
try {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute(['id' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        echo "<div class='container'><h2>Sản phẩm không tồn tại (ID: $product_id).</h2></div>";
        exit;
    }
} catch (PDOException $e) {
    echo "<div class='container'><h2>Lỗi truy vấn sản phẩm: " . $e->getMessage() . "</h2></div>";
    exit;
}

// Giải mã thông số kỹ thuật nếu có (giả định specifications là JSON)
$specifications = isset($product['specifications']) ? json_decode($product['specifications'], true) : [];

// Lấy danh sách sản phẩm đề xuất (3 sản phẩm cùng danh mục, trừ sản phẩm hiện tại)
try {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category = :category AND id != :id LIMIT 3");
    $stmt->execute(['category' => $product['category'], 'id' => $product_id]);
    $recommendedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $recommendedProducts = [];
}

include_once './App/Views/Layout/Homeheader.php';
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
                                            <li><a href="<?= $baseURL ?>product/index?category=laptop_gaming">Laptop Gaming</a></li>
                                            <li><a href="<?= $baseURL ?>product/index?category=laptop_van_phong">Laptop Văn phòng</a></li>
                                            <li><a href="<?= $baseURL ?>product/index?category=ultrabook">Ultrabook</a></li>
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
                                            <li><a href="<?= $baseURL ?>product/index?category=pc_gaming">PC Gaming</a></li>
                                            <li><a href="<?= $baseURL ?>product/index?category=pc_do_hoa">PC Đồ họa</a></li>
                                            <li><a href="<?= $baseURL ?>product/index?category=pc_van_phong">PC Văn phòng</a></li>
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
                                            <li><a href="<?= $baseURL ?>product/index?category=tai_nghe">Tai nghe</a></li>
                                            <li><a href="<?= $baseURL ?>product/index?category=ban_phim">Bàn phím</a></li>
                                            <li><a href="<?= $baseURL ?>product/index?category=chuot">Chuột</a></li>
                                            <li><a href="<?= $baseURL ?>product/index?category=man_hinh">Màn hình</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="brands_products">
                            <h2>Thương hiệu</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="<?= $baseURL ?>product/index?brand=Dell"><span class="pull-right">(50)</span>Dell</a></li>
                                    <li><a href="<?= $baseURL ?>product/index?brand=HP"><span class="pull-right">(30)</span>HP</a></li>
                                    <li><a href="<?= $baseURL ?>product/index?brand=ASUS"><span class="pull-right">(20)</span>ASUS</a></li>
                                    <li><a href="<?= $baseURL ?>product/index?brand=Logitech"><span class="pull-right">(15)</span>Logitech</a></li>
                                    <li><a href="<?= $baseURL ?>product/index?brand=Lenovo"><span class="pull-right">(10)</span>Lenovo</a></li>
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
                        <div class="product-details-row">
                            <div class="col-sm-5">
                                <div class="view-product">
                                    <img src="<?= $assets . $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image" />
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="product-information">
                                    <h2><?= htmlspecialchars($product['name']) ?></h2>
                                    <p>Web ID: <?= $product['id'] ?></p>
                                    <span class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        (5/5)
                                    </span>
                                    <span>
                                        <span><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</span>
                                        <label>Số lượng:</label>
                                        <input type="number" name="quantity" value="1" min="1" max="<?= $product['stock'] ?>" style="width: 60px;" />
                                        <form action="<?= $baseURL ?>cart/add" method="post" style="display: inline;">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                                            <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-primary cart" <?= ($product['stock'] <= 0) ? 'disabled' : '' ?>>
                                                <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                            </button>
                                        </form>
                                        <form action="<?= $baseURL ?>cart/checkout" method="post" style="display: inline;">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                                            <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-success" <?= ($product['stock'] <= 0) ? 'disabled' : '' ?>>
                                                Mua ngay
                                            </button>
                                        </form>
                                    </span>
                                    <p><b>Tình trạng:</b> <?= ($product['stock'] > 0) ? 'Còn hàng' : 'Hết hàng' ?></p>
                                    <p><b>Thương hiệu:</b> <?= isset($product['brand']) ? htmlspecialchars($product['brand']) : 'Không xác định' ?></p>
                                    <p><b>Thông số kỹ thuật:</b></p>
                                    <ul>
                                        <?php if (!empty($specifications) && is_array($specifications)): ?>
                                            <?php foreach ($specifications as $key => $value): ?>
                                                <li><strong><?= htmlspecialchars($key) ?>:</strong> <?= htmlspecialchars($value) ?></li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li>Không có thông tin chi tiết.</li>
                                        <?php endif; ?>
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
                                    <p><?= isset($product['description']) ? htmlspecialchars($product['description']) : 'Không có mô tả chi tiết.' ?></p>
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
                        
                        <?php if (!empty($recommendedProducts)): ?>
                            <div class="recommended-products">
                                <div class="recommended-products-row">
                                    <?php foreach ($recommendedProducts as $recProduct): ?>
                                        <div class="recommended-product">
                                            <a href="<?= $baseURL ?>product/detail/<?= $recProduct['id'] ?>">
                                                <img src="<?= $assets . $recProduct['image'] ?>" alt="<?= htmlspecialchars($recProduct['name']) ?>" class="product-image" />
                                                <h4><?= htmlspecialchars($recProduct['name']) ?></h4>
                                                <p><?= number_format($recProduct['price'], 0, ',', '.') ?> VNĐ</p>
                                            </a>
                                            <form action="<?= $baseURL ?>cart/add" method="post">
                                                <input type="hidden" name="product_id" value="<?= $recProduct['id'] ?>">
                                                <input type="hidden" name="product_name" value="<?= $recProduct['name'] ?>">
                                                <input type="hidden" name="product_price" value="<?= $recProduct['price'] ?>">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-default add-to-cart" <?= ($recProduct['stock'] <= 0) ? 'disabled' : '' ?>>
                                                    <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                                </button>
                                            </form>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
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