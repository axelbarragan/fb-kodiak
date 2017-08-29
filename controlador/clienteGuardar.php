<?php

include_once("../modelo/Hoteles.php");

//var_dump($_POST);
//var_dump($_FILES);
$nombre    = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$direccion = $_POST['direccion'];
$email     = $_POST['email'];
$numcel    = $_POST['numcel'];
$fecnac    = $_POST['fecnac'];

//echo $nombreHotel;
$wish = new Hoteles;
//echo $wish->adminSubirImagenHotel($img);
  //$wish->cerrarSesion();
echo $wish->registrar($nombre, $apellidos, $direccion, $email, $numcel, $fecnac);
$wish->cerrar();

?>
