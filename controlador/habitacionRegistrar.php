<?php

  include_once("../modelo/Habitaciones.php");

  session_start();
  $titulo   = $_POST['habTitulo'];
  $desc     = $_POST['habDesc'];
  $cantidad = $_POST['habCantidad'];
  $precio   = $_POST['habPrecio'];
  $idHotel  = $_SESSION['empresa_usuario'];

  $objeto = new Habitaciones;
  echo $objeto->registrar($titulo,$desc,$cantidad,$precio,$idHotel);
  $objeto->cerrar();

?>
