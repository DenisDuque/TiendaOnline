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

                echo "<ul>";
                foreach($fetchedCategories as $fetchedCategory){
                    $category = new CategoryModel($fetchedCategory["code"],$fetchedCategory["name"]);
                    $code = $category->getCode();
                    $name = $category->getName();

                    $query = "SELECT * FROM products WHERE codecategory LIKE :code";
                    $countProducts = self::getConnection()->prepare($query);
                    $countProducts->bindParam(':code', $code, PDO::PARAM_STR);
                    $countProducts->execute();
                    $numProducts = $countProducts->rowCount();

                    echo "
                        <li>".$name.$code." Productes amb aquesta categoria: ".$numProducts."<button type='button' class='buttons' id='$code'>Editar</button></li>
                    ";
                }
                
                echo "</ul>";
            }catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
        }
    }
?>