<?php
include("/config/Database.php");
class UserModel extends Database {
    private $email;
    private $phone;
    private $name;
    private $surname;
    private $address;
    private $rol;

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function getRol() {
        return $this->rol;
    }

    public function authenticate($userEmail, $password) {
        $conn = conection();
        try {
            $query = "SELECT * FROM users WHERE email = :perspective AND product = :product";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':perspective', $perspective);
            $stmt->bindParam(':product', $product);
            $stmt->execute();
            $img = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $img['route'];
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function register($userName, $userEmail, $userPassword) {
        $validRegister = false;
        $selectUser = "SELECT * FROM users WHERE email LIKE $userEmail";
    }
}
?>