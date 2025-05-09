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

<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning d-flex align-items-center">
            <h4 class="mb-0 fw-bold">Chỉnh sửa sản phẩm</h4>
            <a href="product" class="btn btn-light btn-sm ms-auto"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>
        <div class="card-body p-4">
            <form action="edit" method="POST" enctype="multipart/form-data" id="productForm">
                <input type="hidden" name="ProductID" value="<?= htmlspecialchars($product['id']) ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="name" class="form-label fw-bold">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Nhập tên sản phẩm" value="<?= htmlspecialchars($product['name']) ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="price" class="form-label fw-bold">Giá (VNĐ) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="price" name="price" required placeholder="Nhập giá sản phẩm" value="<?= number_format($product['price'], 0, ',', '.') ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="description" class="form-label fw-bold">Mô tả sản phẩm</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Nhập mô tả sản phẩm"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                </div>
                <div class="form-group mblim4">
                    <label for="image" class="form-label fw-bold">Hình ảnh</label>
                    <div class="custom-file">
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Chọn file ảnh định dạng PNG, JPG hoặc JPEG (Tối đa 5MB). Để trống nếu không muốn thay đổi ảnh.</small>
                    </div>
                    <div id="imagePreview" class="mt-2">
                        <?php if ($product['image']) : ?>
                            <img src="<?= htmlspecialchars($assets . $product['image']) ?>" style="max-width: 200px; max-height: 200px; object-fit: cover; border-radius: 5px;" alt="Hình sản phẩm hiện tại">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Cập nhật sản phẩm</button>
                    <a href="product" class="btn btn-outline-secondary px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 8px;
}
.card-header {
    background-color: #fff3cd;
    border-bottom: 2px solid #ffca2c;
}
.card-header h4 {
    font-size: 1.8rem;
    color: #000;
    text-transform: uppercase;
}
.btn-primary {
    transition: background-color 0.3s ease;
}
.btn-primary:hover {
    background-color: #0056b3;
}
.btn-light {
    display: flex;
    align-items: center;
    gap: 5px;
}
.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
}
#imagePreview img {
    max-width: 200px;
    max-height: 200px;
    object-fit: cover;
    border-radius: 5px;
    margin-top: 10px;
}
</style>

<script>
// Format price input
document.getElementById('price').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value) {
        value = parseInt(value).toLocaleString('vi-VN');
        e.target.value = value;
    } else {
        e.target.value = '';
    }
});

// Image preview
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

// Form validation
document.getElementById('productForm').addEventListener('submit', function(e) {
    const form = this;
    if (!form.checkValidity()) {
        e.preventDefault();
        form.classList.add('was-validated');
    }
});
</script>

<?php
include_once './App/Views/Layout/footer.php';
?>