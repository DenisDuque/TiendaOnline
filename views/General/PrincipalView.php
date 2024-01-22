<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urban Store</title>
    <link rel="stylesheet" href="views/scss/css/main.css">
</head>
<body>
    <header>
        <!--Header include-->
        <?php
        require_once("views\General\Components\headerHome.html");
        ?>
    </header>
    <!--Image slider-->
    <div class="swiper-container">
        <div class="swiper-wrapper">    
            <div class="swiper-slide">
                <div class="text">
                    <h5>New Sales</h5>
                    <button class="ExploreNow" id="NewSales"><p>Explore Now</p></button>
                </div>
                <div class="foto">
                    <img src="views/assets/images/utils/productImage.png" alt="New Sales">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="text">
                    <h5>Athletic Shoes Collection</h5>
                    <button class="ExploreNow" id="AthleticShoes"><p>Explore Now</p></button>
                </div>
                <div class="foto">
                    <img src="views/assets/images/utils/nikeAthletics.png" alt="Athletic Shoes">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="text">
                    <h5>Coolest Flip Flops</h5>
                    <button class="ExploreNow" id="FlipFlops"><p>Explore Now</p></button>
                </div>
                <div class="foto">
                    <img src="views/assets/images/utils/flipFlops.png" alt="Flip Flops">
                </div>
            </div>
            <div class="swiper-slide">
                <div class="text">
                    <h5>New ST RUNNER V3 NL</h5>
                    <button class="ExploreNow" id="STRunnerV3NL"><p>Explore Now</p></button>
                </div>
                <div class="foto">
                    <img src="views/assets/images/utils/pumaRunning.png" alt="Running Shoes">
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
    <!--Categories options-->
    <div>
        <div>
            <h2>Categories</h2>
            <a src="#">Search</a>
        </div>
        <div>
            <!--Categories list code-->
        </div>
    </div>
    <!--All products container-->
    <div>
        <!--Products list-->
    </div>
</body>
</html>