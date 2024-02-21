document.addEventListener("DOMContentLoaded", function () {
    // Validación para el formulario editCategoryForm
    var editCategoryForm = document.getElementById("editCategoryForm");
    if (editCategoryForm) {
        initializeFormValidation(editCategoryForm);
    }

    // Validación para el formulario createCategoryForm
    var createCategoryForm = document.getElementById("createCategoryForm");
    if (createCategoryForm) {
        initializeFormValidation(createCategoryForm);
    }

    function initializeFormValidation(form) {
        var nameInput = form.getElementById("name");
        var submitBtn = form.querySelector(".submitBtn");
        var errorSpan = form.getElementById("error");

        form.addEventListener("submit", function (event) {
            if (!isValidName(nameInput.value)) {
                errorSpan.textContent = 'Invalid name';
                errorSpan.style.color = 'red';
                event.preventDefault();
            } else {
                errorSpan.innerHTML = "";
            }
        });

        nameInput.addEventListener("input", function () {
            if (!isValidName(nameInput.value)) {
                errorSpan.textContent = 'Invalid name';
                errorSpan.style.color = 'red';
                submitBtn.disabled = true;
            } else {
                errorSpan.innerHTML = "";
                submitBtn.disabled = false;
            }
        });

        function isValidName(name) {
            var regex = /[\$&\-_/%()@<>]/;
            return !regex.test(name);
        }
    }
});
