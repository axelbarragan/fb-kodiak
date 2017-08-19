<?php

  require_once("../modelo/Hoteles.php");

  $wish = new Hoteles;
  //$wish->cerrarSesion();
  $wish->contarHoteles();
  $wish->cerrar();

?>
