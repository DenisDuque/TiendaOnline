<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="views/scss/css/administrator.css">
        <script src="views/js/Administrator.js"></script>
        <title>Products</title>
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
                        include("views/Administrator/Components/dashboardPanel.html");
                        include("views/Administrator/Components/customersPanel.html");
                        include("views/Administrator/Components/ordersPanel.html");
                    ?>
                </div>
            </div>
            <div id="rightPanel">
                <h2>Products</h2>
                <?php include("views/Administrator/Components/searchBar.php");?>
                <div id="listContainer">

                <div class="defaultComponent">
                    <div class="imageComponent">
                        <img src="views/assets/images/utils/productImage.png" alt="Product">
                    </div>
                    <div class="textOnLeft">
                        <h4 class="productName">Nike Air Force 1 VL</h4>
                        <p class="productCategory">Category: Sneakers</p>
                        <p class="productCode">Product Code: NI001NIK</p>
                        <h5 class="productPrice">$120.00</h5>
                    </div>
                    <div class="textOnRight">
                        <h4 class="productSold">Sold: 222</h4>
                        <h4 class="productStock">Stock: 125</h4>
                        <div class="editBtn"><img src="views/assets/images/utils/edit.png" alt="Edit"></div>
                    </div>
                </div>

                <div class="defaultComponent">
                    <div class="imageComponent">
                        <img src="views/assets/images/utils/productImage.png" alt="Product">
                    </div>
                    <div class="textOnLeft">
                        <h4 class="productName">Nike Air Force 1 VL</h4>
                        <p class="productCategory">Category: Sneakers</p>
                        <p class="productCode">Product Code: NI001NIK</p>
                        <h5 class="productPrice">$120.00</h5>
                    </div>
                    <div class="textOnRight">
                        <h4 class="productSold">Sold: 222</h4>
                        <h4 class="productStock">Stock: 125</h4>
                        <div class="editBtn"><img src="views/assets/images/utils/edit.png" alt="Edit"></div>
                    </div>
                </div>

                <div class="defaultComponent">
                    <div class="imageComponent">
                        <img src="views/assets/images/utils/productImage.png" alt="Product">
                    </div>
                    <div class="textOnLeft">
                        <h4 class="productName">Nike Air Force 1 VL</h4>
                        <p class="productCategory">Category: Sneakers</p>
                        <p class="productCode">Product Code: NI001NIK</p>
                        <h5 class="productPrice">$120.00</h5>
                    </div>
                    <div class="textOnRight">
                        <h4 class="productSold">Sold: 222</h4>
                        <h4 class="productStock">Stock: 125</h4>
                        <div class="editBtn"><img src="views/assets/images/utils/edit.png" alt="Edit"></div>
                    </div>
                </div>

                <div class="defaultComponent">
                    <div class="imageComponent">
                        <img src="views/assets/images/utils/productImage.png" alt="Product">
                    </div>
                    <div class="textOnLeft">
                        <h4 class="productName">Nike Air Force 1 VL</h4>
                        <p class="productCategory">Category: Sneakers</p>
                        <p class="productCode">Product Code: NI001NIK</p>
                        <h5 class="productPrice">$120.00</h5>
                    </div>
                    <div class="textOnRight">
                        <h4 class="productSold">Sold: 222</h4>
                        <h4 class="productStock">Stock: 125</h4>
                        <div class="editBtn"><img src="views/assets/images/utils/edit.png" alt="Edit"></div>
                    </div>
                </div>

                <div class="defaultComponent">
                    <div class="imageComponent">
                        <img src="views/assets/images/utils/productImage.png" alt="Product">
                    </div>
                    <div class="textOnLeft">
                        <h4 class="productName">Nike Air Force 1 VL</h4>
                        <p class="productCategory">Category: Sneakers</p>
                        <p class="productCode">Product Code: NI001NIK</p>
                        <h5 class="productPrice">$120.00</h5>
                    </div>
                    <div class="textOnRight">
                        <h4 class="productSold">Sold: 222</h4>
                        <h4 class="productStock">Stock: 125</h4>
                        <div class="editBtn"><img src="views/assets/images/utils/edit.png" alt="Edit"></div>
                    </div>
                </div>

                <div class="defaultComponent">
                    <div class="imageComponent">
                        <img src="views/assets/images/utils/productImage.png" alt="Product">
                    </div>
                    <div class="textOnLeft">
                        <h4 class="productName">Nike Air Force 1 VL</h4>
                        <p class="productCategory">Category: Sneakers</p>
                        <p class="productCode">Product Code: NI001NIK</p>
                        <h5 class="productPrice">$120.00</h5>
                    </div>
                    <div class="textOnRight">
                        <h4 class="productSold">Sold: 222</h4>
                        <h4 class="productStock">Stock: 125</h4>
                        <div class="editBtn"><img src="views/assets/images/utils/edit.png" alt="Edit"></div>
                    </div>
                </div>

                <div class="defaultComponent">
                    <div class="imageComponent">
                        <img src="views/assets/images/utils/productImage.png" alt="Product">
                    </div>
                    <div class="textOnLeft">
                        <h4 class="productName">Nike Air Force 1 VL</h4>
                        <p class="productCategory">Category: Sneakers</p>
                        <p class="productCode">Product Code: NI001NIK</p>
                        <h5 class="productPrice">$120.00</h5>
                    </div>
                    <div class="textOnRight">
                        <h4 class="productSold">Sold: 222</h4>
                        <h4 class="productStock">Stock: 125</h4>
                        <div class="editBtn"><img src="views/assets/images/utils/edit.png" alt="Edit"></div>
                    </div>
                </div>


                    <?php AdminProductsController::showProducts(); ?>
                </div>
            </div>
        </div>
    </body>
</html>