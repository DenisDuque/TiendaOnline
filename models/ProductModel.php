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
    private $featured;
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

    public function setFeatured($featured) {
        $this->featured = $featured;
    } 

    public function getFeatured() {
        return $this->featured;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getImage($side) {
        return $this->image[$side];
    }

    public function setImagesArray($images) {
        $this->image["lateral"] = $images[0];
        $this->image["top"] = $images[1];
        $this->image["bottom"] = $images[2];
    }

    public function getImagesArray() {
        return $this->image;
    }

    public function __construct($code,$category,$name,$description,$featured,$price,$sold,$stock,$status,$size,$image){
        $this->code = $code;
        $this->category = $category;
        $this->name = $name;
        $this->description = $description;
        $this->featured = $featured;
        $this->price = $price;
        $this->sold = $sold;
        $this->stock = $stock;
        $this->status = $status;
        $this->size = $size;
        $this->image["lateral"] = $image;
    }

    public static function getProductWithCode($code){
        try {
            $query = "SELECT * FROM products WHERE code = :code";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':code', $code, PDO::PARAM_STR);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            $product["img"] = self::getProductImage("lateral",$code);
            return $product;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    
    public static function generateCode($name, $category){
        //Dos primeras letras categoria--numero 3 cifras--Tres primeras letras producto
        $categoryNum = intval($category);
        try {
            $query = "SELECT name FROM categories WHERE code = :code";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':code', $categoryNum, PDO::PARAM_INT);
            $stmt->execute();
            $categoryRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $categoryName = $categoryRow['name'];
            $randNum = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $randNumStr = strval($randNum);
            $categoryStr = substr($categoryName, 0, 2);
            $productStr = substr($name, 0, 2);
            return strtolower($categoryStr) . $randNumStr . "-" . strtolower($productStr);
            
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public static function getAllProducts() {
        try {
            $query = "SELECT code, codecategory, name, description, featured, price, sold, stock, status, size FROM products";
            $stmt = self::getConnection()->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $Products = array_map(function($row) {
                return new ProductModel(
                    $row['code'],
                    $row['codecategory'],
                    $row['name'],
                    $row['description'],
                    $row['featured'],
                    $row['price'],
                    $row['sold'],
                    $row['stock'],
                    $row['status'],
                    $row['size'],
                    $row['code']."-Side"
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
        if (isset($_GET['category']) && $_GET['category'] !== "null") {
            $query = "SELECT code, codecategory, name, description, featured, price, sold, stock, status, size FROM products WHERE (name LIKE :condition OR name = :condition) AND codecategory = :category";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindValue(':category', $_GET['category'], PDO::PARAM_INT);
        } else {
            $query = "SELECT code, codecategory, name, description, featured, price, sold, stock, status, size FROM products WHERE name LIKE :condition OR name = :condition";
            $stmt = self::getConnection()->prepare($query);
        }
        
        $search = '%' . $condition . '%';
        $stmt->bindValue(':condition', $search, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $Products = array_map(function($row) {
            return new ProductModel(
                $row['code'],
                $row['codecategory'],
                $row['name'],
                $row['description'],
                $row['featured'],
                $row['price'],
                $row['sold'],
                $row['stock'],
                $row['status'],
                $row['size'],
                $row['code']."-Side"

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

    public static function getFeaturedProducts() {
        try {
            $query = "SELECT code, codecategory, name, description, featured, price, sold, stock, status, size FROM products WHERE featured = true";
            $stmt = self::getConnection()->prepare($query);
            
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $Products = array_map(function($row) {
                return new ProductModel(
                    $row['code'],
                    $row['codecategory'],
                    $row['name'],
                    $row['description'],
                    $row['featured'],
                    $row['price'],
                    $row['sold'],
                    $row['stock'],
                    $row['status'],
                    $row['size'],
                    $row['code']."-Side"
    
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
            $query = "SELECT code, codecategory, name, description, featured, price, sold, stock, status, size FROM products ORDER BY sold DESC LIMIT :limit";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
    
            $topProducts = array_map(function($row) {
                return new ProductModel(
                    $row['code'],
                    $row['codecategory'],
                    $row['name'],
                    $row['description'],
                    $row['featured'],
                    $row['price'],
                    $row['sold'],
                    $row['stock'],
                    $row['status'],
                    $row['size'],
                    $row['code']."-Side"
                );
            }, $stmt->fetchAll(PDO::FETCH_ASSOC));
            
            return $topProducts;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function getTopProductsGraph($limit = 10) {
        try {
            $query = "SELECT code, sold FROM products ORDER BY sold DESC LIMIT :limit";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
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
    public static function createProduct($id, $name, $description, $featured, $price, $stock, $status, $category, $sideView, $aboveView, $bottomView, $View3D, $sizes) {
        try{
            $query = "SELECT * FROM products WHERE code = :code";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':code', $id, PDO::PARAM_STR);
            $stmt->execute();
            $rows = $stmt->rowCount();
            if($rows >= 1){
                echo "Ya existe este producto.";
            }else{
                // Realizar la inserción
                $sizesArray = explode(',', $sizes); 
                $sizeString = "{" . implode(",", $sizesArray) . "}";
                $insertQuery = "INSERT INTO products (code, name, description, featured, price, stock, status, codecategory, size, sold) VALUES (:code, :name, :description, :featured, :price, :stock, :status, :codecategory, :size, 0);";
                $insertStatement = self::getConnection()->prepare($insertQuery);
                $insertStatement->bindParam(':code', $id, PDO::PARAM_STR);
                $insertStatement->bindParam(':name', $name, PDO::PARAM_STR);
                $insertStatement->bindParam(':description', $description, PDO::PARAM_STR);
                $insertStatement->bindParam(':featured', $featured, PDO::PARAM_BOOL);
                $insertStatement->bindParam(':price', $price, PDO::PARAM_INT);
                $insertStatement->bindParam(':stock', $stock, PDO::PARAM_INT);
                $insertStatement->bindParam(':status', $status, PDO::PARAM_STR);
                $insertStatement->bindParam(':codecategory', $category, PDO::PARAM_STR);
                $insertStatement->bindParam(':size', $sizeString, PDO::PARAM_STR);
                $result = $insertStatement->execute();
                if ($result) {
                    echo "Product added correctly";
                } else {
                    echo "Error";
                }
                self::insertOrUpdateImage($sideView, $id, "lateralperspective");
                self::insertOrUpdateImage($aboveView, $id, "aboveperspective");
                self::insertOrUpdateImage($bottomView, $id, "belowperspective");
                self::insertOrUpdateImage($View3D, $id, "3dmodel");
                echo"<meta http-equiv='refresh' content='0.1;index.php?page=Product&action=showAdminProduct'>";
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function editProduct($id, $name, $description, $featured, $price, $stock, $status, $category, $sideView, $aboveView, $bottomView, $View3D, $sizes) {
        try {
            $updateQuery = "UPDATE products 
            SET name = :name, description = :description, featured = :featured, price = :price, stock = :stock, status = :status, codecategory = :category, size = :sizes
            WHERE code = :id";
            $sizesArray = explode(',', $sizes); 
            $sizeString = "{" . implode(",", $sizesArray) . "}";
            $updateStatement = self::getConnection()->prepare($updateQuery);
            $updateStatement->bindParam(':id', $id, PDO::PARAM_STR);
            $updateStatement->bindParam(':name', $name, PDO::PARAM_STR);
            $updateStatement->bindParam(':description', $description, PDO::PARAM_STR);
            $updateStatement->bindParam(':featured', $featured, PDO::PARAM_BOOL);
            $updateStatement->bindParam(':price', $price, PDO::PARAM_INT);
            $updateStatement->bindParam(':stock', $stock, PDO::PARAM_INT);
            $updateStatement->bindParam(':status', $status, PDO::PARAM_INT);
            $updateStatement->bindParam(':category', $category, PDO::PARAM_STR);
            $updateStatement->bindParam(':sizes', $sizeString);
            $result = $updateStatement->execute();
            if ($result) {
                echo "Product updated correctly";
            } else {
                echo "Error";
            }
            self::insertOrUpdateImage($sideView, $id, "lateralperspective");
            self::insertOrUpdateImage($aboveView, $id, "aboveperspective");
            self::insertOrUpdateImage($bottomView, $id, "belowperspective");
            self::insertOrUpdateImage($View3D, $id, "3dmodel");
            //echo"<meta http-equiv='refresh' content='0.1;index.php?page=Product&action=showAdminProduct'>";
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function getProductInfoForCart($code) {
        try {
            $query = "SELECT * FROM products WHERE code = :code";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':code', $code, PDO::PARAM_STR);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $routeImage = self::getProductImage('lateral', $code);
            if (!empty($rows)) {
                $rows[0]['image'] = $routeImage;
            } else {
                $rows[0]['image'] = null;
            }
            return $rows;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public static function inWishList(){
        $exists = false;
        $query = "SELECT * FROM wishlist WHERE useremail = :user AND productcode = :product";
        $stmt = self::getConnection()->prepare($query);
        $stmt->bindParam(':user', $_SESSION['email']);
        $stmt->bindParam(':product', $_GET['code']);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows > 0){
            $exists = true;
        }
        return $exists;
    }


    public static function addToWishList(){
        try {
            $query = "INSERT INTO wishlist (useremail,productcode) VALUES (:user, :product)";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':user', $_SESSION['email']);
            $stmt->bindParam(':product', $_GET['code']);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public static function dropFromWishList(){
        try {
            $query = "DELETE FROM wishlist WHERE useremail = :user AND productcode = :product";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':user', $_SESSION['email']);
            $stmt->bindParam(':product', $_GET['code']);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function getCategoryFromAllProducts() {
        try {
            $query = "SELECT codecategory FROM products";
            $stmt = self::getConnection()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
}
?>