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
        require_once("views\Administrator\Components\headerHome.html");
    ?>
    <main>
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
                        foreach($sizes as $size){
                            echo "<button>EU$size</button>";
                            echo "<button>EU$size</button>";
                            echo "<button>EU$size</button>";
                            echo "<button>EU$size</button>";
                            echo "<button>EU$size</button>";
                            echo "<button>EU$size</button>";
                            echo "<button>EU$size</button>";
                            echo "<button>EU$size</button>";
                        }
                    echo "</div>";
                    echo "<div id='description'>";
                        echo "<h3>Description</h3>";
                        echo "<h4>".$product["description"]."</h4>";
                    echo "</div>";
                    echo "<div id='buttons'>";
                        if(!isset($_SESSION["email"])){
                            echo "<a id='wishlist' href='index.php?page=user&action=default&origin=".$product["code"]."&function=wishlist'>";
                        }else{
                            echo "<a id='wishlist' href='index.php?page=product&action=showProduct&origin=".$product["code"]."&function=wishlist'>";

                        }
                            echo "<p>WishList</p>";
                                if($product["inWishList"]){
                                    echo "<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' class='inWishList'>";
                                }else{
                                    echo "<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>";
                                }
                                    echo "<path d='M12 20a1 1 0 0 1-.437-.1C11.214 19.73 3 15.671 3 9a5 5 0 0 1 8.535-3.536l.465.465.465-.465A5 5 0 0 1 21 9c0 6.646-8.212 10.728-8.562 10.9A1 1 0 0 1 12 20z'/>";
                                echo "</svg>";
                            echo "</a>";
                        echo "<a id='cart' href='index.php?page=user&action=default&origin=".$product["code"]."&function=cart'>Add to cart</a>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
        //aqui las tallas que es una movida eso la vd
    ?>
    </main>
</body>
</html>




