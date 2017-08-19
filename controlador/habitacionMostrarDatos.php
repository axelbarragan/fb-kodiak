<?php

  /*Editar hotel*/

  require_once("../modelo/Habitaciones.php");

  session_start();
  $idHab = $_SESSION['idHab'];

  $wish = new Habitaciones;
  $wish->editar($idHab);
  //$wish->cerrar();

?>