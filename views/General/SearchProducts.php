<!-- http://localhost/TiendaOnline/index.php?page=Product&action=showSearchProducts -->
<script src="views/js/ProductSearch.js"></script>
<script id="productData" type="application/json">
    <?php echo $jsonResult; ?>
</script>

<nav>
    <input type="text" class="search" placeholder="Search">
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
                echo '<li id="'.$category->getCode().'" class="category">'.$category->getName().'</li>';
            }
        ?>
    </ul>
</nav>
<section id="itemsContainer"></section>