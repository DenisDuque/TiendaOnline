<?php
require_once("views\General\Components\headerHome.php");
if (isset($_SESSION['email'])) {
    echo "<input type='hidden' id='hiddenEmail' value='" . $_SESSION['email'] . "'>";
} else {
    echo "<input type='hidden' id='hiddenEmail' value='unlogged'>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/scss/css/carrito.css">
    <title>Document</title>
</head>

<body>
    <div id="cart">
        <script src="views/js/cartPage.js"></script>
        <script src="views/js/checkout.js"></script>
        <div id="leftPannel" aria-label="Listado de los productos del carrito con informacion como el nombre y el precio"></div>
        <div id="rightPannel" aria-label="Formulario con las opciones de compra como el tipo de envio y la posibilidad de añadir un codigo promocional"> 
            <form id="orderForm" action="index.php?page=Orders&action=purchaseOrder" method="POST" enctype="multipart/form-data">
                <h1>Order Summary</h1>
                <div id="itemsPrice"></div>
                <div id="shippingMethod">
                    <h6>SHIPPING</h6>
                    <select name="shipping" id="selectShippingMethod">
                        <?php
                        $methods = OrdersController::shippingMethodOptions();
                        foreach ($methods as $method) {
                            echo "<option id='" . $method['id'] . "' value='" . $method['price'] . "'>" . $method['name'] . " - $" . $method['price'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div id="promoCode">
                    <h6>PROMO CODE</h6>
                    <input type="text" id="promo" name="promo" placeholder="Add promo code">
                    <button type="button" id='applyPromoCodeBtn'>APPLY</button>
                </div>
                <div id="totalCost"></div>
                <input type="hidden" name="totalCostInput" id="totalCostInput">
                <input type="hidden" name="fecha" id="fecha">
                <input type="submit" value="CHECKOUT">
            </form>
        </div>
    </div>
</body>

</html>