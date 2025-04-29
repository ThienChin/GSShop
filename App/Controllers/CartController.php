<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class CartController
{
    public function cart()
    {
        require_once './App/Model/ProductModel.php';
        $productModel = new ProductModel();

        $cartItems = [];

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $product = $productModel->getProductById($item['product_id']);
                $product['quantity'] = $item['quantity'];
                $cartItems[] = $product;
            }
        }
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $featuredproduct = $productModel->getFeaturedProductsById($item['product_id']);
                $featuredproduct['quantity'] = $item['quantity'];
                $cartItems[] = $featuredproduct;
            }
        }

        // var_dump($cartItems);
        // die;

        include './App/Views/cart/cart.php';    

    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

            if ($productId > 0) {
                // Khởi tạo giỏ hàng nếu chưa tồn tại
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
                $found = false;
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['product_id'] === $productId) {
                        $item['quantity'] += $quantity;
                        $found = true;
                        break;
                    }
                }

                // Nếu chưa có, thêm mới vào giỏ hàng
                if (!$found) {
                    $_SESSION['cart'][] = [
                        'product_id' => $productId,
                        'quantity' => $quantity
                    ];
                }
            }
        }
        $config = require 'config.php';
            
        $baseURL = $config['baseURL'];

        header('Location:'. $baseURL.'cart/cart');
        exit;
    }
    
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
            $change = isset($_POST['change']) ? (int)$_POST['change'] : 0;

            if ($productId > 0 && isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['product_id'] === $productId) {
                        $item['quantity'] = max(1, $item['quantity'] + $change);
                        break;
                    }
                }
            }

            echo json_encode(['status' => 'success']);
            exit;
        }
    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

            if ($productId > 0 && isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) use ($productId) {
                    return $item['product_id'] !== $productId;
                });
            }

            echo json_encode(['status' => 'success']);
            exit;
        }
    }
}
