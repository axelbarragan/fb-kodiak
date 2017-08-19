<?php

  include_once("../modelo/Hoteles.php");

  session_start();
  $id               = $_SESSION['idHotel'];
  $usuarioNombre    = $_POST['usuarioNombre'];
  $usuarioApellidos = $_POST['usuarioApellidos'];

  $wish = new Hoteles;
  //$wish->cerrarSesion();
  $wish->editarUsuario($id, $usuarioNombre, $usuarioApellidos);
  $wish->cerrar();

?>
