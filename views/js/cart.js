document.addEventListener('DOMContentLoaded', function() {
    var userLogged = document.getElementById('loggedCheck').value;
    if(userLogged !== 'unlogged') {
        const productsArray = readLocalStorage();
        console.log(productsArray);
        if (productsArray.length > 0) {
            $.ajax({ 
                url: "index.php?page=orders&action=transformToLoggedCart",
                type: "POST",
                contentType: 'application/json; charset=UTF-8',
                data: JSON.stringify({productsArray: productsArray}),
                success: function(response) {
                    console.log("correcto: ", response);
                }
            });
        } else {
            console.log("El elemento 'miArrayProductos' no está presente en localStorage. No se enviará la solicitud AJAX.");
        }
        localStorage.clear();
    }
    function readLocalStorage() {
        var localStorageValue = localStorage.getItem('products');
        return localStorageValue ? JSON.parse(localStorageValue) : [];
    }
});