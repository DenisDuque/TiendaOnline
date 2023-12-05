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
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $Orders = OrdersModel::getOrders($search);
        foreach($Orders as $order) {
            $userInfo = UserModel::getSpecifiedUser($order->getUser());
            $productsID = OrdersModel::getMyProducts($order->getId());
            $showProducts = "";
            if (count($productsID) <= 3) {
                $showProducts = implode(", ", $productsID);
            } else {
                $firstProducts = array_slice($productsID, 0, 3);
                $showProducts = implode(", ", $firstProducts) + "...";
            }
            $userImage = $userInfo->getImage();
            if ($userImage == null) {
                $userImage = '../assets/images/utils/customer.png';
            }

            echo "
                <div>
                    <div>
                        <img src='../assets/images/users/". $userImage ."' alt='Customer's Image'>
                    </div>
                    <div>
                        <div>". $userInfo->getName() ." ". $userInfo->getSurname() ."</div>
                        <div>Email: ". $userInfo->getEmail() ."</div>
                        <div>Products: ". $showProducts ."</div>
                        <div><div>Total Amount: ". $order->getPrice() ."</div><div>Status: ". $order->getStatus() ."</div></div>
                    </div>
                    <div>
                        <div><button type='submit' id='". $order->getId() ." bill'><img src='../assets/images/utils/factura.png' alt='Factura'></button></div>
                        <div><button type='submit' id='". $order->getId() ." edit'><img src='../assets/images/utils/edit.png' alt='Edit'></button></div>
                    </div>
                </div>
            ";
        }
    }
}

$AdminOrdersController = new AdminOrdersController();
$AdminOrdersController->showAdminOrders();