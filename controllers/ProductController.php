<?php
require_once __DIR__.'/../models/ProductModel.php';
class ProductController {
    public function default(){
        require_once "views\General\PrincipalView.php";
    }
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
        include __DIR__.'/../views/General/SearchProducts.php';
    }

    public function fetchProducts() {
        try {
            $condition = $_REQUEST['condition'];
            $products = ProductModel::getProductsWhere($condition);
            if (!empty($products)) {
                $data = array_map(function($product) {
                    return [
                        'code' => $product->getCode(),
                        'codecategory' => $product->getCategory(),
                        'name' => $product->getName(),
                        'price' => $product->getPrice(),
                        'sold' => $product->getSold(),
                        'image' => $product->getImage("lateral"),
                        'stock' => $product->getStock(),
                        'status' => $product->getStatus(),
                    ];
                }, $products);
                $jsonData = json_encode($data);
                header('Content-Type: application/json');

                // Devolver el JSON
                echo $jsonData;
            } else {
                header('Content-Type: application/json');
                $jsonData = json_encode([]);
                echo $jsonData;
            }
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Fetch data error: " . $e->getMessage());
        }
    }
    
    public function showProduct() {
        require_once __DIR__.'/../models/CategoryModel.php';
        $product = ProductModel::getProductWithCode();
        $product["category"] = CategoryModel::getCategory($product["codecategory"]);
        include __DIR__.'/../views/General/productPage.php';
        if(isset($_GET["wishlist"]) and $_GET["wishlist"]==true){
            if(isset($_GET["userEmail"])){
                ProductModel::putInWishList($_GET["userEmail"],$_GET['code']);
            }else{
                //Hay que redirigir al inicio de sesion y que luego este te lleve otra vez 
                //a la pagina del producto en el que estabas en vez de la pagina principal
            }
        }
    }
    public function createProduct() {
    }
}
?>