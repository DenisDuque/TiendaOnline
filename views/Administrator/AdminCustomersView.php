<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="views/scss/css/administrator.css">
        <script src="views/js/Administrator.js"></script>
        <title>Customers</title>
    </head>
    <body>
        <header>
            <h1>Urban Store</h1>
            <img src="views/assets/images/utils/signout.png" alt="Sign out">
        </header>
        <div id="container">
            <div id="leftPanel">
                <div class="panels">
                    <?php 
                        include("views/Administrator/Components/categoriesPanel.html");
                        include("views/Administrator/Components/productsPanel.html");
                        include("views/Administrator/Components/dashboardPanel.html");
                        include("views/Administrator/Components/ordersPanel.html");
                    ?>
                </div>
            </div>
            <div id="rightPanel">
                <h2>Customers</h2>
                <?php include("views/Administrator/Components/searchBar.php");?>
                <div id="listContainer">
                    <div class="defaultComponent">
                        <div class="imageComponent">
                            <img src="views/assets/images/utils/customers.png" alt="Customer">
                        </div>
                        <div class="textOnLeft">
                            <h4 class="name">Denis Duque Villanueva</h4>
                            <p class="userEmail">Email: denis.duque@inslapineda.cat</p>
                            <p class="userPhone">612239942</p>
                            <p class="userAddress">Carrer de la Batllòria 76-78 1º4</p>
                        </div>
                    </div>

                    <div class="defaultComponent">
                        <div class="imageComponent">
                            <img src="views/assets/images/utils/customers.png" alt="Customer">
                        </div>
                        <div class="textOnLeft">
                            <h4 class="name">Denis Duque Villanueva</h4>
                            <p class="userEmail">Email: denis.duque@inslapineda.cat</p>
                            <p class="userPhone">612239942</p>
                            <p class="userAddress">Carrer de la Batllòria 76-78 1º4</p>
                        </div>
                    </div>

                    <div class="defaultComponent">
                        <div class="imageComponent">
                            <img src="views/assets/images/utils/customers.png" alt="Customer">
                        </div>
                        <div class="textOnLeft">
                            <h4 class="name">Denis Duque Villanueva</h4>
                            <p class="userEmail">Email: denis.duque@inslapineda.cat</p>
                            <p class="userPhone">612239942</p>
                            <p class="userAddress">Carrer de la Batllòria 76-78 1º4</p>
                        </div>
                    </div>

                    <div class="defaultComponent">
                        <div class="imageComponent">
                            <img src="views/assets/images/utils/customers.png" alt="Customer">
                        </div>
                        <div class="textOnLeft">
                            <h4 class="name">Denis Duque Villanueva</h4>
                            <p class="userEmail">Email: denis.duque@inslapineda.cat</p>
                            <p class="userPhone">612239942</p>
                            <p class="userAddress">Carrer de la Batllòria 76-78 1º4</p>
                        </div>
                    </div>

                    <div class="defaultComponent">
                        <div class="imageComponent">
                            <img src="views/assets/images/utils/customers.png" alt="Customer">
                        </div>
                        <div class="textOnLeft">
                            <h4 class="name">Denis Duque Villanueva</h4>
                            <p class="userEmail">Email: denis.duque@inslapineda.cat</p>
                            <p class="userPhone">612239942</p>
                            <p class="userAddress">Carrer de la Batllòria 76-78 1º4</p>
                        </div>
                    </div>
                    <?php
                    foreach($customers as $customer){
                        if($customer->getImage() == null) {
                            $image = "../utils/customers.png";
                        } else {
                            $image = $customer->getImage();
                        }
                        echo "
                            <div id='". $customer->getEmail() ."' class='defaultComponent'>
                                <div class='imageComponent'><img src='views/assets/images/users/". $image ."'></div>
                                <div class='textOnLeft'>
                                    <h4 class='name'>". $customer->getName() ." ". $customer->getSurname() ."</h4>
                                    <p class='userEmail'>Email: ". $customer->getEmail() ."</p>
                                    <p class='userPhone'>". $customer->getPhone()."</p>
                                    <p class='userAddress'>". $customer->getAddress() ."</p>
                                </div>
                            </div>
                        ";
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>