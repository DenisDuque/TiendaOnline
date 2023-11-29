<?php
// Controlador para gestionar el proceso de inicio de sesión
require_once 'models/ProductModel.php';

class AdminDashboardController {
    public function showAdminDashboard() {
        // Mostrar la vista de inicio de sesión
        include 'views/AdminDashboard.php';
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
    public function bestSelled() {
        $ProductModel = new ProductModel();
        $Products = $ProductModel->getTopProducts()
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
    	case 'login':
            // Iniciar Sesión
        	$loginController->processLogin();
        	break;
    	case 'register':
            // Registrar nuevo usuario
        	$loginController->processRegistration();
        	break;
        case 'categories':
            break;
        case 'products':
            break;
        case 'orders':
            break;
        case 'customers':
    	default:
        	// Manejar caso no válido
        	break;
	}
?>  