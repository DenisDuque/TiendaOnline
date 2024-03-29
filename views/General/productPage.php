<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="views\scss\css\productPage.css">
    <script src="views\js\productPage.js"></script>
</head>
<body>
    <?php         
        require_once("views\General\Components\headerHome.php");
    ?>
    
    <main>
    <?php
        echo "<div id='main'>";
            echo "<div id='allImages' aria-label='imagen principal y seleccionables'>";
                echo "<div id='images'>";
                    echo 
                        "<div class='image imageBtn'>
                            <img src='views/assets/images/products/".$product["lateral"]."' alt='Foto lateral del producto'>
                        </div>";
                    echo 
                        "<div class='image imageBtn'>
                            <img src='views/assets/images/products/".$product["bottom"]."' alt='Foto de la parte inferior del producto'>
                        </div>";
                    echo 
                        "<div class='image imageBtn'>
                            <img src='views/assets/images/products/".$product["top"]."' alt='Foto de la imagen superior del producto'>
                        </div>";
                    echo 
                        "<div class='image' id='3d360'>
                            <img src='views\assets\images\utils\modelo3dEnlace.png' alt='Enlace al modelo 3D del producto'>
                        </div>";
                echo "</div>";
                echo 
                "<div class='image' id='mainImage'>
                    <img src='views/assets/images/products/".$product["lateral"]."' alt='producto' id='main'>
                </div>";
            echo "</div>";

            
            echo "<div id='info' aria-label='Informacion del producto y botones de tallas, lista de deseos y compra'>";
                echo "<h1>".$product["name"]."</h1>";
                echo "<h2>".$product["category"]["name"]."</h3>";
                echo "<h3>$".$product["price"]."</h3>";
                echo "<h3>".$product["stock"]." available units</h3>";
                echo "<h3>Choose a size</h3>";
                $sizes = explode(",",$product["size"]);
                echo "<div id='options'>";
                    echo "<div id='sizes' aria-label='botones de seleccion de talla'>";
                        $chars = array("{", "}", '"', ' ');
                        foreach($sizes as $size){
                            echo "<button class='sizeBtn' value='&". str_replace($chars, "", $size) ."&".$product['stock']."'>EU".str_replace($chars, "", $size)."</button>";
                        }
                        if(isset($noSeleccionado)){
                            echo "<h4>$noSeleccionado</h4>";
                        }
                    echo "</div>";
                    echo "<div id='description'>";
                        echo "<h3>Description</h3>";
                        echo "<h4>".$product["description"]."</h4>";
                    echo "</div>";
                    echo "<div id='buttons' aria-label='Botones para añadir producto al carrito y a la lista de deseados'>";
                        //wishlist btn
                        if(!isset($_SESSION["email"])){
                            echo "<form action='index.php?page=user&action=default&code=".$_GET["code"]."' method='post'>";
                        }else{
                            echo "<form action='index.php?page=product&action=showProduct&code=".$_GET["code"]."' method='post'>";
                        }
                                echo "<input type='hidden' name='function' value='wishlist'>";
                                echo "<button type='submit' id='wishlist'>";
                                    echo "<p>Wishlist</p>";
                                    if($product["inWishList"]){
                                        echo "<img src='views/assets/images/utils/redHeart.png' alt='heart'>";
                                    }else{
                                        echo "<img src='views/assets/images/utils/emptyHeart.png' alt='heart'>";
                                    }
                                echo "</button>";
                            echo "</form>";
                        
                        //add to cart btn
                            echo "<form action='index.php?page=orders&action=productForCart' method=post>";
                                echo "<input type='hidden' name='productDetails' id='productDetails' value='".$_GET["code"]."'>";
                                if(isset($_SESSION['email'])) {
                                    echo "<button type='submit'>";
                                        echo "<p>Add to cart</p>";
                                    echo "</button>";
                                } else {
                                    echo "<button type='submit' id='addCart'>";
                                        echo "<p>Add to cart</p>";
                                    echo "</button>";
                                }
                            echo "</form>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    ?>
    </main>
</body>
</html>




