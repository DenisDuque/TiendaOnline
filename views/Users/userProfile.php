<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My profile</title>
</head>
<body>
    <main>
    <?php
       echo "<div>";
            echo "<div class='titles'>";
                echo "<h1>My Orders</h1>";
                echo "<h1>".count($orders)." items</h1>";
            echo "</div>";
            echo "<h2>DATE</h2>";
            echo "<h2>ORDER DETAILS</h2>";
            echo "<h2>AMOUNT</h2>";
            echo "<h2>STATUS</h2>";
            echo "<h2>ACTIONS</h2>";
            echo "<div id='orders'>";
            foreach($orders as $order){
                echo "<div class='order'>";
                    echo "<p>".$order["purchasedate"]."</p>";
                echo "</div>";
            }
            echo "</div>";

       echo "</div>"; 
    
    ?>
    </main>
</body>
</html>