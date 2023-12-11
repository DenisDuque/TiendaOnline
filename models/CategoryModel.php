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
                $allCategories = [];
                foreach ($rows as $row) {
                    $category = new CategoryModel(
                        $row['code'],
                        $row['name'],
                        $row['status']
                    );
                    $allCategories[] = $category;
                }
        
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
                $names[] = "";
                foreach($rows as $row) {
                    $names[] = $row["name"];
                }
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
            return $names;
        }

        public static function getCategory($code){
            try {
                echo $code;
                $query = "SELECT * FROM categories WHERE code = :codigo";
                $stmt = self::getConnection()->prepare($query);
                $stmt->bindParam(':codigo', $code, PDO::PARAM_INT);
                $stmt->execute();
                $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
                $category = $stmt[0];
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
            return $category;
        }
    }
?>