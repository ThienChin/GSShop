<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once 'Layout/Homeheader.php';
?>

<section id="slider">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div id="slider-carousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators (chấm tròn bên dưới) -->
          <ol class="carousel-indicators">
            <?php
            // Lấy 3 sản phẩm đầu tiên từ $featuredProducts
            $carouselProducts = array_slice($featuredProducts, 0, 3);

            // Sắp xếp lại $carouselProducts theo thứ tự id = 2, 3, 5
            $desiredOrder = [2, 3, 8]; // Thứ tự id mong muốn: Apple MacBook, Laptop ASUS Gaming, Tai nghe Logitech
            usort($carouselProducts, function($a, $b) use ($desiredOrder) {
                $posA = array_search($a['id'], $desiredOrder);
                $posB = array_search($b['id'], $desiredOrder);
                return $posA - $posB;
            });

            foreach ($carouselProducts as $index => $product): ?>
              <li data-target="#slider-carousel" data-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></li>
            <?php endforeach; ?>
          </ol>

          <!-- Nội dung carousel -->
          <div class="carousel-inner">
            <?php if (!empty($carouselProducts)): ?>
              <?php foreach ($carouselProducts as $index => $product): ?>
                <div class="item <?= $index === 0 ? 'active' : '' ?>">
                  <div class="col-sm-6">
                    <h1><span>GS</span>-Shop</h1>
                    <h2><?= htmlspecialchars($product['name']) ?></h2>
                    <p><?= htmlspecialchars($product['description'] ?: 'Không có mô tả.') ?></p>
                    <!-- Liên kết động cho nút "Xem ngay" -->
                    <a href="<?= $baseURL ?>product/detail/<?= $product['id'] ?>" class="btn btn-default get">Xem ngay</a>
                  </div>
                  <div class="col-sm-6">
                    <img
                      src="<?= $assets . $product['image'] ?>"
                      class="img-responsive"
                      alt="<?= htmlspecialchars($product['name']) ?>"
                    />
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="item active">
                <div class="col-sm-6">
                  <h1><span>GS</span>-Shop</h1>
                  <h2>Không có sản phẩm</h2>
                  <p>Không có sản phẩm nổi bật để hiển thị.</p>
                </div>
                <div class="col-sm-6">
                  <!-- Thay bằng hình mặc định nếu có -->
                  <img src="<?= $base ?>assets/images/home/default.jpg" class="img-responsive" alt="Không có sản phẩm"/>
                </div>
              </div>
            <?php endif; ?>
          </div>

          <!-- Nút điều hướng (mũi tên trái/phải) -->
          <a class="left carousel-control" href="#slider-carousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#slider-carousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Phần còn lại của trang -->
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
                  <a href="<?= $baseURL ?>product/index?brand=Asus"><span class="pull-right"></span>Asus</a>
                </li>
                <li>
                  <a href="<?= $baseURL ?>product/index?brand=Logitech"><span class="pull-right"></span>Logitech</a>
                </li>
                <li>
                  <a href="<?= $baseURL ?>product/index?brand=Lenovo"><span class="pull-right"></span>Lenovo</a>
                </li>
              </ul>
            </div>
          </div>

          <div class="shipping text-center">
            <img
              src="<?= $base ?>assets/images/home/shipping.png"
              alt="Khuyến mãi GSShop"
              style="height: 250px; width: 250px"
            />
          </div>
        </div>
      </div>

      <div class="col-sm-9 padding-right">
        <?php
          // Giới hạn số sản phẩm, ví dụ chỉ lấy 6 cái đầu
          $displayProducts = array_slice($featuredProducts, 0, 6);
        ?>
        <div class="features_items">
          <h2 class="title text-center">Sản Phẩm Nổi Bật</h2>
          <div class="row">
            <?php foreach ($displayProducts as $product): ?>
              <div class="col-6 col-sm-4 mb-4">
                <div class="product-image-wrapper">
                  <div class="single-products">
                    <div class="productinfo text-center">
                      <img class="card-img-top" src="<?= $assets . $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
                      <h2><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</h2>
                      <p><?= htmlspecialchars($product['name']) ?></p>
                      <form action="<?= $baseURL ?>cart/addfeatured" method="post">
                        <input type="hidden" name="featuredproduct_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="source" value="featured">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-default add-to-cart">
                          <i class="fa fa-shopping-cart"></i> Thêm vào giỏ
                        </button>
                      </form>
                    </div>
                    <div class="product-overlay">
                      <div class="overlay-content">
                        <h2><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</h2>
                        <p><?= htmlspecialchars($product['name']) ?></p>
                        <form action="<?= $baseURL ?>cart/addfeatured" method="post">
                          <input type="hidden" name="featuredproduct_id" value="<?= $product['id'] ?>">
                          <input type="hidden" name="source" value="featured">
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
      </div>
    </div>
  </div>
</section>

<?php
include_once 'Layout/footer.php';
?>