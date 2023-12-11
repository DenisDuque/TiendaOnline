<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="views/scss/css/administrator.css">
        <script src="views/js/editForms.js"></script>
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
                <div id="formCat">
                    <table>
                        <form action="" method="">
                            <input type="hidden" name="code" id="code" value="">
                            <tr>
                                <td>
                                    <input type="text" name="name" id="name" value="">
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
                            <tr><td><h1>Products</h1></td></tr>
                            <tr>
                                
                                <td>
                                    <ul id="listado">
                                    </ul>
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
            <div id="rightPanel">
                <h2>Categories</h2>
                <?php include("views/Administrator/Components/searchBar.php");?>
                <div id="listContainer">
                    <?php AdminCategoriesController::showCategories(); ?>
                </div>
            </div>
        </div>
    </body>
</html>