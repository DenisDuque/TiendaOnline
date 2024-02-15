<?php
require_once __DIR__ . '/../models/OrdersModel.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../vendor/autoload.php';

// use Spipu\Html2Pdf\Html2Pdf;

class OrdersController
{
    public function showAdminOrders()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $Orders = OrdersModel::getOrdersWithDetail($search);
        include __DIR__ . '/../views/Administrator/AdminOrdersView.php';
    }
    public function showOrders()
    {
    }

    public function showMyProducts($order)
    {
        $result = OrdersModel::getMyProducts($order);
        return $result;
    }

    public function editOrders()
    {
        if (isset($_POST) && isset($_GET['page']) && isset($_GET['action']) && $_GET['action'] == 'editOrders') {
            OrdersModel::editOrder($_POST['orderId'], 'shipped');
        }
    }
    public static function shippingMethodOptions()
    {
        $result = OrdersModel::obtainMethods();
        return $result;
    }
    public function detailsCart()
    {
        if (isset($_SESSION['email'])) {
            $detailsCart = OrdersModel::createProductsArray($_SESSION['email']);
            //echo json_encode(['success' => true, 'logged'=>'yes', 'info' => $detailsCart['productsArray'][0]]);
        } else {
            $detailsCart = json_decode(file_get_contents('php://input'), true);
            //echo json_encode(['success' => true, 'info' => $detailsCart['productsArray'][0]]);
        }
        $tableProducts = OrdersModel::createProductsCartTable($detailsCart);
        $codeTable = "<table>" .
            "<tr id='shoppingTitle'>" .
            "<td><h1>Shopping cart</h1></td>" .
            "<td><h1 id='counterItems'>" . count($detailsCart['productsArray']) . " items</h1></td>" .
            "</tr>" .
            "<tr>" .
            "<td><h3>PRODUCT DETAILS</h3></td>" .
            "<td><h3>AMOUNT</h3></td>" .
            "<td><h3>PRICE</h3></td>" .
            "<td><h3>TOTAL</h3></td>" .
            "</tr>" .
            $tableProducts .
            "</table>";



        echo json_encode(['success' => true, 'info' => $codeTable], JSON_UNESCAPED_SLASHES);
    }
    public function showCart()
    {
        /*if(isset($_SESSION['email'])) {
            $productsDetails = OrdersModel::getProductsCodeFromCart();
        } else {
            $productsDetails = json_decode(file_get_contents('php://input'), true);
            echo json_encode(['success' => true, 'info' => $productsDetails['productsArray']]);
        }*/
        include __DIR__ . '/../views/General/CartView.php';
    }
    public function productForCart()
    {
        $prod = $_POST['productDetails'];
        $product = explode('&', $prod);
        if (isset($_SESSION['email'])) {
            str_replace(' ', '', $product[0]);
            OrdersModel::addToCart(str_replace(' ', '', $product[0]), str_replace(' ', '', $product[1]), str_replace(' ', '', $product[2]), $_SESSION['email']);
        }
        echo "<meta http-equiv='refresh' content='0.1;index.php?page=orders&action=showCart'>";
    }
    public function transformToLoggedCart()
    {
        ob_clean();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrayProductsJSON = json_decode(file_get_contents('php://input'), true);
            if (is_array($arrayProductsJSON)) {
                echo json_encode(['success' => true, 'info' => $arrayProductsJSON['productsArray']]);
                OrdersModel::addToCartFromLocalStorage($arrayProductsJSON, $_SESSION['email']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error decoding JSON data']);
            }
        }
    }
    public function plusAmountProduct()
    {
        ob_clean();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrayProductsDetail = json_decode(file_get_contents('php://input'), true);
            if (is_array($arrayProductsDetail)) {
                OrdersModel::plusTheProductToCart($_SESSION['email'], $arrayProductsDetail['idProduct'], $arrayProductsDetail['stock'], $arrayProductsDetail['cant'], $arrayProductsDetail['size']);
                echo json_encode(['success' => true, 'info' => $arrayProductsDetail]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error decoding JSON data']);
            }
        }
    }
    public function minusAmountProduct()
    {
        ob_clean();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrayProductsDetail = json_decode(file_get_contents('php://input'), true);
            if (is_array($arrayProductsDetail)) {
                OrdersModel::minusTheProductToCart($_SESSION['email'], $arrayProductsDetail['idProduct'], $arrayProductsDetail['stock'], $arrayProductsDetail['cant'], $arrayProductsDetail['size']);
                echo json_encode(['success' => true, 'info' => $arrayProductsDetail]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error decoding JSON data']);
            }
        }
    }
    public function deleteProductFromCart()
    {
        ob_clean();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrayProductsDetail = json_decode(file_get_contents('php://input'), true);
            if (is_array($arrayProductsDetail)) {
                OrdersModel::deleteTheProductFromCart($_SESSION['email'], $arrayProductsDetail['idProduct'], $arrayProductsDetail['stock'], $arrayProductsDetail['size']);
                echo json_encode(['success' => true, 'info' => $arrayProductsDetail]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error decoding JSON data']);
            }
        }
    }
    public function getPromoCodes()
    {
        ob_clean();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codesArray = OrdersModel::getAllPromoCodes();
            $codesString = "&&";
            foreach ($codesArray as $item) {
                $codesString .= $item["code"] . "_" . $item["discount"] . ",";
            }
            $codesString = rtrim($codesString, ",");
            $codesString .= "&&";
            $codesString = str_replace(' ', '', $codesString);
            echo json_encode(['success' => true, 'info' => $codesString]);
        }
    }

    public function purchaseOrder()
    {
        if (isset($_SESSION['email'])) {
            echo "<input type='hidden' id='hiddenEmail' value='" . $_SESSION['email'] . "'>";
            OrdersModel::getStock();
        } else {
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.1;URL=index.php?page=User'>";
        }
    }
}
