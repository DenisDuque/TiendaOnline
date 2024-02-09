<!-- http://localhost/TiendaOnline/index.php?page=Product&action=showSearchProducts -->
<!--Header include-->
<?php
        require_once("views\General\Components\headerHome.html");
?>
<section>
    <nav class="searchNav">
        <div></div>
        <input type="text" id="searchInput" class="search" placeholder="Search">
        <div id="sortby">
            <h3>Sort by: </h3>
            <select id="sortInput" name="active" id="select">
                <option id="noSort" value="none">None</option>
                <option value="high-low">Price: High-low</option>
                <option value="low-high">Price: Low-high</option>
            </select>
        </div>
    </nav>
    
    <nav>
        <ul id="categories">
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
<script src="views/js/initSearch.js"></script>