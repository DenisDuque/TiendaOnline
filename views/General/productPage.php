<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        echo "<img src='views/assets/images/products/../utils/productImage.png' alt='producto'>";
        echo "<img src='views/assets/images/products/../utils/productImage.png' alt='producto'>";
        echo "<img src='views/assets/images/products/../utils/productImage.png' alt='producto'>";
        echo "<img src='views/assets/images/products/../utils/productImage.png' alt='producto'>";
        echo "<img src='views/assets/images/products/../utils/productImage.png' alt='producto'>";
        echo "<h1>".$product["name"]."</h1>";
        echo "<h3>".$product["category"]["name"]."</h3>";
        echo "<h3>$".$product["price"]."</h3>";
        echo "<h3>Choose a size</h3>";
        //aqui las tallas que es una movida eso la vd
    ?>
    <button>WishList</button>
    <button>Add to cart</button>
</body>
</html>