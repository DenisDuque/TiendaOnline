document.addEventListener('DOMContentLoaded', function() {
    var panels = document.getElementsByClassName("panel");
    var searchBtn = document.getElementById("searchBtn");

    function fillDataProduct(code){
        var datos = code.split(",");
        let id = datos[0]
        let name = datos[1];
        let price = datos[2];
        let status = datos[3];
        let stock = datos[4];
        let category = datos[5];
        document.getElementById("name").value = name;
        document.getElementById("price").value = price;
        document.getElementById("stock").value = stock;

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

        var listado = document.getElementById("listado");
        listado.innerHTML = "";
        for(let i = 3; i < datos.length; i++){
            console.log(datos[i]);
            let item = document.createElement("li");
            item.innerHTML = datos[i];
            listado.appendChild(item);
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
            console.log(datos[i]);
            let item = document.createElement("li");
            item.innerHTML = datos[i];
            listado.appendChild(item);
        }   
        

    }

    function fillDataOrder(code){

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