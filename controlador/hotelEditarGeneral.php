<?php

  include_once("../modelo/Hoteles.php");

  session_start();
  $id        = $_SESSION['idHotel'];
  $nombre    = $_POST['hotelNombre'];
  $direccion = $_POST['hotelDireccion'];
  $telefono  = $_POST['hotelTelefono'];

  $wish = new Hoteles;
  //$wish->cerrarSesion();
  $wish->editarGeneral($id, $nombre, $direccion, $telefono);
  $wish->cerrar();

?>
