document.addEventListener('DOMContentLoaded', function() {
    var buttons = document.getElementsByClassName("editBtn");
    for(let i = 0; i < buttons.length; i++){
        buttons[i].addEventListener("click", function (e) {
            fillDataCategory(buttons[i].id);
        });    
    }

    function fillDataCategory(code){
        var divForm = document.getElementById("formCat");

        fetch("views/Administrator/components/FormCategorias.php")
            .then(response => response.text())
            .then(html => {
                html = html.replace("%categoria%", code)
                divForm.innerHTML = html;
            })
    }
});