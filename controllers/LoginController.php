<?php
// Controlador para gestionar el proceso de inicio de sesión
require_once '../models/UserModel.php';

class LoginController {
    public function showLoginForm() {
        // Mostrar la vista de inicio de sesión
        include '../views/LoginView.html';
    }

    public function processLogin() {
        // Procesar el formulario de inicio de sesión
        $userEmail = $_POST['userEmail'];
        $password = $_POST['password'];

        $userModel = new UserModel();

        if ($userModel->authenticate($userEmail, $password)) {
            // Autenticación exitosa, redirige a la página principal
            header('Location: index.php');
        } else {
            // Autenticación fallida, vuelve a mostrar el formulario de inicio de sesión
            include '../views/LoginView.php';
            echo '<p>Invalid userEmail or password</p>';
        }
    }
}
?>