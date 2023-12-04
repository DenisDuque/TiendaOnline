document.addEventListener('DOMContentLoaded', function() {
    var buttons = document.getElementsByClassName("buttons");
    for(let i = 0; i < buttons.length; i++){
        buttons[i].addEventListener("click", function (e) {
            fillDataCategory(buttons[i].id);
        });    
    }
    function fillDataCategory(code){
        var myDiv = document.getElementById("placeHolder");

        fetch("views/Administrator/components/FormCategorias.html")
            .then(response => response.text())
            .then(html => {
                myDiv.innerHTML = html;
            })
    }

    
});