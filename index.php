<?php
// Asignar variable action a el valor $_GET['page'] si esta asignada.
$action = isset($_GET['page']) ? $_GET['page'] : '';

// Seleccionar la pagina actual segun el valor de $action
switch($action){

	case 'login':
		include __DIR__.'/controllers/LoginController.php';
		break;
	/* etc */

	case 'main':
	default:
		include __DIR__.'/controllers/main.php';		
		break;

}
?>
