<?php

  require_once("../modelo/Hoteles.php");

  $wish = new Hoteles;
  //$wish->cerrarSesion();
  $wish->contarClientes();
  $wish->cerrar();

?>
