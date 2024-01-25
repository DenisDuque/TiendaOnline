<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="views\scss\css\main.css.css">
    <script src="views\js\productPage.js"></script>
</head>
<body>
    <?php         
        require_once("views\General\Components\headerHome.html");
    ?>
    
    <main id="productPage">
    <?php
        echo "<div id='main'>";
            echo "<div id='allImages'>";
                echo "<div id='images'>";
                    echo 
                        "<div class='image'>
                            <img src='".$product["img"]."' alt='producto'>
                        </div>";
                    echo 
                        "<div class='image'>
                            <img src='".$product["img"]."' alt='producto'>
                        </div>";
                    echo 
                        "<div class='image'>
                            <img src='views\assets\images\utils\perro.jpg' alt='producto'>
                        </div>";
                    echo 
                        "<div class='image'>
                            <img src='views\assets\images\utils\perro.jpg' alt='perro'>
                        </div>";
                echo "</div>";
                echo 
                "<div class='image' id='mainImage'>
                    <img src='".$product["img"]."' alt='producto' id='main'>
                </div>";
            echo "</div>";

            
            echo "<div id='info'>";
                echo "<h1>".$product["name"]."</h1>";
                echo "<h2>".$product["category"]["name"]."</h3>";
                echo "<h3>$".$product["price"]."</h3>";
                echo "<h3>".$product["stock"]." available units</h3>";
                echo "<h3>Choose a size</h3>";
                $sizes = explode(",",$product["size"]);
                echo "<div id='options'>";
                    echo "<div id='sizes'>";
                        $chars = array("{", "}", '"');
                        foreach($sizes as $size){
                            echo "<button class='sizeBtn'>EU".str_replace($chars, "", $size)."</button>";
                        }
                    echo "</div>";
                    echo "<div id='description'>";
                        echo "<h3>Description</h3>";
                        echo "<h4>".$product["description"]."</h4>";
                    echo "</div>";
                    echo "<div id='buttons'>";
                        //wishlist btn
                        if(!isset($_SESSION["email"])){
                            echo "<form action='index.php?page=user&action=default&code=".$_GET["code"]."' method='post'>";
                        }else{
                            echo "<form action='index.php?page=product&action=showProduct&code=".$_GET["code"]."' method='post'>";
                        }
                                echo "<input type='hidden' name='function' value='wishlist'>";
                                echo "<button type='submit' id='wishlist'>";
                                    echo "<p>wishlist</p>";
                                    if($product["inWishList"]){
                                        echo "<img src='views/assets/images/utils/redHeart.png' alt='heart'>";
                                    }else{
                                        echo "<img src='views/assets/images/utils/emptyHeart.png' alt='heart'>";
                                    }
                                echo "</button>";
                            echo "</form>";
                        
                        //add to cart btn
                        if(!isset($_SESSION["email"])){
                            echo "<form action='index.php?page=user&action=default&code=".$_GET["code"]."' method=post>";
                        }else{
                            echo "<form action='index.php?page=product&action=default&code=".$_GET["code"]."' method=post>";
                        }
                                echo "<input type='hidden' name='function' value='cart'>";
                                echo "<button type='submit' id='wishlist'>";
                                    echo "<p>Add to cart</p>";
                                echo "</button>";
                            echo "</form>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    ?>
    </main>
</body>
</html>




