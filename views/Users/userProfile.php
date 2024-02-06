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
                echo "<h1>".count($orders)." order(s)</h1>";
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
                echo "<h1>Your Profile</h1>";
                echo "<p>EMAIL</p>";
                echo "<p>".$_SESSION["email"]."</p>";
                echo "<form action='index.php?page=User&action=showProfile' method='post'>";
                    echo "<table>";
                        echo "<tr>";
                            echo "<td><label for='name'>NAME</label></td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td><input type='text' name='name' id='name' value='".$user->getName()." ".$user->getSurname()."'></td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td><label for='phone'>PHONE</label></td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td><input type='tel' name='phone' id='phone' value='".$user->getPhone()."'></td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td><label for='address'>ADDRESS</label></td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td><input type='text' name='adress' id='adress' value='".$user->getAddress()."'></td>";
                        echo "</tr>";
                    echo "</table>";
                    echo "<input type='submit' value='SAVE CHANGES'>";
                echo "</form>";
        echo "</div>";
    ?>
    </main>
</body>
</html>