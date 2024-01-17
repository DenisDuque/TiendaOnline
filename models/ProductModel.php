<?php
require_once(__DIR__.'/../config/Database.php');
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
    private $status;
    private $image = [
        "lateral" => "",
        "top" => "",
        "bottom" => ""
    ];

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

    public function setSold($sold) {
        $this->sold = $sold;
    } 

    public function getSold() {
        return $this->sold;
    }

    public function setOutstanding($outstanding) {
        $this->outstanding = $outstanding;
    } 

    public function getOutstanding() {
        return $this->outstanding;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getImage($side) {
        return $this->image[$side];
    }

    public function getImagesArray() {
        return $this->image;
    }

    public function __construct($code,$category,$name,$price,$sold,$stock,$status, $size){
        $this->code = $code;
        $this->category = $category;
        $this->name = $name;
        $this->price = $price;
        $this->sold = $sold;
        $this->stock = $stock;
        $this->status = $status;
        $this->size = $size;
    }

    public static function getProductWithCode(){
        try {
            $code = isset($_GET['code']) ? $_GET['code'] : 'za123-za';
            $query = "SELECT * FROM products WHERE code = :code";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':code', $code, PDO::PARAM_STR);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            $product["img"] = self::getProductImage("lateralperspective",$code);
            return $product;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    
    public static function generateCode($name, $category){
        //Dos primeras letras categoria--numero 3 cifras--Tres primeras letras producto
        try {
            $query = "SELECT * FROM products WHERE category LIKE :category";
            $categoryCount = self::getConnection()->prepare($query);
            $categoryCount->bindParam(':category', $category, PDO::PARAM_STR);
            $categoryCount->execute();
            $numId = $categoryCount->rowCount();
            $numId += 1;
            $numId = (string) $numId;

            $query = "SELECT name FROM categories WHERE code LIKE :code";
            $categoryName = self::getConnection()->prepare($query);
            $categoryName->bindParam(':code', $category, PDO::PARAM_STR);
            $categoryName->execute();
            $catName = $categoryName->fetchAll(PDO::FETCH_NUM);
            $catName = $categoryName[0][0];

            $catName = strtoupper($catName);
            $catName = str_split($catName);

            $name = strtoupper($name);
            $name = str_split($name);

            for($i = 0; $i<3; $i++) {
                if(strlen($numId) < 3) {
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

    public static function getAllProducts() {
        try {
            $query = "SELECT code, codecategory, name, price, sold, stock, status, size FROM products";
            $stmt = self::getConnection()->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $Products = array_map(function($row) {
                return new ProductModel(
                    $row['code'],
                    $row['codecategory'],
                    $row['name'],
                    $row['price'],
                    $row['sold'],
                    $row['stock'],
                    $row['status'],
                    $row['size']
                );
            }, $rows);
            
            return $Products;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public static function getProductsWhere($condition) {
    try {
        // Modificar la consulta SQL para incluir la condición en el nombre del producto
        $query = "SELECT code, codecategory, name, price, sold, stock, status, size FROM products WHERE name LIKE :condition OR name = :condition";

        $stmt = self::getConnection()->prepare($query);
        $search = '%' . $condition . '%';
        $stmt->bindValue(':condition', $search, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $Products = array_map(function($row) {
            return new ProductModel(
                $row['code'],
                $row['codecategory'],
                $row['name'],
                $row['price'],
                $row['sold'],
                $row['stock'],
                $row['status'],
                $row['size']
            );
        }, $rows);

        // Devolver los datos en formato JSON
        return $Products;
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
        // Devolver un mensaje de error en formato JSON
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
}
    

    public static function getTopProducts($limit = 10) {
        try {
            $query = "SELECT code, codecategory, name, price, sold, stock, status, size FROM products ORDER BY sold DESC LIMIT :limit";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
    
            $topProducts = array_map(function($row) {
                return new ProductModel(
                    $row['code'],
                    $row['codecategory'],
                    $row['name'],
                    $row['price'],
                    $row['sold'],
                    $row['stock'],
                    $row['status'],
                    $row['size']
                );
            }, $stmt->fetchAll(PDO::FETCH_ASSOC));
            
            return $topProducts;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    

    public static function getProductImage($perspective, $product) {
        try {
            $query = "SELECT route FROM images WHERE perspectives LIKE :perspectives AND product = :product";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':perspectives', $perspective);
            $stmt->bindParam(':product', $product);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($result)) {
                $img = array_map(function($item) {
                    return $item['route'];
                }, $result);
                return $img[0];
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function getCategoryProductId($category) {
        try {
            $query = "SELECT code FROM products WHERE codeCategory = :codeCategory";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':codeCategory', $category);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $products = array_map(function($item) {
                return $item['code'];
            }, $result);
            return $products;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public static function createProduct($name, $price, $stock, $status, $category, $sideView, $aboveView, $bottomView) {
        try{
            $query = "SELECT * FROM products WHERE name = :name;";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':name', $name, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows) >= 1){
                // avisar de que ya hay un producto con el mismo nombre
                echo "nombre ya en uso e otro producto";
            }else{
                // Realizar la inserción
                $insertQuery = "INSERT INTO products (name, price, stock, status, category, sideView, aboveView, bottomView) VALUES (:name, :price, :stock, :status, :category, :sideView, :aboveView, :bottomView);";
                $insertStatement = self::getConnection()->prepare($insertQuery);
                $insertStatement->bindParam(':name', $name, PDO::PARAM_STR);
                $insertStatement->bindParam(':price', $price, PDO::PARAM_INT);
                $insertStatement->bindParam(':stock', $stock, PDO::PARAM_INT);
                $insertStatement->bindParam(':status', $status, PDO::PARAM_INT);
                $insertStatement->bindParam(':category', $category, PDO::PARAM_STR);
                $insertStatement->bindParam(':sideView', $sideView, PDO::PARAM_STR);
                $insertStatement->bindParam(':aboveView', $aboveView, PDO::PARAM_STR);
                $insertStatement->bindParam(':bottomView', $bottomView, PDO::PARAM_STR);
                $insertStatement->execute();
                echo "Producto agregado correctamente";
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function insertOrUpdateImage($image, $id, $perspective) {
        if($image != NULL) {
            try {
                $query = "SELECT * FROM images WHERE product = :product AND perspectives = :perspectives";
                $stmt = self::getConnection()->prepare($query);
                $stmt->bindParam(':product', $id, PDO::PARAM_STR);
                $stmt->bindParam(':perspectives', $perspective, PDO::PARAM_STR);
                $stmt->execute();
                $numRows = $stmt->rowCount();
                if($numRows > 0) {
                    $updateQuery = "UPDATE images
                    SET route = :route
                    WHERE product = :product AND perspectives = :perspectives";
                    $stmt = self::getConnection()->prepare($updateQuery);
                    $stmt->bindParam(':route', $image, PDO::PARAM_STR);
                    $stmt->bindParam(':perspectives', $perspective, PDO::PARAM_STR);
                    $stmt->bindParam(':product', $id, PDO::PARAM_STR);
                    $stmt->execute();
                } else {
                    $insertQuery = "INSERT INTO images (product, route, perspectives) VALUES (:product, :route, :perspectives)";
                    $stmt = self::getConnection()->prepare($insertQuery);
                    $stmt->bindParam(':product', $id, PDO::PARAM_STR);
                    $stmt->bindParam(':route', $image, PDO::PARAM_STR);
                    $stmt->bindParam(':perspectives', $perspective, PDO::PARAM_STR);   
                    $stmt->execute();             
                }
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
        }
    }
    public static function editProduct($id, $name, $price, $stock, $status, $category, $sideView, $aboveView, $bottomView, $View3D, $sizes) {
        try {
            $updateQuery = "UPDATE products 
            SET name = :name, price = :price, stock = :stock, status = :status, codecategory = :category, size = :sizes
            WHERE code = :id";
            $sizesArray = explode(',', $sizes); 
            $sizeString = "{" . implode(",", $sizesArray) . "}";
            $updateStatement = self::getConnection()->prepare($updateQuery);
            $updateStatement->bindParam(':id', $id, PDO::PARAM_STR);
            $updateStatement->bindParam(':name', $name, PDO::PARAM_STR);
            $updateStatement->bindParam(':price', $price, PDO::PARAM_INT);
            $updateStatement->bindParam(':stock', $stock, PDO::PARAM_INT);
            $updateStatement->bindParam(':status', $status, PDO::PARAM_INT);
            $updateStatement->bindParam(':category', $category, PDO::PARAM_STR);
            $updateStatement->bindParam(':sizes', $sizeString);
            $result = $updateStatement->execute();
            if ($result) {
                echo "Category updated correctly";
            } else {
                echo "Error";
            }
            self::insertOrUpdateImage($sideView, $id, "lateralperspective");
            self::insertOrUpdateImage($aboveView, $id, "aboveperspective");
            self::insertOrUpdateImage($bottomView, $id, "belowperspective");
            self::insertOrUpdateImage($View3D, $id, "3dmodel");
            echo"<meta http-equiv='refresh' content='0.1;index.php?page=Product&action=showAdminProduct'>";
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public static function inWishlist(){
        $query = "SELECT * FROM wishlist WHERE useremail LIKE :user AND productcode LIKE :product";
        $stmt = self::getConnection()->prepare($query);
        $stmt->bindParam(':user', $_SESSION['email']);
        $stmt->bindParam(':product', $_GET['code']);
    }

    public static function addToWishList(){
        try {
            $query = "INSERT INTO wishlist (useremail,productcode) VALUES (:user, :product)";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':user', $_SESSION['email']);
            $stmt->bindParam(':user', $_GET['product']);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
}
?>