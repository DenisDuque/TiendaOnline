<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <script src="views\js\productPage.js"></script>
    <style>
        body{
            width: 100vw;
            height: 100vh;
            background-color: #ececec;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        *{
            font-family: 'Kanit';
            margin: 0;
            padding: 0;
        }
        #main{
            display: grid;
            grid-template-columns: 50vw 50vw;
            justify-content: left;
            justify-self: left;
        }
        .image{
            background-color: white;
            border-radius: 15px;
            margin-left: auto;
        }
        .image:hover{
            background-color: #ff5e00;
        }

        .clicked{
            background-color: rgba(255, 94, 0, 0.40);
            border-radius: 30px;
            margin-left: auto;
        }
      
        #allImages{
            width: 65vw;
            height: 80vh;
            display: grid;
            grid-template-columns: 50% 50%;
            justify-self: right;
            padding-right: 1vw;
            #images{
                height: 60%;
                align-self: center;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-around;
                padding-right: 1vw;
                .image, .clicked{
                    width: 5vw;
                    height: auto;
                    display: flex;
                    img{
                        width: 100%;
                        height: auto;
                    }
                }
            }
            #mainImage{
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                img{
                    width: 100%;
                }
            }
        }
        #info{
            width: 70%;
            grid-column-start: 2;
            grid-column-end: 3;
            #sizes{
                width: auto;
                display: flex;
                flex-wrap: wrap;
                button{
                    width: 30%;
                    margin: 3px;
                }
            }
            #buttons{
                width: 100%;
                padding-top:10px;
                display: flex;
                justify-content: space-between;s
            }
            h1{
                font-size: 50px;
            }
            h3{
                font-size: 30px;
            }
        }
        button, button:hover{
            border: none;
            border-radius: 10px;
            background-color: #FFFFFF;
            font-size: 20px;        
            width: 20%;
        }

        button:hover{
            background-color: #ff5e00;
        }

    </style>
</head>
<body>
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
                            <img src='".$product["img"]."' alt='producto'>
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
                echo "<h3>".$product["category"]["name"]."</h3>";
                echo "<h3>$".$product["price"]."</h3>";
                echo "<h3>Choose a size</h3>";
                $sizes = explode(",",$product["size"]);
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
                echo "<div id='buttons'>";
                    echo "<button id='wishlist'>WishList</button>";
                    echo "<button id='cart'>Add to cart</button>";
                Echo "</div>";
            echo "</div>";
        echo "</div>";

        //aqui las tallas que es una movida eso la vd
    ?>
</body>
</html>




