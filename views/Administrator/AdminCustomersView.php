<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="views/scss/css/administrator.css">
        <script src="views/js/Administrator.js"></script>
        <title>Customers</title>
    </head>
    <body>
        <div>
            <img src="views/assets/images/utils/signout.png" alt="Sign out">
        </div>
        <h1>Urban Store</h1>
        <div>
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
            <div class='panel' id='dashboard'>
                <div class='image'>
                    <img src="views/assets/images/utils/dashboard.png" alt="Dashboard">
                </div>
                <p>Dashboard</p>
            </div>
            <div class='panel' id='orders'>
                <div class='image'>
                    <img src="views/assets/images/utils/orders.png" alt="Orders">
                </div>
                <p>Orders</p>
            </div>
        </div>
        <div>
            <h2>Customers</h2>
            <div id='searcher'>
                <?php $value = isset($_GET['search']) ? $_GET['search'] : ''; 
                    echo '<input id="search" type="text" name="search" value="'.$value.'" placeholder="Search">';
                ?>
                <div id="searchBtn"><img src="views/assets/images/utils/search.png" alt="Search"></a></div>
            </div>
            <div>
                <?php AdminCustomersController::listCustomers(); ?>
            </div>
        </div>
    </body>
</html>