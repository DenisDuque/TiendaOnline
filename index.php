<?php
// Asignar variable action a el valor $_GET['page'] si esta asignada.
$action = isset($_GET['page']) ? $_GET['page'] : '';

// Seleccionar la pagina actual segun el valor de $action
switch($action){
	case 'login':
		include 'controllers/LoginController.php';
		break;
	/* etc */

	case 'administrator':
		include 'controllers/AdminDashboardController.php';
		break;
		

	case 'main':
	default:
	//To-do
		include 'controllers/LoginController.php';		
		break;

}
?>
