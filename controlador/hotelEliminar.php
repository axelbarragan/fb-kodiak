<?php

  include_once("../modelo/Hoteles.php");
  
  session_start();
  $id  = $_POST['idHotelBorrar'];
  $com = $_POST['desc'];
  $usu = $_SESSION['nombre_usuario'];

  $wish = new Hoteles;
  $wish->eliminar($id, $usu, $com);
  $wish->cerrar();

?>
