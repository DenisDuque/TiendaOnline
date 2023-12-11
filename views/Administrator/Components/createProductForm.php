<div id="createProductForm">
    <form>
        <label for="name">Category Name</label>
        <input name="name" class="name" type="text">
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
        <input type="submit" value="Save changes">
    </form>
</div>