<div class="formProd" id="formCreateProduct">
    <button id="closeCreateProductForm"><img src='views/assets/images/utils/signout.png'></button>
    <form id="CreateProdForm" action="index.php?page=Product&action=createProduct" method="POST" enctype="multipart/form-data">
        <table>
            <tr><td><label for="name" class="underline">Name product</label></td></tr>
            <tr>
                <td>
                    <input type="text" name="name" id="name" required>
                </td>
            </tr>
            <tr></tr>
            <tr><td><label for="price"  class="underline">Price</label></td></tr>
            <tr>
                <td>
                    <input type="text" name="price" id="price" required pattern="[0-9]+(\.[0-9]+)?">
                </td>
            </tr>
            <tr><td><label for="stock"  class="underline">Stock</label></td></tr>
            <tr>
                <td>
                    <input type="text" name="stock" id="stock" required pattern="[0-9]+">
                </td>
            </tr>
            <tr><td><label for="description"  class="underline">Description</label></td></tr>
            <tr>
                <td>
                    <input type="text" name="description" id="description" required>
                </td>
            </tr>
            <tr><td><label for=""  class="underline">Featured</label></td></tr>
            <tr>
                <td>
                    <input type="checkbox" name="featured" id="featured">
                </td>
            </tr>
            
            <tr>
                <td id="status">
                    <label for="">Status</label>
                    <select name="active" id="select">
                        <option id="enabled" value="enabled">Enabled</option>
                        <option id="disabled" value="disabled">Disabled</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td id="category">
                    <label for="">Category</label>
                    <select name="category" id="category"> 
                        <?php 
                            $categories = CategoryController::generateCategoriesOptions();
                            foreach ($categories as $category) {
                                echo "<option id='".$category->getCode()."' value='".$category->getCode()."'>".ucfirst($category->getName())."</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr><td><label for="">Perspectives</label></td></tr>
            <tr id="views">
                <td>
                    <label for="Side">Side</label>
                    <input type="file" id="Side" name="Side" style='display:none;'>
                </td>
                <td>
                    <label for="Bottom">Bottom</label>
                    <input type="file" id="Bottom" name="Bottom" style='display:none;'>
                </td>
                <td>
                    <label for="Up">Up</label>
                    <input type="file" id="Up" name="Up" style='display:none;'>
                </td>
                <td>
                    <label for="3D">3D</label>
                    <input type="file" id="3D" name="3D" style='display:none;'>
                </td>
            </tr>
            <tr id="sizes">
                <td><label for="">Sizes</label></td>
                <td id="addSize"><input type="text" id="sizeInput" placeholder="Add a size"><button type="button" class='addSizeBtn'>+</button></td>
            </tr>
            <tr>
                <td>
                    <div id="sizeList"></div>
                </td>
            </tr>
            <input type="hidden" id="sizeInp" name="sizes">
            <tr><td><input type="submit" class="submitBtn" value="Save changes"></td></tr>
        </table>
    </form>
</div>