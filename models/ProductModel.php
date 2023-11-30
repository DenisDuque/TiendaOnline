<?php
include("/config/Database.php");
class ProductModel extends Database {
    private $code;
    private $name;
    private $description;
    private $category;
    private $price;
    private $stock;
    private $size;
    private $outstanding;
    private $sold;

    public function setCode($code) {
        $this->code = $code;
    }

    public function getCode() {
        return $this->code;
    }

    public function setName($name) {
        $this->name = $name;
    } 

    public function getName() {
        return $this->name;
    }
    
    public function setDescription($description) {
        $this->description = $description;
    } 

    public function getDescription() {
        return $this->description;
    }

    public function setCategory($category) {
        $this->category = $category;
    } 

    public function getCategory() {
        return $this->category;
    }

    public function setPrice($price) {
        $this->price = $price;
    } 

    public function getPrice() {
        return $this->price;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    } 

    public function getStock() {
        return $this->stock;
    }

    public function setSize($size) {
        $this->size = $size;
    } 

    public function getSize() {
        return $this->size;
    }

    public function setOutstanding($outstanding) {
        $this->outstanding = $outstanding;
    } 

    public function getOutstanding() {
        return $this->outstanding;
    }

    public function setSold($sold) {
        $this->sold = $sold;
    } 

    public function getSold() {
        return $this->sold;
    }
    public function __construct($code,$category,$name,$price,$sold,$stock){
        $this->code = $code;
        $this->category = $category;
        $this->name = $name;
        $this->price = $price;
        $this->sold = $sold;
        $this->stock = $stock;
    }
    public function getTopProducts($conn, $limit = 10) {
        try {
            $query = "SELECT code, category, name, price, sold, stock FROM products ORDER BY sold DESC LIMIT :limit";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
    
            $topProducts = [];
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            foreach ($rows as $row) {
                $product = new ProductModel($row['code'],$row['category'],$row['name'],$row['price'],$row['sold'],$row['stock']);                
                $topProducts[] = $product;
            }
            
            return $topProducts;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public static function getProductFromId($id){
        $conn = conection();
        try {
            $query = "SELECT * FROM products WHERE code LIKE '$id'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $product = new ProductModel($result['code'],$result['category'],$result['name'],$result['price'],$result['sold'],$result['stock']);                
            return $product;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }

    }

    public function getProductImage($perspective, $product) {
        $conn = conection();
        try {
            $query = "SELECT route FROM images WHERE perspective = :perspective AND product = :product";
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
}
?>