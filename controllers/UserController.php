<?php
require_once __DIR__."/../models/UserModel.php";
require_once __DIR__."/../models/OrdersModel.php";
require_once __DIR__."/../models/ProductModel.php";
class UserController {
    public function default() {
        // Mostrar la vista de inicio de sesión
        $incorrectPassword = false;
        include 'views/LoginView.php';
    }
    public function showLoggedError() {
        include 'views/Administrator/Components/errorLogMessage.html';
    }
    public function processLogin() {
        // Procesar el formulario de inicio de sesión
        $userEmail = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];
        $rol = UserModel::authenticate($userEmail, $password);

        if ($rol !== null) {
            //Creacion de las variables de sesion.
            $_SESSION['email'] = $userEmail;
            $_SESSION['rol'] = $rol;
            // Autenticación exitosa, redirige a la página principal dependiendo del rol
            if($rol == 'admin') {
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=index.php?page=Product&action=showAdminDashboard'>";
            } else {
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=index.php'>";
            }
        } else {
            // Autenticación fallida, vuelve a mostrar el formulario de inicio de sesión
            $incorrectPassword = true;
            include 'views/LoginView.php';
        }
    }
    
    public function processRegistration() {
        $userName = $_POST['registerUsername'];
        $userSurnames = $_POST['registerSurnames'];
        $userEmail = $_POST['registerEmail'];
        $password = $_POST['registerPassword'];
    
        // Validar que los campos no estén vacíos (hay que añadir mas condiciones)
        if (empty($userName) || empty($userSurnames) || empty($userEmail) || empty($password)) {
            // Mostrar pop-up con mensaje: "¡Todos los campos son obligatorios!"
            echo 'Todos los campos son obligatorios';
            return;
        }
    
        // Validar el formato del email
        if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            // Mostrar pop-up con mensaje: "¡El email no es valido!"
            echo 'Formato de email no válido';
            return;
        }
    
        // Cifrado de contraseña utilizando password_hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Guardar el usuario en la base de datos
        if (UserModel::register($userName, $userSurnames, $userEmail, $hashedPassword)) {
            $_SESSION['email'] = $userEmail;
            //$_SESSION['rol'] = 'customer';
    
            //Aqui la redireccion futura a la pagina principal de customer logeado.
            //echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=../index.php?page=customer'>";
        }
    
        // Redirigir a otra página después del registro exitoso
        echo"<meta http-equiv='refresh' content='0;url=index.php?page=Product'>";
    }    
    public function logOut() {
        if(isset($_SESSION['email'])) {
            session_destroy();
        }
        echo"<meta http-equiv='refresh' content='0.1;url=index.php?page=User'>";
    }

    public function showAdminUser() {
        if(isset($_SESSION['email']) && isset($_SESSION['rol'])) {
            if($_SESSION['rol'] == 'admin') {
                $search = isset($_GET['search']) ? $_GET['search'] : null;
                $customers = UserModel::showcustomers($search);
                include __DIR__.'/../views/Administrator/AdminCustomersView.php';
            } else {
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=index.php?page=User&action=showLoggedError'>";
            }
        } else {
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=index.php?page=User&action=showLoggedError'>";
        }
    }

    public function showProfile(){
        if(isset($_SESSION["email"])){
            if(isset($_POST["name"])){
                UserModel::updateUser($_SESSION["email"]);
            }
            if(isset($_GET["deleteOrder"])){
                OrdersModel::dropOrder($_GET["deleteOrder"]);
            }
            $user = UserModel::getSpecifiedUser($_SESSION["email"]);
            $orders = OrdersModel::getOrdersWithDetail($_SESSION["email"]);
            include "views\General\Components\headerHome.php";
            include "views/Users/userProfile.php";
        }else{
            $_SESSION["origin"] = "profile";
            self::default();
        }
    }

    public function showWishlist(){
        if(isset($_SESSION["email"])){
            $codes = UserModel::getUserWishList($_SESSION["email"]);
            $products = [];
            foreach($codes as $code){
                $products[$code[0]] = ProductModel::getProductWithCode($code[0]);
            }
            include "views\General\Components\headerHome.php";
            include "views/Users/wishList.php";
        }else{
            $_SESSION["origin"] = "wishList";
            self::default();
        }
    }
}
?>