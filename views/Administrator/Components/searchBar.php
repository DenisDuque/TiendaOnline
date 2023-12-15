<div id='navBar'>
    <div id='searchBar'>
        <?php $value = isset($_GET['search']) ? $_GET['search'] : ''; 
            echo '<input id="search" type="text" name="search" value="'.$value.'" placeholder="Search">';
        ?>
        <div id="searchBtn"><img src="views/assets/images/utils/search.png" alt="Search"></a></div>
    </div>
    <?php
        if(($_GET['action'] == 'showAdminProduct') OR ($_GET['action'] == 'showAdminCategory')) {
            echo '<div id="addBtn"><img src="views/assets/images/utils/add.png" alt="Add"></a></div>';
        }
    ?>
</div>