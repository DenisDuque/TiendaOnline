<div class="formProd" id="formEditProduct">
    <button id="closeEditProductForm"><img src='views/assets/images/utils/signout.png'></button>
    <form id="EditProdForm" action="index.php?page=Product&action=editProduct" method="POST" enctype="multipart/form-data">
        <table> 
            <input type="hidden" name="code" id="code">
            <tr><td><div>Product code</div></td></tr>
            <tr><td><div id="productCode"></div></td></tr>
            <tr>
                <td>
                    <div id="productCode"></div>
                </td>
            </tr>
            <tr><td><label for="name">Name product</label></td></tr>
            <tr>
                <td>
                    <input type="text" name="name" id="name">
                </td>
            </tr>
            <tr><td><label for="price">Price</label></td></tr>
            <tr>
                <td>
                    <input type="text" name="price" id="price">
                </td>
            </tr>
            <tr><td><label for="stock">Stock</label></td></tr>
            <tr>
                <td>
                    <input type="text" name="stock" id="stock">
                </td>
            </tr>
            <tr><td><label for="description">Description</label></td></tr>
            <tr>
                <td>
                    <input type="text" name="description" id="description">
                </td>
            </tr>
            <tr><td><label for="">Featured</label></td></tr>
            <tr>
                <td>
                    <input type="checkbox" name="featured" id="featured">
                </td>
            </tr>

            <tr><td><label for="">Status</label></td></tr>
            <tr>
                <td>
                    <select name="active" id="select">
                        <option id="enabled" value="enabled">enabled</option>
                        <option id="disabled" value="disabled">disabled</option>
                    </select>
                </td>
            </tr>
            <tr><td><label for="">Category</label></td></tr>
            <tr>
                <td>
                    <select name="category" id="category"> 
                        <?php 
                            $categories = CategoryController::generateCategoriesOptions();
                            foreach ($categories as $category) {
                                echo "<option id='".$category->getCode()."' value='".$category->getCode()."'>".$category->getName()."</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr><td><label for="">Perspectives</label></td></tr>
            <tr>
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
            <tr>
                <td><label for="">Sizes</label></td>
                <td><input type="text" id="sizeInput" placeholder="Add a size"></td>
                <td><button type="button" class='addSizeBtn'>+</button></td>
            </tr>
            <tr>
                <td><div id="sizeList"></div></td>
            </tr>
            <input type="hidden" id="sizeInp" name="sizes">
            <tr><td><input type="submit" class="submitBtn" value="Save changes"></td></tr>
        </table>
    </form>
</div>