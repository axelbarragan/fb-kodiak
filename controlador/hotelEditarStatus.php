<?php

  include_once("../modelo/Hoteles.php");

  session_start();
  $id       = $_SESSION['idHotel'];
  $status = $_POST['hotelStatus'];

  $wish = new Hoteles;
  //$wish->cerrarSesion();
  $wish->editarStatus($id, $status);
  $wish->cerrar();

?>
