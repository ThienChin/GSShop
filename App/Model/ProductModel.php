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

    public function getFeaturedProducts()
    {
        $stmt = $this->db->prepare("SELECT * FROM featuredproducts ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginatedProducts($limit, $offset)
    {
        $stmt = $this->db->prepare("SELECT * FROM products ORDER BY id ASC LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalProducts()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM products");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function insertProduct($name, $price, $image)
    {
        $sql = "INSERT INTO products (name, price, image) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $price, $image]);
    }

    public function deleteProduct($productId)
    {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$productId]);
    }

    public function getProductById($productId)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getFeaturedProductById($id)
    {
        $sql = "SELECT * FROM featuredproducts WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($productId, $name, $price, $image = null)
    {
        if ($image) {
            $sql = "UPDATE products SET name = ?, price = ?, image = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$name, $price, $image, $productId]);
        } else {
            $sql = "UPDATE products SET name = ?, price = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$name, $price, $productId]);
        }
    }
}
?>