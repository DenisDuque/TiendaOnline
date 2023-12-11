<html>
<?php
    require_once("../../../controllers/AdminCategoriesController.php");
    $category = CategoryController::getCategoryInfo($id);
?>
<table>
    <tr>
        <td>
            <h3>
               
            </h3>
        </td>
    </tr>
    <form action="" method="">
        <tr>
            <td>
                <input type="text" name="name" value=>
            </td>
        </tr>
        <tr>
            <td>
                <select name="active">
                    <option value="enabled">enabled</option>
                    <option value="disabled">disabled</option>
                </select>s
            </td>
        </tr>
        <tr>
            <td><h1>Products</h1></td>
            <td>
                <?php
                   
                    $products = CategoryController::showProductsFromCategory("%categoria%");
                
                    echo "<ul>";
                    foreach($products as $product){
                        echo "<li>".$product."</li>";
                    }
                    echo "</ul>";
                ?>
            </td>
        </tr>
    </form>
</table>
</html>