<?php

  require_once("../modelo/Habitaciones.php");

  session_start();
  $idHotel = $_SESSION['empresa_usuario'];

  $wish = new Habitaciones;
  echo $wish->enlistar($idHotel);
  $wish->cerrar();

?>
