document.addEventListener('DOMContentLoaded', function() {
    var panels = document.getElementsByClassName("panel");
    var editButtons = document.getElementsByClassName("editProdBtn");
    var billButtons = document.getElementsByClassName("billBtn");
    var searchBtn = document.getElementById("searchBtn");

    for (let i = 0; i < panels.length; i++) {
        panels[i].addEventListener("click", function (e) {
            let id = panels[i].id;
            let action = "showAdmin" + id;
            window.location.href = "index.php?page="+ id +"&action=" + action;
        });
    }


    for(let i = 0; i < editButtons.length; i++){
        editButtons[i].addEventListener("click", function(e){
           
        });
    }
    
    searchBtn.addEventListener("click", function(e){
        console.log("Boton clickado");
        let search = document.getElementById("search");
        let currentURL = window.location.href;
        let url = new URL(currentURL);
        let action = url.searchParams.get("action");
        window.location.href = "index.php?page=User&action=" + action + "&search=" + search.value;
    });

});