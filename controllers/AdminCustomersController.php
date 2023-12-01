<?php
// Controlador para gestionar el proceso de inicio de sesión
require_once __DIR__.'/../models/UserModel.php';

class AdminCustomersController {
    public function showAdminCustomers() {
        // Mostrar la vista de inicio de sesión
        include __DIR__.'/../views/Administrator/AdminCustomersView.php';
    }
}

$AdminCustomersController = new AdminCustomersController();
$AdminCustomersController->showAdminCustomers();