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
        $grandTotal = 0;

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $product = null;
                if ($item['source'] === 'featured' && isset($item['featuredproduct_id'])) {
                    $product = $productModel->getFeaturedProductById($item['featuredproduct_id']);
                    if ($product) {
                        $product['source'] = 'featured';
                        $product['id'] = $item['featuredproduct_id'];
                    }
                } elseif ($item['source'] === 'product' && isset($item['product_id'])) {
                    $product = $productModel->getProductById($item['product_id']);
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

            if ($productId > 0 && $source === 'product') {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                $found = false;
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['product_id'] === $productId && $item['source'] === 'product') {
                        $item['quantity'] += $quantity;
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
            }

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

            if ($featuredproductId > 0 && $source === 'featured') {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                $found = false;
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['featuredproduct_id'] === $featuredproductId && $item['source'] === 'featured') {
                        $item['quantity'] += $quantity;
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
            }

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

            if ($productId > 0 && isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => &$item) {
                    if (($item['source'] === 'product' && $item['product_id'] === $productId) ||
                        ($item['source'] === 'featured' && $item['featuredproduct_id'] === $productId)) {
                        $newQuantity = $item['quantity'] + $change;
                        if ($newQuantity < 1) {
                            unset($_SESSION['cart'][$key]);
                        } else {
                            $item['quantity'] = $newQuantity;
                        }
                        break;
                    }
                }
            }

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

            if ($productId > 0 && isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => $item) {
                    if (($item['source'] === 'product' && $item['product_id'] === $productId) ||
                        ($item['source'] === 'featured' && $item['featuredproduct_id'] === $productId)) {
                        unset($_SESSION['cart'][$key]);
                        break;
                    }
                }
                // Đặt lại chỉ số mảng
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }

            $config = require 'config.php';
            $baseURL = $config['baseURL'];
            header('Location: ' . $baseURL . 'cart/cart');
            exit;
        }
    }
}