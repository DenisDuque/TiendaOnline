<?php
require_once __DIR__.'/../models/ProductModel.php';
class ProductController {
    public function showAdminProduct() {
        $products = ProductModel::getAllProducts();
        include __DIR__.'/../views/Administrator/AdminProductsView.php';
    }

    public function showAdminDashboard() {
        $products = ProductModel::getTopProducts(10);
        include __DIR__.'/../views/Administrator/AdminDashboardView.php';
    }
}
?>