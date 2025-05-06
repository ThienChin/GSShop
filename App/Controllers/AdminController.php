<?php

require_once __DIR__ . '/../Model/ProductModel.php';

class AdminController
{
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
}