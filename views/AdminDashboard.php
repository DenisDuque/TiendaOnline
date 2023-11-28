<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
    </head>
    <body>
        <h1>Urban Store</h1>
        <div>
            <img src="assets/images/utils/signout.png" alt="Sign out">
        </div>
        <h2>Administrator Panel</h2>
        <div class='panel' id='categories'>
            <div class='image'>
                <img src="assets/images/utils/categories.png" alt="Categories">
            </div>
            <p>Categories</p>
        </div>
        <div class='panel' id='products'>
            <div class='image'>
                <img src="assets/images/utils/products.png" alt="Products">
            </div>
            <p>Products</p>
        </div>
        <div class='panel' id='customers'>
            <div class='image'>
                <img src="assets/images/utils/customers.png" alt="Customers">
            </div>
            <p>Customers</p>
        </div>
        <div class='panel' id='orders'>
            <div class='image'>
                <img src="assets/images/utils/orders.png" alt="Orders">
            </div>
            <p>Orders</p>
        </div>
        <h3>Best Sellers</h3>
        <!-- Aqui va la parte php para saber si hay algun resultado en la query de Best Sellers -->
        <?php
        // llamamos a la funcion BestSeller();
        // function BestSeller(){
            // if($resltado=false){
            //     // se ponen del top 1 al top 4, en caso de haber 4 o más.
            // }else{
            //     echo "<p>There is no Best Sellers yet!</p>";
            // }
        // }
        ?>
    </body>
</html>