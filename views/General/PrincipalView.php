<!-- http://localhost/TiendaOnline/index.php?page=Product -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urban Store</title>
    <link rel="stylesheet" href="views/scss/css/main.css">
</head>
<body>
    <!--Header include-->
    <?php
        include("views\General\Components\headerHome.html");
    ?>
    <!--Image slider-->
    <div class="swiper-container">
        <div class="swiper-wrapper">    
            <div class="swiper-slide">
                <div class="content">
                    <div class="text">
                        <h2>New Sales</h2>
                        <button class="ExploreNow" id="NewSales"><p>Explore Now</p></button>
                    </div>
                    <div class="foto">
                        <img src="views/assets/images/utils/productImage.png" alt="New Sales">
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="content">
                    <div class="text">
                        <h2>Athletic Shoes Collection</h2>
                        <button class="ExploreNow" id="AthleticShoes"><p>Explore Now</p></button>
                    </div>
                    <div class="foto">
                        <img src="views/assets/images/utils/nikeAthletics.png" alt="Athletic Shoes">
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="content">
                    <div class="text">
                        <h2>Coolest Flip Flops</h2>
                        <button class="ExploreNow" id="FlipFlops"><p>Explore Now</p></button>
                    </div>
                    <div class="foto">
                        <img src="views/assets/images/utils/flipFlops.png" alt="Flip Flops">
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="content">
                    <div class="text">
                        <h2>New ST RUNNER V3 NL</h2>
                        <button class="ExploreNow" id="STRunnerV3NL"><p>Explore Now</p></button>
                    </div>
                    <div class="foto">
                        <img src="views/assets/images/utils/pumaRunning.png" alt="Running Shoes">
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-buttons">
            <button class="swiper-button" data-index="0"></button>
            <button class="swiper-button" data-index="1"></button>
            <button class="swiper-button" data-index="2"></button>
            <button class="swiper-button" data-index="3"></button>
        </div>
    </div>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="views/js/slider.js"></script>
    <section class="home-products">
        <div class="categories-title">
            <h2>Categories</h2>
            <a href="index.php?page=Product&action=showSearchProducts">Search</a>
        </div>
        <nav>
            <ul id="categories">
                <li id="featured" class="category">Featured</li>
                <?php
                    foreach ($categories as $category) {
                        echo '<li id="'.$category->getCode().'" class="category">'.$category->getName().'</li>';
                    }
                ?>
            </ul>
            <button id="categories-show"><img src="views/assets/images/utils/selectArrow.png" alt="Flecha desplegable"/></button>
        </nav>
        <section id="itemsContainer"></section>
    </section>
    <script src="views/js/search.js"></script>
    <script src="views/js/mainPage.js"></script>
</body>
</html>