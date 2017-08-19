<?php

  include_once("../modelo/Login.php");

  $token = $_POST['ttk'];

  $objeto = new Login;
  $objeto->cerrarSesion($token);
  $objeto->cerrar();

?>
