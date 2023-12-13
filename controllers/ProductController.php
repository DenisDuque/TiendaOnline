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

    public function showSearchProducts() {
        require_once __DIR__.'/../models/CategoryModel.php';
        // Hay que filtrar tanto por categoria, como por barra de busqueda, y ordenar por Sort by.
        $categories = CategoryModel::listCategories("");
        $products = ProductModel::getAllProducts();
        include __DIR__.'/../views/General/SearchProducts.php';
    }
}
?>