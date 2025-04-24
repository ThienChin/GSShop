<!-- search.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Kết quả tìm kiếm</title>
</head>
<body>
<div class="mt-3">
  <?php
    // Danh sách sản phẩm mẫu (giả lập)
    $products = [
      "Laptop Dell XPS 13",
      "MacBook Pro M2",
      "Asus ROG Strix",
      "Lenovo ThinkPad X1",
      "Laptop HP Pavilion",
      "iMac 24 inch",
      "PC Gaming MSI",
    ];

    // Nếu có từ khóa tìm kiếm
    if (isset($_GET['q']) && $_GET['q'] !== '') {
      $query = strtolower($_GET['q']);
      $results = [];

      // Duyệt danh sách sản phẩm để tìm những cái phù hợp
      foreach ($products as $product) {
        if (stripos($product, $query) !== false) {
          $results[] = $product;
        }
      }

      // Hiển thị kết quả nếu có
      if (count($results) > 0) {
        echo '<div class="row">';
        foreach ($results as $item) {
          echo '
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">' . htmlspecialchars($item) . '</h5>
                  <p class="card-text">Mô tả ngắn về sản phẩm này.</p>
                  <a href="#" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                </div>
              </div>
            </div>
          ';
        }
        echo '</div>';
      } else {
        echo "<p>Không tìm thấy sản phẩm phù hợp.</p>";
      }
    }
  ?>
</div>
</body>
</html>
