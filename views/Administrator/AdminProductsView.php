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
                    <table>
                        <form action="" method="">
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
                                    
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
            <div id="rightPanel">
                <h2>Products</h2>
                <?php include("views/Administrator/Components/searchBar.php");?>
                <div id="listContainer">
                    <?php AdminProductsController::showProducts(); ?>
                </div>
            </div>
        </div>
    </body>
</html>