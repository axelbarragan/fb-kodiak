<?php

  include_once('../conexion/conn.php');
  include_once('../config/config.php');

  class FechaYHora {
  	private $hora;
  	private $fecha;

  	public function __construct() {
  		date_default_timezone_set('America/Mexico_City');
  	}

  	public function obtenerHora() {
  		return $this->hora = date("H:i:s");
  	}

  	public function obtenerFecha() {
  		return $this->fecha = date("d-m-Y");
  	}
  }

?>