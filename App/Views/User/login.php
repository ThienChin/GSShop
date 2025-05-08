<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);

include_once './App/Views/Layout/UserHeader.php';
?>

<section id="form">
    <div class="form-container">
        <div class="login-form" id="login-form-container">
            <?php if ($error): ?>
                <div class="error-message" style="display: block; color: red; text-align: center;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['message']) && $_GET['message'] === 'please_login_to_checkout'): ?>
                <div class="alert alert-info">
                    Vui lòng đăng nhập để tiếp tục thanh toán!
                </div>
            <?php endif; ?>
            <div class="social-login">
                <a href="#" onclick="socialLogin('google')">
                    <img src="https://img.icons8.com/color/20/000000/google-logo.png" alt="Google" />Google
                </a>
                <a href="#" onclick="socialLogin('zalo')">
                    <img src="https://img.icons8.com/color/20/000000/zalo.png" alt="Zalo" />Zalo
                </a>
            </div>
            <div class="divider"><span>hoặc</span></div>
            <form id="login-form" action="<?= $baseURL ?>user/login" method="POST">
                <input type="hidden" name="redirect" value="<?= isset($_GET['redirect']) ? htmlspecialchars($_GET['redirect']) : $baseURL . 'home/index' ?>">
                <div class="form-group">
                    <label for="login-identifier">Tên đăng nhập hoặc Số điện thoại</label>
                    <input type="text" placeholder="Tên đăng nhập hoặc Số điện thoại" required id="login-identifier" name="identifier" />
                    <div class="error-message" id="login-identifier-error"></div>
                </div>
                <div class="form-group">
                    <label for="login-password">Mật khẩu</label>
                    <div class="password-container">
                        <input type="password" placeholder="Nhập mật khẩu" required id="login-password" name="password" />
                        <span class="toggle-password" onclick="togglePassword('login-password')">
                            <i class="fa fa-eye"></i>
                            <i class="fa fa-eye-slash"></i>
                        </span>
                    </div>
                    <div class="error-message" id="login-password-error"></div>
                </div>
                <div class="checkbox-container">
                    <label class="checkbox-label">
                        <input type="checkbox" id="remember-me" name="remember" />
                        Ghi nhớ
                    </label>
                    <a href="<?= $baseURL ?>user/forgot_password" class="forgot-password">Quên mật khẩu?</a>
                </div>
                <button type="submit" class="btn-login">Đăng nhập</button>
            </form>
            <p class="register-link">
                Chưa có tài khoản? <a href="<?= $baseURL ?>user/register">Đăng ký ngay</a>
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
    function validateIdentifier(identifier) {
        const phoneRe = /^[0-9]{10,11}$/;
        const usernameRe = /^[a-zA-Z0-9_]{3,20}$/;
        return phoneRe.test(identifier) || usernameRe.test(identifier);
    }

    function clearErrors() {
        document.querySelectorAll(".error-message").forEach((el) => {
            el.style.display = "none";
            el.textContent = "";
        });
    }

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

    document.getElementById("login-form").addEventListener("submit", function (event) {
        event.preventDefault();
        clearErrors();
        const identifier = document.getElementById("login-identifier").value;
        const password = document.getElementById("login-password").value;
        let hasError = false;

        if (!validateIdentifier(identifier)) {
            document.getElementById("login-identifier-error").textContent =
                "Vui lòng nhập tên đăng nhập (3-20 ký tự) hoặc số điện thoại (10-11 số).";
            document.getElementById("login-identifier-error").style.display = "block";
            hasError = true;
        }

        if (!password) {
            document.getElementById("login-password-error").textContent =
                "Vui lòng nhập mật khẩu.";
            document.getElementById("login-password-error").style.display = "block";
            hasError = true;
        }

        if (!hasError) {
            this.submit();
        }
    });

    function socialLogin(provider) {
        alert(`Đăng nhập bằng ${provider.charAt(0).toUpperCase() + provider.slice(1)} đang được phát triển.`);
    }

    window.onload = function () {
        const username = "<?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '' ?>";
        if (username) {
            const menu = document.querySelector(".shop-menu ul");
            const loginLink = menu.querySelector('a[href="<?= $baseURL ?>user/login"]');
            loginLink.innerHTML = `<i class="fa fa-user"></i> ${username}`;
            loginLink.href = "#";
            loginLink.onclick = function () {
                window.location.href = "<?= $baseURL ?>user/logout";
            };
        }
    };
</script>
</body>
</html>