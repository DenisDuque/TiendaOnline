<?php
require_once("views\General\Components\headerHome.php");
if (isset($_SESSION['email'])) {
    echo "<input type='hidden' id='hiddenEmail' value='" . $_SESSION['email'] . "'>";
} else {
    echo "<input type='hidden' id='hiddenEmail' value='unlogged'>";
}
?>
<h1>Compra Realizada con éxito!</h1>
<div>Descargar factura: <button><img src="views/assets/images/utils/downloadOrder.png" alt="Descargar Factura"></button></div>