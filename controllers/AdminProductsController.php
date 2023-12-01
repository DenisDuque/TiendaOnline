<?php
// Controlador para gestionar el proceso de inicio de sesión
require_once __DIR__.'/../models/UserModel.php';

class AdminProductsController {
    public function showAdminProducts() {
        // Mostrar la vista de inicio de sesión
        include __DIR__.'/../views/Administrator/AdminProductsView.php';
    }
}

$AdminProductsController = new AdminProductsController();
$AdminProductsController->showAdminProducts();