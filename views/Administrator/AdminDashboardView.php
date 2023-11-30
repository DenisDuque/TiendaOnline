<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="scss/css/main.css"> -->
        <title>Dashboard</title>
    </head>
    <body>
        <div>
            <img src="views/assets/images/utils/signout.png" alt="Sign out">
        </div>
        <div>
            <h1>Urban Store</h1>
            <h2>Administrator Panel</h2>
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
            <h3>Best Sellers</h3>
            <!-- Aqui va la parte php para saber si hay algun resultado en la query de Best Sellers -->
            <?php // bestSellers();
            ?>
        </div>
    </body>
</html>