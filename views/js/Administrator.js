document.addEventListener('DOMContentLoaded', function() {
    var panels = document.getElementsByClassName("panel");
    var editButtons = document.getElementsByClassName("editBtn");
    var billButtons = document.getElementsByClassName("billBtn");
    var searchBtn = document.getElementById("searchBtn");

    for (let i = 0; i < panels.length; i++) {
        panels[i].addEventListener("click", function (e) {
            let id = panels[i].id;
            window.location.href = "index.php?page=administrator&panel=" + id;
        });
    }


    for(var i = 0; i < editButtons.length; i++){
        editButtons[i].addEventListener("click", function(e){
            let div = document.getElementById("panelContainer");
        });
    }
    
    searchBtn.addEventListener("click", function(e){
        console.log("Boton clickado");
        let search = document.getElementById("search");
        let currentURL = window.location.href;
        let url = new URL(currentURL);
        let panelValue = url.searchParams.get("panel");
        window.location.href = "index.php?page=administrator&panel=" + panelValue + "&search=" + search.value;
    });

});