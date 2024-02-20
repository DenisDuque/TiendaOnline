<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/scss/css/main.css">
    <title>Urban Store</title>
</head>

<body>
    <?php
    require_once("views/General/Components/headerHome.php");

    if (isset($_SESSION['email'])) {
        if (isset($allProductsHaveStock)) {
            echo '<div id="compraExitosa">';
            echo '<h1>Compra Realizada con éxito!</h1>';
    ?>
            <form id="downloadOrderForm" action="index.php?page=Orders&action=downloadOrder" method="POST" enctype="multipart/form-data">
                <?php
                if (isset($idCompra[0])) {
                    echo "<input type='hidden' name='hiddenEmail' value='" . $_SESSION['email'] . "'>";
                    echo "<input type='hidden' name='idCompra' value='" . $idCompra[0]['id'] . "'>";
                    echo "<input type='hidden' name='post' value='" . htmlspecialchars(json_encode($_POST), ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<input type='hidden' name='products' value='" . htmlspecialchars(json_encode($products), ENT_QUOTES, 'UTF-8') . "'>";
                    echo '<div class="button-container">';
                    echo '  <input type="submit" value="Descargar Factura">';
                    echo '  <button id="cancelar"><a href="index.php?page=product&action=default">Volver</a></button>';
                    echo '</div>';
                }
                ?>
            </form>
    <?php
            echo '</div>';
        } else {
            echo 'No hay stock, lo sentimos!';
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='4;URL=index.php?page=User&action=default'>";
        }
    } else {
        echo "<input type='hidden' name='hiddenEmail' value='unlogged'>";
    }
    ?>
</body>

</html>