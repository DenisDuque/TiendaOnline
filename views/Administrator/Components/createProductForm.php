<div id="createProductForm">
    <form>
        <label for="name">Product Name</label>
        <input name="name" class="name" type="text">
        <label for="price">Price</label>
        <input name="price" class="price" type="text">
        <label for="stock">Stock</label>
        <input name="stock" class="stock" type="text">
        <label for="status">Status</label>
        <select name="status">
            <option value="enabled">Enabled</option>
            <option value="dissabled">Dissabled</option>
        </select>
        <label for="category">Category</label>
        <select name="category">
            <?php
                require_once __DIR__.'/../../../controllers/AdminCategoriesController.php';
                CategoryController::generateCategoriesOptions();
            ?>
        </select>
        <label>Images</label>
        <input type="file" id="sideView">
        <input type="file" id="aboveView">
        <input type="file" id="bottomView">
        <input type="file" id="3dView">
        <label>Size</label>
        <!--  -->
        <input type="submit" value="Save changes">
    </form>
</div>