<?php
include("conexion.php");

session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.html");
  
////////////////////////////////////////////
/////////////Obtengo el ID del cliente y el del Usuario 
////////////////////////////////////////////
  
  
$IDCliente = $_POST["TxtIDCliente"];
$idUser = $_SESSION['idUser'];
$Login = $_SESSION["username"];
$Nombre = $_SESSION["nombre"];
$Apellido = $_SESSION["apellido"];
$Observaciones=$_POST["TxtObservaciones"];
$fecha=$_POST["TxtFecha"];	
////////////////////////////////////////////
/////////////Obtengo el ultimo numero de la cotizacion
////////////////////////////////////////////

$con=mysql_connect($host,$user, $pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");  

$DatosVentaActiva=mysql_query("SELECT MAX(NumCotizacion) as NumCotizacion FROM vestasactivas WHERE Usuario_idUsuario='$idUser'", $con) or die('problemas para consultas vestasactivas: ' . mysql_error());
$DatosVentaActiva=mysql_fetch_array($DatosVentaActiva);
$NumCotizacion =$DatosVentaActiva["NumCotizacion"];

if($NumCotizacion>0){
	
	$DatosVentaActiva=mysql_query("SELECT MAX(NumCotizacion) as NumCotizacion  FROM vestasactivas", $con) or die('problemas para consultas vestasactivas: ' . mysql_error());
	$DatosVentaActiva=mysql_fetch_array($DatosVentaActiva);
	$NumCotizacion =$DatosVentaActiva["NumCotizacion"];
	$NumCotizacion2 =$NumCotizacion+1;
	
	mysql_query("UPDATE vestasactivas SET NumCotizacion='$NumCotizacion2' WHERE Usuario_idUsuario='$idUser'", $con) or die('problemas para actualizar vestasactivas: ' . mysql_error());
	
}else{
	$DatosVentaActiva=mysql_query("SELECT MAX(NumCotizacion) as NumCotizacion  FROM vestasactivas", $con) or die('problemas para consultas vestasactivas: ' . mysql_error());
	$DatosVentaActiva=mysql_fetch_array($DatosVentaActiva);
	$NumCotizacion =$DatosVentaActiva["NumCotizacion"]+1;
	$NumCotizacion2 =$NumCotizacion+1;
	
	mysql_query("INSERT INTO vestasactivas (`Nombre`,`Usuario_idUsuario`,`Clientes_idClientes`, `NumCotizacion` ) 
				VALUES('Venta por: $Nombre','$idUser','1','$NumCotizacion2')", $con) or die('problemas para actualizar vestasactivas: ' . mysql_error());
}



////////////////////////////////////////////
/////////////Obtener los items de precotizacion y guardar los datos en la tabla cotizaciones
////////////////////////////////////////////


$reg=mysql_query("select * from precotizacion WHERE idUsuario='$idUser'");

if(mysql_num_rows($reg)){
	
	while($registros2=mysql_fetch_array($reg)){
	
	$SubTotal=round($registros2["SubTotal"]);
	$IVA=round($registros2["IVA"]);
	$Total=round($registros2["Total"]);
	
	
	 mysql_query("INSERT INTO `cotizaciones` (  `NumCotizacion`, `Fecha`, `Descripcion`,`Referencia`, `ValorUnitario`,
	  `Cantidad`, `Subtotal`, `IVA`, `Total`,  `Descuento`, `ValorDescuento`, `PrecioCosto`,  `SubtotalCosto`, `Clientes_idClientes`,
	 `Usuarios_idUsuarios`,`Observaciones`, `TipoItem`, `CuentaPUC`)
	 VALUES ( '$NumCotizacion', '$fecha', '$registros2[Descripcion]', '$registros2[Referencia]', '$registros2[ValorUnitario]', 
	 '$registros2[Cantidad]', '$SubTotal', '$IVA', '$Total', '$registros2[Descuento]', '$registros2[ValorDescuento]',
	 '$registros2[PrecioCosto]', '$registros2[SubtotalCosto]', '$IDCliente', '$idUser', '$Observaciones','$registros2[TipoItem]','$registros2[CuentaPUC]' ) ",$con)
	 or die("Problemas al agregar los datos a cotizaciones");
	
	
	
	}
			
}

mysql_query("delete from precotizacion where idUsuario='$idUser'") or die("no se pudo borrar la precotizacion de la base de datos");	


////////////////////////////////////////////
/////////////Adjuntar Archivo///////////////
////////////////////////////////////////////

$tbl = <<<EOD


<div id="wb_Form3" style="position:absolute;width:639px;height:154px;">
<form name="formPrintCoti" method="post" action="tcpdf/examples/imprimircoti.php" enctype="multipart/form-data" target="_blank" id="Form3">
<input type="hidden" name="ImgPrintCoti" value="$NumCotizacion">

<input type="image" id="Button5" name="Img" src="images/crear_pdf.png" value=$NumCotizacion style="position:absolute;left:20px;top:20px;width:110px;height:150px;z-index:103;">

</form>
</div>
	
		
		 
EOD;

echo $tbl;
	

?>