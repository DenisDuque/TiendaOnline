<?php
// Controlador para gestionar el proceso de inicio de sesión
require_once __DIR__.'/../models/UserModel.php';

class AdminCustomersController {
    public function showAdminCustomers() {
        // Mostrar la vista de inicio de sesión
        include __DIR__.'/../views/Administrator/AdminCustomersView.php';
    }

    public static function listCustomers() {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $customers = UserModel::showcustomers($search);
        foreach($customers as $customer){
            if($customer->getImage() == null) {
                $image = "../utils/customers.png";
            } else {
                $image = $customer->getImage();
            }
            echo "
                <div id='". $customer->getEmail() ."' class='defaultComponent'>
                    <div class='imageComponent'><img src='views/assets/images/users/". $image ."'></div>
                    <div class='textOnLeft'>
                        <h4 class='name'>". $customer->getName() ." ". $customer->getSurname() ."</h4>
                        <p class='userEmail'>Email: ". $customer->getEmail() ."</p>
                        <p class='userPhone'>". $customer->getPhone()."</p>
                        <p class='userAddress'>". $customer->getAddress() ."</p>
                    </div>
                </div>
            ";
        }
    }
}

$AdminCustomersController = new AdminCustomersController();
$AdminCustomersController->showAdminCustomers();