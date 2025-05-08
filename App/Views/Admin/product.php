<?php
// File: product.php
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
            <h4 class="mb-0 fw-bold">Danh sách sản phẩm</h4>
            <div class="ms-auto d-flex gap-2">
                <a href="create" class="btn btn-primary btn-sm">Thêm sản phẩm</a>
                <a href="index" class="btn btn-light btn-sm"><i class="fas fa-arrow-left"></i> Quay lại</a>
            </div>
        </div>
        <div class="card-body p-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productList as $item) : ?>
                        <tr>
                            <td><?= htmlspecialchars($item['id']) ?></td>
                            <td><img class="card-img-top" src="<?= htmlspecialchars($assets . $item['image']) ?>" style="max-width: 100px; border-radius: 5px;" alt="Hình sản phẩm" /></td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</td>
                            <td>
                                <form action="delete" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                    <input type="hidden" name="ProductID" value="<?= htmlspecialchars($item['id']) ?>" />
                                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa sản phẩm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="edit" method="GET" style="display: inline;">
                                    <input type="hidden" name="ProductID" value="<?= htmlspecialchars($item['id']) ?>" />
                                    <button type="submit" class="btn btn-sm btn-warning" title="Sửa sản phẩm">
                                        <i class="fa-solid fa-edit"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Phân trang -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1) : ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">«</a></li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages) : ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">»</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 8px;
}
.card-header {
    background-color: #fff3cd; /* Màu vàng nhạt */
    border-bottom: 2px solid #ffca2c; /* Viền dưới */
}
.card-header h4 {
    font-size: 1.8rem;
    color: #000;
    text-transform: uppercase;
}
.table th, .table td {
    vertical-align: middle;
    text-align: center;
}
.table-hover tbody tr:hover {
    background-color: #f1f3f5;
}
.btn-sm {
    padding: 5px 10px;
    font-size: 14px;
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
.pagination .page-link {
    border-radius: 5px;
    margin: 0 3px;
}
.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}
</style>

<?php
include_once './App/Views/Layout/footer.php';
?>