<?php
// Controlador para gestionar el proceso de inicio de sesión
require_once __DIR__.'/../models/UserModel.php';
require_once __DIR__.'/../models/OrdersModel.php';

class AdminOrdersController {
    public function showAdminOrders() {
        // Mostrar la vista de inicio de sesión
        include __DIR__.'/../views/Administrator/AdminOrdersView.php';
    }
    public static function showOrders() {
        $Orders = OrdersModel::getOrders();
        foreach($Orders as $order) {
            $userInfo = UserModel::getSpecifiedUser($order->getUser());
            $productsInfo = OrdersModel::getMyProducts($order->getId());
            echo "
                <div>

                </div>
            ";
        }
        //$userInfo = UserModel::getSpecifiedUser($Orders['']);
    }
}

$AdminOrdersController = new AdminOrdersController();
$AdminOrdersController->showAdminOrders();