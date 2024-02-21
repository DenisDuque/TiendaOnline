document.addEventListener("DOMContentLoaded", function () {
    // Obtén el formulario y el campo de nombre
    var editForm = document.getElementById("EditProdForm");
    var createForm = document.getElementById("CreateProdForm");

    initializeForm(editForm);
    initializeForm(createForm);

    // Función para inicializar el formulario
    function initializeForm(form) {
        if (!form) return;

        var nameInput = form.getElementById("name");
        var errorSpan = form.getElementById("error");
        var submitBtn = form.querySelector(".submitBtn");

        // Agrega un evento de escucha para el cambio en el campo de nombre
        nameInput.addEventListener("input", function () {
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
                submitBtn.disabled = false; // Habilitar el botón de enviar
            }
        });

        // Agrega un evento de escucha para el envío del formulario
        form.addEventListener("submit", function (event) {
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
    }
});
