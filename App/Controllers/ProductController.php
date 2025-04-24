<?php
require_once __DIR__ . '/../Model/ProductModel.php';
class ProductController
{
    public function index()
    {
        $product = new ProductModel();
        $productList = $product->getAllProducts();
        include_once __DIR__ . '/../Views/Product/DanhSachSanPham.php';
    }

    public function detail()
    {
        include_once __DIR__ . '/../Views/Product/ChiTietSanPham.php';
    }
}