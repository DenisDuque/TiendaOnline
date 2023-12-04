<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>
    </head>
    <body>
        <div>
            <img src="../assets/images/utils/signout.png" alt="Sign out">
        </div>
        <h1>Urban Store</h1>
        <form action="#" method='POST'>
            <div>
                <div>
                    <div class='panel' id='categories'>
                        <div class='image'>
                            <img src="../assets/images/utils/categories.png" alt="Categories">
                        </div>
                        <p>Categories</p>
                    </div>
                    <div class='panel' id='dashboard'>
                        <div class='image'>
                            <img src="../assets/images/utils/dashboard.png" alt="Dashboard">
                        </div>
                        <p>Dashboard</p>
                    </div>
                    <div class='panel' id='customers'>
                        <div class='image'>
                            <img src="../assets/images/utils/customers.png" alt="Customers">
                        </div>
                        <p>Customers</p>
                    </div>
                    <div class='panel' id='orders'>
                        <div class='image'>
                            <img src="../assets/images/utils/orders.png" alt="Orders">
                        </div>
                        <p>Orders</p>
                    </div>
                </div>
            </div>
            <div>
                <h2>Products</h2>
                <div id='searcher'>
                    <input type="text" name="q" placeholder="Search">
                    <!-- LA IMAGEN SE PONE DESDE EL CSS CON EL BACKGROUND-IMAGE, AQUI SE DEJARIA EL BOTON SOLO -->
                    <button type="submit"><img src="../assets/images/utils/search.png" alt="Search"></a></button>
                    <button type="submit"><img src="../assets/images/utils/addProduct.png" alt="Add Product"></a></button>
                </div>
                <div>
                    <?php AdminProductsController::showProducts(); ?>
                </div>
            </div>
        </form>
    </body>
</html>