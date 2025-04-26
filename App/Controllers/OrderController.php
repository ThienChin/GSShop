<?php
require_once __DIR__ . '/../Model/OrderModel.php';

class OrderController
{
    public function checkout()
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
        // var_dump($cartItems);
        // die;

        include './App/Views/order/checkout.php';    

    }
}