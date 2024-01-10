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
                        echo "<button id='wishlist'>WishList</button>";
                        echo "<button id='cart'>Add to cart</button>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        echo "</div>";

        //aqui las tallas que es una movida eso la vd
    ?>
    </main>
</body>
</html>




