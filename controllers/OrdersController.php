<?php 
require_once __DIR__.'/../models/OrdersModel.php';
require_once __DIR__.'/../models/UserModel.php';
class OrdersController {
    public function showAdminOrders() {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $Orders = OrdersModel::getOrdersWithDetail($search);
        include __DIR__.'/../views/Administrator/AdminOrdersView.php';
    }
    public function showOrders() {
        
    }

    public function showMyProducts($order){
        $result = OrdersModel::getMyProducts($order);
        return $result;
    }

    public function editOrders(){
        if(isset($_POST) && isset($_GET['page']) && isset($_GET['action']) && $_GET['action']== 'editOrders'){
            OrdersModel::editOrder($_POST['orderId'], 'shipped');
        }
    }
}
?>