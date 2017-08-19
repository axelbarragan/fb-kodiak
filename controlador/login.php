<?php

  include_once("../modelo/Login.php");

  $user = $_POST['user'];
  $pass = $_POST['pass'];

  $wish = new Login;
  //$wish->cerrarSesion();
  $wish->login($user, $pass);
  $wish->cerrar();

?>
