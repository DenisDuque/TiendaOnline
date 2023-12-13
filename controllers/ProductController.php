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
        $productArray = [];
        foreach ($products as $product) {
            $productJSON = [
                'productCode' => $product->getCode(),
                'productName' => $product->getName(),
                'productPrice' => $product->getPrice(),
                'productImage' => $product->getImage("lateral"),
                'inWishlist' => false // TODO: Funcion para saber si se encuentra en la wishlist del user
            ];
            $productArray[] = $productJSON;
        }
        header("Content-Type: application/json");
        $jsonResult = json_encode($productArray);
        include __DIR__.'/../views/General/SearchProducts.php';
    }
}
?>