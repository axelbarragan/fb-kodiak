<?php

require_once('../conexion/conn.php');
require_once('../config/config.php');
require_once('Encriptacion.php');

class Login extends Conexion {
    //Atributos a usar
 private $user;
 private $password;
 private $db;
 private $mysqli;
 private $token;
 private $tokenRecibido;
 private $salt;
 private $contraOrdi;
 private $contraHash;

    #Método constructor
 public function __construct() {
  $this->db     = Conexion::getInstance();
  $this->mysqli = $this->db->getConnection();

}

    #Método para verificar datos
public function login($usuario, $pass) {
  $this->user = $usuario;
  //$this->pass = $pass;
  //$this->salt = Encriptacion::obtenerCodigoAleatorioNumerico();
  //$this->pass = hash_hmac("sha256", $this->pass, $this->salt);
  $query = "SELECT * FROM sesion INNER JOIN usuarios ON sesion.id_usuario = usuarios.id_usuario INNER JOIN hotel ON sesion.id_hotel = hotel.id_hotel INNER JOIN t_salt ON sesion.id_usuario = t_salt.id_usuario WHERE sesion.correo_usuario = '".$this->user."'";
  $consulta = $this->mysqli->query($query);
  if($row = $consulta->fetch_array()) {
    $codigoSalt = $row['salt'];
    $this->pass = Encriptacion::encLogin($codigoSalt, $pass);
    if($row['pass_usuario'] == $this->pass) {
      if($row['status_hotel'] == 1) {
        session_start();
        $_SESSION['sesion_iniciada'] = "si";
        $_SESSION['nombre_usuario']  = $row['nombre_usuario']." ".$row['apellidos_usuario'];
        $_SESSION['nivel_usuario']   = $row['tipo_usuario'];
        $_SESSION['empresa_usuario'] = $row['id_hotel'];
        $_SESSION['nombre_empresa']  = $row['nombre_hotel'];
        $_SESSION['status']  = $row['status_hotel'];
        $token = Encriptacion::generarToken();
        $_SESSION['token'] = $token;
        echo "oka";
      } else {
        echo "noka";
      }
    } else {
      echo "Contraseña mal";
    }  
  } else {
    echo "Usuario y/o contraseña mal";
  }
}

    #Método para cerrar la conexion
public function cerrar() {
  $this->mysqli->close();
}

public function cerrarSesion(/*$token*/) {
  session_start();
  $_SESSION = array();
  session_destroy();
  echo "adios";

      /*$this->tokenRecibido = $token;
      $this->token = $_SESSION['token'];
      if($this->token == $this->tokenRecibido) {
        
      } else {
        echo "error";
      }*/
      
    }



  }

  ?>