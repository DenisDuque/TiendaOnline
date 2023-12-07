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
            if($img == null) {
                $img = '../utils/productImage.png';
            }
            echo "
                <div id='". $product->getCode() ."' class='defaultComponent'>
                    <div class='imageComponent'>
                        <img src='views/assets/images/products/".$img."'>
                    </div>
                    <div class='textOnLeft'>
                        <h4>". $product->getName() ."</h4>
                        <p>Category: ". $product->getCategory() ."</p>
                        <p>Product Code: ". $product->getCode() ."</p>
                        <h5>$". $product->getPrice() ."</h5>
                    </div>
                    <div class='textOnRight'>
                        <h4 class='productSold'>Sold: ". $product->getSold() ."</h4>
                        <h4 class='productStock'>Stock: ". $product->getStock() ."</h4>
                        <div id='editBtn_". $product->getCode() ."' class='editBtn'><img src='views/assets/images/utils/edit.png' alt='Edit'></div>
                    </div>
                </div>
            ";
        }
    }
}

$AdminProductsController = new AdminProductsController();
require_once __DIR__.'/../models/ProductModel.php';
$AdminProductsController->showAdminProducts();