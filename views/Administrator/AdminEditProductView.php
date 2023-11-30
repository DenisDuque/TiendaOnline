<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include("ProductModel.php");
        function fillInfoProduct($id){
            $product = new ProductModel()->getProductFromId($id);

            ?>
            <form action="">
                <label for="code">Product code</label>
                <label for="code"><?php echo $product->getCode() ?></label>

                <label for="name">Product Name</label>
                <input type="text" name="productName" value=<?php echo $product->getName() ?>>

                <label for="name">Price</label>
                <input type="text" name="productPrice" value=<?php echo $product->getPrice() ?>>
 
                <label for="name">Stock</label>
                <input type="text" name="stock" value=<?php ?>>


            </form>




            <?php
        }
    
    ?>
</body>
</html>