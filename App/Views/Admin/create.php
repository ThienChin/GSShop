<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];

include_once './App/Views/Layout/Adminheader.php';
?>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Thêm sản phẩm mới</h4>
        </div>
        <div class="card-body">
            <form action="create" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group mb-3">
                    <label for="price" class="form-label">Giá (VNĐ) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Nhập giá sản phẩm">
                </div>
                <div class="form-group mb-4">
                    <label for="image" class="form-label">Hình ảnh <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    <small class="form-text text-muted">Chọn file ảnh định dạng PNG, JPG hoặc JPEG.</small>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Thêm sản phẩm</button>
                    <a href="index" class="btn btn-outline-secondary px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('price').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, ''); // Loại bỏ tất cả ký tự không phải số
    if (value) {
        // Định dạng số với dấu chấm
        value = parseInt(value).toLocaleString('vi-VN', { style: 'decimal' });
    }
    // e.target.value = value;
});
</script>

<?php
include_once './App/Views/Layout/footer.php';
?>