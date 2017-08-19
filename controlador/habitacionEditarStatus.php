<?php

  include_once("../modelo/Habitaciones.php");

  session_start();
  $id     = $_SESSION['idHab'];
  $status = $_POST['habStatus'];

  $wish = new Habitaciones;
  //$wish->cerrarSesion();
  $wish->editarStatus($id, $status);
  $wish->cerrar();

?>
