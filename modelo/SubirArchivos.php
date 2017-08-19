<?php

include_once('../conexion/conn.php');
include_once('../config/config.php');

class SubirArchivos extends Conexion{
  	//Atributos
	private $mysqli;
	private $db;
	private $img;
	private $idHotel;

	public function __construct() {
		$this->db     = Conexion::getInstance();
		$this->mysqli = $this->db->getConnection();
	}

	private function formatSizeUnits($bytes) {
		if ($bytes >= 1073741824) {
			$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		} elseif ($bytes >= 1048576) {
			$bytes = number_format($bytes / 1048576, 2) . ' MB';
		} elseif ($bytes >= 1024) {
			$bytes = number_format($bytes / 1024, 2) . ' KB';
		} elseif ($bytes > 1) {
			$bytes = $bytes . ' bytes';
		} elseif ($bytes == 1) {
			$bytes = $bytes . ' byte';
		} else {
			$bytes = '0 bytes';
		}
		return $bytes;
	}

	public function adminSubirImagenHotel($img, $id) {
		$nombreArchivo = $img['name'];
		if ($img["error"] > 0){
			return "ha ocurrido un error";
		} else {
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 100024;
			if (in_array($img['type'], $permitidos) && $img['size'] <= $limite_kb * 100024){
				$ruta = "../assets/hoteles/" . $img['name'];
				if (!file_exists($ruta)){
					$resultado = @move_uploaded_file($img["tmp_name"], $ruta);
					if ($resultado){
						$query = "UPDATE hotel SET url_imagen = '$nombreArchivo' WHERE id_hotel = '$id'";
						$res = $this->mysqli->query($query);
						if($res) {
							return "El archivo ha sido subido";
						} else {
							return "No se pudo hacer update: error: ".$this->mysqli->errno." - ".$this->mysqli->error;
						}
					} else {
						return "ocurrio un error al mover el archivo.";
					}
				} else {
					return $img['name'] . ", este archivo existe";
				}
			} else {
				return "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
			}
		}
	}
}

?>