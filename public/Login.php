<?php
// Punto de entrada para el Login y Register
require_once '../controllers/LoginController.php';

$loginController = new LoginController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si se envió el formulario, procesar el inicio de sesión o registro
    $action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
    	case 'login':
            // Iniciar Sesión
        	$loginController->processLogin();
        	break;
    	case 'register':
            // Registrar nuevo usuario
        	$loginController->processRegistration();
        	break;
    	default:
        	// Manejar caso no válido
        	break;
	}
    
} else {
    // Mostrar el formulario de inicio de sesión
    $loginController->showLoginForm();
}
?>