document.addEventListener('DOMContentLoaded', function() {
    var panels = document.getElementsByClassName("panel");
    var searchBtn = document.getElementById("searchBtn");

    function fillDataProduct(code){
        var datos = code.split(",");
        let name = datos[1];
        let price = datos[2];
        let status = datos[3];
        let stock = datos[4];
        let category = datos[5];
        let sideView = document.getElementById("side");
        let topVIew = document.getElementById("top");
        let bottomView = document.getElementById("bottom");
        document.getElementById("name").value = name;
        document.getElementById("price").value = price;
        document.getElementById("stock").value = stock;
        
        sideView.src = datos[6];
        

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
        let name = datos[1];
        let status = datos[2];
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
        var titleName = document.getElementById("name");
        var titleSurname = document.getElementById("surname");
        var divEmail = document.getElementById("email");
        var divPhone = document.getElementById("phone");
        var listProd = document.getElementById("products");
        listProd.innerHTML="";
        var divStatus = document.getElementById("status");
        var divPrice = document.getElementById("price");

        titleName.innerHTML = datos[1];
        titleSurname.innerHTML = datos[2];
        divEmail.innerHTML = datos[3];
        divPhone.innerHTML = datos[4];
        divStatus.innerHTML = datos[5];
        divPrice.innerHTML = datos[6];

        var products = datos[7].split("/");
        for(let i = 1; i<products.length;i++){
            let product = products[i].split(":");
            let item = document.createElement("li");
            item.innerHTML = product[0] + " " + product[1];
            listProd.appendChild(item);
        }
        
    
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