<?php

include_once('../config/config.php');

session_start();
if($_SESSION['sesion_iniciada'] == "si") {
	$var = $_SESSION['nivel_usuario'];
	//echo $var;
	switch ($var) {
		case 'Administrador':
		header("Location: administrador/");
		break;

		case 'Usuario':
		header("Location: clientes/");
		break;

	}
} else {
	header("Location: ".URL."login");
}


?>