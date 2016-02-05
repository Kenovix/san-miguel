<?php

function ActualizaCartera()
{
	
include("conexion.php");	
$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

$NumMayor=mysql_query("select max(idCartera) as maxnp from cartera");
$item=mysql_fetch_array($NumMayor);
$MaxCartera=$item["maxnp"];

$FechaActual=date("Y-m-d");
//echo $FechaActual." ";

mysql_query("DELETE FROM alertas WHERE AlertaTipo='Cartera'",$con);
 for ($i=1;$i <= $MaxCartera; $i++) {
 	
	$datos = mysql_query("select * from cartera WHERE idCartera=$i") or die (mysql_error());
	
	if(mysql_num_rows($datos)>0)
	{
		
		$r=mysql_fetch_array($datos);	
		$FechaVencimiento= $r["FechaVencimiento"];
		//echo $FechaVencimiento." ";
		
		$datetime1 = date_create($FechaActual);
		$datetime2 = date_create($FechaVencimiento);
		$interval = date_diff($datetime1, $datetime2);
		 $interval = $interval->format('%R%a');
		//echo $interval;
		//echo "  ,,,,,, ,,,, ,,, ,, ";
		
		$signo=substr("$interval", 0, 1);
		$dias=substr("$interval", 1);
		//echo "signo $signo  dias: $dias    ";
		if($signo=="-"){
			$sql = " UPDATE cartera SET
		  		DiasCartera = '$dias' 
				WHERE idCartera='$i' ";
				mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
				
		 mysql_query("INSERT INTO `servitorno`.`alertas` ( `AlertaTipo`, `Mensaje`, `Cartera_idCartera`, `PagosProgram_idPagosProgram`) VALUES ( 'Cartera', 'Vencimiento de Cartera del cliente $r[Cliente]', '$r[idCartera]', 'No'); ",$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
		 
		}
		
	} 
	
	}
	echo "Cartera Actualizada!";
}

/////////////////////////////////////////////////////////
//////////////Actualiza Cuentas por pagar////////////////
///////////////////////////////////////////////////////

function ActualizaCuentas()
{
	
include("conexion.php");	
$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

$FechaActual=date("Y-m-d");
//echo $FechaActual." ";

mysql_query("DELETE FROM alertas WHERE AlertaTipo='PagoProgramado'",$con) or die (mysql_error());


$NumMayor=mysql_query("select max(idEgresos) as maxnp from egresos");
$item=mysql_fetch_array($NumMayor);
$MaxEgreso=$item["maxnp"];


 for ($i=1;$i <= $MaxEgreso; $i++) {
 	
	$datos = mysql_query("select * from egresos WHERE idEgresos=$i and PagoProg='Programado' ") or die (mysql_error()); //recorro toda la tabla de egresos
	
	if(mysql_num_rows($datos)>0)
	{
		
		$r=mysql_fetch_array($datos);	
		$FechaVencimiento= $r["FechaPagoPro"];
		//echo $FechaVencimiento." ";
		
		$datetime1 = date_create($FechaActual);
		$datetime2 = date_create($FechaVencimiento);
		$interval = date_diff($datetime1, $datetime2);
		 $interval = $interval->format('%R%a');
		//echo $interval;
		//echo "  ,,,,,, ,,,, ,,, ,, ";
		
		$signo=substr("$interval", 0, 1);
		$dias=substr("$interval", 1);
		//echo "signo $signo  dias: $dias    ";
		if($signo=="-"){
							
		 mysql_query("INSERT INTO `servitorno`.`alertas` ( `AlertaTipo`, `Mensaje`, `Cartera_idCartera`, `PagosProgram_idPagosProgram`) VALUES ( 'PagoProgramado', 'Se venció el plazo para pagar $r[Concepto] a $r[Beneficiario], ID del Pago: $r[idEgresos]', 'NO', '$r[idEgresos]'); ",$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
		 
		}
		
	} 
	
	}
	echo "Alertas Actualizadas!, actualice la página para observar los cambios";
}


/////////////////////////////////////////////////////////
//////////////////////////Llamado a la funcion////////////
/////////////////////////////////////////////////////////




if(isset($_POST["BtnActCartera"]))
	ActualizaCartera();
	
if(isset($_POST["BtnPagaCuenta"]))
	ActualizaCuentas();

?>