<?php
// Punto de entrada para el Login y Register
require_once '../controllers/LoginController.php';

$loginController = new LoginController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si se envió el formulario, procesar el inicio de sesión
    $loginController->processLogin();
} else {
    // Mostrar el formulario de inicio de sesión
    $loginController->showLoginForm();
}
?>