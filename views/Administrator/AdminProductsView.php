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
                <div class="formProd">
                    <form action="" method="">
                        <table> 
                            <input type="hidden" name="code" id="code">
                            <tr><td><label for="name">Name product</label></td></tr>
                            <tr>
                                <td>
                                    <input type="text" name="name" id="name">
                                </td>
                            </tr>
                            <tr><td><label for="name">Price</label></td></tr>
                            <tr>
                                <td>
                                    <input type="text" name="price" id="price">
                                </td>
                            </tr>
                            <tr><td><label for="name">Stock</label></td></tr>
                            <tr>
                                <td>
                                    <input type="text" name="stock" id="stock">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="active" id="select">
                                        <option id="enabled" value="enabled">enabled</option>
                                        <option id="disabled" value="disabled">disabled</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="category" id="category"> 
                                        <?php 
                                            $categories = CategoryController::generateCategoriesOptions();
                                            foreach ($categories as $category) {
                                                echo "<option id='".$category->getCode()."' value='".$category->getCode()."'>".$category->getName()."</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div id="rightPanel">
                <h2>Products</h2>
                <?php include("views/Administrator/Components/searchBar.php");?>
                <div id="listContainer">
                    <?php 
                        foreach($products as $product) {
                            $img = ProductModel::getProductImage('lateralPerspective', $product->getCode());
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
                                        <div id='".$product->getCode().",".$product->getName().",".$product->getPrice().",".$product->getStatus().",".$product->getStock().",".$product->getCategory()."' class='editBtn editProdBtn'><img src='views/assets/images/utils/edit.png' alt='Edit'></div>
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