<?php
// Controlador para gestionar el proceso de inicio de sesión
require_once __DIR__.'/../models/UserModel.php';

class AdminProductsController {
    public function showAdminProducts() {
        include __DIR__.'/../views/Administrator/AdminProductsView.php';
    }
    public static function showProducts() {
        $Products = ProductModel::getAllProducts();
        foreach($Products as $product) {
            $img = ProductModel::getProductImage('lateralPerspective', $product->getCode());
            echo "
                <div>
                    <div>
                        <img src='/views/assets/images/products/".$img."'>
                    </div>
                    <div>
                        <div>". $product->getName() ."</div>
                        <div>Category: ". $product->getCategory() ."</div>
                        <div>Product Code: ". $product->getCode() ."</div>
                        <div>". $product->getPrice() ."</div>
                    </div>
                    <div>
                        <div>Sold: ". $product->getSold() ."</div>
                        <div>Stock: ". $product->getStock() ."</div>
                        <div><button type='submit'><img src='../assets/images/utils/edit.png' alt='Edit'></button></div>
                    </div>
                </div>
            ";
        }
    }
}

$AdminProductsController = new AdminProductsController();
require_once __DIR__.'/../models/ProductModel.php';
$AdminProductsController->showAdminProducts();