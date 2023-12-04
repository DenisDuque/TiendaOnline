<?php
require_once(__DIR__.'/../config/Database.php');
class OrdersModel extends Database {
    private $id;
    private $user;
    private $price; //Puede ser null
    private $status;
    private $date; //Puede ser null
    private $sentDate; //Puede ser null

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setUser($user) {
        $this->user = $user;
    } 

    public function getUser() {
        return $this->user;
    }
    
    public function setPrice($price) {
        $this->price = $price;
    } 

    public function getPrice() {
        return $this->price;
    }

    public function setStatus($status) {
        $this->status = $status;
    } 

    public function getStatus() {
        return $this->status;
    }

    public function setDate($date) {
        $this->date = $date;
    } 

    public function getDate() {
        return $this->date;
    }

    public function setSentDate($sentDate) {
        $this->sentDate = $sentDate;
    } 

    public function getSentDate() {
        return $this->sentDate;
    }

    
    public function __construct($id,$user,$price = null,$status,$date = null,$sentDate = null){
        $this->id = $id;
        $this->user = $user;
        $this->price = $price;
        $this->status = $status;
        $this->date = $date;
        $this->sentDate = $sentDate;
    }

    public static function getOrders() {
        try {
            $query = "SELECT * FROM shopping WHERE ";
            $stmt = self::getConnection()->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $Orders = [];
            foreach($rows as $row) {
                $order = new OrdersModel(
                    $row['id'],
                    $row['userEmail'],
                    $row['price'],
                    $row['status'],
                    $row['datePurchase'],
                    $row['dateEnd']
                );
                $Orders[] = $order;
            }
            return $Orders;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function getMyProducts($order) {
        require_once(__DIR__.'/ProductModel.php');
        try {
            $query = "SELECT product, amount FROM inCart WHERE shop = :shop";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':shop', $order);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
}
?>