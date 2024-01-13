document.addEventListener('DOMContentLoaded', function() {
    var panels = document.getElementsByClassName("panel");
    var searchBtn = document.getElementById("searchBtn");

    function fillDataProduct(code){
        var datos = code.split(",");
        let id = datos[0];
        let name = datos[1];
        let price = datos[2];
        let status = datos[3];
        let stock = datos[4];
        let category = datos[5];
        let sizes = datos[6];
        var sizesArray = sizes.split('!');
        document.getElementById("EditProdForm").reset();
        document.getElementById("code").value = id;
        document.getElementById("name").value = name;
        document.getElementById("price").value = price;
        document.getElementById("stock").value = stock;
        $('#sizeList').empty();
        for (let i = 0 ; i != sizesArray.length-1 ; i++) {
            var newSize = sizesArray[i];
            if (newSize.trim() !== "") {
                $('#sizeList').append('<div class="size">' + newSize + '</div>');
            }
        }
        if(status=="enabled"){
            document.getElementById("select").selectedIndex = "enabled";
        }else{
            document.getElementById("select").selectedIndex = "disabled"; 
        }
        let selectCategory = document.getElementById("category");
        for(let i = 0; i<selectCategory.options.length;i++){
            let opcion = document.getElementById(selectCategory.options[i].id);
            if(opcion.id == category){
                selectCategory.options.selectedIndex = opcion.index;
            }
        }     
    }

    function fillDataCategory(code){
        var datos = code.split(",");
        let id = datos[0];
        let name = datos[1];
        let status = datos[2];
        document.getElementById("code").value = id;
        document.getElementById("name").value = name;
        if(status=="enabled"){
            document.getElementById("select").selectedIndex = "enabled";
        }else{
            document.getElementById("select").selectedIndex = "disabled"; 
        }

        var listado = document.getElementById("listado");
        listado.innerHTML = "";
        for(let i = 3; i < datos.length; i++){
            let item = document.createElement("li");
            item.innerHTML = datos[i];
            listado.appendChild(item);
        }
        
        

    }

    function fillDataOrder(code){
        var datos = code.split(",");
        var orderId = document.getElementById("orderId");
        var titleName = document.getElementById("name");
        var titleSurname = document.getElementById("surname");
        var divEmail = document.getElementById("email");
        var divPhone = document.getElementById("phone");
        var listProd = document.getElementById("products");
        listProd.innerHTML="";
        var listAmount = document.getElementById("amount");
        listAmount.innerHTML = "";
        var divStatus = document.getElementById("status");
        var divPrice = document.getElementById("price");

        orderId.value = parseInt(datos[0], 10);
        titleName.innerHTML = datos[1];
        titleSurname.innerHTML = datos[2];
        divEmail.innerHTML = datos[3];
        divPhone.innerHTML = datos[4];
        divStatus.innerHTML = datos[5];
        divPrice.innerHTML = "$"+datos[6];

        var products = datos[7].split("/");
        for(let i = 1; i<products.length;i++){
            let product = products[i].split(":");
            let item = document.createElement("li");
            item.innerHTML = product[0];
            listProd.appendChild(item);
            let amounts = document.createElement("dt");
            amounts.innerHTML = product[1];
            listAmount.appendChild(amounts);
        }

        // Deshabilitar el botón si el estado es "shipped"
        var submitButton = document.getElementById("pedidoEnviado");
        if (datos[5] === "shipped") {
            submitButton.style.display = "none";
        } else {
            submitButton.style.display = "block";
        }
    }

    function addSize() {
        var newSize = $('#sizeInput').val();
        if (newSize.trim() !== "") {
            $('#sizeList').append('<div class="size">' + newSize + '</div>');
            $('#sizeInput').val(""); 
        }
    }
    
    function preparePost() {
        var sizeDivs = $('.size');
        if (sizeDivs.length > 0) {
            var sizesStrings = sizeDivs.map(function() {
                return $(this).text();
            }).get().join(',');
            $('#sizeInp').val(sizesStrings);
        } else {
            $('#sizeInp').val("");
        }
        return true;
    }

    document.querySelectorAll('.editCatBtn').forEach(button => {
        button.addEventListener('click', function() {
            fillDataCategory(button.id);
        });
    });

    document.querySelectorAll('.editProdBtn').forEach(button => {
        button.addEventListener('click', function() {
            fillDataProduct(button.id);
        });
    });

    document.querySelectorAll('.editOrderBtn').forEach(button => {
        button.addEventListener('click', function() {
            fillDataOrder(button.id);
        });
    });

    document.querySelectorAll('.addSizeBtn').forEach(button => {
        button.addEventListener('click', function() {
            addSize();
        });
    });
    /*var url = window.location.href;
    var urlObj = new URL(url);
    var action = urlObj.searchParams.get('action');
    if(action == 'showAdminProduct') {
        document.getElementById('EditProdForm').addEventListener('submit', function(event) {
            event.preventDefault();
            preparePost();
        });
    }*/
    $('#EditProdForm').submit(function(event) {
        console.log("Evento de submit capturado");
        preparePost();
    });
    

    for (let i = 0; i < panels.length; i++) {
        panels[i].addEventListener("click", function (e) {
            let id = e.currentTarget.id;
            let action = "showAdmin" + id;
            if(id == 'Dashboard') {
                id = 'Product';
            }
            window.location.href = "index.php?page="+ id +"&action=" + action;
        });
    }

    /*searchBtn.addEventListener("click", function(e){
        console.log("Boton clickado");
        let search = document.getElementById("search");
        let currentURL = window.location.href;
        let url = new URL(currentURL);
        let action = url.searchParams.get("action");
        window.location.href = "index.php?page=User&action=" + action + "&search=" + search.value;
    });*/
});