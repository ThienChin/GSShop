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

        $config = require 'config.php';
        $baseURL = $config['baseURL'];

        $orderModel = new OrderModel();
        $productModel = new ProductModel();

        $cartItems = [];
        $total = 0;

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                if ($item['source'] === 'featured' && isset($item['featuredproduct_id'])) {
                    $product = $productModel->getFeaturedProductById($item['featuredproduct_id']);
                    if ($product) {
                        $product['quantity'] = $item['quantity'];
                        $product['source'] = 'featured';
                        $product['id'] = $item['featuredproduct_id'];
                        $cartItems[] = $product;
                        $total += $product['price'] * $item['quantity'];
                    }
                } elseif ($item['source'] === 'product' && isset($item['product_id'])) {
                    $product = $productModel->getProductById($item['product_id']);
                    if ($product) {
                        $product['quantity'] = $item['quantity'];
                        $product['source'] = 'product';
                        $product['id'] = $item['product_id'];
                        $cartItems[] = $product;
                        $total += $product['price'] * $item['quantity'];
                    }
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($cartItems)) {
                $_SESSION['error'] = 'Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi thanh toán.';
                header('Location: ' . $baseURL . 'cart/cart');
                exit;
            }

            // Kiểm tra trạng thái đăng nhập khi gửi form
            if (!isset($_SESSION['user_id']) && !isset($_POST['guest_checkout'])) {
                $_SESSION['redirect_after_login'] = $baseURL . 'order/checkout';
                header('Location: ' . $baseURL . 'user/login?message=please_login_to_checkout&redirect=' . urlencode($baseURL . 'order/checkout'));
                exit;
            }

            // Kiểm tra dữ liệu đầu vào
            if (!isset($_SESSION['user_id']) && isset($_POST['guest_checkout'])) {
                if (empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['address']) || empty($_POST['city'])) {
                    $_SESSION['error'] = 'Vui lòng điền đầy đủ họ tên, số điện thoại, địa chỉ và thành phố.';
                    header('Location: ' . $baseURL . 'order/checkout');
                    exit;
                }
                if (!preg_match('/^[0-9]{10,11}$/', $_POST['phone'])) {
                    $_SESSION['error'] = 'Số điện thoại không hợp lệ (10-11 số).';
                    header('Location: ' . $baseURL . 'order/checkout');
                    exit;
                }
                if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['error'] = 'Email không hợp lệ.';
                    header('Location: ' . $baseURL . 'order/checkout');
                    exit;
                }
            }

            // Xử lý thông tin thanh toán
            $billingInfo = [];
            if (isset($_SESSION['user_id'])) {
                $billingInfo = [
                    'name' => $_SESSION['fullname'] ?? ($_POST['name'] ?? ''),
                    'email' => $_POST['email'] ?? '',
                    'phone' => $_SESSION['phone'] ?? ($_POST['phone'] ?? '')
                ];
            } else {
                $billingInfo = [
                    'name' => trim($_POST['name'] ?? ''),
                    'email' => trim($_POST['email'] ?? ''),
                    'phone' => trim($_POST['phone'] ?? '')
                ];
            }
            $billingInfo = json_encode($billingInfo, JSON_UNESCAPED_UNICODE);
            if ($billingInfo === false) {
                $_SESSION['error'] = 'Lỗi định dạng thông tin thanh toán.';
                header('Location: ' . $baseURL . 'order/checkout');
                exit;
            }

            $shippingAddress = json_encode([
                'address' => trim($_POST['address'] ?? ''),
                'city' => trim($_POST['city'] ?? '')
            ], JSON_UNESCAPED_UNICODE);
            if ($shippingAddress === false) {
                $_SESSION['error'] = 'Lỗi định dạng địa chỉ giao hàng.';
                header('Location: ' . $baseURL . 'order/checkout');
                exit;
            }

            $paymentMethod = $_POST['payment_method'] ?? 'cod';
            $notes = trim($_POST['notes'] ?? '');
            $userId = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;

            try {
                // Ghi log dữ liệu để debug
                error_log("Tạo đơn hàng: user_id=$userId, total=$total, billing_info=$billingInfo, shipping_address=$shippingAddress");

                // Bắt đầu giao dịch
                $orderModel->beginTransaction();

                // Tạo đơn hàng
                $orderId = $orderModel->createOrder($userId, $total, $billingInfo, $shippingAddress, $paymentMethod, $notes);
                if (!$orderId) {
                    throw new Exception('Không thể tạo đơn hàng. Vui lòng kiểm tra thông tin và thử lại.');
                }

                // Thêm các mục đơn hàng
                foreach ($cartItems as $item) {
                    $productId = $item['source'] === 'product' ? $item['id'] : null;
                    $featuredproductId = $item['source'] === 'featured' ? $item['id'] : null;
                    $result = $orderModel->addOrderItem($orderId, $productId, $featuredproductId, $item['quantity'], $item['price']);
                    if (!$result) {
                        throw new Exception('Không thể thêm sản phẩm vào đơn hàng. Vui lòng thử lại.');
                    }
                }

                // Xác nhận giao dịch
                $orderModel->commit();

                // Xóa giỏ hàng
                unset($_SESSION['cart']);

                // Chuyển hướng đến trang xác nhận
                header('Location: ' . $baseURL . 'order/checkout_success?order_id=' . $orderId);
                exit;
            } catch (Exception $e) {
                $orderModel->rollBack();
                $_SESSION['error'] = $e->getMessage();
                header('Location: ' . $baseURL . 'order/checkout');
                exit;
            }
        }

        // Tải giao diện thanh toán
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
?>