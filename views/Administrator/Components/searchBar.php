<div id='navBar'>
    <div id='searchBar'>
        <?php $value = isset($_GET['search']) ? $_GET['search'] : ''; 
            echo '<input id="search" type="text" name="search" value="'.$value.'" placeholder="Search">';
        ?>
        <div id="searchBtn"><img src="views/assets/images/utils/search.png" alt="Search"></a></div>
    </div>
    <?php
        if(($_GET['action'] == 'showAdminProduct') OR ($_GET['action'] == 'showAdminCategory')) {
            if($_GET['action'] == 'showAdminProduct') {
                echo '<div id="addBtn" class="addCreateProductForm"><img src="views/assets/images/utils/add.png" alt="Add"></a></div>';
            } else {
                echo '<div id="addBtn" class="addCreateCategoryForm"><img src="views/assets/images/utils/add.png" alt="Add"></a></div>';
            }
            
        }
    ?>
</div>