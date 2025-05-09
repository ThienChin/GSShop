<?php

require_once __DIR__ . '/../Model/ProductModel.php';
require_once __DIR__ . '/../Model/UserModel.php';
require_once __DIR__ . '/../Model/OrderModel.php';
require_once __DIR__ . '/../Model/ChartModel.php';

class AdminController
{
    public function index()
    {
        $productModel = new ProductModel();
        $userModel = new UserModel();
        $orderModel = new OrderModel();
        $chartModel = new ChartModel();
        
        // Lấy số liệu thống kê
        $totalProducts = $productModel->getTotalProducts();
        $totalUsers = $userModel->getTotalUsers();
        $totalOrders = $orderModel->getTotalOrders();
        $totalRevenue = $orderModel->getTotalRevenue();
        $earnings = $chartModel->getEarningsPerMonth();
        $orderStatusCounts = $chartModel->getOrderStatusCounts();
        $topProducts = $chartModel->getTopProducts();
        
        // Lấy thống kê đơn hàng 7 ngày gần nhất
        $recentOrderStats = $orderModel->getRecentOrderStats();
        
        include __DIR__ . '/../Views/Admin/dashboard.php';
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
                // Hiển thị lỗi nếu giá không hợp lệ
                echo "<div class='alert alert-danger'>Giá sản phẩm không hợp lệ!</div>";
                include __DIR__ . '/../Views/Admin/create.php';
                return;
            }
            
            // Xử lý upload hình ảnh
            if (!empty($image)) {
                $target_dir = __DIR__ . '/../../assets/uploads/';
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }
                $target_file = $target_dir . basename($image);
                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                $image = '/uploads/' . $image;
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
        header('Location: ' . $baseURL . 'admin/user');
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
        header('Location: ' . $baseURL . 'admin/orders');
        exit;
    }

    public function orderDetail()
    {
        $orderId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $orderModel = new OrderModel();
        $order = $orderModel->getOrderById($orderId);
        
        if (!$order) {
            // Xử lý trường hợp không tìm thấy đơn hàng
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
                $image = '/uploads/' . $image;
            } else {
                $image = null; // Không cập nhật ảnh nếu không upload
            }
            
            // Cập nhật sản phẩm
            $productModel->updateProduct($productId, $name, $price, $image, $description);
            
            // Chuyển hướng về danh sách sản phẩm
            $config = require 'config.php';
            $baseURL = $config['baseURL'];
            header('Location: ' . $baseURL . 'admin/product');
            exit;
        }
        
        // Nếu không có ProductID, quay lại danh sách sản phẩm
        $config = require 'config.php';
        $baseURL = $config['baseURL'];
        header('Location: ' . $baseURL . 'admin/product');
        exit;
    }
}
?>