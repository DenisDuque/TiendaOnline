<!-- http://localhost/TiendaOnline/index.php?page=Product&action=showSearchProducts -->
<!--Header include-->
<?php
        require_once("views\General\Components\headerHome.html");
    ?>
<div>
    <nav>
        <input type="text" class="search" placeholder="Search">
        <h3>Sort by</h3>
        <select id="sortInput" name="active" id="select">
            <option id="noSort" value="none">None</option>
            <option value="high-low">Price: High-low</option>
            <option value="low-high">Price: Low-high</option>
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
</div>
<script src="views/js/ProductSearch.js"></script>