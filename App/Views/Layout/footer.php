<?php
?>
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
                <img src="../assets/images/home/map.png" alt="Bản đồ GSShop" />
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
            <p class="pull-right">Designed by GSShop Team</p>
          </div>
        </div>
      </div>
    </footer>

    <script
      data-cfasync="false"
      src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="<?= $base ?>assets/js/jquery.js"></script>
    <script src="<?= $base ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= $base ?>assets/js/jquery.scrollUp.min.js"></script>
    <script src="<?= $base ?>assets/js/price-range.js"></script>
    <script src="<?= $base ?>assets/js/jquery.prettyPhoto.js"></script>
    <script src="<?= $base ?>assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
      <script>
      // Kiểm tra trạng thái đăng nhập và cập nhật menu
      document.addEventListener('DOMContentLoaded', function () {
        const username = "<?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '' ?>";
        if (username) {
          const menu = document.querySelector(".shop-menu ul");
          if (menu) {
            const loginLink = menu.querySelector('a[href="<?= $baseURL ?>user/login"]');
            if (loginLink) {
              loginLink.innerHTML = `<i class="fa fa-user"></i> ${username}`;
              loginLink.href = "#";
              loginLink.onclick = function () {
                window.location.href = "<?= $baseURL ?>user/logout";
              };
            }
          }
        }
      });
    </script>
  </body>
</html>