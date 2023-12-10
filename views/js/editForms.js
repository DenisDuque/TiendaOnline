document.addEventListener('DOMContentLoaded', function() {
    var buttons = document.getElementsByClassName("editBtn");
    for(let i = 0; i < buttons.length; i++){
        buttons[i].addEventListener("click", function (e) {
            fillDataCategory(buttons[i].id);
        });    
    }

    function fillDataCategory(code){
        code = code.replace("editBtn_", "");
        var divForm = document.getElementById("formCat");

        const tabla = document.createElement("table");
        const form = document.createElement("form");
        
        const trTitulo = document.createElement("tr");
        const tdTitulo = document.createElement("td");
        const titulo = document.createElement("h3");
        titulo.innerHTML = code;

        tdTitulo.appendChild(titulo);
        trTitulo.appendChild(tdTitulo);
        tabla.appendChild(trTitulo);

        divForm.appendChild(tabla);
    }
});