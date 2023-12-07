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
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $Orders = OrdersModel::getOrders($search);
        foreach($Orders as $order) {
            $userInfo = UserModel::getSpecifiedUser($order->getUser());
            $productsID = OrdersModel::getMyProducts($order->getId());
            $showProducts = "";
            if (count($productsID) <= 3) {
                $showProducts = implode(", ", $productsID);
            } else {
                $firstProducts = array_slice($productsID, 0, 3);
                $showProducts = implode(", ", $firstProducts) . "...";
            }
            $userImage = $userInfo->getImage();
            if ($userImage == null) {
                $userImage = '../utils/customers.png';
            }

            echo "
                <div id='". $order->getId() ."' class='defaultComponent'>
                    <div class='imageComponent'>
                        <img src='views/assets/images/users/". $userImage ."' alt='Customer'>
                    </div>
                    <div class='textOnLeft'>
                        <h4 class='name'>". $userInfo->getName() ." ". $userInfo->getSurname() ."</h4>
                        <p class='userEmail'>Email: ". $userInfo->getEmail() ."</p>
                        <p class='userPhone'>Products: ". $showProducts ."</p>
                        <p class='userAddress'>Total Amount: ". $order->getPrice() ."<span>Status: ". $order->getStatus() ."</span></p>
                    </div>
                    <div class='textOnRight'>
                        <div id='downloadBill_". $order->getId() ."' class='downloadBillBtn'><img src='views/assets/images/utils/downloadBill.png' alt='Download Bill'></div>
                        <div id='editBtn_". $order->getId() ."' class='editBtn'><img src='views/assets/images/utils/edit.png' alt='Edit'></div>
                    </div>
                </div>
            ";
        }
    }
}

$AdminOrdersController = new AdminOrdersController();
$AdminOrdersController->showAdminOrders();