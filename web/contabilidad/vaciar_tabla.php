<?php 
include("conexion.php");

session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.html");
   
$con=mysql_connect($host,$user, $pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");  
		  
if ($_POST["btnVaciar"]="Limpiar Cotizacion"){
	$tabla="precotizacion";
}
mysql_query("truncate table $tabla");
echo "Cotizacion borrada";
?>