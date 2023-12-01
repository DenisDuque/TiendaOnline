<?php
// Controlador para gestionar el proceso de inicio de sesión
require_once __DIR__.'/../models/UserModel.php';

class AdminOrdersController {
    public function showAdminOrders() {
        // Mostrar la vista de inicio de sesión
        include __DIR__.'/../views/Administrator/AdminOrdersView.php';
    }
}

$AdminOrdersController = new AdminOrdersController();
$AdminOrdersController->showAdminOrders();