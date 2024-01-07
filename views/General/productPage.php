<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="views\js\productPage.js"></script>
    <style>
        body{
            background-color: #ABABAB;
            display: grid;
            grid-gap: 40px;
            grid-template-columns: 50% 50%;
        }
        .image{
            background-color: white;
            border-radius: 30px;
            margin-left: auto;
        }
        .image:hover{
            background-color: rgba(255, 94, 0, 0.40);
        }

        .clicked{
            background-color: rgba(255, 94, 0, 0.40);
            border-radius: 30px;
            margin-left: auto;
        }
      
        #allImages{
            display: grid;
            grid-template-columns: 40% 60%;
            #images{
                width: 40%;
                height: 80%;
                display: flex;
                flex-direction: column;
                justify-self: right;
                align-self: center;
                justify-content: space-around;
                padding-right: 40px;
                .image{
                    width: 60%;
                    img{
                        width: 100%;
                        height: auto;
                    }
                }
                .clicked{
                    width: 60%;
                    img{
                        width: 100%;
                        height: auto;
                    }
                }
            }
            #mainImage{
                width: 100%;
                height: 100%;
                img{
                    width: 100%;
                    height: 100%;
                }
            }
        }
        #info{
            grid-column-start: 2;
            grid-column-end: 3;
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
        echo "<div id='allImages'>";
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
                        <img src='views\assets\images\utils\perro.jpg' alt='perro'>
                    </div>";
            echo "</div>";
            echo 
            "<div class='image' id='mainImage'>
                <img src='views/assets/images/products/..".$product["img"]."' alt='producto' id='main'>
            </div>";
        echo "</div>";

        
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




