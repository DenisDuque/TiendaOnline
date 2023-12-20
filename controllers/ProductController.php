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
        $productArray = array_map(function($product) {
            return [
                'productCode' => $product->getCode(),
                'productName' => $product->getName(),
                'productPrice' => $product->getPrice(),
                'productImage' => $product->getImage("lateral"),
                'productCategory' => $product->getCategory(),
                'inWishlist' => false // TODO: Función para saber si se encuentra en la wishlist del usuario
            ];
        }, $products);
        //header("Content-Type: application/json");
        $jsonResult = json_encode($productArray);
        include __DIR__.'/../views/General/SearchProducts.php';
    }

    public function showProduct() {
        require_once __DIR__.'/../models/CategoryModel.php';
        $product = ProductModel::getProductWithCode();
        $product["category"] = CategoryModel::getCategory($product["codecategory"]);
        include __DIR__.'/../views/General/productPage.php';
    }
}
?>