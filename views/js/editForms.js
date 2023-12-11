document.addEventListener('DOMContentLoaded', function() {
    function fillDataCategory(code){
        code = code.replace("editBtn_", "");
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
        for(let i = 3; i < datos.length; i++){
            console.log(datos[i]);
            let item = document.createElement("li");
            item.innerHTML = datos[i];
            listado.appendChild(item);
        }   
        

    }
    
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function() {
            fillDataCategory(button.id.replace('editBtn_', ''));
        });
    });
});