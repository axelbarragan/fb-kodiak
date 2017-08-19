<?php

  include_once("../modelo/Hoteles.php");

  $id = $_POST['id'];

  $wish = new Hoteles;
  echo $wish->ver($id);
  $wish->cerrar();

?>
