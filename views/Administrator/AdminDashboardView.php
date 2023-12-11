<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="views/scss/css/administrator.css">
        <script src="views/js/Administrator.js"></script>
        <title>Dashboard</title>
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
                        include("views/Administrator/Components/ordersPanel.html");
                    ?>
                </div>
            </div>
            <div id="rightPanel">
                <h2>Best Sellers</h2>
                <div id="listContainer" class="dashboardList">

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
                    </div>
                </div>
                    <?php
                        foreach($products as $product) {
                            $img = ProductModel::getProductImage('lateralPerspective', $product->getCode());
                            if($img == null) {
                                $img = '../utils/productImage.png';
                            }
                            echo "
                                <div class='defaultComponent'>
                                    <div class='imageComponent'>
                                        <img src='views/assets/images/products/".$img."' alt='Product'>
                                    </div>
                                    <div class='textOnLeft'>
                                        <h4>". $product->getName() ."</h4>
                                        <p>Category: ". $product->getCategory() ."</p>
                                        <p>Product Code: ". $product->getCode() ."</p>
                                        <h5>$". $product->getPrice() ."</h5>
                                    </div>
                                    <div class='textOnRight'>
                                        <h4 class='productSold'>Sold: ". $product->getSold() ."</h4>
                                        <h4 class='productStock'>Stock: ". $product->getStock() ."</h4>
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