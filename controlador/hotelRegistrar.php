<?php

  include_once("../modelo/Hoteles.php");

  $nombre    = "Yaocalli";
  $direccion = "Pendiente";
  $telefono  = "123456789";

  $objeto = new Hoteles;
  $objeto->registrar($nombre,$direccion,$telefono);
  $objeto->cerrar();

?>
