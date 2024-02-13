<header class="admin">
    <h1>Urban Store</h1>
    <a href="index.php?page=User&action=LogOut"><img src="views/assets/images/utils/signout.png" alt="Sign out"></a>
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
        <!--<div class="formProd">
            <?php
                //SOLUCION TEMPORAL: comentar uno y descomentar el otro para ver los formularios.
                //include("views/Administrator/Components/editProductForm.php");
                //include("views/Administrator/Components/createProductForm.php");
            ?>
        </div>-->
    </div>
    <div id="rightPanel">
        <h2>Products</h2>
        <?php include("views/Administrator/Components/searchBar.php");?>
        <div id="listContainer">
            <?php 
                foreach($products as $product) {
                    $img = ProductModel::getProductImage('lateralPerspective', $product->getCode());
                    $sizes = $product->getSize();
                    $stringSinComas = str_replace([',','{','}','"'], '', $sizes);
                    $stringProcesada = preg_replace('/\s+/', '!', $stringSinComas);
                    if($img == null) {
                        $img = '../utils/productImage.png';
                    }
                    echo "
                        <div id='". $product->getCode() ."' class='defaultComponent'>
                            <div class='imageComponent'>
                                <img src='views/assets/images/products/".$img."'>
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
                                <div id='".$product->getCode().",".$product->getName().",".$product->getDescription().",".$product->getPrice().",".$product->getFeatured().",".$product->getStatus().",".$product->getStock().",".$product->getCategory().",".$stringProcesada.","."views/assets/images/products/".$img."' class='editBtn editProdBtn'><img src='views/assets/images/utils/edit.png' alt='Edit'></div>
                            </div>
                        </div>
                    ";
                }
            ?>
        </div>
    </div>
</div>