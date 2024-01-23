<?php
require_once __DIR__."/../models/UserModel.php";
class UserController {
    public function default() {
        // Mostrar la vista de inicio de sesión
        $incorrectPassword = false;
        include 'views/LoginView.php';
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
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=index.php?page=administrator'>";
            } else {
                if(!isset($_GET["code"])){
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=index.php?page=product&action=showProduct'>";
                }else{
                    //En caso de que se nos haya redirigido al login desde una pagina de producto, este se almacenara en el origen
                    //y despues de loguear volveremos a la pagina de ese producto
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=index.php?page=product&action=showProduct&function=".$_GET["function"]."&code=".$_GET["code"]."'>";
                }
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
        echo 'Registro realizado';
    }    

    public function showAdminUser() {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $customers = UserModel::showcustomers($search);
        include __DIR__.'/../views/Administrator/AdminCustomersView.php';
    }

    public function showPrincipalUser() {
        include __DIR__.'/../views/General/PrincipalView.php';
        require_once __DIR__.'/../models/CategoryModel.php';
        // Hay que filtrar tanto por categoria, como por barra de busqueda, y ordenar por Sort by.
        $categories = CategoryModel::listCategories("");
        $products = ProductModel::getAllProducts();
        $productArray = array_map(function($product) {
            return [
                'code' => $product->getCode(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'image' => $product->getImage("lateral"),
                'codecategory' => $product->getCategory(),
                'inWishlist' => false // TODO: Función para saber si se encuentra en la wishlist del usuario
            ];
        }, $products);
        //header("Content-Type: application/json");
        $jsonResult = json_encode($productArray);
    }
}
?>