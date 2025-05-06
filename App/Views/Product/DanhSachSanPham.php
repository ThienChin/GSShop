<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Chỉ khởi động session nếu chưa có session nào chạy
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

// Số sản phẩm mỗi trang
$productsPerPage = 9;

// Lấy trang hiện tại từ URL, mặc định là 1 nếu không có
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

// Lấy danh mục từ URL (nếu có), mặc định là null
$category = isset($_GET['category']) ? $_GET['category'] : null;

// Lấy thương hiệu từ URL (nếu có), mặc định là null
$brand = isset($_GET['brand']) ? $_GET['brand'] : null;

// Lọc sản phẩm theo danh mục nếu có
$filteredProducts = $productList;
if ($category) {
    $filteredProducts = array_filter($filteredProducts, function($product) use ($category) {
        return isset($product['category']) && $product['category'] === $category;
    });
}

// Lọc sản phẩm theo thương hiệu nếu có
if ($brand) {
    $filteredProducts = array_filter($filteredProducts, function($product) use ($brand) {
        return stripos($product['name'], $brand) !== false;
    });
}

// Tính tổng số trang
$totalProducts = count($filteredProducts); // Số lượng sản phẩm sau khi lọc
$totalPages = ceil($totalProducts / $productsPerPage);

// Đảm bảo trang hiện tại không vượt quá số trang tối đa
if ($currentPage > $totalPages) $currentPage = $totalPages;

// Tính offset để lấy đúng sản phẩm cho trang hiện tại
$offset = ($currentPage - 1) * $productsPerPage;

// Lấy danh sách sản phẩm cho trang hiện tại
$productList = array_slice($filteredProducts, $offset, $productsPerPage);


include_once './App/Views/Layout/Homeheader.php';

?>

    <section id="advertisement">
      <div class="container" style="text-align: center">
        <img
          src="images/home/shipping.jpg"
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
                    <li>
                      <a href="<?= $baseURL ?>product/index?brand=Dell"><span class="pull-right"></span>Dell</a>
                    </li>
                    <li>
                      <a href="<?= $baseURL ?>product/index?brand=HP"><span class="pull-right"></span>HP</a>
                    </li>
                    <li>
                      <a href="<?= $baseURL ?>product/index?brand=ASUS"><span class="pull-right"></span>ASUS</a>
                    </li>
                    <li>
                      <a href="<?= $baseURL ?>product/index?brand=Logitech">
                        <span class="pull-right"></span>Logitech</a
                      >
                    </li>
                    <li>
                      <a href="<?= $baseURL ?>product/index?brand=Lenovo"><span class="pull-right"></span>Lenovo</a>
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
              <div class="row"><!-- row để Bootstrap xếp ngang -->
                <?php foreach ($productList as $product): ?>
                  <div class="col-6 col-sm-4 mb-4"><!-- mỗi sản phẩm 1 cột -->
                    <div class="product-image-wrapper">
                      <div class="single-products">
                        <div class="productinfo text-center">
                          <img
                            class="card-img-top"
                            src="<?= $assets. $product['image'] ?>"
                            alt="<?= $assets. $product['name'] ?>"
                          />
                          <h2><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</h2>
                          <p><?= htmlspecialchars($product['name']) ?></p>

                          <!-- 2. Dùng form POST cho Add to Cart -->
                          <form action="<?= $baseURL ?>cart/add" method="post">
                              <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                              <input type="hidden" name="quantity" value="1">
                              <button type="submit" class="btn btn-default add-to-cart">
                                  <i class="fa fa-shopping-cart"></i> Thêm vào giỏ
                              </button>
                          </form>
                        </div>
                        <div class="product-overlay">
                          <div class="overlay-content">
                            <h2><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</h2>
                            <p><?= $product['name'] ?></p>
                            <!-- Nếu vẫn muốn overlay thêm -->
                            <form action="<?= $baseURL .'cart/add' ?>" method="post">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                                <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-default add-to-cart">
                                    <i class="fa fa-shopping-cart"></i> Thêm vào giỏ
                                </button>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                          <li><a href="#"><i class="fa fa-plus-square"></i> Yêu thích</a></li>
                          <li><a href="<?= $baseURL ?>product/detail/<?= $product['id'] ?>"><i class="fa fa-plus-square"></i> Xem chi tiết</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

              <ul class="pagination">
                <?php
                // Nút Previous
                if ($currentPage > 1) {
                    echo '<li><a href="' . $baseURL . 'product/index?page=' . ($currentPage - 1) . ($category ? '&category=' . $category : '') . ($brand ? '&brand=' . $brand : '') . '"><i class="fa fa-angle-double-left"></i></a></li>';
                } else {
                    echo '<li class="disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>';
                }

                // Tạo các liên kết số trang
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $currentPage) {
                        echo '<li class="active"><a href="#">' . $i . '</a></li>';
                    } else {
                        echo '<li><a href="' . $baseURL . 'product/index?page=' . $i . ($category ? '&category=' . $category : '') . ($brand ? '&brand=' . $brand : '') . '">' . $i . '</a></li>';
                    }
                }

                // Nút Next
                if ($currentPage < $totalPages) {
                    echo '<li><a href="' . $baseURL . 'product/index?page=' . ($currentPage + 1) . ($category ? '&category=' . $category : '') . ($brand ? '&brand=' . $brand : '') . '"><i class="fa fa-angle-double-right"></i></a></li>';
                } else {
                    echo '<li class="disabled"><a href="#"><i class="fa fa-angle-double-right"></i></a></li>';
                }
                ?>
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