<?php
// require_once __DIR__ . '/../Model/ProductModel.php';
class ProductController
{
    public function index()
    {
        // $product = new ProductModel();
        // $productList = $product->getAllProducts();
        include_once __DIR__ . '/../Views/Product/DanhSachSanPham.php';
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