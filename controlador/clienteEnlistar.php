<?php

  require_once("../modelo/Hoteles.php");

  $wish = new Hoteles;
  echo $wish->enlistar();
  $wish->cerrar();

?>
