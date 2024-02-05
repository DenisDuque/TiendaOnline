document.addEventListener("DOMContentLoaded", function() {
    var canvas = document.getElementById("pinturaCanvas");
    var context = canvas.getContext("2d");
    var pintando = false;
    var borrando = false;

    // Configuración del lienzo
    context.lineWidth = 5;
    context.lineCap = "round";
    context.strokeStyle = "black";
    
    //Funcion para obtener las coordenadas:
    function obtainLocation(evento, canvas) {
        var rect = canvas.getBoundingClientRect();
        return {
            x: evento.clientX - rect.left,
            y: evento.clientY - rect.top
        };
    }

    // Eventos del ratón
    canvas.addEventListener("mousedown", function(e) {
        pintando = true;
        var coords = obtainLocation(e, canvas);
        if (borrando) {
            borrar(coords);
        } else {
            dibujar(coords);
        }
    });

    canvas.addEventListener("mousemove", function(e) {
        if (pintando) {
            var coords = obtainLocation(e, canvas);
            if (borrando) {
                borrar(coords);
            } else {
                dibujar(coords);
            }
        }
    });

    canvas.addEventListener("mouseup", function() {
        pintando = false;
        context.beginPath();
    });
    // Función para dibujar
    function dibujar(coords) {
        var x = coords.x;
        var y = coords.y;
        console.log("x = "+ x +" , y = "+y);

        context.lineTo(x, y);
        context.stroke();
        context.beginPath();
        context.arc(x, y, context.lineWidth / 2, 0, Math.PI * 2);
        context.fill();
        context.beginPath();
        context.moveTo(x, y);
    }

    // Función para borrar
    function borrar(coords) {
        var x = coords.x;
        var y = coords.y;

        // Aumentar el tamaño de la goma de borrar
        context.lineWidth = 20;

        context.globalCompositeOperation = 'destination-out';
        context.arc(x, y, context.lineWidth / 2, 0, Math.PI * 2);
        context.fill();
        context.beginPath();
        context.globalCompositeOperation = 'source-over';

        // Restaurar el tamaño del trazo al valor original
        context.lineWidth = 5;
    }

    // Botón de borrar/escribir
    var botonBorrar = document.getElementById("botonBorrar");
    botonBorrar.addEventListener("click", function() {
        borrando = !borrando;

        if (borrando) {
            botonBorrar.textContent = "Escribir";
        } else {
            botonBorrar.textContent = "Borrar";
        }
    });
    var botonGuardar = document.getElementById("botonGuardar");
    botonGuardar.addEventListener("click", function() {
        var canvas = document.getElementById("pinturaCanvas");
        var imageData = canvas.toDataURL();  // Obtener la imagen en formato base64
        console.log(imageData);
        
        // Enviar la imagen al servidor
        var xhr = new XMLHttpRequest();
    
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                } else {
                    console.error("Error en la solicitud. Código de estado: " + xhr.status);
                }
            }
        };
    
        xhr.onerror = function() {
            console.error("Error al realizar la solicitud.");
        };
    
        xhr.open("POST", "views/Administrator/Components/canvas.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("imagen=" + encodeURIComponent(imageData));
    });
    
});