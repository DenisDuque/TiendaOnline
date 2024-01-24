<?php
    require_once("views\General\Components\headerHome.html");
?>
<div>
    <div id="leftPannel">
        <div id="ShoppingTitle">
            <h1>Shopping cart</h1>
            <h2>items</h2>
        </div>
        <div id="cartLegend">
            <h3>PRODUCT DETAILS</h3>
            <h3>AMOUNT</h3>
            <h3>PRICE</h3>
            <h3>TOTAL</h3>
        </div>
        <div id="productsListCart">

        </div>
    </div>
    <div id="rightPannel">
        <form id="orderForm" action="index.php?page=Orders&action=purchaseOrder" method="POST" enctype="multipart/form-data">
            <h1>Order Summary</h1>
            <div id="itemsPrice"><h6>ITEMS: </h6></div>
            <div id="shippingMethod">
                <h6>SHIPPING</h6>
                <select name="shipping" id="select">
                    <?php
                        $methods = OrdersController::shippingMethodOptions();
                        foreach ($methods as $method) {
                            echo "<option id='".$method['code']."' value='".$method['code']."'>".$method['name']." - $".$method['price']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div id="promoCode">
                <h6>PROMO CODE</h6>
                <input type="text" id="promo" name="promo" placeholder="Add promo code">
                <button type="button" class='applyPromoCode'>APPLY</button>
            </div>
            <div id="totalCost"><h6>TOTAL COST</h6></div>
            <input type="submit" value="CHECKOUT">
        <form>
    </div>
</div>