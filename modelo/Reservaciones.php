<?php

include_once('../conexion/conn.php');
include_once('../config/config.php');

class Reservaciones extends Conexion {
    //Atributos a usar
  private $mysqli;
  private $titulo;
  private $descrip;
  private $cantidad;
  private $precio;
  private $id;
  private $status;

    #Método constructor
  public function __construct() {
    $this->db     = Conexion::getInstance();
    $this->mysqli = $this->db->getConnection();
  }

    #Método para cerrar la conexion
  public function cerrar() {
    $this->mysqli->close();
  }

    #Método para verificar datos
  public function registrar($titulo,$desc,$cantidad,$precio,$idHotel) {
    $this->titulo   = $titulo;
    $this->descrip  = $desc;
    $this->cantidad = $cantidad;
    $this->precio   = $precio;
    $this->id       = $idHotel;
    $this->status   = 1;
    $query = "INSERT INTO habitaciones VALUES(null,'$this->id','$this->titulo','$this->descrip','$this->cantidad','$this->precio','$this->status')";
    $res = $this->mysqli->query($query);
    if($res) {
      return "registro completo";
    } else {
      return "error: ".$this->mysqli->errno." - ".$this->mysqli->error;
    }
  }

    #Método para editar
  public function editar($id) {
    $this->id = $id;
    $columns = array();
    $query = "SELECT * FROM habitaciones WHERE id_hab = '".$this->id."'";
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

  public function enlistarServicios($id) {
    $this->id = $id;
    $columns = array();
    $query = "SELECT * FROM servicio_habitacion AS serhab INNER JOIN servicios_habitaciones ON serhab.id_servicio = servicios_habitaciones.id_servicio WHERE serhab.id_hab = '".$this->id."'";
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
    $query = "UPDATE habitaciones SET status_hab = '".$this->status."' WHERE id_hab = '".$this->id."'";
    $res   = $this->mysqli->query($query);
    if($res) {
      echo "BIEN";
    } else {
      echo "error: ".$this->mysqli->errno." - ".$this->mysqli->error;
    }
  }

    #Método para eliminar
  public function eliminar($id) {

  }

  public function eliminarServicio($id) {
    $this->id = $id;
    $query = "DELETE FROM servicio_habitacion WHERE id_servicio_hab = '".$this->id."'";
    $res = $this->mysqli->query($query);
    if($res) {
      return true;
    } else {
      return false;
    }
  }

    #Método para ver datos
  public function ver($id) {
    $this->id = $id;
    $columns  = array();
    session_start();
    $_SESSION['idHab'] = $this->id;
    $query = "SELECT * FROM habitaciones WHERE id_hab = '".$this->id."'";
    $resultado = $this->mysqli->query($query);
    if($resultado) {
      while ($row = $resultado->fetch_assoc()) {
        $columns[] = $row;
      }
      header('Content-type: application/json; charset=utf-8');
      //var_dump($columns);
      echo json_encode($columns);
    } else {
      echo "error: ".$this->mysqli->errno." - ".$this->mysqli->error;
    }
  }

    #Método para enlistar
  public function enlistar() {
    $columns  = array();
    $query     = "SELECT * FROM reservaciones";
    $resultado = $this->mysqli->query($query);
    if($resultado) {
      while ($row = $resultado->fetch_array()) {
        $columns[] = $row;
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($columns);
    } else {
      echo "NO";
    }
  }

  public function contarReservaciones() {
    $query = "SELECT * FROM reservaciones";
    $res   = $this->mysqli->query($query);
    if($resultado) {
      while ($row = $resultado->fetch_array()) {
        $arreglo["data"][] = $row;
      }
      echo json_encode($arreglo);
    } else {
      echo "NO";
    }
  }
}
?>