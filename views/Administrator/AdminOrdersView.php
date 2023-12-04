<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="views/scss/css/administrator.css">
        <script src="views/js/Administrator.js"></script>
        <title>Orders</title>
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
                        include("views/Administrator/Components/customersPanel.html");
                        include("views/Administrator/Components/dashboardPanel.html");
                    ?>
                </div>
            </div>
            <div id="rightPanel">
                <h2>Orders</h2>
                <?php include("views/Administrator/Components/searchBar.php");?>
                <div id="listContainer">
                    <?php // AdminOrdersController::listOrders(); ?>
                </div>
            </div>
        </div>


        
        <!--
            <div>
                <!--<div>
                    <div id='productImage'>
                        <img src="../assets/images/utils/customer.png" alt="Customer's Image">
                    </div>
                    <div>
                        <p>Customer Name and Surname</p>
                        <p>Email: mail</p>
                        <p>Products: NI991NIK, AD043REV, PU033NEW...</p>
                        <p><label>Total Amount: $230.00</label><label>Status: Pending</label></p>
                    </div>
                    <div>
                        <p><button type="submit"><img src="../assets/images/utils/factura.png" alt="Factura"></a></button></p>
                        <p><button type="submit"><img src="../assets/images/utils/edit.png" alt="Edit"></a></button></p>
                    </div>
                </div>
                <div>
                    <div id='productImage'>
                        <img src="../assets/images/utils/customer.png" alt="Customer's Image">
                    </div>
                    <div>
                        <p>Customer Name and Surname</p>
                        <p>Email: mail</p>
                        <p>Products: NI991NIK, AD043REV, PU033NEW...</p>
                        <p><label>Total Amount: $230.00</label><label>Status: Pending</label></p>
                    </div>
                    <div>
                        <p><button type="submit"><img src="../assets/images/utils/factura.png" alt="Factura"></a></button></p>
                        <p><button type="submit"><img src="../assets/images/utils/edit.png" alt="Edit"></a></button></p>
                    </div>
                </div>
                <div>
                    <div id='productImage'>
                        <img src="../assets/images/utils/customer.png" alt="Customer's Image">
                    </div>
                    <div>
                        <p>Customer Name and Surname</p>
                        <p>Email: mail</p>
                        <p>Products: NI991NIK, AD043REV, PU033NEW...</p>
                        <p><label>Total Amount: $230.00</label><label>Status: Pending</label></p>
                    </div>
                    <div>
                        <p><button type="submit"><img src="../assets/images/utils/factura.png" alt="Factura"></a></button></p>
                        <p><button type="submit"><img src="../assets/images/utils/edit.png" alt="Edit"></a></button></p>
                    </div>
                </div>
                <div>
                    <div id='productImage'>
                        <img src="../assets/images/utils/customer.png" alt="Customer's Image">
                    </div>
                    <div>
                        <p>Customer Name and Surname</p>
                        <p>Email: mail</p>
                        <p>Products: NI991NIK, AD043REV, PU033NEW...</p>
                        <p><label>Total Amount: $230.00</label><label>Status: Pending</label></p>
                    </div>
                    <div>
                        <p><button type="submit"><img src="../assets/images/utils/factura.png" alt="Factura"></a></button></p>
                        <p><button type="submit"><img src="../assets/images/utils/edit.png" alt="Edit"></a></button></p>
                    </div>
                </div>-->
            </div>
        </div> -->
    </body>
</html>