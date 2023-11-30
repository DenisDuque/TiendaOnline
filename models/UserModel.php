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
        try {
            $hashedPassword = md5($password);
            $query = "SELECT rol FROM users WHERE email = :email AND password = :password";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':email', $userEmail);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                $rol = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $rol['rol'];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function register($userName, $userSurnames, $userEmail, $userPassword) {
        try {
            $validRegister = false;
            $query = "SELECT * FROM users WHERE email LIKE :email";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':email', $userEmail);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                return false; 
            } else {
                $query = "INSERT INTO users(email, name, surnames, rol) VALUES (:email, :name, :surnames, :rol)";
                $stmt = self::getConnection()->prepare($query);
                $stmt->bindParam(':email', $userEmail);
                $stmt->bindParam(':name', $userName);
                $stmt->bindParam(':surnames', $userSurnames);
                //Borrar admin despues para crear el administrador por primera vez!!!! (cambiar por customer).
                $role = 'admin';
                $stmt->bindParam(':rol', $role);
                $stmt->execute();
                return $stmt;
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }   
   }
}
?>