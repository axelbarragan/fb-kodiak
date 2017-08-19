<?php

  require_once('conexion/conn.php');
  require_once('config/config.php');

  $db = Conexion::getInstance();
  $mysqli = $db->getConnection();

  $query = "SELECT *  FROM sesion INNER JOIN usuarios ON sesion.id_usuario = usuarios.id_usuario INNER JOIN nivel_usuario ON sesion.id_nivel = nivel_usuario.id_nivel WHERE sesion.nombre_usuario = 'axel@mail.com'";
  $consulta = $mysqli->query($query);

  if($row = $consulta->fetch_array()) {
  	echo $row;
  }

  

?>