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
                        echo "<td>";
                            foreach($order->getProducts() as $products){
                                echo $product;
                            }
                        echo "</td>";
                        echo "<td>".$order->getPrice()."</td>";
                        echo "<td>".$order->getStatus()."</td>";
                    echo "</tr>";
                }
            echo "</table>";
        echo "</div>";
    ?>
    </main>
</body>
</html>