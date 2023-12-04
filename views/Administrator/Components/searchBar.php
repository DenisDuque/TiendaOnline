<div id='searcher'>
    <?php $value = isset($_GET['search']) ? $_GET['search'] : ''; 
        echo '<input id="search" type="text" name="search" value="'.$value.'" placeholder="Search">';
    ?>
    <div id="searchBtn"><img src="views/assets/images/utils/search.png" alt="Search"></a></div>
</div>