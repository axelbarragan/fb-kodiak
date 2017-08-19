<?php

include_once("../modelo/Hoteles.php");

//var_dump($_POST);
//var_dump($_FILES);
$nombreHotel  = $_POST['nom'];
$direccion    = $_POST['dir'];
$telefono     = $_POST['tel'];
$email        = $_POST['ema'];
$nombreCont   = $_POST['nomcon'];
$apellidoCont = $_POST['apecon'];
$img          = $_FILES['archivo'];

//echo $nombreHotel;
$wish = new Hoteles;
//echo $wish->adminSubirImagenHotel($img);
  //$wish->cerrarSesion();
echo $wish->registrar($nombreHotel, $direccion, $telefono, $email, $nombreCont, $apellidoCont, $img);
$wish->cerrar();

?>
