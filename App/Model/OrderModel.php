<?php
require_once __DIR__ . '/../../Core/database.php';

class OrderModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getAllOrders()
    {
        $stmt = $this->db->prepare("SELECT * FROM orders ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrdersByUserId($userId)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createOrder($userId, $total, $billingInfo, $shippingAddress, $paymentMethod, $notes)
    {
        $sql = "INSERT INTO orders (user_id, total, order_date, status, billing_info, shipping_address, payment_method, notes)
                VALUES (?, ?, NOW(), 'pending', ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([$userId, $total, $billingInfo, $shippingAddress, $paymentMethod, $notes]);
        if (!$result) {
            throw new Exception('Lỗi SQL khi tạo đơn hàng: ' . implode(', ', $this->db->errorInfo()));
        }
        return $this->db->lastInsertId();
    }

    public function addOrderItem($orderId, $productId, $featuredproductId, $quantity, $price)
    {
        $sql = "INSERT INTO order_items (order_id, product_id, featuredproduct_id, quantity, price)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([$orderId, $productId, $featuredproductId, $quantity, $price]);
        if (!$result) {
            throw new Exception('Lỗi SQL khi thêm mục đơn hàng: ' . implode(', ', $this->db->errorInfo()));
        }
        return true;
    }

    public function getOrderById($orderId)
    {
        // Lấy thông tin đơn hàng
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$orderId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($order) {
            // Lấy các mục trong đơn hàng
            $sql = "SELECT oi.*, p.name as product_name, fp.name as featured_product_name
                    FROM order_items oi
                    LEFT JOIN products p ON oi.product_id = p.id
                    LEFT JOIN featuredproducts fp ON oi.featuredproduct_id = fp.id
                    WHERE oi.order_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$orderId]);
            $order['items'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $order;
    }
}