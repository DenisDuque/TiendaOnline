<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: #ABABAB;
            justify-content: left;
            display: grid;
            grid-gap: 40px;
            grid-template-columns: 10% 40% 40%;

        }
        .image{
            background-color: white;
            border-radius: 30px;
            img{
                size: 80%;
            }
            margin-left: auto;
        }
        .image:hover{
            background-color: rgba(255, 94, 0, 0.40);
        }
        #images{
            grid-column-start: 1;
            grid-column-end: 1;
            display: grid;
            grid-template-rows: repeat(25%,4);
            grid-gap: 20px;
            .image{
                width: 50%;
                img{
                    width: 100%;
                    height: auto;
                }
            }
        }
        #mainImage{
            grid-column-start: 2;
            grid-column-end: 3;
        }
        #info{
            grid-column-start: 3;
            grid-column-end: 4;
            #sizes{
                justify-content: space-around;
            }
        }
        button{
            border: none;
            border-radius: 20px;
        }

    </style>
</head>
<body>
    <?php 
        echo "<div id='images'>";
            echo 
                "<div class='image'>
                    <img src='views/assets/images/products/..".$product["img"]."' alt='producto'>
                </div>";
            echo 
                "<div class='image'>
                    <img src='views/assets/images/products/..".$product["img"]."' alt='producto'>
                </div>";
            echo 
                "<div class='image'>
                    <img src='views/assets/images/products/..".$product["img"]."' alt='producto'>
                </div>";
            echo 
                "<div class='image'>
                    <img src='views/assets/images/products/../utils/perro.jpg' alt='perro'>
                </div>";
        echo "</div>";
        echo "<h1>".$product["img"]."</h1>";
        echo 
        "<div class='image' id='mainImage'>
            <img src='views/assets/images/products/..".$product["img"]."' alt='producto'>
        </div>";
        
        echo "<div id='info'>";
            echo "<h1>".$product["name"]."</h1>";
            echo "<h3>".$product["category"]["name"]."</h3>";
            echo "<h3>$".$product["price"]."</h3>";
            echo "<h3>Choose a size</h3>";
            $sizes = explode(",",$product["size"]);
            echo "<div id='sizes'>";
                foreach($sizes as $size){
                    echo "<button>$size</button>";
                    echo "<button>$size</button>";
                    echo "<button>$size</button>";
                    echo "<button>$size</button>";
                    echo "<button>$size</button>";
                    echo "<button>$size</button>";
                    echo "<button>$size</button>";
                    echo "<button>$size</button>";
                    echo "<button>$size</button>";
                }
            echo "</div>";
            echo "<button>WishList</button>";
            echo "<button>Add to cart</button>";
        echo "</div>";

        //aqui las tallas que es una movida eso la vd
    ?>
</body>
</html>




