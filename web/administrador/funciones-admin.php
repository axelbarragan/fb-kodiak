<?php

  require_once('../../../config/config.php');
  require_once('../../../conexion/conn.php');

  $db = Conexion::getInstance();
  $mysqli = $db->getConnection();

  function mostrarDatos() {
  	return var_dump($mysqli);
  }
  

?>