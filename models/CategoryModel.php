<?php
    require_once(__DIR__."/../config/Database.php");
    class CategoryModel extends Database {
        private $code;
        private $name;

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

        public function __construct($code,$name){
            $this->code = $code;
            $this->name = $name;
        }

        public function listCategories(){
            try{
                $query = "SELECT * FROM categories";
                $categories = self::getConnection()->prepare($query);
                $categories->execute();
                $fetchedCategories = $categories->fetchAll(PDO::FETCH_ASSOC);

                foreach($fetchedCategories as $fetchedCategory){
                    $category = new CategoryModel($fetchedCategory["code"],$fetchedCategory["name"]);
                    echo $category->getCode();
                    echo $category->getName();
                }
            }catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
        }
    }
?>