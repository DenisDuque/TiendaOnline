<?php 
require_once __DIR__.'/../models/OrdersModel.php';
class OrderController {
    public function showAdminOrders() {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $Orders = OrdersModel::getOrders($search);
        include __DIR__.'/../views/Administrator/AdminOrdersView.php';
    }
    public function showOrders() {
        
    }
}
?>