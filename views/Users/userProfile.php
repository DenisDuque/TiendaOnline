<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My profile</title>
    <link rel="stylesheet" href="views\scss\css\profilePage.css">
</head>
<body>
    <main>
        <div id="all">
    <?php
        echo "<div id='orders'>";
            echo "<div class='titles'>";
                echo "<h1>My Orders</h1>";
                echo "<h1>".count($orders)." order(s)</h1>";
            echo "</div>";
            echo "<div id='list'>";
                echo "<div class='tableHead'>";
                    echo "<p>DATE</p>";
                    echo "<p>ORDER DETAILS</p>";
                    echo "<p>AMOUNT</p>";
                    echo "<p>STATUS</p>";
                    echo "<p>ACTIONS</p>";
                echo "</div>";
                foreach($orders as $order){
                    echo "<div class='order'>";
                        echo "<p>".$order->getDate()."</p>";
                        echo "<div class='products'>";
                            foreach($order->getProducts() as $product=>$amount){
                                echo "<p>$product x $amount</p>";
                            }
                        echo "</div>";
                        echo "<p>".$order->getPrice()."</p>";
                        echo "<p>".$order->getStatus()."</p>";
                        if($order->getStatus() != "shipped"){
                            echo "<p><a href='index.php?page=User&action=showProfile&deleteOrder=".$order->getId()."'>CANCEL</a></p>";
                        }
                    echo "</div>";
                }
            echo "</div>";
        echo "</div>";
        echo "<div id='userInfo'>";
                echo "<div class='titles'>";
                    echo "<h1>Your Profile</h1>";
                echo "</div>";
                echo "<div id='email'>";
                    echo "<p>EMAIL:</p>";
                    echo "<p>".$_SESSION["email"]."</p>";
                echo "</div>";
                echo "<form action='index.php?page=User&action=showProfile' method='post'>";
                    echo "<label for='name'>NAME</label>";
                    echo "<input type='text' class='text' name='name' id='name' value='".$user->getName()." ".$user->getSurname()."'>";
                    echo "<label for='phone'>PHONE</label>";
                    echo "<input type='tel' class='text'  name='phone' id='phone' value='".$user->getPhone()."'>";
                    echo "<label for='address'>ADDRESS</label>";
                    echo "<input type='text' class='text' name='adress' id='adress' value='".$user->getAddress()."'>";
                    echo "<input type='submit' value='SAVE CHANGES' id='button'>";
                echo "</form>";
        echo "</div>";
    ?>
        </div>
    </main>
</body>
</html>