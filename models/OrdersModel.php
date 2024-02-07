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
            echo"<meta http-equiv='refresh' content='0.1;index.php?page=Orders&action=showAdminOrders'>";
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function obtainMethods() {
        try{
            $query = "SELECT * FROM shippingMethod";
            $categories = self::getConnection()->prepare($query);
            $categories->execute();
            $rows = $categories->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function searchCart($user) {
        try {
            $defaultStatus = "cart";
            $query = "SELECT id FROM shopping WHERE useremail = :useremail AND status = :status";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':useremail', $user, PDO::PARAM_STR);
            $stmt->bindParam(':status', $defaultStatus, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function searchInCart($shopId, $product, $size) {
        try {
            $cartQuery = "SELECT amount FROM inCart WHERE shop = :shop AND product = :product AND size = :size";
            $Cartstmt = self::getConnection()->prepare($cartQuery);
            $Cartstmt->bindParam(':shop', $shopId, PDO::PARAM_INT);
            $Cartstmt->bindParam(':product', $product, PDO::PARAM_STR);
            $Cartstmt->bindParam(':size', $size, PDO::PARAM_STR);
            $Cartstmt->execute();
            return $Cartstmt; 
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function getProductAmount($code) {
        try {
            $query = "SELECT amount FROM inCart WHERE product = :product";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':product', $code, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $suma = 0;
            foreach ($result as $row) {
                $suma += $row['amount'];
            }
            return $suma;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function addToCart($size, $product, $stock, $user) { 
        try {
            $stmt = self::searchCart($user);
            $currentAmount = self::getProductAmount($product);
            if (intval($stock) != intval($currentAmount)) { 
                if($stmt->rowCount() == 0) {
                    $defaultStatus = 'cart';
                    $insertQuery = "INSERT INTO shopping (useremail, status) VALUES (:useremail, :status)";
                    $stmtI = self::getConnection()->prepare($insertQuery);
                    $stmtI->bindParam(':useremail', $user, PDO::PARAM_STR);
                    $stmtI->bindParam(':status', $defaultStatus, PDO::PARAM_STR);
                    $stmtI->execute();  
                    $stmt = self::searchCart($user);  
                }
                $id = $stmt->fetchColumn();
                $Cartstmt = self::searchInCart($id, $product, $size);
                if($Cartstmt->rowCount() == 0) {
                    $defaultAmount = 1;
                    $insertQuery = "INSERT INTO inCart (shop, product, amount, size) VALUES (:shop, :product, :amount, :size)";
                    $stmtI = self::getConnection()->prepare($insertQuery);
                    $stmtI->bindParam(':shop', $id, PDO::PARAM_INT);
                    $stmtI->bindParam(':product', $product, PDO::PARAM_STR);
                    $stmtI->bindParam(':amount', $defaultAmount, PDO::PARAM_INT);
                    $stmtI->bindParam(':size', $size, PDO::PARAM_STR);
                    $stmtI->execute();
                } else {
                    $amount = $Cartstmt->fetchColumn();
                    $newAmount = $amount + 1;
                    $updateQuery = "UPDATE inCart SET amount = :amount WHERE shop = :shop AND product = :product AND size = :size";
                    $stmtU = self::getConnection()->prepare($updateQuery);
                    $stmtU->bindParam(':shop', $id, PDO::PARAM_INT);
                    $stmtU->bindParam(':product', $product, PDO::PARAM_STR);
                    $stmtU->bindParam(':amount', $newAmount, PDO::PARAM_INT);
                    $stmtU->bindParam(':size', $size, PDO::PARAM_STR);
                    $stmtU->execute();
                }
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function addIfCartNotExists($user) {
        try {
            $defaultStatus = "cart";
            $query = "SELECT * FROM shopping WHERE useremail = :useremail AND status = :status";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':useremail', $user, PDO::PARAM_STR);
            $stmt->bindParam(':status', $defaultStatus, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount() == 0) {
                $insertQuery = "INSERT INTO shopping (useremail, status) VALUES (:useremail, :status)";
                $stmtI = self::getConnection()->prepare($insertQuery);
                $stmtI->bindParam(':useremail', $user, PDO::PARAM_STR);
                $stmtI->bindParam(':status', $defaultStatus, PDO::PARAM_STR);
                $stmtI->execute();
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function addToCartFromLocalStorage($products, $user) {
        try {
            self::addIfCartNotExists($user);
            $defaultStatus = "cart";
            $query = "SELECT id FROM shopping WHERE useremail = :useremail AND status = :status";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':useremail', $user, PDO::PARAM_STR);
            $stmt->bindParam(':status', $defaultStatus, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $result['id'];
            $deleteQuery = "DELETE FROM inCart WHERE shop = :shop";
            $stmtD = self::getConnection()->prepare($deleteQuery);
            $stmtD->bindParam(':shop', $id, PDO::PARAM_INT);
            $stmtD->execute();
            foreach($products['productsArray'] as $product) {
                $queryI = "INSERT INTO inCart (product, amount, size, shop) VALUES (:product, :amount, :size, :shop)";
                $stmtI = self::getConnection()->prepare($queryI);
                $stmtI->bindParam(':product',$product['code'] , PDO::PARAM_STR);
                $stmtI->bindParam(':amount', $product['amount'], PDO::PARAM_INT);
                $stmtI->bindParam(':size', $product['size'], PDO::PARAM_STR);
                $stmtI->bindParam(':shop', $id, PDO::PARAM_INT);
                $stmtI->execute();
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function getProductsInfoFromCart() {
        $stmtCart = self::searchCart($_SESSION['email']);
        $id = $stmtCart->fetchColumn();
        try {
            $query = "SELECT product, amount FROM inCart WHERE shop = :shop";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':shop', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function createProductsArray($user) {
        $stmt = self::searchCart($user);
        if($stmt->rowCount() > 0) {
            $id = $stmt->fetchColumn();
            try {
                $query = "SELECT product code, size size, amount amount FROM inCart WHERE shop = :shop ORDER BY size";
                $stmt = self::getConnection()->prepare($query);
                $stmt->bindParam(':shop', $id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $productsArray = ["productsArray" => []];
                foreach ($result as $product) {
                    $productsArray['productsArray'][] = [
                        'code' => $product['code'],
                        'size' => $product['size'],
                        'amount' => $product['amount'],
                    ];
                }
                return $productsArray;
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
        } else {
            return null;
        }
    }
    public static function plusTheProductToCart($user, $code, $stock, $cant, $size) {
        $stmt = self::searchCart($user);
        if($stmt->rowCount() > 0) {
            $id = $stmt->fetchColumn();
            $currentAmount = self::getProductAmount($code);
            if(($currentAmount + 1) <= $stock) {
                try {
                    $cant += 1;
                    $query = "UPDATE inCart SET amount = :amount WHERE shop = :shop AND product = :product AND size = :size";
                    $stmt = self::getConnection()->prepare($query);
                    $stmt->bindParam(':amount', $cant, PDO::PARAM_INT);
                    $stmt->bindParam(':shop', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':product', $code, PDO::PARAM_STR);
                    $stmt->bindParam(':size', $size, PDO::PARAM_STR);
                    $stmt->execute();
                } catch (PDOException $e) {
                    error_log("Error: " . $e->getMessage());
                    throw new Exception("Database error: " . $e->getMessage());
                }
            }
        }
    }
    public static function minusTheProductToCart($user, $code, $stock, $cant, $size) {
        $stmt = self::searchCart($user);
        if($stmt->rowCount() > 0) {
            $id = $stmt->fetchColumn();
            if($cant != 1) {
                try {
                    $cant -= 1;
                    $query = "UPDATE inCart SET amount = :amount WHERE shop = :shop AND product = :product AND size = :size";
                    $stmt = self::getConnection()->prepare($query);
                    $stmt->bindParam(':amount', $cant, PDO::PARAM_INT);
                    $stmt->bindParam(':shop', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':product', $code, PDO::PARAM_STR);
                    $stmt->bindParam(':size', $size, PDO::PARAM_STR);
                    $stmt->execute();
                } catch (PDOException $e) {
                    error_log("Error: " . $e->getMessage());
                    throw new Exception("Database error: " . $e->getMessage());
                }
            }
        }
    }
    public static function deleteTheProductFromCart($user, $code, $stock, $size) {
        $stmt = self::searchCart($user);
        if($stmt->rowCount() > 0) {
            $id = $stmt->fetchColumn();
            try {
                $query = "DELETE FROM inCart WHERE shop = :shop AND product = :product AND size = :size";
                $stmt = self::getConnection()->prepare($query);
                $stmt->bindParam(':shop', $id, PDO::PARAM_INT);
                $stmt->bindParam(':product', $code, PDO::PARAM_STR);
                $stmt->bindParam(':size', $size, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
                throw new Exception("Database error: " . $e->getMessage());
            }
        }
    }
    public static function getAllPromoCodes() {
        try {
            $actualDate = sprintf('%04d-%02d-%02d', date('Y'), date('m'), date('d'));
            $query = "SELECT code, discount FROM discountcodes WHERE dateexpiration >= :dateexpiration";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':dateexpiration', $actualDate, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function createProductsCartTable($detailsCart) {
        require_once(__DIR__.'/../models/ProductModel.php');
        $htmlTable = "";
        foreach($detailsCart['productsArray'] as $product) {
            $info = ProductModel::getProductInfoForCart($product['code']);
            if($info[0]['image'] == null) {
                $info[0]['image'] = "views/assets/images/products/productImage.png";
            }
            $totalAmount = $info[0]['price'] * number_format($product['amount'], 2, '.', '');
            $htmlTable = $htmlTable . 
            "<tr>" .
            "<td>" . 
            "<div><img src='". $info[0]['image'] ."'></div>" . 
            "<div><h3>". $info[0]['name'] ."</h3><div>". $product['size'] ."</div></div>" .
            "<div>". $info[0]['description'] ."</div>" .
            "<div><button class='deleteButton' codeId='". $product['code'] ."' size='". $product['size'] ."' cant='". $product['amount'] ."' stock='". $info[0]['stock'] ."'>Borrar</button>" .
            "</td>" .
            "<td>" .
            "<div><button class='minusButton' codeId='". $product['code'] ."' size='". $product['size'] ."' cant='". $product['amount'] ."' stock='". $info[0]['stock'] ."'>-</button><div>". $product['amount'] ."</div><button class='plusButton' codeId='". $product['code'] ."' size='". $product['size'] ."' cant='". $product['amount'] ."' stock='". $info[0]['stock'] ."'>+</button></div>" .
            "</td>" .
            "<td>" .
            "<div>$" . $info[0]['price'] . "</div>" .
            "</td>" .
            "<td>" .
            "<div class='valueItem'>$". number_format($totalAmount, 2, '.', '') ."</div>" .
            "</td>" .
            "</tr>";
        }
        return $htmlTable;
    }
}
?>