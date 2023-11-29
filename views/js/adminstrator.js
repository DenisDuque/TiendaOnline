var panels = document.getElementsByClassName("panel");
var editButtons = document.getElementsByClassName("editButtons");

for(var i = 0; i < panels.length; i++){
    panels[i].addEventListener("click", function(e){
        let id = panels[i].id;
        var meta = document.createElement("meta");
        meta.httpEquiv = "refresh";
        meta.content = "0:index.php?page=admnistrator&panel="+id;
    })
}

for(var i = 0; i < editButtons.length; i++){
    editButtons[i].addEventListener("click", function(e){
        let div = document.getElementById("panelContainer");
    })
}