<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class CartController
{
    private $productModel;

    public function __construct()
    {
        require_once './App/Model/ProductModel.php';
        $this->productModel = new ProductModel();
    }

    public function cart()
    {
        $cartItems = [];
        $grandTotal = 0;

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $product = null;
                if ($item['source'] === 'featured' && isset($item['featuredproduct_id'])) {
                    $product = $this->productModel->getFeaturedProductById($item['featuredproduct_id']);
                    if ($product) {
                        $product['source'] = 'featured';
                        $product['id'] = $item['featuredproduct_id'];
                    }
                } elseif ($item['source'] === 'product' && isset($item['product_id'])) {
                    $product = $this->productModel->getProductById($item['product_id']);
                    if ($product) {
                        $product['source'] = 'product';
                        $product['id'] = $item['product_id'];
                    }
                }

                if ($product) {
                    $product['quantity'] = $item['quantity'];
                    $product['total'] = $product['price'] * $item['quantity'];
                    $cartItems[] = $product;
                    $grandTotal += $product['total'];
                }
            }
        }

        $config = require 'config.php';
        $base = $config['base'];
        $baseURL = $config['baseURL'];
        $assets = $config['assets'];

        include './App/Views/Cart/cart.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            $source = isset($_POST['source']) ? $_POST['source'] : 'product';

            if ($productId <= 0 || $quantity < 1 || $quantity > 100 || !in_array($source, ['product'])) {
                $_SESSION['error'] = 'Dữ liệu không hợp lệ.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'cart/cart');
                exit;
            }

            $product = $this->productModel->getProductById($productId);
            if (!$product) {
                $_SESSION['error'] = 'Sản phẩm không tồn tại.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'cart/cart');
                exit;
            }

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['product_id'] === $productId && $item['source'] === 'product') {
                    $item['quantity'] = min($item['quantity'] + $quantity, 100);
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $_SESSION['cart'][] = [
                    'product_id' => $productId,
                    'source' => 'product',
                    'quantity' => $quantity
                ];
            }

            $_SESSION['success'] = 'Đã thêm sản phẩm vào giỏ hàng.';
            $config = require 'config.php';
            $baseURL = $config['baseURL'];
            header('Location: ' . $baseURL . 'cart/cart');
            exit;
        }
    }

    public function addfeatured()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $featuredproductId = isset($_POST['featuredproduct_id']) ? (int)$_POST['featuredproduct_id'] : 0;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            $source = isset($_POST['source']) ? $_POST['source'] : 'featured';

            if ($featuredproductId <= 0 || $quantity < 1 || $quantity > 100 || !in_array($source, ['featured'])) {
                $_SESSION['error'] = 'Dữ liệu không hợp lệ.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'cart/cart');
                exit;
            }

            $product = $this->productModel->getFeaturedProductById($featuredproductId);
            if (!$product) {
                $_SESSION['error'] = 'Sản phẩm nổi bật không tồn tại.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'cart/cart');
                exit;
            }

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['featuredproduct_id'] === $featuredproductId && $item['source'] === 'featured') {
                    $item['quantity'] = min($item['quantity'] + $quantity, 100);
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $_SESSION['cart'][] = [
                    'featuredproduct_id' => $featuredproductId,
                    'source' => 'featured',
                    'quantity' => $quantity
                ];
            }

            $_SESSION['success'] = 'Đã thêm sản phẩm nổi bật vào giỏ hàng.';
            $config = require 'config.php';
            $baseURL = $config['baseURL'];
            header('Location: ' . $baseURL . 'cart/cart');
            exit;
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
            $source = isset($_POST['source']) ? $_POST['source'] : 'product';
            $change = isset($_POST['change']) ? (int)$_POST['change'] : 0;

            if ($productId <= 0 || !in_array($source, ['product', 'featured']) || !isset($_SESSION['cart'])) {
                $_SESSION['error'] = 'Dữ liệu không hợp lệ.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'cart/cart');
                exit;
            }

            foreach ($_SESSION['cart'] as $key => &$item) {
                if (($item['source'] === 'product' && $item['product_id'] === $productId) ||
                    ($item['source'] === 'featured' && $item['featuredproduct_id'] === $productId)) {
                    $newQuantity = $item['quantity'] + $change;
                    if ($newQuantity < 1) {
                        unset($_SESSION['cart'][$key]);
                    } else {
                        $item['quantity'] = min($newQuantity, 100);
                    }
                    break;
                }
            }

            $_SESSION['success'] = 'Đã cập nhật giỏ hàng.';
            $config = require 'config.php';
            $baseURL = $config['baseURL'];
            header('Location: ' . $baseURL . 'cart/cart');
            exit;
        }
    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
            $source = isset($_POST['source']) ? $_POST['source'] : 'product';

            if ($productId <= 0 || !in_array($source, ['product', 'featured']) || !isset($_SESSION['cart'])) {
                $_SESSION['error'] = 'Dữ liệu không hợp lệ.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'cart/cart');
                exit;
            }

            foreach ($_SESSION['cart'] as $key => $item) {
                if (($item['source'] === 'product' && $item['product_id'] === $productId) ||
                    ($item['source'] === 'featured' && $item['featuredproduct_id'] === $productId)) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            $_SESSION['cart'] = array_values($_SESSION['cart']);

            $_SESSION['success'] = 'Đã xóa sản phẩm khỏi giỏ hàng.';
            $config = require 'config.php';
            $baseURL = $config['baseURL'];
            header('Location: ' . $baseURL . 'cart/cart');
            exit;
        }
    }
}