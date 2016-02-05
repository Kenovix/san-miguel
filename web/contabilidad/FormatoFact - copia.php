<?php
session_start();
   if(!isset($_SESSION["username"]))
      header("Location: index.php");
error_reporting(E_ERROR | E_PARSE);		
include("classes_servi/CreaTablasMysql.php");
$hora=date("H:i:s");
$fechaActual=date("Y-m-d");
$fecha = $_POST["TxtFecha"];
$idUsuario=$_SESSION["idUser"];
$tab = "librodiario";
$tabla=  new Mytable($servi,$baseDatos,$usuario,$passsword,$tab);
$tabla->conectar();

if(isset($_POST["CbComprasActivas"]) and $_POST["CbComprasActivas"]>0){
	
	$idCompra = $_POST["CbComprasActivas"];	
}else{
	exit("Debes seleccionar una compra activa");
}

if(isset($_POST["BtnAgregarItem"]))
	$accion = "agregarItem";

if(isset($_POST["BtnGuardar"]))
	$accion = "guardarFact";

if(isset($_POST["EliminarItem"])){
	
	$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
	mysql_select_db($db,$con) or die("la base de datos no abre");
	mysql_query("DELETE FROM compras_precompra WHERE idPreCompra='$_POST[EliminarItem]'",$con)
	or die(mysql_error());
	
	
}
if(isset($_POST["BtnBorrarFact"])){
	
	$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
	mysql_select_db($db,$con) or die("la base de datos no abre");
	mysql_query("DELETE FROM compras_precompra WHERE idComprasActivas='$idCompra'",$con)
	or die(mysql_error());
	mysql_query("DELETE FROM compras_activas WHERE idComprasActivas='$idCompra'",$con)
	or die(mysql_error());
	exit('Factura Borrada, por favor actualice la pagina');
	
}
if($accion=="agregarItem"){
	
	if( isset($_POST["TxtCantidad"]) and !empty($_POST["TxtCantidad"]) and
		isset($_POST["TxtValorUnitario"]) and !empty($_POST["TxtValorUnitario"]) 
		){
			$ValorUnitario=$_POST["TxtValorUnitario"];
			$Cantidad=$_POST["TxtCantidad"];
			$IVA=$_POST["TxtIVA"];
			$data = explode(";", $_POST["ListItems"]);
			$idProducto=$data[1];
			$Subtotal=$ValorUnitario*$Cantidad;
			$Impuestos=round($Subtotal*$IVA);
			$Total=round($Subtotal+$Impuestos);
			
			//////registramos en compras precompra
		
		$NumRegistros=9;
		
		$tabla->NombresColumnas("productosventa");
		$DatosProducto=$tabla->DevuelveValores($idProducto);
				
		$Columnas[0]="idProductosVenta";	$Valores[0]=$idProducto;
		$Columnas[1]="Referencia";      	$Valores[1]=$DatosProducto["Referencia"];
		$Columnas[2]="Descripcion";			$Valores[2]=$DatosProducto["Nombre"];;
		$Columnas[3]="Cantidad";			$Valores[3]=$Cantidad;
		$Columnas[4]="ValorUnitario";		$Valores[4]=$ValorUnitario;
		$Columnas[5]="Subtotal"; 			$Valores[5]=$Subtotal;
		$Columnas[6]="IVA";					$Valores[6]=$Impuestos;
		$Columnas[7]="Total";				$Valores[7]=$Total;
		$Columnas[8]="idComprasActivas";	$Valores[8]=$idCompra;
		
		$tabla->InsertarRegistro("compras_precompra",$NumRegistros,$Columnas,$Valores);
			
			
		}else{
			exit("No se digitó el valor unitario o la cantidad del producto o el IVA");
}
}


/////////////////////////////////
///////////////////guardamos
/////////////////////////////////

if($accion=="guardarFact"){
	
		$ComparaIn=$_POST["TxtTotalCompara"];
		
		$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
		mysql_select_db($db,$con) or die("la base de datos no abre");
			
			//////obtenemos datos de la compra
		$reg = mysql_query("SELECT *, SUM(Subtotal) as SubTotalFact, 
		SUM(IVA) as IVAFact, SUM(Total) as TotalFact
		  FROM `compras_precompra` WHERE `idComprasActivas`='$idCompra' ",$con) 
		or die("La consulta a precompras es erronea.".mysql_error());

		$datosSumas=mysql_fetch_array($reg);

		
		$Subtotal=$datosSumas["SubTotalFact"];
		$IVA=$datosSumas["IVAFact"];
		$Valor=$datosSumas["TotalFact"];			
		$tabla->NombresColumnas("compras_activas");
		$DatosCompra=$tabla->DevuelveValores($idCompra);
		$idProveedor=$DatosCompra["idProveedor"];
		$NumFact=$DatosCompra["Factura"];
		$CuentaOrigen=$DatosCompra["CuentaOrigen"];
		$FormaPago=$DatosCompra["FormaPago"];
		$FechaPagoPro=$DatosCompra["FechaProg"];
		$TipoCompra=$DatosCompra["Tipo"];
		$TotalCompra=$DatosCompra["TotalCompra"];
		
		///////////////////////////////////Alimentamos el inventario
		////////////////////////////////////////////////////////////
		
		$reg = mysql_query("SELECT * FROM `compras_precompra` WHERE `idComprasActivas`='$idCompra' ",$con) 
or die("La consulta a precompras es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

	
   while($datosProducto=mysql_fetch_array($reg)){
	   
	   mysql_query("INSERT INTO relacioncompras ( Fecha, Documento, NumDocumento, Cantidad, ValorUnitarioAntesIVA, TotalAntesIva, ProductosVenta_idProductosVenta  )
	VALUES ('$fecha','$TipoCompra','$NumFact','$datosProducto[Cantidad]','$datosProducto[ValorUnitario]','$datosProducto[Subtotal]','$datosProducto[idProductosVenta]') ",$con) 
or die("no se pudo alimentar el inventario ".mysql_error());
      
}


}
		
		$Diferencia=$TotalCompra-$ComparaIn;
		
		mysql_query("DELETE FROM compras_precompra WHERE idComprasActivas='$idCompra'",$con)
		or die(mysql_error());
		mysql_query("DELETE FROM compras_activas WHERE idComprasActivas='$idCompra'",$con)
		or die(mysql_error());
		
		if($Diferencia<>0)
		print("<script> alert('El total de la factura ingresada no es igual a la sumatoria de los productos comprados, existe una diferencia de: $Diferencia')</script>");
		
		exit('Compra Registrada e inventario alimentado, por favor actualice la pagina');
		
			

}



?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>FormatoFact</title>
<meta name="generator" content="WYSIWYG Web Builder 10 - http://www.wysiwygwebbuilder.com">
<style type="text/css">
body
{
   background-color: #FFFFFF;
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   line-height: 1.1875;
   margin: 0;
   padding: 0;
}
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
#wb_Form1
{
   background-color: transparent;
   border: 2px #000000 solid;
   -moz-border-radius: 8px;
   -webkit-border-radius: 8px;
   border-radius: 8px;
}
#wb_Text10 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text10 div
{
   text-align: left;
}
#wb_Text1 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text1 div
{
   text-align: center;
}
#wb_Text2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text2 div
{
   text-align: center;
}
#Button1
{
   border: 1px #A9A9A9 solid;
   background-color: #87CEEB;
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
}
#AdvancedButton1
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/guardar.png);
   background-repeat: no-repeat;
   background-position: left top;
}
#Layer3
{
   background-color: transparent;
}
#Editbox5
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Editbox6
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Editbox7
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Editbox8
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Editbox9
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#wb_Text3 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text3 div
{
   text-align: center;
}
#Line1
{
   border-width: 0;
   height: 11px;
   width: 1117px;
}
#Line2
{
   border-width: 0;
   height: 11px;
   width: 1117px;
}
</style>
<script language="JavaScript"> 
function envia(){ 
if (confirm('¿Estas seguro que deseas registrar este egreso?')){ 
      document.FrmArriendos.submit();
      document.FrmArriendos.reset();
    } 

 
} 

function confirmadel(){ 
if (confirm('¿Estas seguro que deseas borrar esta factura?')){ 
      document.FrmArriendos.submit();
      document.FrmArriendos.reset();
    } 

 
} 
</script>
</head>
<body>
<div id="wb_Form1" style="position:absolute;left:0px;top:0px;width:1105px;height:1100px;z-index:19;">
<form name="FrmAgregarItemCompra" method="post" action="FormatoFact.php" enctype="multipart/form-data" target="_self" id="Form1">
<input type="hidden" name="CbComprasActivas" value="<?php print($idCompra); ?>">

<div id="Html4" style="position:absolute;left:15px;top:6px;width:171px;height:35px;z-index:1">
<?php


	$tabla->NombresColumnas("compras_activas");
	$DatosCompra=$tabla->DevuelveValores($idCompra);
	$idProveedor=$DatosCompra["idProveedor"];
	$Factura=$DatosCompra["Factura"];
	$fecha=$DatosCompra["Fecha"];
	$CuentaOrigen=$DatosCompra["CuentaOrigen"];
	$Total=$DatosCompra["TotalCompra"];

print('<input type="date" name="TxtFecha" step="1" min="2010-01-01" max="2200-12-31" value='.$fecha.'>');

?></div>

<div id="wb_Text1" style="position:absolute;left:449px;top:13px;width:205px;height:24px;text-align:center;z-index:5;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Datos de la factura <?php print("$Factura por: $ $Total") ?></em></span></div>
<div id="wb_Text2" style="position:absolute;left:462px;top:109px;width:205px;height:24px;text-align:center;z-index:6;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Agregar Item</em></span></div>
<div id="Html3" style="position:absolute;left:15px;top:172px;width:336px;height:42px;z-index:7">
<input list="Items" name="ListItems" value="" required style="width:580px;height:30px" >
<datalist id="Items">

<?php

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

$reg = mysql_query("SELECT * FROM `productosventa` ",$con) or die("La consulta a productos venta es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      print('<option value="'.$datos["Referencia"].'; '.$datos["idProductosVenta"].';'.$datos["Nombre"].'">');
   }

}

?>
</datalist></div>


<div id="Layer3" style="position:absolute;overflow:auto;text-align:left;left:15px;top:314px;width:1073px;height:564px;z-index:10;">
<div id="Html6" style="position:absolute;left:18px;top:8px;width:1022px;height:520px;z-index:0">
<?php

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");


$reg = mysql_query("SELECT * FROM `compras_precompra` WHERE `idComprasActivas`='$idCompra' ",$con) 
or die("La consulta a precompras es erronea.".mysql_error());

print("
<table border=1><tr><th>Referencia</th><th>Descripcion</th><th>Cantidad</th>
<th>Vr Unitario</th><th>Subtotal</th><th>IVA</th><th>Total</th><th>Eliminar</th></tr>");
if(mysql_num_rows($reg)){//Si existen resultados

	
   while($datos=mysql_fetch_array($reg)){
      print("<tr><td>$datos[Referencia]</td><td>$datos[Descripcion]</td><td>$datos[Cantidad]</td>
<td>$datos[ValorUnitario]</td><td>$datos[Subtotal]</td><td>$datos[IVA]</td><td>$datos[Total]</td><td>
Eliminar Item:<br><input type=submit name=EliminarItem Value=$datos[idPreCompra]></td></tr>");
}

$reg = mysql_query("SELECT *, SUM(Subtotal) as SubTotalFact, 
SUM(IVA) as IVAFact, SUM(Total) as TotalFact
  FROM `compras_precompra` WHERE `idComprasActivas`='$idCompra' ",$con) 
or die("La consulta a precompras es erronea.".mysql_error());

$datosSumas=mysql_fetch_array($reg);
$TotalCompara=$datosSumas["TotalFact"];
print("<tr><td colspan=7 align=right><h3>Subtotal</h3></td><td>$ ".number_format($datosSumas["SubTotalFact"])."</td></tr>
<tr><td colspan=7 align=right><h3>IVA</h3></td><td>$ ".number_format($datosSumas["IVAFact"])."</td></tr>
<tr><td colspan=7 align=right><h3>Total</h3></td><td>$ ".number_format($datosSumas["TotalFact"])."</td></tr>");
}

print("</table>");
?></div>
</div>

<input type="submit" name="BtnAgregarItem" value="Agregar" style="position:absolute;left:943px;top:165px;width:132px;height:42px;z-index:8;background-color:#99CCFF">
<input type="submit" name="BtnBorrarFact" style="position:absolute;top:943px;left:20px;width:134px;height:136px;z-index:9;background-color:#F6CED8" onclick="confirmadel();return false;"  value="Eliminar">
<input type="submit" name="BtnGuardar" style="position:absolute;left:954px;top:943px;width:134px;height:136px;z-index:10;" onclick="envia();return false;"  value="Guardar">

<input type="hidden" name="TxtTotalCompara"  value="<?php print("$TotalCompara")?>">

<input type="number" id="Editbox5" style="position:absolute;left:630px;top:173px;width:69px;height:32px;line-height:32px;z-index:11;" name="TxtCantidad" step="any"  value="" required placeholder="Cantidad">
<input type="number" id="Editbox6" style="position:absolute;left:710px;top:173px;width:102px;height:32px;line-height:32px;z-index:12;" name="TxtValorUnitario" value="" required placeholder="ValorUnitario" step="any">
<input type="text" id="Editbox6" style="position:absolute;left:820px;top:173px;width:69px;height:32px;line-height:32px;z-index:13;" name="TxtIVA" value="0.16" required placeholder="ValorUnitario">

<div id="TextFactura" style="position:absolute;left:800px;top:10px;width:69px;height:3px;z-index:20;">
<?php

print('<input type="text" name="TxtNumFactura" value="'.$Factura.'" placeholder="Digite el numero de factura">');

?></div>
</form>
</div>
<div id="wb_Line1" style="position:absolute;left:-4px;top:107px;width:1109px;height:3px;z-index:20;">
<hr></div>
<div id="wb_Line2" style="position:absolute;left:-4px;top:234px;width:1109px;height:3px;z-index:21;">
<hr></div>
</body>
</html>