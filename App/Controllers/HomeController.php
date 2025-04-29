<?php
require_once __DIR__ . '/../Model/ProductModel.php';

class HomeController
{
    public function index()
    {
        $product = new ProductModel();
        $featuredProducts = $product->getFeaturedProducts(); // Sản phẩm nổi bật
        $recommendProducts = $product->getRecommendProducts();
        include_once 'App/Views/Home.php';
    }
}