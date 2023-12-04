<?php
require_once(__DIR__."/../config/Database.php");
class UserModel extends Database {
    private $email;
    private $phone;
    private $name;
    private $surname;
    private $address;
    private $rol;

    private $image;

    public function __construct($email, $phone, $name, $surname, $address, $rol){
        $this->email = $email;
        $this->phone = (string) $phone;
        $this->name = $name;
        $this->surname = $surname;
        $this->address = $address;
        $this->rol = $rol;
    }

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

    public function setImage($image) {
        $this->image = $image;
    }

    public function getImage() {
        return $this->image;
    }

    public static function authenticate($userEmail, $password) {
        try {
            $hashedPassword = md5($password);
            $query = "SELECT rol FROM users WHERE email = :email AND password = :password";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':email', $userEmail);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                $rol = $stmt->fetch(PDO::FETCH_ASSOC);
                return $rol['rol'];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public static function register($userName, $userSurnames, $userEmail, $userPassword) {
        try {
            $validRegister = false;
            $query = "SELECT * FROM users WHERE email LIKE :email";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':email', $userEmail);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                return false; 
            } else {
                $query = "INSERT INTO users(email, name, surnames, rol, password) VALUES (:email, :name, :surnames, :rol, :password)";
                $stmt = self::getConnection()->prepare($query);
                $stmt->bindParam(':email', $userEmail);
                $stmt->bindParam(':name', $userName);
                $stmt->bindParam(':surnames', $userSurnames);
                $stmt->bindParam(':password', $userPassword);
                $role = 'customer';
                $stmt->bindParam(':rol', $role);
                $stmt->execute();
                return $stmt;
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }   
   }

   public static function showCustomers($search) {
        try {
            $search = '%' . $search . '%';
            $query = "SELECT email, phone, name, surnames, address FROM users WHERE (name::text LIKE :search OR surnames::text LIKE :search OR phone::text LIKE :search OR email::text LIKE :search OR address::text LIKE :search) AND rol LIKE 'user'";
            $customers = self::getConnection()->prepare($query);
            $customers->bindParam(':search', $search, PDO::PARAM_STR);
            $customers->execute();
            $fetchedCustomers = $customers->fetchAll(PDO::FETCH_ASSOC);

            return $fetchedCustomers;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
}
?>