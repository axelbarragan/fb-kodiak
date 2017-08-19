<?php

  include_once("../modelo/Habitaciones.php");

  $id = $_POST['id'];

  $wish = new Habitaciones;
  //$wish->cerrarSesion();
  $wish->eliminarServicio($id);
  $wish->cerrar();

?>
