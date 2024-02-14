<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/scss/css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Urban Store</title>
</head>
<header>
    <div>
        <!--Logo Image-->
        <img src="views/assets/images/utils/logo.png" alt="Urban store logo">
        <!--Title-->
        <h1>Urban store</h1>
    </div>
    <!--Options-->
    <nav>
        <ul id="headerMenu">
            <li><a href="index.php?page=Product&action=default"><img id="homeButton" src="views/assets/images/utils/home.png" alt="Home"></a></li>
            <li><a href="index.php?page=Product&action=showSearchProducts"><img id="searchButton" src="views/assets/images/utils/search.png" alt="Search"></a></li>
            <li><a href="index.php?page=User&action=showWishlist"><img id="outstandingButton" src="views/assets/images/utils/wishlist.png" alt="Outstanding"></a></li>
            <li class="cart-li">
                <a href="index.php?page=Orders&action=showCart">
                    <span id="cartNumber" class="dot"></span>
                    <img id="cartButton" src="views/assets/images/utils/cart.png" alt="Cart">
                </a>
            </li>
            <li><a href="index.php?page=User&action=showProfile"><img id="customersButton" src="views/assets/images/utils/profile.png" alt="Profile"></a></li>
            <?php
                if(isset($_SESSION["email"])){
                    echo "<li><a href='index.php?page=User&action=LogOut'><img id='logoutClientButton' src='views/assets/images/utils/signout.png'></a></li>";
                }
            ?>
        </ul>
    </nav>
    <script src="views/js/cartNumber.js"></script>
</header>