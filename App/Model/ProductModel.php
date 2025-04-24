<?php
require_once __DIR__ . '/../../Core/database.php';
class ProductModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function getAllProducts()
    {
        $stmt = $this->db->prepare("SELECT * FROM products ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $sql = "SELECT * FROM products WHERE Id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}