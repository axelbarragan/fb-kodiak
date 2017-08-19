<?php

  include_once("../modelo/Hoteles.php");

  session_start();
  $id               = $_SESSION['idHotel'];
  $correoUsuario    = $_POST['correoUsuario'];

  $wish = new Hoteles;
  //$wish->cerrarSesion();
  $wish->editarSesion($id, $correoUsuario);
  $wish->cerrar();

?>
