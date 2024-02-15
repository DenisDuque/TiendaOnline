document.addEventListener('DOMContentLoaded', function() {
    const cartCount = document.getElementById("cartNumber");
    let cartNumber = 0;
    processCart();
    function processCart() {
        const productsArray = readLocalStorage();
        console.log(productsArray);
        $.ajax({ 
            url: "index.php?page=orders&action=detailsCart",
            type: "POST",
            contentType: 'application/json; charset=UTF-8',
            data: JSON.stringify({productsArray: productsArray}),
            success: function(response) {
                //console.log("correcto: ", response);
                //Table
                var leftPannel = document.getElementById("leftPannel");
                var startIndex = response.indexOf('<table>');
                var endIndex = response.indexOf('</table>', startIndex);
                if (startIndex !== -1 && endIndex !== -1) {
                    var tableContent = response.substring(startIndex, endIndex + '</table>'.length);
                    leftPannel.innerHTML = tableContent;
                } else {
                    console.error("Table not found in the response");
                }
                //Total Items
                var itemsTotal = document.getElementsByClassName("valueItem");
                var itemsTotalValue = 0.00;
                for(var i=0 ; i < itemsTotal.length ; i++) {
                    var price = itemsTotal[i].innerHTML.replace('$', '');
                    var priceFloat = parseFloat(price);
                    itemsTotalValue += priceFloat;
                }
                document.getElementById("itemsPrice").innerHTML = "ITEMS: " + itemsTotal.length + " $" + itemsTotalValue.toFixed(2);
                //Shipping method and final price
                var selectElement = document.getElementById("selectShippingMethod");
                var outputDiv = document.getElementById("totalCost");
                function updateContent() {
                    var selectedValue = selectElement.value;
                    var finalValue = itemsTotalValue + parseFloat(selectedValue);
                    finalValue = finalValue.toFixed(2);
                    outputDiv.innerHTML = "TOTAL COST: $" + finalValue;
                }
                selectElement.addEventListener("change", updateContent);
                updateContent();

                //Promo code
                var promoCodeUse = true;
                var buttonPromo = document.getElementById("applyPromoCodeBtn");
                buttonPromo.addEventListener("click", function() {
                    $.ajax({ 
                        url: "index.php?page=orders&action=getPromoCodes",
                        type: "POST",
                        contentType: 'application/json; charset=UTF-8',
                        success: function(response) {
                            var regex = /&&([^&]+)&&/;
                            var match = response.match(regex);
                            if (match && match[1]) {
                                var trueContent = match[1];
                                var elements = trueContent.split(',');
                                var arrayCodes = [];
                                elements.forEach(function(element) {
                                    var parts = element.split('_');
                                    var internArray = [parts[0], parts[1]];
                                    arrayCodes.push(internArray);
                                });
                                for(let i = 0; i < arrayCodes.length ; i++) {
                                    if(arrayCodes[i][0] == document.getElementById("promo").value && promoCodeUse) {
                                        var discountedFinalValue = (parseInt(arrayCodes[i][1]) / 100) * (itemsTotalValue + parseFloat(document.getElementById("selectShippingMethod").value));
                                        var final = (itemsTotalValue + parseFloat(document.getElementById("selectShippingMethod").value)) - discountedFinalValue;
                                        document.getElementById("totalCost").innerHTML = "TOTAL COST: $" + final.toFixed(2);
                                        promoCodeUse = false;
                                    }
                                }
                            } else {
                                console.log("No se encontró contenido entre &&");
                            }
                        }
                    });
                });
                // Verificar si el número de elementos es cero y deshabilitar el botón de checkout si es así
                var checkoutButton = document.querySelector("input[type='submit'][value='CHECKOUT']");
                if (itemsTotal.length === 0) {
                    checkoutButton.disabled = true;
                } else {
                    checkoutButton.disabled = false;
                }
            }
        });
    }

    async function updateLocalStorage(productsArray) {
        localStorage.setItem("products", JSON.stringify(productsArray));  
        let cartAmount = 0;

        productsArray.forEach(function (product) {
            cartAmount += product.amount;
        });

        cartCount.innerHTML = cartAmount;
    }

    function readLocalStorage() {
        var localStorageValue = localStorage.getItem('products');
        return localStorageValue ? JSON.parse(localStorageValue) : [];
    }
    $(document).on("click", ".plusButton", function(){
        var idProduct = this.getAttribute('codeId');
        var stock = this.getAttribute('stock');
        var cant = this.getAttribute('cant');
        var size = this.getAttribute('size');
        if(document.getElementById('hiddenEmail').value == "unlogged") {
            const productsArray = readLocalStorage();
            const amounts = productsArray.reduce((totalAmount, product) => {
                if (product.code === idProduct) {
                    return totalAmount + product.amount;
                } else {
                    return totalAmount;
                }
            }, 0);
            productsArray.forEach(function(product) {
                if (product.code === idProduct && product.size === size && amounts < stock) {
                    product.amount++;
                }
            });
            updateLocalStorage(productsArray);
            processCart();
        } else {
            $.ajax({ 
                url: "index.php?page=orders&action=plusAmountProduct",
                type: "POST",
                contentType: 'application/json; charset=UTF-8',
                data: JSON.stringify({
                    idProduct: idProduct,
                    stock: stock,
                    cant: cant,
                    size: size
                }),
                success: function(response) {
                    console.log("correcto: ", response);
                    processCart();
                    
                }
            });
        }
    });
    $(document).on("click", ".minusButton", function(){
        var idProduct = this.getAttribute('codeId');
        var stock = this.getAttribute('stock');
        var cant = this.getAttribute('cant');
        var size = this.getAttribute('size');
        if(document.getElementById('hiddenEmail').value == "unlogged") {
            const productsArray = readLocalStorage();
            productsArray.forEach(function(product) {
                if (product.code === idProduct && product.size === size && cant != 1) {
                    product.amount--;
                }
            });   
            updateLocalStorage(productsArray);
            processCart();
        } else {
            $.ajax({ 
                url: "index.php?page=orders&action=minusAmountProduct",
                type: "POST",
                contentType: 'application/json; charset=UTF-8',
                data: JSON.stringify({
                    idProduct: idProduct,
                    stock: stock,
                    cant: cant,
                    size: size
                }),
                success: function(response) {
                    console.log("correcto: ", response);
                    processCart();
                }
            });
        } 
    });
    $(document).on("click", ".deleteButton", function(){
        var idProduct = this.getAttribute('codeId');
        var stock = this.getAttribute('stock');
        var cant = this.getAttribute('cant');
        var size = this.getAttribute('size');
        var idProduct = this.getAttribute('codeId');
        var stock = this.getAttribute('stock');
        var cant = this.getAttribute('cant');
        var size = this.getAttribute('size');
        if(document.getElementById('hiddenEmail').value == "unlogged") {
            const productsArray = readLocalStorage();
            var index = -1;  
            for (var i = 0; i < productsArray.length; i++) {
                if (productsArray[i].code === idProduct && productsArray[i].size === size) {
                  index = i;
                }
            }
            if (index !== -1) {
                productsArray.splice(index, 1);
            }
            updateLocalStorage(productsArray);  
            processCart();
        } else {
            $.ajax({ 
                url: "index.php?page=orders&action=deleteProductFromCart",
                type: "POST",
                contentType: 'application/json; charset=UTF-8',
                data: JSON.stringify({
                    idProduct: idProduct,
                    stock: stock,
                    cant: cant,
                    size: size
                }),
                success: function(response) {
                    console.log("correcto: ", response);
                    processCart();
                }
            });
        } 
    });
});