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
        $this->id = (string) $id;
        $this->user = $user;
        $this->price = (string) $price;
        $this->status = (string) $status;
        $this->date = (string) $date;
        $this->sentDate = (string) $sentDate;
    }

    public static function getOrders($search) {
        try {
            $badStatus='cart';
            if($search != null) {
                $query = "SELECT * FROM shopping 
                            WHERE (id::text LIKE :search OR useremail::text LIKE :search 
                            OR price::text LIKE :search OR status::text LIKE :search 
                            OR datepurchase::text LIKE :search OR dateend::text LIKE :search) AND status::text NOT LIKE :status";
                            $stmt = self::getConnection()->prepare($query);
                            $stmt->bindParam(':search', $search);
                            $stmt->bindParam(':status', $badStatus);
            } else {
                $query = "SELECT * FROM shopping 
                            WHERE status::text NOT LIKE :status";
                            $stmt = self::getConnection()->prepare($query);
                            $stmt->bindParam(':status', $badStatus);
            }
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $Orders = [];
            foreach($rows as $row) {
                $order = new OrdersModel(
                    $row['id'],
                    $row['useremail'],
                    $row['price'],
                    $row['status'],
                    $row['datepurchase'],
                    $row['dateend']
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
        try {
            $query = "SELECT product FROM inCart WHERE shop = :shop";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':shop', $order);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $products = array_map(function($item) {
                return $item['product'];
            }, $result);
            return $products;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
}
?>