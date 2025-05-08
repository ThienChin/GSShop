<?php
// File: user.php
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
            <h4 class="mb-0 fw-bold">Danh sách người dùng</h4>
            <a href="index" class="btn btn-light btn-sm ms-auto"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>
        <div class="card-body p-4">
            <table class="table table-hover">
                <thead>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Tên đăng nhập</th>
                        <th>Số điện thoại</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userList as $user) : ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['fullname']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['phone']) ?></td>
                            <td>
                                <form action="deleteUser" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc muốn xóa người dùng này?');">
                                    <input type="hidden" name="UserID" value="<?= htmlspecialchars($user['id']) ?>" />
                                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa người dùng">
                                        <i class="fa-solid fa-trash"></i>
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
    background-color: #fff3cd; /* Màu vàng nhạt như create.php */
    border-bottom: 2px solid #ffca2c; /* Viền dưới để nhấn mạnh */
}
.card-header h4 {
    font-size: 1.8rem; /* Tăng kích thước tiêu đề */
    color: #000;
    text-transform: uppercase; /* Chữ in hoa cho nổi bật */
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
    gap: 5px; /* Khoảng cách giữa icon và chữ */
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