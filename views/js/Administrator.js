document.addEventListener('DOMContentLoaded', function() {
    var panels = document.getElementsByClassName("panel");
    var editButtons = document.getElementsByClassName("editButtons");

    for (let i = 0; i < panels.length; i++) {
        panels[i].addEventListener("click", function (e) {
            let id = panels[i].id;
            window.location.href = "index.php?page=administrator&panel=" + id;
        });
    }


    for(var i = 0; i < editButtons.length; i++){
        editButtons[i].addEventListener("click", function(e){
            let div = document.getElementById("panelContainer");
        })
    }
});