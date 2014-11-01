<?php
class Errors {
	
	public $errorTipos = array(
		1 => "ERROR",
		2 => "WARNING", 
		4 => "PARSE ERROR",
		8 => "NOTICE",
		16 => "CORE ERROR",
		32 => "CORE WARNING",
		64 => "COMPILE ERROR",
		128 => "COMPILE WARNING",
		256 => "USER ERROR",
		512 => "USER WARNING",
		1024 => "USER NOTICE"
	);

	private $mostrarErrores = TRUE;
	private $loguearErrores = TRUE;
	private $archivoErrores = 'tmp/php_errores.log';

	public function __construct(){
		$gestor = set_error_handler(array($this, 'gestionErrores'));

		error_reporting(E_ALL);

	}

	public function gestionErrores($errno, $errstr, $file, $line, $context){
		$strErr  = "<pre>";
		$strErr .= "-- ERROR ".$this->errorTipos[$errno]." --".PHP_EOL;
		$strErr .= "FECHA: ".date("Y-m-d H:i:s").PHP_EOL;
		$strErr .= "ARCHIVO: ".$file.PHP_EOL;
		$strErr .= "LINEA : ".$line.PHP_EOL;
		$strErr .= "IP SERVIDOR: ".$_SERVER['SERVER_ADDR'].PHP_EOL;
		$strErr .= "IP USUARIO: ".$_SERVER['REMOTE_ADDR'].PHP_EOL;
		$strErr .= "MENSAJE: ". $errstr.PHP_EOL;
		$strErr .= "-- ERROR ".$this->errorTipos[$errno]. " --".PHP_EOL;
		$strErr .= "</pre>";
		

		if($this->loguearErrores){
			if(is_writable($this->archivoErrores)){
				$logTxt  = file_get_contents($this->archivoErrores);
				$logTxt .= $strErr.PHP_EOL;
				file_put_contents($this->archivoErrores, $logTxt);
			}
		}

		if($this->mostrarErrores){
			echo $strErr;
		}else{
			echo "ERROR".PHP_EOL;
		}
	}

}