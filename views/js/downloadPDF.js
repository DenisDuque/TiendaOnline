function downloadOrder(data) {
    $.ajax({
        type: "POST",
        url: "index.php?page=orders&action=downloadOrder",
        contentType: 'application/json; charset=UTF-8',
        data: JSON.stringify(data),
        xhrFields: {
            responseType: 'blob'  // Establecer el tipo de respuesta esperada como blob
        },
        success: function (response) {
            var blob = new Blob([response], { type: 'application/pdf' });
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'order.pdf';
            link.click();
        },
        error: function (xhr, status, error) {
            console.error("Error en la petición AJAX:", status, error);
            console.log(xhr.responseText);
        }
    });
}

function showCart() {
    // Realiza la acción correspondiente para mostrar el carrito
    // Puedes agregar tu lógica aquí
    console.log("Mostrar carrito");
}

// Llamas a la función pasando un objeto que contiene los tres elementos

document.getElementById("descargar").addEventListener("click", function () {
    downloadOrder(data);
});

document.getElementById("cancelar").addEventListener("click", function () {
    showCart();
});