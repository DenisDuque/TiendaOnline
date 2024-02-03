<?php
    require_once("views\General\Components\headerHome.html");
    if(isset($_SESSION['email'])) {
        echo "<input type='hidden' id='hiddenEmail' value='".$_SESSION['email']."'>";
    } else {
        echo "<input type='hidden' id='hiddenEmail' value='unlogged'>";
    }
?>
<div>
    <script src="views/js/cartPage.js"></script>
    <div id="leftPannel"></div>
    <div id="rightPannel">
        <form id="orderForm" action="index.php?page=Orders&action=purchaseOrder" method="POST" enctype="multipart/form-data">
            <h1>Order Summary</h1>
            <div id="itemsPrice"></div>
            <div id="shippingMethod">
                <h6>SHIPPING</h6>
                <select name="shipping" id="selectShippingMethod">
                    <?php
                        $methods = OrdersController::shippingMethodOptions();
                        foreach ($methods as $method) {
                            echo "<option id='".$method['id']."' value='".$method['price']."'>".$method['name']." - $".$method['price']."</option>";
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
            <input type="submit" value="CHECKOUT">
        <form>
    </div>
</div>