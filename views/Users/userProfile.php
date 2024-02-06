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
        echo "<div id='orders'>";
            echo "<div class='titles'>";
                echo "<h1>My Orders</h1>";
                echo "<h1>".count($orders)." items</h1>";
            echo "</div>";
            echo "<table>";
                echo "<tr>";
                    echo "<th>DATE</th>";
                    echo "<th>ORDER DETAILS</th>";
                    echo "<th>AMOUNT</th>";
                    echo "<th>STATUS</th>";
                    echo "<th>ACTIONS</th>";
                echo "</tr>";
                foreach($orders as $order){
                    echo "<tr class='order'>";
                        echo "<td>".$order->getDate()."</td>";
                        echo "<td class='products'>";
                            foreach($order->getProducts() as $product=>$amount){
                                echo $product;
                                echo "x$amount";
                                echo "<br>";
                            }
                        echo "</td>";
                        echo "<td>".$order->getPrice()."</td>";
                        echo "<td>".$order->getStatus()."</td>";
                    echo "</tr>";
                }
            echo "</table>";
        echo "</div>";
        echo "<div id='userInfo'>";
                
        echo "</div>";
    ?>
    </main>
</body>
</html>