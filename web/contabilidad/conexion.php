<?php
$host="localhost";
$user="root";
$pw="root";
$db="sissg_dev";

$servi='localhost';
$baseDatos='sissg_dev';
$usuario='root';
$passsword='root';	

$COMPrinter="COM6";
$COMBarcode="COM2";

class conexion {
  private $server;
  private $database;
  private $usuario;
  private $pass;
  
  public function __construct($server,$database, $usuario, $pass)
  {
    $this->server=$server;
	$this->database=$database;
	$this->usuario=$usuario;
	$this->pass=$pass;
	
  }
  public function conectar()
  {
    $con=mysql_connect($this->server,$this->usuario,$this->pass) or die("problemas con el servidor");
	mysql_select_db($this->database,$con) or die("la base de datos no abre clase");
	return($con);
  }
  function desconectar() {
	##############################
	
		mysql_close();
		print("desconectado");

	}
  
}


?>