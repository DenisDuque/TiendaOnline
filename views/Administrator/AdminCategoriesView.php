<?php include("adminHeader.php") ?>
        <script src="views/js/canvasGraphCat.js"></script>
        <div id="container">
            <div id="leftPanel">
                <div class="panels">
                    <?php 
                        include("views/Administrator/Components/dashboardPanel.html");
                        include("views/Administrator/Components/productsPanel.html");
                        include("views/Administrator/Components/customersPanel.html");
                        include("views/Administrator/Components/ordersPanel.html");
                    ?>
                </div>
                <?php
                    include('views/Administrator/Components/editCategoryForm.html');
                    include('views/Administrator/Components/createCategoryForm.html');
                ?>
            </div>
            <div id="rightPanel">
                <h2>Categories</h2>
                <?php include("views/Administrator/Components/searchBar.php");?>
                <div id="listContainer">
                    <?php
                    foreach($categories as $category) {
                        $ProductsID = ProductModel::getCategoryProductId($category->getCode());
                        $ProductsTextValue = implode(',', $ProductsID);
                        $ProductsTextValue = str_replace(' ','',$ProductsTextValue);
                        echo "
                            <div id='". $category->getCode() ."' class='categoryComponent'>
                                <h5 class='categoryName'>". $category->getName() ."</h5>
                                <p class='categoryCount'>Products: ". count($ProductsID) ."</p>
                                <input class='products' type='hidden' value='". $ProductsTextValue ."'>
                                <input class='status' type='hidden' value='". $category->getStatus() ."'>
                                <div id='".$category->getCode().",".$category->getName().",".$category->getStatus().",".$ProductsTextValue."' class='editBtn editCatBtn'><img src='views/assets/images/utils/edit.png' alt='Edit'></div>
                            </div>
                        ";
                    }
                    ?>
                </div>
            </div>
            <h1>Popular categories chart</h1>
            <canvas id="canvasCatTopProducts" width="620" height="300"></canvas>
        </div>
    </body>
</html>