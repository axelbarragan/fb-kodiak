<?php

  require_once("../modelo/Reservaciones.php");

  $wish = new Reservaciones;
  $wish->enlistar();
  $wish->cerrar();

?>
