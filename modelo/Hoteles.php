<?php

include_once('../conexion/conn.php');
include_once('../config/config.php');
include_once('SubirArchivos.php');
include_once('FechaYHora.php');
include_once('Encriptacion.php');

class Hoteles extends Conexion {
    //Atributos a usar
  private $mysqli;
  private $nombre;
  private $direccion;
  private $telefono;
  private $email;
  private $nombreCont;
  private $apellidoCont;
  private $id;
  private $status;
  private $salt;
  private $pass;
  private $fecha;
  private $hora;
  private $usuario;
  private $comentario;

    #Método constructor
  public function __construct() {
    $this->db     = Conexion::getInstance();
    $this->mysqli = $this->db->getConnection();
    /*---*/
    /*$key = '';
    $longitud = "8";
    $pattern = '1234567890';
    $max = strlen($pattern)-1;
    for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
    $this->pass = $key;*/
    /*---*/
    $date = new FechaYHora;
    $this->fecha = $date->obtenerFecha();
    $this->hora = $date->obtenerHora();
  }

    #Método para cerrar la conexion
  public function cerrar() {
    $this->mysqli->close();
  }

    #Método para verificar datos
  public function registrar($nombreHotel, $direccion, $telefono, $email, $nombreCont, $apellidoCont, $img) {
    $this->nombre       = $nombreHotel;
    $this->direccion    = $direccion;
    $this->telefono     = $telefono;
    $this->email        = $email;
    $this->nombreCont   = $nombreCont;
    $this->apellidoCont = $apellidoCont;
    $this->img          = $img;
    $this->status       = 1;
    $this->salt         = Encriptacion::obtenerCodigoAleatorioNumerico();
    $this->pass         = 1234;
    $this->pass         = hash_hmac("sha256", $this->pass, $this->salt);

    $query = "INSERT INTO hotel VALUES (null,'$this->nombre','$this->direccion','$this->telefono','$this->email','$this->status','$this->fecha','$this->hora',null)";
    $resultado = $this->mysqli->query($query);
    if($resultado) {
      $id_hotel = $this->mysqli->insert_id;
      $query   = "INSERT INTO usuarios VALUES (null,'$this->nombreCont','$this->apellidoCont','$id_hotel')"; 
      $res     = $this->mysqli->query($query);
      if($res) {
        $id_usuario = $this->mysqli->insert_id;
        $query = "INSERT INTO t_salt VALUES (null,'$id_usuario','$this->salt')";
        $res = $this->mysqli->query($query);
        if($res) {
          $query   = "INSERT INTO sesion VALUES (null,'$id_usuario','$this->email','$this->pass','Usuario','$id_hotel')";
          $res     = $this->mysqli->query($query);
          if($res) {
            $objeto = new SubirArchivos;
            echo $objeto->adminSubirImagenHotel($img, $id_hotel);
          } else {
            echo "Error en sesion";
          }
        } else {
          echo "Error en salt";
        }
      } else {
        echo "Error usuarios: ".$this->mysqli->connect_errno;
      }
    } else {
      echo "error: ".$this->mysqli->errno." - ".$this->mysqli->error;
    }
  }

    #Método para editar
  public function editar($id) {
    $this->id = $id;
    $columns = array();
    $query = "SELECT * FROM hotel INNER JOIN usuarios ON hotel.id_hotel = usuarios.id_hotel INNER JOIN sesion ON hotel.correo_usuario = sesion.correo_usuario WHERE hotel.id_hotel = '".$this->id."'";
    $res = $this->mysqli->query($query);
    if($res) {
      while ($row = $res->fetch_assoc()) {
        $columns[] = $row;
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($columns);
    } else {
      echo "error: ".$this->mysqli->errno." - ".$this->mysqli->error;
    }
  }

  public function editarStatus($id, $status) {
    $this->id     = $id;
    $this->status = $status;
    $query = "UPDATE hotel SET status_hotel = '".$this->status."' WHERE id_hotel = '".$this->id."'";
    $res   = $this->mysqli->query($query);
    if($res) {
      echo "BIEN";
    } else {
      echo "error: ".$this->mysqli->errno." - ".$this->mysqli->error;
    }
  }

  public function editarGeneral($id, $nombre, $direccion, $telefono) {
    $this->id        = $id;
    $this->nombre    = $nombre;
    $this->direccion = $direccion;
    $this->telefono  = $telefono;
    $query  = "UPDATE hotel SET ";
    $query .= "nombre_hotel    = '".$this->nombre."', ";
    $query .= "direccion_hotel = '".$this->direccion."', ";
    $query .= "telefono_hotel  = '".$this->telefono."' ";
    $query .= "WHERE id_hotel  = '".$this->id."'";
    $res = $this->mysqli->query($query);
    if($res) {
      unset($_SESSION['idHotel']);
      echo "Datos cambiados";
    } else {
      echo "error: ".$this->mysqli->errno." - ".$this->mysqli->error;
    }
  }

  public function editarUsuario($id, $usuarioNombre, $usuarioApellido) {
    $this->id           = $id;
    $this->nombreCont   = $usuarioNombre;
    $this->apellidoCont = $usuarioApellido;
    $query  = "UPDATE usuarios SET ";
    $query .= "nombre_usuario    = '".$this->nombreCont."', ";
    $query .= "apellidos_usuario = '".$this->apellidoCont."' ";
    $query .= "WHERE id_hotel    = '".$this->id."'";
    $res = $this->mysqli->query($query);
    if($res) {
      echo "Datos cambiados";
    } else {
      echo "error: ".$this->mysqli->errno." - ".$this->mysqli->error;
    }
  }

  public function editarSesion($id, $correoUsuario) {
    $this->id    = $id;
    $this->email = $correoUsuario;
    $query  = "UPDATE sesion SET ";
    $query .= "correo_usuario = '".$this->email."' ";
    $query .= "WHERE id_hotel    = '".$this->id."'";
    $res = $this->mysqli->query($query);
    if($res) {
      $query  = "UPDATE hotel SET ";
      $query .= "correo_usuario = '".$this->email."' ";
      $query .= "WHERE id_hotel    = '".$this->id."'";
      $res = $this->mysqli->query($query);
      if($res) {
        echo "Datos cambiados";
      } else {
        echo "2 cambio no";
      }
    } else {
      echo "error: ".$this->mysqli->errno." - ".$this->mysqli->error;
    }
  }

    #Método para eliminar
  public function eliminar($id, $usuario, $comentario) {
    //Atributos a usar
    $this->id         = $id;
    $this->usuario    = $usuario;
    $this->comentario = $comentario;

    $query =  $query = "SELECT *  FROM hotel WHERE id_hotel = '".$this->id."'";
    $res = $this->mysqli->query($query);
    if($row = $res->fetch_array()) {
      $nombreHotel = $row['nombre_hotel'];
      $query = "DELETE FROM usuarios WHERE id_hotel = '".$this->id."'";
      $res = $this->mysqli->query($query);
      if($res) {
        $query = "DELETE FROM sesion WHERE id_hotel = '".$this->id."'";
        $res = $this->mysqli->query($query);
        if($res) {
          $query = "DELETE FROM hotel WHERE id_hotel = '".$this->id."'";
          $res = $this->mysqli->query($query);
          if($res) {
            $query = "INSERT INTO t_reg_hotel VALUES (null,'".$this->usuario."','".$this->fecha."','".$this->hora."','$nombreHotel','".$this->comentario."')";
            $res = $this->mysqli->query($query);
            if($res) {
              echo "El hotel ha sido borrado de la plataforma";
            } else {
              echo "Error: ".$this->mysqli->errno." - ".$this->mysqli->error;
            }
          } else {
            echo "Error: ".$this->mysqli->errno." - ".$this->mysqli->error;
          }
        } else {
          echo "Error: ".$this->mysqli->errno." - ".$this->mysqli->error;
        }
      } else {
        echo "Error: ".$this->mysqli->errno." - ".$this->mysqli->error;
      }
    } else {
      echo "Error: ".$this->mysqli->errno." - ".$this->mysqli->error;
    }
  }

    #Método para ver datos
  public function ver($id) {
    $this->id = $id;
    $columns  = array();
    session_start();
    $_SESSION['idHotel'] = $this->id;
    $query =  $query = "SELECT *  FROM hotel WHERE hotel.id_hotel = '".$this->id."'";
    $resultado = $this->mysqli->query($query);
    if($resultado) {
      while ($row = $resultado->fetch_assoc()) {
        $columns[] = $row;
      }
      header('Content-type: application/json; charset=utf-8');
      //var_dump($columns);
      echo json_encode($columns);
      /*switch(json_last_error()) {
        case JSON_ERROR_NONE:
        echo ' - Sin errores';
        break;
        case JSON_ERROR_DEPTH:
        echo ' - Excedido tamaño máximo de la pila';
        break;
        case JSON_ERROR_STATE_MISMATCH:
        echo ' - Desbordamiento de buffer o los modos no coinciden';
        break;
        case JSON_ERROR_CTRL_CHAR:
        echo ' - Encontrado carácter de control no esperado';
        break;
        case JSON_ERROR_SYNTAX:
        echo ' - Error de sintaxis, JSON mal formado';
        break;
        case JSON_ERROR_UTF8:
        echo ' - Caracteres UTF-8 malformados, posiblemente están mal codificados';
        break;
        default:
        echo ' - Error desconocido';
        break;
      }*/
      
    } else {
      echo "error: ".$this->mysqli->errno." - ".$this->mysqli->error;
    }

  }

    #Método para enlistar
  public function enlistar() {
      //Código para enlistar
    $columns = array();
    $query     = "SELECT id_hotel, nombre_hotel, direccion_hotel, telefono_hotel FROM hotel";
    $res = $this->mysqli->query($query);
    if($res) {
      while ($row = $res->fetch_assoc()) {
        $columns[] = $row;
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($columns);
    } else {
      echo "error: ".$this->mysqli->errno." - ".$this->mysqli->error;
    }
  }

  public function enlistarHotelesBorrados() {
      //Código para enlistar
    $columns = array();
    $query     = "SELECT usuario_reg, fecha_reg, hora_reg, hotel_reg, desc_reg FROM t_reg_hotel";
    $res = $this->mysqli->query($query);
    if($res) {
      while ($row = $res->fetch_assoc()) {
        $columns[] = $row;
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($columns);
    } else {
      echo "error: ".$this->mysqli->errno." - ".$this->mysqli->error;
    }
  }

  public function contarHoteles() {
    $query = "SELECT * FROM hotel";
    $res   = $this->mysqli->query($query);
    if($res) {
      $cantidadHoteles = $res->num_rows;
      $query = "SELECT * FROM habitaciones";
      $res   = $this->mysqli->query($query);
      if($res) {
        $cantidadHabitaciones = $res->num_rows;
        $valores = array("cuantosHoteles" => $cantidadHoteles, "cuantasHabitaciones" => $cantidadHabitaciones);
        echo json_encode($valores);
      }
      
    }
  }
}
?>