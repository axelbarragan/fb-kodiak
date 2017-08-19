<?php

  session_start();

  /*Archivo de redirección*/
  switch ($_SESSION['nivel_usuario']) {
  	case 'Administrador':
  		#Administrador
  	  header('Location: web/administrador/index');
  		break;

  	case 'Usuario':
  		#Cliente
  	  header('Location: web/clientes/index');
  		break;
  }

?>