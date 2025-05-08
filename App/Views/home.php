<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once 'Layout/header.php';
?>

    <section id="slider">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div
              id="slider-carousel"
              class="carousel slide"
              data-ride="carousel"
            >
              <ol class="carousel-indicators">
                <li
                  data-target="#slider-carousel"
                  data-slide-to="0"
                  class="active"
                ></li>
                <li data-target="#slider-carousel" data-slide-to="1"></li>
                <li data-target="#slider-carousel" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="item active">
                  <div class="col-sm-6">
                    <h1><span>GS</span>-Shop</h1>
                    <h2>Laptop Dell XPS 13</h2>
                    <p>
                      Laptop siêu mỏng nhẹ với màn hình 13.4" 4K, Intel Core i7,
                      16GB RAM, 512GB SSD.
                    </p>
                    <a href="product-details.html" class="btn btn-default get"
                      >Xem ngay</a
                    >
                  </div>
                  <div class="col-sm-6">
                    <img
                      src="<?= $base ?>assets/images/products/dell-xps13.jpg"
                      class="img-responsive"
                      alt="Laptop Dell XPS 13"
                    />
                  </div>
                </div>
                <div class="item">
                  <div class="col-sm-6">
                    <h1><span>GS</span>-Shop</h1>
                    <h2>PC Gaming ASUS ROG</h2>
                    <p>
                      Máy tính chơi game mạnh mẽ với CPU Intel Core i9, GPU RTX
                      3080, 32GB RAM, 1TB SSD.
                    </p>
                    <a href="product-details.html" class="btn btn-default get"
                      >Xem ngay</a
                    >
                  </div>
                  <div class="col-sm-6">
                    <img
                      src="<?= $base ?>assets/images/products/asus-rog-pc.jpg"
                      class="img-responsive"
                      alt="PC Gaming ASUS ROG"
                    />
                  </div>
                </div>
                <div class="item">
                  <div class="col-sm-6">
                    <h1><span>GS</span>-Shop</h1>
                    <h2>Tai nghe Logitech G Pro X</h2>
                    <p>
                      Tai nghe gaming với âm thanh vòm 7.1, micro chất lượng
                      cao, thiết kế thoải mái.
                    </p>
                    <a href="product-details.html" class="btn btn-default get"
                      >Xem ngay</a
                    >
                  </div>
                  <div class="col-sm-6">
                    <img
                      src="<?= $base ?>assets/images/products/logitech-gprox.jpg"
                      class="img-responsive"
                      alt="Tai nghe Logitech G Pro X"
                    />
                  </div>
                </div>
              </div>
              <div
                class="carousel-controls"
                style="
                  display: flex;
                  justify-content: space-between;
                  align-items: center;
                "
              >
                <a
                  href="#slider-carousel"
                  class="left control-carousel hidden-xs"
                  data-slide="prev"
                  style="margin-right: 10px"
                >
                  <i class="fa fa-angle-left"></i>
                </a>
                <a
                  href="#slider-carousel"
                  class="right control-carousel hidden-xs"
                  data-slide="next"
                >
                  <i class="fa fa-angle-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
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