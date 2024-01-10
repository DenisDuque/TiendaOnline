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
                <div class="orderInfo">
                    <h2 id="name">Name</h2>
                    <h2 id="surname">Surname</h2>
                    <form action="index.php?page=Orders&action=editOrders" method="POST">
                        <input type="hidden" name="orderId" id="orderId">
                        <label for="email">Email</label>
                        <div id="email"></div>
                        <label for="phone">Phone</label>
                        <div id="phone"></div>
                        <div id="productsAmount">
                            <div id="text">
                                <label for="products">Products</label>
                                <label for="prodAmount">Amount</label>
                            </div>
                            <div id="list">
                                <ul id="products"></ul>
                                <dl id="amount"></dl>
                            </div>
                        </div>
                        <div id="divStatus">
                            <label for="status">Status</label>
                            <div id="status"></div>
                        </div>
                        <div id="divPrice">
                            <label for="price">Total amount</label>
                            <div id="price"></div>
                        </div>
                        <input type="submit" value="Pedido enviado" id="pedidoEnviado">
                    </form>
                </div>
            </div>
            <div id="rightPanel">
                <h2>Orders</h2>
                <?php include("views/Administrator/Components/searchBar.php");?>
                <div id="listContainer">
                    <?php 
                        foreach($Orders as $order) {
                            //DATOS DEL PEDIDO
                            $orderId = $order->getId();
                            $orderStatus = $order->getStatus();
                            $orderPrice = $order->getPrice();

                            //DATOS DEL USUARIO
                            $userName = $order->getUser()->getName();
                            $userSurname = $order->getUser()->getSurname();
                            $userEmail = $order->getUser()->getEmail();
                            $userPhone = $order->getUser()->getPhone();

                            //PRODUCTOS
                            $products = $order->getProducts();
                            $prodList = "";
                            foreach($products as $name=>$amount) {
                                $prodList = $prodList."/".$name.":".$amount;
                            }
                            /*if (count($productsID) <= 3) {
                                $showProducts = implode(", ", $productsID);
                            } else {
                                $firstProducts = array_slice($productsID, 0, 3);
                                $showProducts = implode(", ", $firstProducts) . "...";
                            }
                            $userImage =  $order->getUser()->getImage();
                            if ($userImage == null) {
                                $userImage = '../utils/customers.png';
                            }*/
                
                            echo "
                                <div id='". $orderId ."' class='defaultComponent'>
                                    <div class='imageComponent'>
                                        <img src='views/assets/images/users/"/*. $userImage */."' alt='Customer'>
                                    </div>
                                    <div class='textOnLeft'>
                                        <h4 class='name'>". $userName ." ". $userSurname ."</h4>
                                        <p class='userEmail'>Email: ".  $userEmail ."</p>
                                        <p class='userPhone'>Products: "./* $showProducts .*/"</p>
                                        <p class='userAddress'>Total Amount: ". $orderPrice ."<span>Status: ". $orderStatus ."</span></p>
                                    </div>
                                    <div class='textOnRight'>
                                        <div id='downloadBill_". $orderId ."' class='downloadBillBtn'><img src='views/assets/images/utils/downloadBill.png' alt='Download Bill'></div>
                                        <div id='".$orderId.",".$userName.",".$userSurname.",".$userEmail.",".$userPhone.",".$orderStatus.",".$orderPrice.",".$prodList."' class='editBtn editOrderBtn'><img src='views/assets/images/utils/edit.png' alt='Edit'></div>
                                    </div>
                                </div>
                            ";
                        }
                    ?>
                </div>
            </div>
        </div>


        
        <!--
            <div>
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
        </div>
    </body>
</html>