<?php
// Controlador para gestionar el proceso de inicio de sesión
require_once __DIR__.'/../models/UserModel.php';

class AdminCustomersController {
    public function showAdminCustomers() {
        // Mostrar la vista de inicio de sesión
        include __DIR__.'/../views/Administrator/AdminCustomersView.php';
    }

    public static function listCustomers() {
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $fetchedCustomers = UserModel::showCustomers($search);
        foreach($fetchedCustomers as $fetchedCustomer){
            $customer = new UserModel($fetchedCustomer["email"], $fetchedCustomer["phone"], $fetchedCustomer["name"], $fetchedCustomer["surnames"], $fetchedCustomer["address"], 'user');
            // Imprimir customers
            echo $customer->getEmail();
            echo $customer->getName();
            echo '  <div>
                        <div class="customerImage">
                            <img src="/assets/images/users/'. $customer->getImage() .'" alt="Customer Image">
                        </div>
                        <div>
                            <p>'. $customer->getName() .' '. $customer->getSurname() .'</p>
                            <p>Email: '. $customer->getEmail() .'</p>
                            <p>Phone Number: '. $customer->getPhone() .'</p>
                            <p>Adress: '. $customer->getAddress() .'</p>
                        </div>
                    </div>';
        }
    }
}

$AdminCustomersController = new AdminCustomersController();
$AdminCustomersController->showAdminCustomers();