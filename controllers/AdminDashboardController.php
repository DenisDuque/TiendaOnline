<?php
// Controlador para gestionar el proceso de inicio de sesión


class AdminDashboardController {
    public function showAdminDashboard() {
        // Mostrar la vista de inicio de sesión
        include __DIR__.'/../views/Administrator/AdminDashboardView.php';
    }
    public function isUserLoged() {
        /* 
        if(isset($_SESSION)) {
            if($_SESSION['rol'] == 'admin') {
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=../index.php?page=administrator'>";
            } else {
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=../index.php'>";
            }
        }
        */
    }
    public static function bestSellers() {
        $Products = ProductModel::getTopProducts(10);
        foreach($Products as $product) {
            $img = ProductModel::getProductImage('lateralPerspective', $product->getCode());
            if($img != null) {
                echo "
                    <div>
                        <div>
                            <img src='/views/assets/images/products/".$img."' alt='productImage'>
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
                        </div>
                    </div>
                ";
            } else {
                echo "
                    <div>
                        <div>
                            <img src='/views/assets/images/utils/defaultProductImage.jpg' alt='productImage'>
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
                        </div>
                    </div>
                ";
            }
        }
    }
}

if(isset($_SESSION['user'])) {
    if($_SESSION['rol'] != 'admin') {
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=../index.php'>";
    }
} else {
    $AdminDashboardController = new AdminDashboardController();
    // Si se envió el formulario, procesar el inicio de sesión o registro
    $panel = isset($_GET['panel']) ? $_GET['panel'] : '';
    switch ($panel) {
        case 'categories':
            include __DIR__.'/AdminCategoriesController.php';
            break;
        case 'products':
            include __DIR__.'/AdminProductsController.php';
            break;
        case 'orders':
            include __DIR__.'/AdminOrdersController.php';
            break;
        case 'customers':
            include __DIR__.'/AdminCustomersController.php';
            break;
        case '':
        default:
            require_once __DIR__.'/../models/ProductModel.php';
            $AdminDashboardController->showAdminDashboard();
            break;
    }
}

    
?>  