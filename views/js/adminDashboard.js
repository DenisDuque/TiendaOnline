var panels = document.getElementsByClassName("panel");

for(var i = 0; i < panels.length; i++){
    panels[i].addEventListener("click", function(e){
        let id = panels[i].id;
        var meta = document.createElement("meta");
        meta.httpEquiv = "refresh";
        meta.content = "0:index.php?page=admnistrator&panel="+id;
    })
}