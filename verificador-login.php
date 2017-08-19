<?php
session_start();
function login() {
	if(isset($_SESSION['sesion_iniciada']) == "si") {
		header("Location: ".URL."web/index");
	}
}
?>