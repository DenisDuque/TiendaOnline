<?php
require_once(__DIR__.'/../config/Database.php');
class OrdersModel extends Database {
    private $id;
    private $user;
    private $price; //Puede ser null
    private $status;
    private $date; //Puede ser null
    private $sentDate; //Puede ser null
    private $products;

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

    public function setProducts($products) {
        $this->products = $products;
    } 

    public function getProducts() {
        return $this->products;
    }

    
    public function __construct($id,$user,$price = null,$status,$date = null,$sentDate = null, $products){
        $this->id = (string) $id;
        $this->user = $user;
        $this->price = (string) $price;
        $this->status = (string) $status;
        $this->date = (string) $date;
        $this->sentDate = (string) $sentDate;
        $this->products = $products;
    }

    public static function getOrdersWithDetail($search) {
        try {
            $badStatus='cart';
            if($search != null) {
                $query = "SELECT * FROM (shopping INNER JOIN users
                            ON shopping.useremail = users.email)
                            WHERE (shopping.id::text LIKE :search OR shopping.useremail::text LIKE :search 
                            OR shopping.price::text LIKE :search OR shopping.status::text LIKE :search 
                            OR shopping.datepurchase::text LIKE :search OR shopping.dateend::text LIKE :search) AND status::text NOT LIKE :status";
                $stmt = self::getConnection()->prepare($query);
                $stmt->bindParam(':search', $search);
                $stmt->bindParam(':status', $badStatus);
            } else {
                $query = "SELECT * FROM shopping INNER JOIN users
                            ON shopping.useremail = users.email
                            WHERE status::text NOT LIKE :status";
                            $stmt = self::getConnection()->prepare($query);
                            $stmt->bindParam(':status', $badStatus);
            }
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $Orders = [];
            foreach($rows as $row) {
                $client = new UserModel($row['email'],$row['phone'], $row['name'],$row['surnames'],$row['address'],$row['rol'],$row['image']);
                $products = self::getMyProducts($row['id']);
                $order = new OrdersModel(
                    $row['id'],
                    $client,
                    $row['price'],
                    $row['status'],
                    $row['datepurchase'],
                    $row['dateend'],
                    $products
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
            $query = "SELECT product,amount FROM inCart WHERE shop = :shop";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':shop', $order);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $products = [];
            foreach($result as $product){
                $query = "SELECT name FROM products WHERE code = :code";
                $stmt = self::getConnection()->prepare($query);
                $stmt->bindParam(':code', $product["product"]);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $name = $result[0]["name"];
                $products[$name] = $product["amount"];

                
            }
            return $products;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public static function editOrder($id, $status) {
        try {
            // Realizar la actualización
            $updateQuery = "UPDATE shopping SET status = :status WHERE id = :id";

            $updateStatement = self::getConnection()->prepare($updateQuery);
            $updateStatement->bindParam(':id', $id, PDO::PARAM_STR);
            $updateStatement->bindParam(':status', $status, PDO::PARAM_INT);
            $updateStatement->execute();
            
            if ($updateStatement->rowCount() > 0) {

                echo "Order actualizado correctamente";

            } else {
                echo "La order no se encuentra en la base de datos";
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
}
?>