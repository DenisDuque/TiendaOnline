<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/scss/css/main.css">
    <link rel="stylesheet" href="views/scss/css/administrator.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="views/js/Administrator.js"></script>
    <title>Urban Store</title>
</head>
<body>
<?php 
require_once "autoload.php";
// require_once "views/general/cabecera.html";
// require_once "views/general/menu.php";

if(isset($_GET['page'])) {
    $controllerName = $_GET['page']."Controller";
} else {
    $controllerName = "ProductController";
}
if(class_exists($controllerName)) {
    $controller = new $controllerName(); 
	$action = isset($_GET['action']) ? $_GET['action'] : 'default';
    session_start();
    $controller->$action(); 
} else {
    echo "No existe el controlador";
}
// require_once "views/general/pie.html";
?>
</body>
</html>