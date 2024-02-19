document.addEventListener('DOMContentLoaded', function () {
    // Agrega un evento de escucha para el envío del formulario
    var orderForm = document.getElementById('orderForm');
    if (orderForm) {
        orderForm.addEventListener('submit', function (event) {
            // Obtén la fecha actual en formato yyyy-mm-dd
            var today = obtenerFechaActual();

            // Establece el valor del input hidden 'fecha' con la fecha actual
            document.getElementById('fecha').value = today;

            // Obtén el contenido del div totalCost
            var totalCostText = document.getElementById('totalCost').textContent.trim(); // Obtener el contenido del div totalCost

            // Extraer solo el número final del texto totalCost
            var totalCostValue = totalCostText.match(/\d+(\.\d{1,2})?/); // Buscar un número con opcionalmente hasta dos decimales

            // Verificar si se encontró un número
            if (totalCostValue) {
                // Parsear el número extraído como un entero
                var integerValue = parseFloat(totalCostValue[0]); // Convertir a entero
                // Establecer el valor de totalCostInput con el número entero
                document.getElementById('totalCostInput').value = integerValue;
            } else {
                console.error('Error: no se pudo extraer un valor numérico válido del texto totalCost.');
            }
        });
    }
});

function obtenerFechaActual() {
    var hoy = new Date();
    var año = hoy.getFullYear();
    var mes = hoy.getMonth() + 1; // Los meses van de 0 a 11, por lo que se suma 1
    var dia = hoy.getDate();

    // Agrega un cero inicial si el mes o el día son menores que 10 para que tengan dos dígitos
    if (mes < 10) {
        mes = '0' + mes;
    }
    if (dia < 10) {
        dia = '0' + dia;
    }

    // Devuelve la fecha en formato yyyy-mm-dd
    return año + '-' + mes + '-' + dia;
}
