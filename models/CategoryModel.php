<?php
    require_once(__DIR__."/../config/Database.php");
    class CategoryModel extends Database {
        private $code;
        private $name;
        private $status;

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
        public function setStatus($status) {
            $this->status = $status;
        }
        public function getStatus() {
            return $this->status;
        }
        public function __construct($code,$name,$status){
            $this->code = $code;
            $this->name = $name;
            $this->status = $status;
        }

        public static function listCategories($search) {
            try{
                $query = "SELECT * FROM categories";
                $categories = self::getConnection()->prepare($query);
                $categories->execute();
                $rows = $categories->fetchAll(PDO::FETCH_ASSOC);
                $allCategories = array_map(function($row) {
                    return new CategoryModel(
                        $row['code'],
                        $row['name'],
                        $row['status']
                    );
                }, $rows);
        
                return $allCategories;
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
        }

        public static function getProductsFromCategory($category) {
            try {
                $query = "SELECT name FROM products WHERE codecategory LIKE :category";
                $stmt = self::getConnection()->prepare($query);
                $stmt->bindParam(':category', $category, PDO::PARAM_INT);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $names = array_column($rows, 'name');
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
            return $names;
        }

        public static function getCategory($code){
            try {
                $query = "SELECT * FROM categories WHERE code = :codigo";
                $stmt = self::getConnection()->prepare($query);
                $stmt->bindParam(':codigo', $code, PDO::PARAM_INT);
                $stmt->execute();
                $stmt = $stmt->fetch(PDO::FETCH_BOTH);
                $category = $stmt;
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
            return $category;
        }

        public static function createCategory($name, $status) {
            try{
                $query = "SELECT * FROM categories WHERE name = :name;";
                $stmt = self::getConnection()->prepare($query);
                $stmt->bindParam(':name', $name, PDO::PARAM_INT);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($rows > 0){
                    // avisar de que ya hay una categoria con el mismo nombre
                    echo "La categoria ya existe!";
                } else {
                    // Realizar la inserción
                    $insertQuery = "INSERT INTO categories (name, status) VALUES (:name, :status)";
                    $insertStatement = self::getConnection()->prepare($insertQuery);
                    $insertStatement->bindParam(':name', $name, PDO::PARAM_STR);
                    $insertStatement->bindParam(':status', $status, PDO::PARAM_INT);
                    $insertStatement->execute();
                    echo "Categoría agregada correctamente";
                }
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
        }

        public static function editCategory($code, $name, $status) {
            try {
                $codeStr = strval($code);
                $updateQuery = "UPDATE categories SET name = :name, status = :status WHERE code = :code";
                $updateStatement = self::getConnection()->prepare($updateQuery);
                $updateStatement->bindParam(':name', $name, PDO::PARAM_STR);
                $updateStatement->bindParam(':status', $status, PDO::PARAM_INT);
                $updateStatement->bindParam(':code', $codeStr, PDO::PARAM_INT);
        
                if ($updateStatement->execute()) {
                    $rowCount = $updateStatement->rowCount();
                    if ($rowCount > 0) {
                        echo "Categoría actualizada correctamente";
                    } else {
                        // Avisar que la categoría no existe o esta no se ha visto afectada.
                        echo "La categoría no existe en la base de datos. No se puede actualizar.";
                    }
                    
                } else {
                    echo "Error al actualizar la categoria.";
                }
                echo"<meta http-equiv='refresh' content='0.1;index.php?page=Category&action=showAdminCategory'>";
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
        }
    }
?>