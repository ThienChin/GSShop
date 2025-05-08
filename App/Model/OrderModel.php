<?php
require_once __DIR__ . '/../../Core/database.php';

class OrderModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // Phương thức công khai để bắt đầu giao dịch
    public function beginTransaction()
    {
        return $this->db->beginTransaction();
    }

    // Phương thức công khai để xác nhận giao dịch
    public function commit()
    {
        return $this->db->commit();
    }

    // Phương thức công khai để hủy giao dịch
    public function rollBack()
    {
        return $this->db->rollBack();
    }

    public function getAllOrders()
    {
        $stmt = $this->db->prepare("SELECT * FROM orders ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginatedOrders($limit, $offset)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders ORDER BY order_date DESC LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalOrders()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM orders");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
    public function getTotalRevenue()
    {
        $sql = "SELECT SUM(total) as total_revenue FROM orders";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_revenue'] ? (float)$result['total_revenue'] : 0;
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
        try {
            // Kiểm tra dữ liệu đầu vào
            if (empty($billingInfo) || empty($shippingAddress)) {
                error_log("Lỗi tạo đơn hàng: billing_info hoặc shipping_address trống.");
                throw new Exception('Thông tin thanh toán hoặc địa chỉ giao hàng trống.');
            }
            if (!is_numeric($total) || $total <= 0) {
                error_log("Lỗi tạo đơn hàng: total không hợp lệ ($total).");
                throw new Exception('Tổng tiền không hợp lệ.');
            }

            $sql = "INSERT INTO orders (user_id, total, order_date, status, billing_info, shipping_address, payment_method, notes)
                    VALUES (:user_id, :total, NOW(), :status, :billing_info, :shipping_address, :payment_method, :notes)";
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([
                'user_id' => $userId, // Có thể là NULL cho guest_checkout
                'total' => $total,
                'status' => 'Đặt hàng',
                'billing_info' => $billingInfo,
                'shipping_address' => $shippingAddress,
                'payment_method' => $paymentMethod,
                'notes' => $notes
            ]);
            if (!$result) {
                error_log("Lỗi SQL khi tạo đơn hàng: " . implode(', ', $this->db->errorInfo()));
                throw new Exception('Lỗi SQL khi tạo đơn hàng.');
            }
            $orderId = $this->db->lastInsertId();
            if (!$orderId) {
                error_log("Lỗi tạo đơn hàng: Không lấy được order_id.");
                throw new Exception('Không thể lấy ID đơn hàng.');
            }
            return $orderId;
        } catch (Exception $e) {
            error_log("Lỗi khi tạo đơn hàng: " . $e->getMessage());
            throw $e;
        }
    }

    public function addOrderItem($orderId, $productId, $featuredproductId, $quantity, $price)
    {
        try {
            $sql = "INSERT INTO order_items (order_id, product_id, featuredproduct_id, quantity, price)
                    VALUES (:order_id, :product_id, :featuredproduct_id, :quantity, :price)";
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([
                'order_id' => $orderId,
                'product_id' => $productId,
                'featuredproduct_id' => $featuredproductId,
                'quantity' => $quantity,
                'price' => $price
            ]);
            if (!$result) {
                error_log("Lỗi SQL khi thêm mục đơn hàng: " . implode(', ', $this->db->errorInfo()));
                throw new Exception('Lỗi SQL khi thêm mục đơn hàng.');
            }
            return true;
        } catch (Exception $e) {
            error_log("Lỗi khi thêm mục đơn hàng: " . $e->getMessage());
            throw $e;
        }
    }

    public function getOrderById($orderId)
    {
        try {
            // Lấy thông tin đơn hàng
            $sql = "SELECT * FROM orders WHERE id = :order_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['order_id' => $orderId]);
            $order = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($order) {
                // Giải mã billing_info và shipping_address
                $order['billing_info'] = json_decode($order['billing_info'], true) ?? [];
                $order['shipping_address'] = json_decode($order['shipping_address'], true) ?? [];

                // Lấy các mục trong đơn hàng
                $sql = "SELECT oi.*, p.name as product_name, fp.name as featured_product_name
                        FROM order_items oi
                        LEFT JOIN products p ON oi.product_id = p.id
                        LEFT JOIN featuredproducts fp ON oi.featuredproduct_id = fp.id
                        WHERE oi.order_id = :order_id";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(['order_id' => $orderId]);
                $order['items'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            return $order ?: false;
        } catch (Exception $e) {
            error_log("Lỗi khi lấy đơn hàng: " . $e->getMessage());
            return false;
        }
    }

    public function deleteOrder($orderId)
    {
        // Xóa các mục đơn hàng trong order_items
        $sql = "DELETE FROM order_items WHERE order_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$orderId]);

        // Xóa đơn hàng trong orders
        $sql = "DELETE FROM orders WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$orderId]);
    }

    public function updateOrderStatus($orderId, $status)
    {
        $validStatuses = ['pending', 'completed', 'canceled'];
        if (!in_array($status, $validStatuses)) {
            throw new Exception("Trạng thái không hợp lệ: $status");
        }
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([$status, $orderId]);
        if (!$result) {
            throw new Exception('Lỗi SQL khi cập nhật trạng thái: ' . implode(', ', $this->db->errorInfo()));
        }
        return $stmt->rowCount() > 0;
    }

    public function getRecentOrderStats()
    {
        $sql = "SELECT DATE(order_date) as order_day, COUNT(*) as order_count
                FROM orders
                WHERE order_date >= NOW() - INTERVAL 7 DAY
                GROUP BY DATE(order_date)
                ORDER BY order_day ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>