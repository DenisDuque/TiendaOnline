<?php
include(__DIR__."/../config/Database.php");
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
        $conn = $this->connect();
        try {
            $hashedPassword = md5($password);
            $query = "SELECT rol FROM users WHERE email = :email AND password = :password";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $userEmail);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                $rol = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $rol['rol'];
            } else {
                return false;
            }

            //$img = $stmt->fetchAll(PDO::FETCH_ASSOC);
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