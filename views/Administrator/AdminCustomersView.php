<?php include("adminHeader.php") ?>
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