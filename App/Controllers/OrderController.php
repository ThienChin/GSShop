<?php
require_once __DIR__ . '/../Model/OrderModel.php';
require_once __DIR__ . '/../Model/ProductModel.php';

class OrderController
{
    public function checkout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $orderModel = new OrderModel();
        $productModel = new ProductModel();
        $config = require 'config.php';
        $baseURL = $config['baseURL'];

        $cartItems = [];
        $total = 0;

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                if ($item['source'] === 'featured' && isset($item['featuredproduct_id'])) {
                    $product = $productModel->getFeaturedProductById($item['featuredproduct_id']);
                    if ($product) {
                        $product['quantity'] = $item['quantity'];
                        $product['source'] = 'featured';
                        $cartItems[] = $product;
                        $total += $product['price'] * $item['quantity'];
                    }
                } elseif ($item['source'] === 'product' && isset($item['product_id'])) {
                    $product = $productModel->getProductById($item['product_id']);
                    if ($product) {
                        $product['quantity'] = $item['quantity'];
                        $product['source'] = 'product';
                        $cartItems[] = $product;
                        $total += $product['price'] * $item['quantity'];
                    }
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($cartItems)) {
                die('Error: Cart is empty');
            }

            $billingInfo = json_encode([
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? ''
            ]);
            $shippingAddress = json_encode([
                'address' => $_POST['address'] ?? '',
                'city' => $_POST['city'] ?? '',
            ]);
            $paymentMethod = $_POST['payment_method'] ?? 'cod';
            $notes = $_POST['notes'] ?? '';
            // Gán $userId là null nếu chưa đăng nhập
            $userId = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;

            // Create order
            $orderId = $orderModel->createOrder($userId, $total, $billingInfo, $shippingAddress, $paymentMethod, $notes);
            if (!$orderId) {
                die('Error: Failed to create order. Check database logs for details.');
            }

            // Add order items
            foreach ($cartItems as $item) {
                $productId = $item['source'] === 'product' ? $item['id'] : null;
                $featuredproductId = $item['source'] === 'featured' ? $item['id'] : null;
                $orderModel->addOrderItem($orderId, $productId, $featuredproductId, $item['quantity'], $item['price']);
            }

            // Clear cart
            unset($_SESSION['cart']);

            // Redirect to checkout success page
            header('Location: ' . $baseURL . 'order/checkout_success?order_id=' . $orderId);
            exit;
        }

        // Load checkout view
        include './App/Views/Order/checkout.php';
    }

    public function checkout_success()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $orderModel = new OrderModel();
        $orderId = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;
        $order = $orderModel->getOrderById($orderId);

        if (!$order) {
            $config = require 'config.php';
            $baseURL = $config['baseURL'];
            header('Location: ' . $baseURL . 'home/index');
            exit;
        }

        include './App/Views/Order/checkout_success.php';
    }
}