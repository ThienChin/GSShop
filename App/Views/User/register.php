<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

// Hiển thị thông báo lỗi hoặc thành công nếu có
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$success = isset($_SESSION['success']) ? $_SESSION['success'] : '';
unset($_SESSION['error']);
unset($_SESSION['success']);

include_once './App/Views/Layout/UserHeader.php'
?>


    <section id="form">
      <div class="form-container">
        <div class="signup-form" id="signup-form-container">
          <?php if ($error): ?>
            <div class="error-message" style="display: block; color: red; text-align: center;">
              <?= htmlspecialchars($error) ?>
            </div>
          <?php endif; ?>
          <?php if ($success): ?>
            <div class="success-message" style="display: block; color: green; text-align: center;">
              <?= htmlspecialchars($success) ?>
            </div>
          <?php endif; ?>
          <div class="social-login">
            <a href="#" onclick="socialLogin('google')"
              ><img
                src="https://img.icons8.com/color/20/000000/google-logo.png"
                alt="Google"
              />Google</a
            >
            <a href="#" onclick="socialLogin('zalo')"
              ><img
                src="https://img.icons8.com/color/20/000000/zalo.png"
                alt="Zalo"
              />Zalo</a
            >
          </div>
          <div class="divider"><span>hoặc</span></div>
          <form id="signup-form" action="<?= $baseURL ?>user/register" method="POST">
            <div class="form-group">
              <label for="signup-name">Họ và tên</label>
              <input
                type="text"
                placeholder="Họ và tên"
                required
                id="signup-name"
                name="name"
              />
              <div class="error-message" id="signup-name-error"></div>
            </div>
            <div class="form-group">
              <label for="signup-username">Tên đăng nhập</label>
              <input
                type="text"
                placeholder="Tên đăng nhập"
                required
                id="signup-username"
                name="username"
              />
              <div class="error-message" id="signup-username-error"></div>
            </div>
            <div class="form-group">
              <label for="signup-phone">Số điện thoại</label>
              <input
                type="tel"
                placeholder="Số điện thoại"
                required
                id="signup-phone"
                name="phone"
              />
              <div class="error-message" id="signup-phone-error"></div>
            </div>
            <div class="form-group">
              <label for="signup-password">Mật khẩu</label>
              <div class="password-container">
                <input
                  type="password"
                  placeholder="Mật khẩu (ít nhất 8 ký tự)"
                  required
                  id="signup-password"
                  name="password"
                />
                <span class="toggle-password" onclick="togglePassword('signup-password')">
                  <i class="fa fa-eye"></i>
                  <i class="fa fa-eye-slash"></i>
                </span>
              </div>
              <div class="error-message" id="signup-password-error"></div>
            </div>
            <div class="form-group">
              <label for="signup-confirm-password">Xác nhận mật khẩu</label>
              <div class="password-container">
                <input
                  type="password"
                  placeholder="Xác nhận mật khẩu"
                  required
                  id="signup-confirm-password"
                  name="confirm-password"
                />
                <span class="toggle-password" onclick="togglePassword('signup-confirm-password')">
                  <i class="fa fa-eye"></i>
                  <i class="fa fa-eye-slash"></i>
                </span>
              </div>
              <div class="error-message" id="signup-confirm-password-error"></div>
            </div>
            <button type="submit" class="btn-login">Đăng ký</button>
          </form>
          <p class="login-link">
            Đã có tài khoản? <a href="<?= $baseURL ?>user/login">Đăng nhập ngay</a>
          </p>
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

    <script src="<?= $base ?>assets/js/jquery.js"></script>
    <script src="<?= $base ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= $base ?>assets/js/jquery.scrollUp.min.js"></script>
    <script src="<?= $base ?>assets/js/jquery.prettyPhoto.js"></script>
    <script src="<?= $base ?>assets/js/main.js"></script>
    <script>
      // Kiểm tra định dạng số điện thoại
      function validatePhone(phone) {
        const re = /^[0-9]{10,11}$/;
        return re.test(phone);
      }

      // Kiểm tra định dạng tên đăng nhập
      function validateUsername(username) {
        const re = /^[a-zA-Z0-9_]{3,20}$/;
        return re.test(username);
      }

      // Kiểm tra độ mạnh mật khẩu
      function validatePassword(password) {
        const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        return re.test(password);
      }

      // Xóa thông báo lỗi
      function clearErrors() {
        document.querySelectorAll(".error-message").forEach((el) => {
          el.style.display = "none";
          el.textContent = "";
        });
      }

      // Xử lý hiển thị/ẩn mật khẩu
      function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const toggle = input.parentElement.querySelector('.toggle-password');
        if (input.type === 'password') {
          input.type = 'text';
          toggle.classList.add('show');
        } else {
          input.type = 'password';
          toggle.classList.remove('show');
        }
      }

      // Xử lý đăng ký
      document
        .getElementById("signup-form")
        .addEventListener("submit", function (event) {
          event.preventDefault();
          clearErrors();
          const name = document.getElementById("signup-name").value;
          const username = document.getElementById("signup-username").value;
          const phone = document.getElementById("signup-phone").value;
          const password = document.getElementById("signup-password").value;
          const confirmPassword = document.getElementById(
            "signup-confirm-password"
          ).value;
          let hasError = false;

          if (!name) {
            document.getElementById("signup-name-error").textContent =
              "Vui lòng nhập họ và tên.";
            document.getElementById("signup-name-error").style.display = "block";
            hasError = true;
          }

          if (!validateUsername(username)) {
            document.getElementById("signup-username-error").textContent =
              "Tên đăng nhập phải có 3-20 ký tự, chỉ chứa chữ, số hoặc _.";
            document.getElementById("signup-username-error").style.display = "block";
            hasError = true;
          }

          if (!validatePhone(phone)) {
            document.getElementById("signup-phone-error").textContent =
              "Vui lòng nhập số điện thoại hợp lệ (10-11 số).";
            document.getElementById("signup-phone-error").style.display = "block";
            hasError = true;
          }

          if (!validatePassword(password)) {
            document.getElementById("signup-password-error").textContent =
              "Mật khẩu phải có ít nhất 8 ký tự, gồm chữ hoa, chữ thường và số.";
            document.getElementById("signup-password-error").style.display = "block";
            hasError = true;
          }

          if (password !== confirmPassword) {
            document.getElementById("signup-confirm-password-error").textContent =
              "Mật khẩu xác nhận không khớp.";
            document.getElementById("signup-confirm-password-error").style.display =
              "block";
            hasError = true;
          }

          if (!hasError) {
            this.submit(); // Gửi form đến UserController
          }
        });

      // Xử lý đăng nhập mạng xã hội
      function socialLogin(provider) {
        alert(
          `Đăng nhập bằng ${
            provider.charAt(0).toUpperCase() + provider.slice(1)
          } đang được phát triển.`
        );
      }
    </script>
  </body>
</html>