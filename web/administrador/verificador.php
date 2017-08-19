<?php
session_start();
function index() {
	if(isset($_SESSION['sesion_iniciada']) != "si") {
		header("Location: ".URL."login");
	} else if ($_SESSION['nivel_usuario'] != "Administrador") {
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