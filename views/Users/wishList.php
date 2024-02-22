<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="views/scss/css/main.css">
</head>
<body>
    <main>
        <section id='itemsContainer' aria-label="Lista de articulos que has añadidoa tu lista de deseados">
    <?php
        foreach($products as $code=>$product){
            echo "<article id='$code' class='product-article'>";
                echo "<img class='product-heart' src='views/assets/images/utils/defaultheart.png'>";
                echo "<img class='product-heart' src='views/assets/images/products/".$product["lateral"]."'>";
                echo "<p>".$product["name"]."</p>";
                echo "<p>".$product["price"]."</p>";
            echo "</article>";
        }
    ?>
        </section>
    </main>
</body>
</html>