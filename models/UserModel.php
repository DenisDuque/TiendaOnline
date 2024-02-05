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

    public function __construct($email, $phone, $name, $surname, $address, $rol, $image = null){
        $this->email = $email;
        $this->phone = (string) $phone;
        $this->name = $name;
        $this->surname = $surname;
        $this->address = $address;
        $this->rol = $rol;
        $this->image = $image;
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
            $query = "SELECT rol, password FROM users WHERE LOWER(email) LIKE LOWER(:email)";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindValue(':email', $userEmail);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashedPasswordFromDatabase = $user['password'];
                if (password_verify($password, $hashedPasswordFromDatabase)) {
                    return $user['rol'];
                } else {
                    //echo('Contraseña incorrecta');
                }
            } else {
                echo('Usuario no encontrado');
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
        return null;
    }    
    

    public static function register($userName, $userSurnames, $userEmail, $userPassword) {
        try {
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
            if($search != null) {
                $search = '%' . $search . '%';
                $query = "SELECT * FROM users WHERE (name::text LIKE :search OR surnames::text LIKE :search OR phone::text LIKE :search OR email::text LIKE :search OR address::text LIKE :search) AND rol LIKE 'customer'";
                $customers = self::getConnection()->prepare($query);
                $customers->bindParam(':search', $search, PDO::PARAM_STR);
            } else {
                $query = "SELECT * FROM users WHERE rol LIKE 'customer'";
                $customers = self::getConnection()->prepare($query);
            }
            $customers->execute();
            $rows = $customers->fetchAll(PDO::FETCH_ASSOC);
            $users = array_map(function($row) {
                return new UserModel (
                    $row['email'],
                    $row['phone'],
                    $row['name'],
                    $row['surnames'],
                    $row['address'],
                    $row['rol'],
                    $row['image']
                );
            }, $rows);
            
            return $users;
        } 
        catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
        }
    }
    
    public static function getSpecifiedUser($email) {
        try {
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $user = new UserModel(
                $row[0]['email'],
                $row[0]['phone'],
                $row[0]['name'],
                $row[0]['surnames'],
                $row[0]['address'],
                $row[0]['rol'],
                $row[0]['image']
            );
            return $user;
        } 
        catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function insertAdminSignature($user, $route) {
        try {
            $query = "UPDATE users SET signature = :signature WHERE email = :email";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(":email", $user, PDO::PARAM_STR);
            $stmt->bindParam(":signature", $route, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt;
        } 
        catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public static function getUserOrders($email){
        try {
            $query = "SELECT * FROM shopping WHERE useremail = :user";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(":user", $email);
        } 
        catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }

    }
}
?>