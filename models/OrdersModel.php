<?php
require_once(__DIR__ . '/../config/Database.php');
require_once __DIR__ . '/../vendor/autoload.php';

class OrdersModel extends Database
{
    private $id;
    private $user;
    private $price; //Puede ser null
    private $status;
    private $date; //Puede ser null
    private $sentDate; //Puede ser null
    private $products;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setSentDate($sentDate)
    {
        $this->sentDate = $sentDate;
    }

    public function getSentDate()
    {
        return $this->sentDate;
    }

    public function setProducts($products)
    {
        $this->products = $products;
    }

    public function getProducts()
    {
        return $this->products;
    }


    public function __construct($id, $user, $price = null, $status, $date = null, $sentDate = null, $products)
    {
        $this->id = (string) $id;
        $this->user = $user;
        $this->price = (string) $price;
        $this->status = (string) $status;
        $this->date = (string) $date;
        $this->sentDate = (string) $sentDate;
        $this->products = $products;
    }

    public static function getOrdersWithDetail($search)
    {
        try {
            $badStatus = 'cart';
            $search = '%' . $search . '%';
            if ($search != null) {
                /*$query = "SELECT * FROM (shopping INNER JOIN users
                            ON shopping.useremail = users.email)
                            WHERE (shopping.id::text LIKE :search OR shopping.useremail::text LIKE :search 
                            OR shopping.price::text LIKE :search OR shopping.status::text LIKE :search 
                            OR shopping.datepurchase::text LIKE :search OR shopping.dateend::text LIKE :search) AND status::text NOT LIKE :status";*/
                $query = "SELECT * FROM shopping INNER JOIN users ON shopping.useremail = users.email WHERE status::text NOT LIKE :status AND shopping.useremail::text LIKE :search";
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
            foreach ($rows as $row) {
                $client = new UserModel($row['email'], $row['phone'], $row['name'], $row['surnames'], $row['address'], $row['rol'], $row['image']);
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
    public static function getMyProducts($order)
    {
        try {
            $query = "SELECT product,amount FROM inCart WHERE shop = :shop";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':shop', $order);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $products = [];
            foreach ($result as $product) {
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

    public static function editOrder($id, $status)
    {
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
            echo "<meta http-equiv='refresh' content='0.1;index.php?page=Orders&action=showAdminOrders'>";
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function obtainMethods()
    {
        try {
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
    public static function searchCart($user)
    {
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
    public static function searchInCart($shopId, $product, $size)
    {
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
    public static function getProductAmount($code, $shop)
    {
        try {
            $query = "SELECT amount FROM inCart WHERE product = :product AND shop = :shop";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':product', $code, PDO::PARAM_STR);
            $stmt->bindParam(':shop', $shop, PDO::PARAM_INT);
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
    public static function addToCart($size, $product, $stock, $user)
    {
        try {
            $stmt = self::searchCart($user);
            if ($stmt->rowCount() == 0) {
                $defaultStatus = 'cart';
                $insertQuery = "INSERT INTO shopping (useremail, status) VALUES (:useremail, :status)";
                $stmtI = self::getConnection()->prepare($insertQuery);
                $stmtI->bindParam(':useremail', $user, PDO::PARAM_STR);
                $stmtI->bindParam(':status', $defaultStatus, PDO::PARAM_STR);
                $stmtI->execute();
                $stmt = self::searchCart($user);
            }
            $id = $stmt->fetchColumn();
            $currentAmount = self::getProductAmount($product, $id);
            if (intval($stock) != intval($currentAmount)) {
                $Cartstmt = self::searchInCart($id, $product, $size);
                if ($Cartstmt->rowCount() == 0) {
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
    public static function addIfCartNotExists($user)
    {
        try {
            $defaultStatus = "cart";
            $query = "SELECT * FROM shopping WHERE useremail = :useremail AND status = :status";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':useremail', $user, PDO::PARAM_STR);
            $stmt->bindParam(':status', $defaultStatus, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
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
    public static function addToCartFromLocalStorage($products, $user)
    {
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
            foreach ($products['productsArray'] as $product) {
                $queryI = "INSERT INTO inCart (product, amount, size, shop) VALUES (:product, :amount, :size, :shop)";
                $stmtI = self::getConnection()->prepare($queryI);
                $stmtI->bindParam(':product', $product['code'], PDO::PARAM_STR);
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
    public static function getProductsInfoFromCart()
    {
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
    public static function createProductsArray($user)
    {
        $stmt = self::searchCart($user);
        if ($stmt->rowCount() > 0) {
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
    public static function plusTheProductToCart($user, $code, $stock, $cant, $size)
    {
        $stmt = self::searchCart($user);
        if ($stmt->rowCount() > 0) {
            $id = $stmt->fetchColumn();
            $currentAmount = self::getProductAmount($code, $id);
            if (($currentAmount + 1) <= $stock) {
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
    public static function minusTheProductToCart($user, $code, $stock, $cant, $size)
    {
        $stmt = self::searchCart($user);
        if ($stmt->rowCount() > 0) {
            $id = $stmt->fetchColumn();
            if ($cant != 1) {
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
    public static function deleteTheProductFromCart($user, $code, $stock, $size)
    {
        $stmt = self::searchCart($user);
        if ($stmt->rowCount() > 0) {
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
    public static function getAllPromoCodes()
    {
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
    public static function createProductsCartTable($detailsCart)
    {
        require_once(__DIR__ . '/../models/ProductModel.php');
        $htmlTable = "";
        foreach ($detailsCart['productsArray'] as $product) {
            $info = ProductModel::getProductInfoForCart($product['code']);
            if ($info[0]['image'] == null) {
                $info[0]['image'] = "views/assets/images/products/productImage.png";
            }
            $totalAmount = $info[0]['price'] * number_format($product['amount'], 2, '.', '');
            $htmlTable = $htmlTable .
                "<tr>" .
                "<td>" .
                "<div><img src='" . $info[0]['image'] . "'></div>" .
                "<div><h3>" . $info[0]['name'] . "</h3><div>" . $product['size'] . "</div></div>" .
                "<div>" . $info[0]['description'] . "</div>" .
                "<div><button class='deleteButton' codeId='" . $product['code'] . "' size='" . $product['size'] . "' cant='" . $product['amount'] . "' stock='" . $info[0]['stock'] . "'>Borrar</button>" .
                "</td>" .
                "<td>" .
                "<div><button class='minusButton' codeId='" . $product['code'] . "' size='" . $product['size'] . "' cant='" . $product['amount'] . "' stock='" . $info[0]['stock'] . "'>-</button><div class='productAmount'>" . $product['amount'] . "</div><button class='plusButton' codeId='" . $product['code'] . "' size='" . $product['size'] . "' cant='" . $product['amount'] . "' stock='" . $info[0]['stock'] . "'>+</button></div>" .
                "</td>" .
                "<td>" .
                "<div>$" . $info[0]['price'] . "</div>" .
                "</td>" .
                "<td>" .
                "<div class='valueItem'>$" . number_format($totalAmount, 2, '.', '') . "</div>" .
                "</td>" .
                "</tr>";
        }
        return $htmlTable;
    }

    // EMPIEZO AQUI!
    public static function getInCart($email)
    {
        try {
            $query = "SELECT * FROM inCart WHERE shop = (SELECT id FROM shopping WHERE useremail = :email AND status = 'cart')";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    // Hay que pasarle un array siempre.
    public static function getStock($products)
    {
        try {
            $allProductsHaveStock = true;
            foreach ($products as $key => $product) {
                $queryStock = "SELECT * FROM products WHERE code = :code";
                $stmt = self::getConnection()->prepare($queryStock);
                $stmt->bindParam(':code', $product['product'], PDO::PARAM_STR);
                $stmt->execute();
                $productsStock = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($productsStock[0]['stock'] < self::getProductAmount($product['product'], $products[$key]['shop'])) {
                    $allProductsHaveStock = false;
                    // echo "Error! No tenemos stock de estos modelos ahora mismo. Lo sentimos!";
                    // echo "<META HTTP-EQUIV='REFRESH' CONTENT='4;URL=index.php'>";
                }
            }

            return $allProductsHaveStock;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    // Hay que pasarle un array siempre.
    public static function updateProductsTable($products)
    {
        try {
            // foreach ($products as $key => $product) {
            foreach ($products as $product) {
                $queryUpdateStock = "UPDATE products SET stock = stock - :amount, sold = sold + :amount WHERE code = :code";
                $stmt = self::getConnection()->prepare($queryUpdateStock);
                $stmt->bindParam(':amount', $product['amount'], PDO::PARAM_INT);
                $stmt->bindParam(':code', $product['product'], PDO::PARAM_STR);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public static function updateShoppingTable($date)
    {
        try {
            $email = $_SESSION['email'];
            $queryUpdateShopping = "UPDATE shopping SET price = :price, datepurchase = :datepurchase, status = 'pending' WHERE useremail = :email AND status = 'cart'";
            $stmt = self::getConnection()->prepare($queryUpdateShopping);
            $stmt->bindParam(':price', $_POST['totalCostInput'], PDO::PARAM_INT);
            $stmt->bindParam(':datepurchase', $date, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public static function getProduct()
    {
        // hay una funcion en ProductModel que le pasas el codigo y te lo dice todo.
    }
    public static function getStockk()
    {
        $email = $_SESSION['email'];
        try {
            // getInCart() HECHO1
            $query = "SELECT * FROM inCart WHERE shop = (SELECT id FROM shopping WHERE useremail = :email AND status = 'cart')";
            $stmt = self::getConnection()->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // return $result;
            // hasta aqui!!
            // Hay que pasarle un array siempre.
            // getStock($cart) HECHO1
            $allProductsHaveStock = true;
            foreach ($result as $key => $product) {
                $queryStock = "SELECT * FROM products WHERE code = :code";
                $stmt = self::getConnection()->prepare($queryStock);
                $stmt->bindParam(':code', $product['product'], PDO::PARAM_STR);
                $stmt->execute();
                $resultStock = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($resultStock[0]['stock'] < self::getProductAmount($product['product'], $result[$key]['shop'])) {
                    $allProductsHaveStock = false;
                    echo "Error! No tenemos stock de estos modelos ahora mismo. Lo sentimos!";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='4;URL=index.php'>";
                }
            }
            // return $allProductsHaveStock;
            // hasta aqui!!
            if ($allProductsHaveStock) {
                // Hay que pasarle un array siempre.
                // updateProductsTable($cart) HECHO1
                foreach ($result as $key => $product) {
                    $queryUpdateStock = "UPDATE products SET stock = stock - :amount, sold = sold + :amount WHERE code = :code";
                    $stmt = self::getConnection()->prepare($queryUpdateStock);
                    $stmt->bindParam(':amount', $product['amount'], PDO::PARAM_INT);
                    $stmt->bindParam(':code', $product['product'], PDO::PARAM_STR);
                    $stmt->execute();
                }
                // hasta aqui!!

                $idCompra = self::getIdCompra($email);
                $date = $_POST['fecha'];
                // updateShoppingTable($date) HECHO1
                $queryUpdateShopping = "UPDATE shopping SET price = :price, datepurchase = :datepurchase, status = 'pending' WHERE useremail = :email AND status = 'cart'";
                $stmt = self::getConnection()->prepare($queryUpdateShopping);
                $stmt->bindParam(':price', $_POST['totalCostInput'], PDO::PARAM_INT);
                $stmt->bindParam(':datepurchase', $date, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();
                // hasta aqui!!
                $resultFactura = array();
                foreach ($result as $product1) {
                    // hay que pasarle siempre un array
                    // getProduct($cart)1
                    // funcion del product model desde aqui.
                    $factura = "SELECT * FROM products WHERE code = :code";
                    $stmt = self::getConnection()->prepare($factura);
                    $stmt->bindParam(':code', $product1['product'], PDO::PARAM_STR);
                    $stmt->execute();
                    // funcion del product model hasta aqui.
                    $resultFactura[] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    // hasta aqui!!
                }
                $firma = self::getFirmaAdmin();
                if (empty($_POST['promo'])) {
                    $discount = array(
                        array('code' => 'None', 'discount' => 0)
                    );
                } else {
                    $discount = self::getDiscount($_POST['promo']);
                }
                $shippingmode = self::getShippingMethod($_POST['shipping']);
                $company = self::getCompanyInfo();

                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=views/General/compraExitosa.php'>";
                self::generatePDF($result, $resultFactura, $_POST['totalCostInput'], $date, $shippingmode, $discount, $firma, $idCompra, $company);
            }
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public static function getIdCompra($email)
    {
        $query = "SELECT id FROM shopping WHERE useremail = :email AND status = 'cart'";
        $stmt = self::getConnection()->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $id = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $id;
    }

    public static function getFirmaAdmin()
    {
        $query = "SELECT signature FROM users WHERE rol = 'admin' LIMIT 1";
        $stmt = self::getConnection()->prepare($query);
        $stmt->execute();
        $firma = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $firma;
    }

    public static function getShippingMethod($shippingPrice)
    {
        $shippingMethod = "SELECT * FROM shippingmethod WHERE price = :price";
        $stmt = self::getConnection()->prepare($shippingMethod);
        $stmt->bindParam(':price', $shippingPrice, PDO::PARAM_STR);
        $stmt->execute();
        $method = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $method;
    }

    public static function getCompanyInfo()
    {
        $query = "SELECT * FROM company";
        $stmt = self::getConnection()->prepare($query);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $info;
    }

    public static function getDiscount($code)
    {
        $query = "SELECT * FROM discountcodes WHERE code = :code";
        $stmt = self::getConnection()->prepare($query);
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->execute();
        $discount = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $discount;
    }

    public static function generatePDF($result, $resultFactura, $totalCost, $date, $shipping, $discount, $firma, $idCompra, $company)
    {
        // Crear instancia de mPDF
        $mpdf = new \Mpdf\Mpdf();

        // Add content to the body of the PDF
        $html = '<h1>' . $company[0]['name'] . '</h1>';
        $html .= $company[0]['phone'] . '<br>';
        $html .= $company[0]['cif'] . '<br>';
        $html .= $company[0]['email'] . '<br>';
        $html .= $company[0]['address'] . '<br>';

        // Add the date
        $html .= '<p><strong>Fecha:</strong> ' . $date . '</p>';

        // Add table with product details
        $html .= '<table border="1" cellpadding="5" cellspacing="0">
<thead>
    <tr>
        <th>Nombre del Producto</th>
        <th>Cantidad</th>
        <th>Talla</th>
        <th>Precio</th>
        <th>Total</th>
    </tr>
</thead>
<tbody>';
        foreach ($resultFactura as $key => $product11) {
            $html .= '<tr>
        <td>' . $product11['name'] . '</td>
        <td>' . $result[$key]['amount'] . '</td>
        <td>' . $result[$key]['size'] . '</td>
        <td>' . number_format($product11['price'], 2) . '</td>
        <td>' . number_format($product11['price'] * $result[$key]['amount'], 2) . '</td>
    </tr>';
        }
        $html .= '<tr>
    <td colspan="4"><strong>Shipping Method:</strong></td>
    <td>' . $shipping[0]['name'] . ' : $' . $shipping[0]['price'] . '</td>
</tr>';
        $html .= '<tr>
    <td colspan="4"><strong>Discount:</strong></td>
    <td>' . $discount[0]['code'] . ' : -' . $discount[0]['discount'] . '%</td>
</tr>';
        $html .= '<tr>
    <td colspan="4"><strong>Total:</strong></td>
    <td>$' . number_format($totalCost, 2) . '</td>
</tr>';
        $html .= '</tbody></table>';
        $html .= '<p>Firma Administrador:</p><img src="./views/assets/images/signatures/' . str_replace(' ', '', $firma[0]['signature']) . '" alt="Firma Admin" style="width: 100px; height: auto;">';

        // Generar el PDF
        $mpdf->writeHTML($html);
        $mpdf->output('Order'.$idCompra.'.pdf', 'D');
    }

    public static function dropOrder($orderID)
    {
        try {
            $deleteOrder = "DELETE FROM shopping WHERE id = :ID";
            $order = self::getConnection()->prepare($deleteOrder);
            $order->bindParam(':ID', $orderID);
            $order->execute();

            $deleteCarts = "DELETE FROM inCart WHERE shop = :shop";
            $cart = self::getConnection()->prepare($deleteCarts);
            $cart->bindParam(':shop', $orderID);
            $cart->execute();
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
}
