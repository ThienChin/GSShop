<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Đặt section
$section = 'create';

// Debug
// var_dump($section, $product); exit;

include_once __DIR__ . '/../Layout/Adminheader.php';
?>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <div class="logo-header" data-background-color="dark">
                    <a href="<?= $baseURL ?>home/index" class="logo">
                        <img
                            src="<?= $base ?>assets/images/home/logo.png"
                            alt="navbar brand"
                            class="navbar-brand"
                            height="100"
                            width="200"
                        />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                        <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
                    </div>
                    <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
                </div>
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item <?= $section === 'home' ? 'active' : '' ?>">
                            <a href="<?= $baseURL ?>admin/dashboard"><i class="fas fa-home"></i><p>Dashboard</p></a>
                        </li>
                        <li class="nav-item <?= $section === 'products' ? 'active' : '' ?>">
                            <a href="<?= $baseURL ?>admin/product"><i class="fas fa-list"></i><p>Danh sách sản phẩm</p></a>
                        </li>
                        <li class="nav-item <?= $section === 'create' ? 'active' : '' ?>">
                            <a href="<?= $baseURL ?>admin/create"><i class="fas fa-plus"></i><p>Thêm sản phẩm</p></a>
                        </li>
                        <li class="nav-item <?= $section === 'users' ? 'active' : '' ?>">
                            <a href="<?= $baseURL ?>admin/user"><i class="fas fa-users"></i><p>Người dùng</p></a>
                        </li>
                        <li class="nav-item <?= $section === 'orders' ? 'active' : '' ?>">
                            <a href="<?= $baseURL ?>admin/orders"><i class="fas fa-shopping-cart"></i><p>Đơn hàng</p></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="dark">
                        <a href="<?= $baseURL ?>home/index" class="logo">
                        <img
                            src="<?= $base ?>assets/images/home/logo.png"
                            alt="navbar brand"
                            class="navbar-brand"
                            height="100"
                            width="200"
                        />
                    </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                            <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
                        </div>
                        <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
                    </div>
                </div>
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1"><i class="fa fa-search search-icon"></i></button>
                                </div>
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div>
                        </nav>
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="<?= $base ?>assets/admin/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold"><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="<?= $base ?>assets/admin/img/profile.jpg" alt="image profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></h4>
                                                    <p class="text-muted"><?= htmlspecialchars($_SESSION['email'] ?? 'admin@example.com') ?></p>
                                                    <a href="#" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">My Profile</a>
                                            <a class="dropdown-item" href="#">Account Setting</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="<?= $baseURL ?>user/logout">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="card shadow-lg border-0 mt-5">
                        <div class="card-header bg-warning d-flex align-items-center">
                            <h4 class="mb-0 fw-bold">Chỉnh sửa sản phẩm</h4>
                            <a href="<?= $baseURL ?>admin/product" class="btn btn-light btn-sm ms-auto"><i class="fas fa-arrow-left"></i> Quay lại</a>
                        </div>
                        <div class="card-body p-4">
                            <form action="<?= $baseURL ?>admin/create" method="POST" enctype="multipart/form-data" id="productForm">
                                <input type="hidden" name="ProductID" value="<?= htmlspecialchars($product['id'] ?? '') ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="name" class="form-label fw-bold">Tên sản phẩm <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" required placeholder="Nhập tên sản phẩm" value="<?= htmlspecialchars($product['name'] ?? '') ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="price" class="form-label fw-bold">Giá (VNĐ) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="price" name="price" required placeholder="Nhập giá sản phẩm" value="<?= isset($product['price']) ? number_format($product['price'], 0, ',', '.') : '' ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="description" class="form-label fw-bold">Mô tả sản phẩm</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Nhập mô tả sản phẩm"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="image" class="form-label fw-bold">Hình ảnh</label>
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        <small class="form-text text-muted">Chọn file ảnh định dạng PNG, JPG hoặc JPEG (Tối đa 5MB). Để trống nếu không muốn thay đổi ảnh.</small>
                                    </div>
                                    <div id="imagePreview" class="mt-2">
                                        <?php if (!empty($product['image'])): ?>
                                            <img src="<?= htmlspecialchars($assets . $product['image']) ?>" style="max-width: 200px; max-height: 200px; object-fit: cover; border-radius: 5px;" alt="Hình sản phẩm hiện tại">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary px-4">Cập nhật sản phẩm</button>
                                    <a href="<?= $baseURL ?>admin/product" class="btn btn-outline-secondary px-4">Hủy</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item"><a class="nav-link" href="http://www.themekita.com">ThemeKita</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Licenses</a></li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        2024, made with <i class="fa fa-heart heart text-danger"></i> by
                        <a href="http://www.themekita.com">ThemeKita</a>
                    </div>
                    <div>
                        Distributed by <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="<?= $base ?>assets/admin/js/core/jquery-3.7.1.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/core/popper.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/core/bootstrap.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/kaiadmin.min.js"></script>
    <script src="<?= $base ?>assets/admin/js/setting-demo.js"></script>
    <script src="<?= $base ?>assets/admin/js/demo.js"></script>

    <script>
    //Format price input
    document.getElementById('price').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');Add commentMore actions
        if (value) {
            value = parseInt(value).toLocaleString('vi-VN');
            e.target.value = value;
        } else {
            e.target.value = '';
        }
    });

    document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    if (e.target.files && e.target.files[0]) {
        const file = e.target.files[0];
        if (file.size > 5 * 1024 * 1024) {
            alert('Kích thước file ảnh không được vượt quá 5MB');
                e.target.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '200px';
                img.style.maxHeight = '200px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '5px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('productForm').addEventListener('submit', function(e) {
        const form = this;
        if (!form.checkValidity()) {
            e.preventDefault();
            form.classList.add('was-validated');
        }
    });
    </script>
</body>
</html>

<style>
.card { border-radius: 8px; }
.card-header { background-color: #fff3cd; border-bottom: 2px solid #ffca2c; }
.card-header h4 { font-size: 1.8rem; color: #000; text-transform: uppercase; }
.btn-primary { transition: background-color 0.3s ease; }
.btn-primary:hover { background-color: #0056b3; }
.btn-light { display: flex; align-items: center; gap: 5px; }
.form-control:focus { border-color: #007bff; box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25); }
#imagePreview img { max-width: 200px; max-height: 200px; object-fit: cover; border-radius: 5px; margin-top: 10px; }
</style>