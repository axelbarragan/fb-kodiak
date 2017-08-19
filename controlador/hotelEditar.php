<?php

  /*Editar hotel*/

  require_once("../modelo/Hoteles.php");

  session_start();
  $idHotel = $_SESSION['idHotel'];

  $wish = new Hoteles;
  $wish->editar($idHotel);
  //$wish->cerrar();

?>