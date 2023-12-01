<?php
include(__DIR__.'/../config/Database.php');
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
    
    public static function generateCode($name, $category){
        //Dos primeras letras categoria--numero 3 cifras--Tres primeras letras producto
        try {
            $query = "SELECT * FROM products WHERE category LIKE :category";
            $categoryCount = self::$conn->prepare($query);
            $categoryCount ->bindParam(':category', $category, PDO::PARAM_STR);
            $categoryCount ->execute();
            $numId = $categoryCount ->rowCount();
            $numId+= 1;
            $numId = (string) $numId;

            $query = "SELECT name FROM categories WHERE code LIKE :code";
            $categoryName = self::$conn->prepare($query);
            $categoryName->bindParam(':code', $category, PDO::PARAM_STR);
            $categoryName->execute();
            $catName = $categoryName->fetchAll(PDO::FETCH_NUM);
            $catName = $categoryName[0][0];

            $catName = str_split($catName);
            $name = str_split($name);

            for($i = 0; $i<3; $i++){
                if(strlen($numId)<3){
                    $numId = "0".$numId;
                }
                
            }

            $code = $catName[0].$catName[1].$numId.$name[0].$name[1].$name[2];

            return $code;
            
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }


    }

    public static function getTopProducts($limit = 10) {
        try {
            $query = "SELECT code, codecategory, name, price, sold, stock FROM products ORDER BY sold DESC LIMIT :limit";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
    
            $topProducts = [];
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            foreach ($rows as $row) {
                $product = new ProductModel(
                    $row['code'],
                    $row['codecategory'],
                    $row['name'],
                    $row['price'],
                    $row['sold'],
                    $row['stock']
                );
                $topProducts[] = $product;
            }
    
            return $topProducts;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    

    public static function getProductImage($perspective, $product) {
        try {
            $query = "SELECT route FROM images WHERE perspective = :perspective AND product = :product";
            $stmt = self::getConnection()->prepare($query);
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