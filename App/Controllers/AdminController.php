<?php
require_once __DIR__ . '/../Model/ProductModel.php';
require_once __DIR__ . '/../Model/UserModel.php';
require_once __DIR__ . '/../Model/OrderModel.php';
require_once __DIR__ . '/../Model/ChartModel.php';

class AdminController
{
    public function dashboard()
    {
        $orderModel = new OrderModel();
        $userModel = new UserModel();
        $chartModel = new ChartModel();

        // Lấy tham số time_range từ URL (mặc định: week)
        $timeRange = $_GET['time_range'] ?? 'week';
        if (!in_array($timeRange, ['day', 'week', 'month'])) {
            $timeRange = 'week';
        }

        // Dữ liệu cho dashboard
        $data = [
            'section' => 'home',
            'totalUsers' => $userModel->getTotalUsers(),
            'totalOrders' => $orderModel->getTotalOrders(),
            'totalRevenue' => $orderModel->getTotalRevenue(),
            'earnings' => $chartModel->getEarningsPerMonth(),
            'recentOrderStats' => $orderModel->getRecentOrderStats($timeRange),
            'orderStatusCounts' => $this->formatOrderStatusCounts($orderModel->getOrderStatusCounts()),
            'topProducts' => $chartModel->getTopProducts(5),
            'timeRange' => $timeRange
        ];

        $this->render('dashboard', $data);
    }

    public function product()
    {
        $productModel = new ProductModel();
        
        // Xử lý phân trang
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 15;
        $offset = ($page - 1) * $limit;
        
        $productList = $productModel->getPaginatedProducts($limit, $offset);
        $totalProducts = $productModel->getTotalProducts();
        $totalPages = ceil($totalProducts / $limit);
        
        include __DIR__ . '/../Views/Admin/product.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? '';
            $image = $_FILES['image']['name'] ?? '';
            
            // Loại bỏ dấu chấm trong giá và kiểm tra định dạng
            $price = str_replace('.', '', $price);
            if (!is_numeric($price) || $price < 0) {
                echo "<div class='alert alert-danger'>Giá sản phẩm không hợp lệ!</div>";
                include __DIR__ . '/../Views/Admin/create.php';
                return;
            }
            
            // Xử lý upload hình ảnh (nếu có)
            if (!empty($image)) {
                $target_dir = __DIR__ . '/../../assets/uploads/';
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }
                $target_file = $target_dir . basename($image);
                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                $image = '/Uploads/' . $image;
            } else {
                $image = null;
            }
            
            $productModel = new ProductModel();
            $productModel->insertProduct($name, $price, $image);

            $config = require 'config.php';
            $baseURL = $config['baseURL'];
            header('Location: ' . $baseURL . 'admin/product');
            exit;
        }
        
        include __DIR__ . '/../Views/Admin/create.php';
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ProductID'])) {
            $productId = $_POST['ProductID'];
            $productModel = new ProductModel();
            $productModel->deleteProduct($productId);
        }
        $config = require 'config.php';
            $baseURL = $config['baseURL'];
            header('Location: ' . $baseURL . 'admin/product');
        exit;
    }

    public function user()
    {
        $userModel = new UserModel();
        
        // Xử lý phân trang
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 15;
        $offset = ($page - 1) * $limit;
        
        // Lấy danh sách người dùng với phân trang
        $userList = $userModel->getPaginatedUsers($limit, $offset);
        $totalUsers = $userModel->getTotalUsers();
        $totalPages = ceil($totalUsers / $limit);
        
        include __DIR__ . '/../Views/Admin/user.php';
    }

    public function deleteUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['UserID'])) {
            $userId = $_POST['UserID'];
            $userModel = new UserModel();
            $userModel->deleteUser($userId);
        }
        $config = require 'config.php';
            $baseURL = $config['baseURL'];
            header('Location: ' . $baseURL . 'admin/product');
        exit;
    }

    public function orders()
    {
        $orderModel = new OrderModel();
        
        // Xử lý phân trang
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 15;
        $offset = ($page - 1) * $limit;
        
        $orderList = $orderModel->getPaginatedOrders($limit, $offset);
        $totalOrders = $orderModel->getTotalOrders();
        $totalPages = ceil($totalOrders / $limit);
        
        include __DIR__ . '/../Views/Admin/orders.php';
    }

    public function deleteOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['OrderID'])) {
            $orderId = $_POST['OrderID'];
            $orderModel = new OrderModel();
            $orderModel->deleteOrder($orderId);
        }
        $config = require 'config.php';
            $baseURL = $config['baseURL'];
            header('Location: ' . $baseURL . 'admin/product');
        exit;
    }

    public function orderDetail()
    {
        $orderId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $orderModel = new OrderModel();
        $order = $orderModel->getOrderById($orderId);
        
        if (!$order) {
            echo "<div class='alert alert-danger'>Không tìm thấy đơn hàng!</div>";
            return;
        }
        
        include __DIR__ . '/../Views/Admin/order_detail.php';
    }
 
    public function edit()
    {
        $productModel = new ProductModel();
        
        // Lấy thông tin sản phẩm để hiển thị form
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ProductID'])) {
            $productId = (int)$_GET['ProductID'];
            $product = $productModel->getProductById($productId);
            
            if (!$product) {
                echo "<div class='alert alert-danger'>Không tìm thấy sản phẩm!</div>";
                return;
            }
            
            include __DIR__ . '/../Views/Admin/edit.php';
            return;
        }
        
        // Xử lý cập nhật sản phẩm
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ProductID'])) {
            $productId = (int)$_POST['ProductID'];
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? '';
            $description = $_POST['description'] ?? '';
            $image = $_FILES['image']['name'] ?? '';
            
            // Loại bỏ dấu chấm trong giá và kiểm tra định dạng
            $price = str_replace('.', '', $price);
            if (!is_numeric($price) || $price < 0) {
                echo "<div class='alert alert-danger'>Giá sản phẩm không hợp lệ!</div>";
                $product = $productModel->getProductById($productId);
                include __DIR__ . '/../Views/Admin/edit.php';
                return;
            }
            
            // Xử lý upload hình ảnh (nếu có)
            if (!empty($image)) {
                $target_dir = __DIR__ . '/../../assets/uploads/';
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }
                $target_file = $target_dir . basename($image);
                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                $image = '/Uploads/' . $image;
            } else {
                $image = null;
            }
            
            // Cập nhật sản phẩm
            $productModel->updateProduct($productId, $name, $price, $image, $description);
            
            $config = require 'config.php';
            $baseURL = $config['baseURL'];
            header('Location: ' . $baseURL . 'admin/product');
            exit;
        }
        
        $config = require 'config.php';
            $baseURL = $config['baseURL'];
            header('Location: ' . $baseURL . 'admin/product');
        exit;
    }

    public function updateOrderStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['OrderID'] ?? 0;
            $status = $_POST['status'] ?? '';
            
            try {
                $orderModel = new OrderModel();
                if ($orderModel->updateOrderStatus($orderId, $status)) {
                    $_SESSION['message_type'] = 'success';
                    $_SESSION['message'] = "Cập nhật trạng thái đơn hàng #$orderId thành công.";
                } else {
                    $_SESSION['message_type'] = 'error';
                    $_SESSION['message'] = "Không tìm thấy đơn hàng hoặc không thể cập nhật.";
                }
            } catch (Exception $e) {
                $_SESSION['message_type'] = 'error';
                $_SESSION['message'] = "Lỗi: " . $e->getMessage();
            }
        }
        // Chuyển hướng về trang danh sách đơn hàng hoặc chi tiết
        $redirectUrl = isset($_GET['redirect']) && $_GET['redirect'] === 'detail' 
            ? $this->baseURL . 'orderDetail?id=' . $orderId 
            : $this->baseURL . 'orders';
        header('Location: ' . $redirectUrl);
        exit;
    }

    private function formatOrderStatusCounts($counts)
    {
        $statusMap = [
            'pending' => 'Đặt hàng',
            'completed' => 'Hoàn thành',
            'canceled' => 'Hủy'
        ];
        $formatted = [];
        foreach ($statusMap as $key => $label) {
            $found = array_filter($counts, fn($item) => $item['status'] === $key || $item['status'] === $label);
            $formatted[] = [
                'status' => $label,
                'count' => $found ? reset($found)['count'] : 0
            ];
        }
        return $formatted;
    }

    private function render($view, $data = [])
    {
        extract($data);
        include __DIR__ . '/../Views/Admin/' . $view . '.php';
    }
}
?>