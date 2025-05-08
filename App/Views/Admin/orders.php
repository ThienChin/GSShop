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
    <div class="card shadow-sm">
        <div class="card-header bg-warning d-flex align-items-center">
            <h4 class="mb-0 fw-bold">Danh Sách Đơn Hàng</h4>
            <a href="<?= $baseURL ?>admin/index" class="btn btn-light btn-sm ms-auto"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Ngày Đặt</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orderList)) : ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">Không có đơn hàng nào.</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($orderList as $item) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['id']) ?></td>
                                    <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($item['order_date']))) ?></td>
                                    <td><?= number_format($item['total'], 0, ',', '.') ?> VNĐ</td>
                                    <td>
                                        <?php
                                        $status = htmlspecialchars($item['status']);
                                        $badgeClass = $status === 'pending' ? 'badge-warning' : ($status === 'completed' ? 'badge-success' : 'badge-danger');
                                        ?>
                                        <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                                    </td>
                                    <td>
                                        <a href="<?= $baseURL ?>admin/orderDetail?id=<?= htmlspecialchars($item['id']) ?>" class="btn btn-sm btn-info" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="<?= $baseURL ?>admin/deleteOrder" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này?');">
                                            <input type="hidden" name="OrderID" value="<?= htmlspecialchars($item['id']) ?>" />
                                            <button type="submit" class="btn btn-sm btn-danger" title="Xóa đơn hàng">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Phân trang -->
            <?php if ($totalPages > 1) : ?>
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php if ($page < $totalPages) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
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
.table-hover tbody tr:hover {
    background-color: #f8f9fa;
}
.badge {
    font-size: 0.9em;
    padding: 0.5em 1em;
}
.badge-warning {
    background-color: #ffc107;
    color: #212529;
}
.badge-success {
    background-color: #28a745;
    color: #fff;
}
.badge-danger {
    background-color: #dc3545;
    color: #fff;
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