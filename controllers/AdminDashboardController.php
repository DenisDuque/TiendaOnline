<?php
// Controlador para gestionar el proceso de inicio de sesión
require_once __DIR__.'/../models/ProductModel.php';

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
                    </div>
                </div>
            ";
        }
    }
}
if(isset($_SESSION['user'])) {
    if($_SESSION['rol'] != 'admin') {
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=../index.php'>";
    }
}

$AdminDashboardController = new AdminDashboardController();
    // Si se envió el formulario, procesar el inicio de sesión o registro
    $panel = isset($_GET['panel']) ? $_GET['panel'] : '';
	switch ($panel) {
        case 'categories':
            break;
        case 'products':
            break;
        case 'orders':
            break;
        case 'customers':
            break;
        case '':
    	default:
            $AdminDashboardController->showAdminDashboard();
        	break;
	}
    
?>  