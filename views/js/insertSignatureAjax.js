document.addEventListener("DOMContentLoaded", function() {
    var botonGuardar = document.getElementById("botonGuardar");
    botonGuardar.addEventListener("click", function() {
        $.ajax({ 
            url: "index.php?page=Product&action=adminSignature",
            type: "POST",
            contentType: 'application/json; charset=UTF-8',
            success: function(response) {
                console.log(response);
            }
        });
    });
});