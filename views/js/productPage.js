document.addEventListener('DOMContentLoaded', function() {
    class Product {
        constructor(code, size, amount) {
            this.code = code;
            this.size = size;
            this.amount = amount;
        }
    }
    function changeImage(image){
        let mainImage = document.getElementById("mainImage");
        mainImage.children[0].src = image;
    }
    var images = document.getElementsByClassName("imageBtn");

    for(let i = 0; i<images.length; i++){
        if(images[i].id != "mainImage"){
            images[i].addEventListener("click", function(){
                changeImage(images[i].children[0].src);
                images[i].classList.add("clicked");
                for(let x = 0; x<images.length; x++){
                    if(x!=i){
                        images[x].classList.remove("clicked");
                    }
                }
            })
        }
    }


    var sizes = document.getElementsByClassName("sizeBtn");

    for(let i = 0; i<sizes.length; i++){
        sizes[i].addEventListener("click", function(){
            sizes[i].classList.add("selected");
            for(let x = 0; x<sizes.length; x++){
                if(x!=i){
                    sizes[x].classList.remove("selected");
                }
            }
            let details = document.querySelector('button.selected').value;
            let prodcuctDetails = document.getElementById("productDetails");
            prodcuctDetails.value = prodcuctDetails.value+details.trim();
        })
    }

    const addCartButton = document.getElementById('addCart');
    if(addCartButton) {
        addCartButton.addEventListener('click', function() {
            let details = document.querySelector('button.selected').value;
            const arrayDetails = details.split("&");
            const productArray = JSON.parse(localStorage.getItem('products')) || [];

            //Recopilar cuantos productos del mismo tipo hay en el carrito
            const amounts = productArray.reduce((totalAmount, product) => {
                if (product.code.trim() === arrayDetails[1].trim()) {
                    return totalAmount + product.amount;
                } else {
                    return totalAmount;
                }
            }, 0);

            if (parseInt(arrayDetails[2]) !== amounts) {
                if (productArray.length > 0) {
                    const findIndex = productArray.findIndex(product => product.code.trim() === arrayDetails[1].trim() && product.size.trim() === arrayDetails[0].trim());
                    if(findIndex !== -1) {
                        productArray[findIndex].amount += 1;
                        localStorage.setItem("products", JSON.stringify(productArray));
                        //Opcional para imprimir y sacar los datos
                        const storedProductsArray = JSON.parse(localStorage.getItem("products"));
                        console.log(storedProductsArray);
                    } else {
                        const products = new Product(arrayDetails[1].trim(), arrayDetails[0].trim(), 1);
                        productArray.push(products);
                        localStorage.setItem("products", JSON.stringify(productArray));
                        //Opcional para imprimir y sacar los datos
                        const storedProductsArray = JSON.parse(localStorage.getItem("products"));
                        console.log(storedProductsArray);
                    }
                } else {
                    const products = new Product(arrayDetails[1].trim(), arrayDetails[0].trim(), 1);
                    productArray.push(products);
                    localStorage.setItem("products", JSON.stringify(productArray));
                    //Opcional para imprimir y sacar los datos
                    const storedProductsArray = JSON.parse(localStorage.getItem("products"));
                    console.log(storedProductsArray);
                }
            } else {
                console.log("NO HAY STOCK");
            }
        });
    }

    const visualizerBtn = document.getElementById('3d360');

    visualizerBtn.addEventListener('click', function() {
        const queryParams = new URLSearchParams(window.location.search);

        const code = queryParams.get('code');
        const port = '5173';

        const ThreeJSVisualizer = 'http://localhost:'+ port +'?model=' + code;

        window.open(ThreeJSVisualizer, '_blank');
    });
    /*function readLocalStorage() {
        var localStorageValue = localStorage.getItem('myLocalStorage');
        return localStorageValue ? JSON.parse(localStorageValue) : [];
    }

    function guardarEnLocalStorage(nuevoCarrito) {
        // Obtener la lista actual de carritos del localStorage
        var arrayDeCarritos = leerLocalStorage();

        // Buscar el carrito actual en la lista
        var carritoExistente = arrayDeCarritos.find(function(carrito) {
            return carrito.usuario.email === nuevoCarrito.usuario.email;
        });

        if (carritoExistente) {
            // Si el carrito ya existe, actualizar los productos existentes con los nuevos
            nuevoCarrito.productos.forEach(function(nuevoProducto) {
                var productoExistente = carritoExistente.productos.find(function(producto) {
                    return producto.id_producto === nuevoProducto.id_producto;
                });

                if (productoExistente) {
                    // Si el producto ya existe, actualizar sus propiedades
                    Object.assign(productoExistente, nuevoProducto);
                } else {
                    // Si el producto no existe, añadirlo a la lista de productos
                    carritoExistente.productos.push(nuevoProducto);
                }
            });
        } else {
            // Si el carrito no existe, añadirlo a la lista
            arrayDeCarritos.push(nuevoCarrito);
        }

        // Guardar la lista actualizada en el localStorage
        localStorage.setItem('miLocalStorage', JSON.stringify(arrayDeCarritos));
    }*/
});
