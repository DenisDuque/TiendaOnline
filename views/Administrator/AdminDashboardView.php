<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="views/scss/css/administrator.css">
        <script src="views/js/Administrator.js"></script>
        <title>Dashboard</title>
    </head>
    <body>
        <header>
            <h1>Urban Store</h1>
            <img src="views/assets/images/utils/signout.png" alt="Sign out">
        </header>
        <div id="container">
            <div id="leftPanel">
                <div class="panels">
                    <div class='panel' id='categories'>
                        <div class='image'>
                            <img src="views/assets/images/utils/categories.png" alt="Categories">
                        </div>
                        <p>Categories</p>
                    </div>
                    <div class='panel' id='products'>
                        <div class='image'>
                            <img src="views/assets/images/utils/products.png" alt="Products">
                        </div>
                        <p>Products</p>
                    </div>
                    <div class='panel' id='customers'>
                        <div class='image'>
                            <img src="views/assets/images/utils/customers.png" alt="Customers">
                        </div>
                        <p>Customers</p>
                    </div>
                    <div class='panel' id='orders'>
                        <div class='image'>
                            <img src="views/assets/images/utils/orders.png" alt="Orders">
                        </div>
                        <p>Orders</p>
                    </div>
                </div>
            </div>
            <div id="rightPanel">
                <h2>Administrator Panel</h2>
                <div id="listContainer">
                    <?php AdminDashboardController::bestSellers(); ?>
                </div>
            </div>
        </div>
    </body>
</html>