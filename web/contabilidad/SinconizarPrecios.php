<?php

include "conexion.php"; //Connect to Database
////////////////////////////////////////////
/////////////Verifico que haya una sesion activa
////////////////////////////////////////////
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.php");
 

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor local ".mysql_error());
mysql_select_db($db,$con) or die("la base de datos no abre");

$idServerExt=$_POST["CmbServidor"];

if($idServerExt=="NO"){
	
	exit("<script>alert('Debe seleccionar un servidor valido');<script>");
}

$sql = "SELECT * FROM servidores WHERE idServer='$idServerExt'"; //empty the table of its current records	
$reg=mysql_query($sql,$con) or die("No se pudo obtener los datos del servidor seleccionado ".mysql_error());
$DatosServerExt=mysql_fetch_array($reg);

print("Conectandose al servidor externo $DatosServerExt[Direccion]...<br>");

$conExt=mysql_connect($DatosServerExt["Direccion"],$DatosServerExt["Usuario"],$DatosServerExt["Password"]) or die("Problemas al conectarse al servidor externo ".mysql_error());
mysql_select_db($db,$conExt) or die("la base de datos del servidor seleccionado no abre ".mysql_error());

print("Conexion establecida con $DatosServerExt[Nombre], ip: $DatosServerExt[Direccion]...<br>");

$fecha=date("Y-m-d");
	
	
	print("Borrando sincronización anterior...<br>");
	
	$deleterecords1 = "TRUNCATE TABLE prod_sinc"; //empty the table of its current records
	
	mysql_query($deleterecords1,$conExt) or die("No se pudo eliminar la sincronización anterior".mysql_error());

	
	print("Leyendo listado de precios del servidor local....<br>");
	
	$sql = "SELECT * FROM productosventa"; //empty the table of its current records	
	$reg=mysql_query($sql,$con) or die("No se pudo obtener los datos del servidor seleccionado ".mysql_error());

	
	if(mysql_num_rows($reg)){
	
	print("Datos del listado local listos para transferir...<br> Espere a que se copien los registros...");
	
	while($DatosListLocal=mysql_fetch_array($reg)){
		
		$sql="INSERT INTO prod_sinc (`Referencia`, `Departamento`, `Nombre`, `PrecioVenta`, `PrecioMayorista`) 
		VALUES ('$DatosListLocal[Referencia]','$DatosListLocal[Departamento]','$DatosListLocal[Nombre]','$DatosListLocal[PrecioVenta]','$DatosListLocal[PrecioMayorista]');";
		mysql_query($sql,$conExt) or die("No se pudo copiar el producto con id: $DatosListLocal[idProductosVenta]  ".mysql_error());
		
    }
	
	print("Datos Transferidos, listados actualizados...<br>");
	
	}else{
		
		exit("No hay registros en la lista local");
	}
 

?>