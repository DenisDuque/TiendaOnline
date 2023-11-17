<?php
require_once '../config/Database.php';
class UserModel {
    public function authenticate($userEmail, $password) {
        // Lógica de autenticación (consulta a la base de datos)
        // Devuelve true si la autenticación es exitosa, false de lo contrario
    }

    public function register($userName, $userEmail, $userPassword) {
        // Lógica de registro (consulta a la base de datos)
        // Devuelve true si el registro es exitoso, false de lo contrario
    }
}
?>