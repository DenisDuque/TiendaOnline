<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="views/scss/css/administrator.css">
        <script src="views/js/Administrator.js"></script>
        <title>Categories</title>
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
                        include("views/Administrator/Components/dashboardPanel.html");
                        include("views/Administrator/Components/productsPanel.html");
                        include("views/Administrator/Components/customersPanel.html");
                        include("views/Administrator/Components/ordersPanel.html");
                    ?>
                </div>
                <div id="formEditCategory" class="adminForm">
                    <h4 id="editCategoryTitle">Sneakers</h4>
                        <form action="index.php?page=Category&action=editCategory" method="POST">
                            <input type="hidden" name="code" id="code">
                            <label for="name">Category name</label>
                            <input type="text" name="name" id="name">
                            <div>
                                <label for="active">Status</label>
                                <select name="active" id="select">
                                    <option id="enabled" value="enabled">enabled</option>
                                    <option id="disabled" value="disabled">disabled</option>
                                </select>
                            </div>
                            <label for="">Products</label>
                            <ul id="listado" class="productsList">
                            </ul>
                            <input type="submit" class="submitBtn" value="Save changes"></input>
                        </form>
                </div>
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
        </div>
    </body>
</html>