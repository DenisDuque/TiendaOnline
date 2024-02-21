<script src="views/js/validacion.js"></script>
<div class="formProd" id="formCreateProduct">
    <button id="closeCreateProductForm"><img src='views/assets/images/utils/signout.png'></button>
    <form id="CreateProdForm" action="index.php?page=Product&action=createProduct" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="name" class="underline">Name product</label></td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="name" id="name" required>
                </td>
            </tr>
            <tr>
                <td>
                    <span id="error"></span>
                </td>
            </tr>
            <tr>
                <td><label for="price" class="underline">Price</label></td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="price" id="price" required pattern="[0-9]+(\.[0-9]+)?">
                </td>
            </tr>
            <tr>
                <td><label for="stock" class="underline">Stock</label></td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="stock" id="stock" required pattern="[0-9]+">
                </td>
            </tr>
            <tr>
                <td><label for="description" class="underline">Description</label></td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="description" id="description" required>
                </td>
            </tr>
            <tr>
                <td><label for="" class="underline">Featured</label></td>
            </tr>
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
                            echo "<option id='" . $category->getCode() . "' value='" . $category->getCode() . "'>" . ucfirst($category->getName()) . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="">Perspectives</label></td>
            </tr>
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
                <td id="addSize"><input type="text" id="sizeInputCreate" placeholder="Add a size"><button type="button" class='addSizeBtnCreate'>+</button></td>
            </tr>
            <tr>
                <td>
                    <div id="sizeListCreate"></div>
                </td>
            </tr>
            <input type="hidden" id="sizeInpCreate" name="sizes">
            <tr>
                <td><input type="submit" class="submitBtn" value="Save changes"></td>
            </tr>
        </table>
    </form>
</div>
<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtén el formulario y el campo de nombre
        var form = document.getElementById("EditProdForm");
        var nameInput = document.getElementById("name");
        var errorSpan = document.getElementById("error");

        // Agrega un evento de escucha para el cambio en el campo de nombre
        nameInput.addEventListener("input", function() {
            // Verifica la entrada del usuario en tiempo real
            if (!isValidName(nameInput.value)) {
                // Si la entrada no es válida, muestra el mensaje de error
                errorSpan.textContent = 'Invalid name';
                errorSpan.style.color = 'red';
                submitBtn.disabled = true; // Deshabilitar el botón de enviar
                event.preventDefault(); // Evitar el envío del formulario    
            } else {
                // Si la entrada es válida, borra el mensaje de error
                errorSpan.innerHTML = "";
            }
        });

        // Agrega un evento de escucha para el envío del formulario
        form.addEventListener("submit", function(event) {
            // Verifica la entrada del usuario antes de permitir el envío del formulario
            if (!isValidName(nameInput.value)) {
                // Si la entrada no es válida, evita que el formulario se envíe
                event.preventDefault();
            }
        });

        // Función para validar el campo de nombre
        function isValidName(name) {
            // Utiliza una expresión regular para verificar si el nombre contiene caracteres no permitidos
            var regex = /[\$&\-_/%()@<>]/;
            return !regex.test(name);
        }
    });
</script> -->