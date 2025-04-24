<?php
require_once __DIR__ . '/../Model/OrderModel.php';

class OrderController
{
    public function checkout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $orderModel = new OrderModel();
        $productModel = new ProductModel();

        $total = 0;
            foreach ($_SESSION['cart'] as $item) {
                $product = $productModel->getProductById($item['product_id']);
                $total += $product['Price'] * $item['quantity'];
            }

        $orderId = $orderModel->createOrder($_SESSION['user_id'], $total);
        foreach ($_SESSION['cart'] as $item) {
            $product = $productModel->getProductById($item['product_id']);
            $orderModel->addOrderItem($orderId, $item['product_id'], 
                                $item['quantity'], $product['Price']);
        }
         
        unset($_SESSION['cart']); //xoá cart đã success
        include './App/Views/Order/checkout_success.php';
    }
}