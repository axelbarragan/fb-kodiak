<?php

include_once('../conexion/conn.php');
include_once('../config/config.php');

class Encriptacion {
  	//Atributos
	  private $salt;
	  private $pass;

  	//Métodos
	public function __construct() {

	}

	public static function encLogin($salt, $pass) {
		return hash_hmac("sha256", $pass, $salt);
	}

	public static function generarToken() {
		return md5(uniqid(rand(), TRUE));
	}

	private function encriptar($input) {
		$output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$Key), $input, MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))));
		return $output;
	}

	private function desencriptar($input) {
		$output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$Key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))), "\0");
		return $output;
	}

	public function turingEntrada() {

	}

	public function turingSalida() {

	}

	public static function obtenerCodigoAleatorioNumerico() {
		$key = '';
		$longitud = "8";
		$pattern = '1234567890';
		$max = strlen($pattern)-1;
		for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
			return $key;
	}

	public function obtenerCodigoAleatorioAlfanumerico($cantidad) {
		$key = '';
		$longitud = $cantidad;
		$pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$max = strlen($pattern)-1;
		for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
			return $key;
	}

	public static function vamoADarle() {
		$salt = self::obtenerCodigoAleatorioNumerico();
		$pass = 1234;
		$resp = self::encLogin($salt, $pass);
		return $salt." - ".$resp;
	}

}

/*$obj = Encriptacion::vamoADarle();
echo $obj;*/

?>