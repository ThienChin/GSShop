<?php
require_once __DIR__ . '/../../Core/database.php';

class ChartModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getEarningsPerMonth()
    {
        $sql = "SELECT MONTH(order_date) as month, SUM(total) as total
                FROM orders
                WHERE YEAR(order_date) = YEAR(CURDATE())
                GROUP BY MONTH(order_date)
                ORDER BY month ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $earnings = array_fill(1, 12, 0); // 12 tháng mặc định 0
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $earnings[(int)$row['month']] = (float)$row['total'];
        }

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = [
                'month' => date('M', mktime(0, 0, 0, $i, 1)),
                'total' => $earnings[$i]
            ];
        }
        return $data;
    }

    public function getOrderStatusCounts()
    {
        $sql = "SELECT status, COUNT(*) as count
                FROM orders
                GROUP BY status";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopProducts($limit = 5)
    {
        $sql = "SELECT p.name, SUM(oi.quantity) as quantity
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                GROUP BY p.id, p.name
                ORDER BY quantity DESC
                LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>