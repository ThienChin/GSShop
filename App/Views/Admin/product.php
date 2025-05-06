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

<div class="panel panel-default">
    <div class="panel-heading">
        Danh sách sản phẩm
    </div>
    <div class="panel-body">
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
                        <td><img class="card-img-top" src="<?= htmlspecialchars($assets . $item['image']) ?>" style="max-width: 100px;" alt="Hình sản phẩm" /></td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</td>
                        <td>
                            <form action="delete" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                <input type="hidden" name="ProductID" value="<?= htmlspecialchars($item['id']) ?>" />
                                <button type="submit" style="border: none; background: none; cursor: pointer; font-size: 16px; padding: 5px;" title="Xóa sản phẩm">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                    <span class="trash-icon" style="display: none;"></span>
                                </button>
                            </form>
                        </td>
                        <td>?</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Phân trang -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($page > 1) : ?>
                    <li><a href="?page=<?= $page - 1 ?>" aria-label="Previous">«</a></li>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="<?= $i === $page ? 'active' : '' ?>">
                        <a href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                
                <?php if ($page < $totalPages) : ?>
                    <li><a href="?page=<?= $page + 1 ?>" aria-label="Next">»</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<?php
include_once './App/Views/Layout/footer.php';
?>