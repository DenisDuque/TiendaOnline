<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customers</title>
    </head>
    <body>
        <div>
            <img src="../assets/images/utils/signout.png" alt="Sign out">
        </div>
        <h1>Urban Store</h1>
        <div>
            <div class='panel' id='categories'>
                <div class='image'>
                    <img src="../assets/images/utils/categories.png" alt="Categories">
                </div>
                <p>Categories</p>
            </div>
            <div class='panel' id='products'>
                <div class='image'>
                    <img src="../assets/images/utils/products.png" alt="Products">
                </div>
                <p>Products</p>
            </div>
            <div class='panel' id='dashboard'>
                <div class='image'>
                    <img src="../assets/images/utils/dashboard.png" alt="Dashboard">
                </div>
                <p>Dashboard</p>
            </div>
            <div class='panel' id='orders'>
                <div class='image'>
                    <img src="../assets/images/utils/orders.png" alt="Orders">
                </div>
                <p>Orders</p>
            </div>
        </div>
        <div>
            <h2>Customers</h2>
            <div id='searcher'>
                <form action="#" method='POST'>
                    <input type="text" name="q" placeholder="Search">
                    <!-- LA IMAGEN SE PONE DESDE EL CSS CON EL BACKGROUND-IMAGE, AQUI SE DEJARIA EL BOTON SOLO -->
                    <button type="submit"><img src="../assets/images/utils/search.png" alt="Search"></a></button>
                </form>
            </div>
            <div>
                <?php AdminCustomersController::listCustomers(); ?>
            </div>
        </div>
    </body>
</html>