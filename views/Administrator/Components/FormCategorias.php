<?php
    require_once("../../../controllers/AdminCategoriesController.php");
    $category = AdminCategoriesController::getCategoryInfo("'%categoria%'");
    
?>
<table>
    <tr>
        <td>
            <h3>
                <?php //echo $category["code"]; ?>
            </h3>
        </td>
    </tr>
    <form action="" method="">
        <tr>
            <td>
                <input type="text" name="name" value=<?php //echo $category["name"]; ?>>
            </td>
        </tr>
        <tr>
            <td>
                <select name="active">
                    <option value="enabled">enabled</option>
                    <option value="disabled">disabled</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><h1>Products</h1></td>
            <td>
                <?php
                   
                    $products = AdminCategoriesController::showProductsFromCategory("%categoria%");
                
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
