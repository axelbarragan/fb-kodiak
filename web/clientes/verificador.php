<?php
session_start();
function index() {
	if(isset($_SESSION['sesion_iniciada']) != "si") {
		header("Location: ".URL."login");
	} else if (isset($_SESSION['nivel_usuario']) != "Usuario") {
		header("Location: ".URL."login");
	}
	/*switch ($_SESSION['nivel_usuario']) {
		case 'a':
			# code...
			break;
		
		default:
			# code...
			break;
	}*/
}
?>