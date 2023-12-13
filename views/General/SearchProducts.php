<!-- http://localhost/TiendaOnline/index.php?page=Product&action=showSearchProducts -->
<nav>
    <!--Search bar-->
    <h3>Sort by</h3>
    <select name="active" id="select">
        <option id="outstanding" value="outstanding">Outstanding</option>
        <option id="newest" value="newest">Newest</option>
        <option id="high-low" value="high-low">Price: High-low</option>
        <option id="low-high" value="low-high">Price: Low-high</option>
    </select>
</nav>

<nav>
    <ul id="categories">
        <?php
            foreach ($categories as $category) {
                echo '<li id="'.$category->getCode().'">'.$category->getName().'</li>';
            }
        ?>
    </ul>
</nav>
<section>
    <?php
        foreach ($products as $product) {
            $inWishlist = "../assets/utils/defaultHeart";
            echo '
                <article>
                    <img src="'.$inWishlist.'" alt="Wishlist">
                    <img src="'.$product->getImage("lateral").'" alt="Wishlist">
                    <p>'.$product->getName().'</p>
                    <p>$'.$product->getPrice().'</p>
                </article>
            ';
        }
    ?>
</section>