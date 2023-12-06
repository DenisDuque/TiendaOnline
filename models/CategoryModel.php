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

        public static function listCategories() {
            try{
                $query = "SELECT * FROM categories";
                $categories = self::getConnection()->prepare($query);
                $categories->execute();
                $fetchedCategories = $categories->fetchAll(PDO::FETCH_ASSOC);
                foreach($fetchedCategories as $fetchedCategory){
                    $category = new CategoryModel($fetchedCategory["code"],$fetchedCategory["name"]);
                    $code = $category->getCode();
                    $name = $category->getName();

                    $query = "SELECT * FROM products WHERE codecategory LIKE :code";
                    $countProducts = self::getConnection()->prepare($query);
                    $countProducts->bindParam(':code', $code, PDO::PARAM_STR);
                    $countProducts->execute();
                    $numProducts = $countProducts->rowCount();

                    echo 
                        '<div class="categoryComponent">
                                <h5 class="categoryName">'.$name.'</h5>
                                <p class="categoryCount">Products: '.$numProducts.'</p>
                                <input class="products" type="hidden" value="NI001NIK,NI002NIK,NI003NIK">
                                <input class="status" type="hidden" value="Enabled">
                                <button type="button" class="editBtn" id="'.$code.'"><img src="views/assets/images/utils/edit.png" alt="Edit"></button>
                        </div>
                    ';

                }
                return $fetchedCategories;
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
        }
    }
?>