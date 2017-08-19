<?php

  require_once("../modelo/Habitaciones.php");

  session_start();
  $idHotel = $_SESSION['empresa_usuario'];

  $wish = new Habitaciones;
  $wish->contarHabitaciones($idHotel);
  $wish->cerrar();

?>
