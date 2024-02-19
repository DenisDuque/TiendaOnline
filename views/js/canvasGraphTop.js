document.addEventListener("DOMContentLoaded", function() {
    $.ajax({ 
        url: "index.php?page=Product&action=getTopProductsForGraph",
        type: "POST",
        contentType: 'application/json; charset=UTF-8',
        success: function(response) {
            var regex = /&&([^&]+)&&/;
            var match = response.match(regex);
            if (match && match[1]) {
                var trueContent = match[1];
                var elements = trueContent.split(',');
                var data = [];

                elements.forEach(function(element) {
                    var parts = element.split('_');
                    var internObject = {
                        name: parts[0],
                        sales: parseInt(parts[1], 10) // Convertir a número entero
                    };
                    data.push(internObject);
                });
                console.log(data);
                var canvas = document.getElementById('canvasGraphTopProducts');
                var ctx = canvas.getContext('2d');

                var barWidth = 40;
                var barSpacing = 20;
                var topMargin = 20;
                var bottomMargin = 20;

                function calculateScaledHeight(sales, maxBarHeight) {
                    var values = data.map(function (item) {
                        return item.sales;
                    });

                    var maxValue = Math.max.apply(null, values);
                    var scale = (canvas.height - topMargin - bottomMargin) / maxValue;

                    return sales * scale;
                }

                function drawBars() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);

                    for (var i = 0; i < data.length; i++) {
                        var x = i * (barWidth + barSpacing) + barSpacing; // Añadir margen a la derecha de la primera barra
                        var y = canvas.height - topMargin - calculateScaledHeight(data[i].sales, canvas.height);

                        if(data[i].sales < 25) {
                            ctx.fillStyle = 'rgba(255, 0, 0, 0.4)';
                        } else if (data[i].sales < 75) {
                            ctx.fillStyle = 'rgba(255, 165, 0, 0.4';
                        } else {
                            ctx.fillStyle = 'rgba(255, 94, 0, 0.4)'; 
                        }

                        ctx.fillRect(x, y, barWidth, calculateScaledHeight(data[i].sales, canvas.height));

                        ctx.fillStyle = '#000';
                        ctx.textAlign = 'center'; // Alinear el texto al centro
                        ctx.fillText(data[i].name, x + barWidth / 2, canvas.height - 10);
                        ctx.fillText(data[i].sales, x + barWidth / 2, y - 5);
                    }
                }

                drawBars();
            } else {
                console.log("No se encontró contenido entre &&");
            }
        }
    });
});