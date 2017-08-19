<?php

require_once('../config/config.php');

class Conexion {
  //Atributos
  private $_connection;
  private static $_instance;      //The single instance
  private $_host     = SERVIDOR;  //Servidor
  private $_username = USUARIO;   //Usuario
  private $_password = PASSWORD;  //Contraseña
  private $_database = BASE;      //Base de datos

  //Métodos
  	public static function getInstance() {
      if(!self::$_instance) { //Si no hay instancia, la crea
        self::$_instance = new self();
      }
      return self::$_instance;
    }

    #Método constructor
    private function __construct() {
      $conne = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
      $conne->set_charset("utf8");
      //Verificacion de conexion
      if($conne->connect_errno) {
        switch ($conne->connect_errno) {
          case '1045':
            echo "La contrasena no es correcta";
            break;
        }
      }
      return $this->_connection = $conne;
    }

    #Método para evitar la clonación de la conexión
    private function __clone() { }

    #Método para obtener la conexión mysqli
    public function getConnection() {
      return $this->_connection;
    }

  }

  /*$db = Conexion::getInstance();
  $mysqli = $db->getConnection();
  var_dump($mysqli);*/ 


  ?>