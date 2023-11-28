var buttons = document.getElementsByClassName("menu");

for(var i = 0; i < buttons.length; i++){
    buttons[i].addEventListener("click", function(e){
        let idBtn = buttons[i].id;
        var meta = document.createElement("meta");
        meta.httpEquiv = "refresh";
        meta.content = "0:index.php?page=admnistrator&filter="+idBtn;
    })
}