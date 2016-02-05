<?php
session_start();
   if(!isset($_SESSION["username"]))
      header("Location: index.php");
   		

error_reporting(E_ERROR | E_PARSE);		
include("classes_servi/CreaTablasMysql.php");

$fechaActual=date("Y-m-d");
$fecha = $_POST["TxtFecha"];
$idUsuario=$_SESSION["idUser"];
$tab = "librodiario";
$tabla=  new Mytable($servi,$baseDatos,$usuario,$passsword,$tab);
$tabla->conectar();

if(isset($_POST["AgregarCompra"])){
	
	$FechaProg=$_POST["TxtFechaProg"];
	
	$data = explode(";", $_POST["CmbProveedores"]);
	$idProveedor=$data[1];
		
	if($_POST["CmbCuentaOrigen"]<>"NO" and isset($_POST["TxtNumFactura"]) and !empty($_POST["TxtNumFactura"]) and $idProveedor>0){
		
	$NumFact=$_POST["TxtNumFactura"];
	$CuentaDestino="1435";
	$CuentaOrigen=$_POST["CmbCuentaOrigen"];
	$Subtotal=$_POST["TxtSubtotal"];
	$IVA=$_POST["TxtIVA"];
	$Total=$_POST["TxtTotal"];
	$Documento=$_POST["CmbTipoCompra"];
	
	//////registramos en Compras Activas
		
		$NumRegistros=10;
		$tabla->NombresColumnas("proveedores");
		$DatosProveedor=$tabla->DevuelveValores($idProveedor);
		$RazonSocial=$DatosProveedor["RazonSocial"];
		//$NIT=$DatosProveedor["Num_Identificacion"];
		
		
		
		$Columnas[0]="Fecha";				$Valores[0]=$fecha;
		$Columnas[1]="idProveedor";			$Valores[1]=$idProveedor;
		$Columnas[2]="Factura";				$Valores[2]=$NumFact;
		$Columnas[3]="NombrePro";			$Valores[3]=$RazonSocial;
		
		$Columnas[4]="Usuarios_idUsuarios";	$Valores[4]=$idUsuario;
		$Columnas[5]="FormaPago";			$Valores[5]=$_POST["CmbFormaPago"];
		$Columnas[6]="CuentaOrigen";		$Valores[6]=$CuentaOrigen;
		$Columnas[7]="FechaProg";			$Valores[7]=$FechaProg;	
		$Columnas[8]="Tipo";	   			$Valores[8]=$_POST["CmbTipoCompra"];
		$Columnas[9]="TotalCompra";	   		$Valores[9]=$_POST["TxtTotal"];		
		$tabla->InsertarRegistro("compras_activas",$NumRegistros,$Columnas,$Valores);
		
		///////////////////////////////////////////////////////777
		//////////////////////Realizo asientos contables
		
		
		$Concepto="Compra de mercancias";
		
		$Valor=$Total;
			
		//////registramos en egresos
		if($Total>0){
			
		$NumRegistros=16;
		$tabla->NombresColumnas("proveedores");
		$DatosProveedor=$tabla->DevuelveValores($idProveedor);
		$RazonSocial=$DatosProveedor["RazonSocial"];
		$NIT=$DatosProveedor["Num_Identificacion"];
		
		
		
		$Columnas[0]="Fecha";				$Valores[0]=$fecha;
		$Columnas[1]="Beneficiario";		$Valores[1]=$RazonSocial;
		$Columnas[2]="NIT";					$Valores[2]=$NIT;
		$Columnas[3]="Concepto";			$Valores[3]=$Concepto;
		$Columnas[4]="Valor";				$Valores[4]=$Valor;
		$Columnas[5]="Usuario_idUsuario";	$Valores[5]=$idUsuario;
		$Columnas[6]="PagoProg";			$Valores[6]=$_POST["CmbFormaPago"];
		$Columnas[7]="FechaPagoPro";		$Valores[7]=$_POST["TxtFechaProg"];
		$Columnas[8]="TipoEgreso";			$Valores[8]=$accion;
		$Columnas[9]="Direccion";			$Valores[9]=$DatosProveedor["Direccion"];
		$Columnas[10]="Ciudad";				$Valores[10]=$DatosProveedor["Ciudad"];
		$Columnas[11]="Subtotal";			$Valores[11]=$Subtotal;
		$Columnas[12]="IVA";				$Valores[12]=$IVA;
		$Columnas[13]="NumFactura";			$Valores[13]=$NumFact;
		$Columnas[14]="idProveedor";		$Valores[14]=$idProveedor;
		$Columnas[15]="Cuenta";				$Valores[15]=$CuentaOrigen;
							
		$tabla->InsertarRegistro("egresos",$NumRegistros,$Columnas,$Valores);
		
		
		
		if($Documento=="FACTURA"){
		
		/////////////////////////////////////////////////////////////////
		//////registramos en libro diario
		
		
		
		$tab="librodiario";
		$tabla->NombresColumnas("egresos");
		$NumEgreso=$tabla->VerUltimoID();
		$NumRegistros=24;
		$CuentaPUC=$CuentaDestino;  			 /////Servicios
		$tabla->NombresColumnas("cuentas");
		$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
		$NombreCuenta=$DatosCuenta["Nombre"];
		
		
		
		$Columnas[0]="Fecha";					$Valores[0]=$fecha;
		$Columnas[1]="Tipo_Documento_Intero";	$Valores[1]="CompEgreso";
		$Columnas[2]="Num_Documento_Interno";	$Valores[2]=$NumEgreso;
		$Columnas[3]="Tercero_Tipo_Documento";	$Valores[3]=$DatosProveedor['Tipo_Documento'];
		$Columnas[4]="Tercero_Identificacion";	$Valores[4]=$NIT;
		$Columnas[5]="Tercero_DV";				$Valores[5]=$DatosProveedor['DV'];
		$Columnas[6]="Tercero_Primer_Apellido";	$Valores[6]=$DatosProveedor['Primer_Apellido'];
		$Columnas[7]="Tercero_Segundo_Apellido";$Valores[7]=$DatosProveedor['Segundo_Apellido'];
		$Columnas[8]="Tercero_Primer_Nombre";	$Valores[8]=$DatosProveedor['Primer_Nombre'];
		$Columnas[9]="Tercero_Otros_Nombres";	$Valores[9]=$DatosProveedor['Otros_Nombres'];
		$Columnas[10]="Tercero_Razon_Social";	$Valores[10]=$RazonSocial;
		$Columnas[11]="Tercero_Direccion";		$Valores[11]=$DatosProveedor['Direccion'];
		$Columnas[12]="Tercero_Cod_Dpto";		$Valores[12]=$DatosProveedor['Cod_Dpto'];
		$Columnas[13]="Tercero_Cod_Mcipio";		$Valores[13]=$DatosProveedor['Cod_Mcipio'];
		$Columnas[14]="Tercero_Pais_Domicilio"; $Valores[14]=$DatosProveedor['Pais_Domicilio'];
		$Columnas[15]="CuentaPUC";				$Valores[15]=$CuentaPUC;
		$Columnas[16]="NombreCuenta";			$Valores[16]=$NombreCuenta;
		$Columnas[17]="Detalle";				$Valores[17]="egresos";
		
		$Columnas[18]="Debito";					$Valores[18]=$Subtotal;
		$Columnas[19]="Credito";				$Valores[19]="0";
		$Columnas[20]="Neto";					$Valores[20]=$Subtotal;
		$Columnas[21]="Mayor";					$Valores[21]="NO";
		$Columnas[22]="Esp";					$Valores[22]="NO";
		$Columnas[23]="Concepto";				$Valores[23]=$Concepto;
							
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		/////////////////////////////////////////////////////////////////
		//////contra partida
		if($_POST["CmbFormaPago"]=="Contado"){
			
			
			$CuentaPUC=$CuentaOrigen; //cuenta de donde sacaremos el valor del egreso
			$tabla->NombresColumnas("cuentasfrecuentes");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
		}
		if($_POST["CmbFormaPago"]=="Programado"){
			$CuentaPUC="2205".$idProveedor;
			$NombreCuenta="Proveedor Nacional $RazonSocial $NIT";
		}
		
		
		$Valores[15]=$CuentaPUC;
		$Valores[16]=$NombreCuenta;
		$Valores[18]="0";
		$Valores[19]=$Valor; 						//Credito se escribe el total de la venta menos los impuestos
		$Valores[20]=$Valor*(-1);  											//Credito se escribe el total de la venta menos los impuestos
		
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		/////////////////////////////////////////////////////////////////
		//////Si hay IVA
		if($IVA<>0){
		
			$CuentaPUC=2408; //cuenta de donde sacaremos el valor del egreso
			$tabla->NombresColumnas("cuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=$IVA;
			$Valores[19]=0; 						
			$Valores[20]=$IVA;  											//Credito se escribe el total de la venta menos los impuestos
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		}
		
		}
		}
		print("Se agregó la factura");
	}else{
		exit("Para ingresar una compra debe seleccionar y completar todos los campos 
		Usted seleccionó cuenta origen: $_POST[CmbCuentaOrigen] <br> Numero de Factura:$Factura<br> del proveedor $_POST[CmbCuentaDestino]");
	}
	
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Compra Productos</title>
<style type="text/css">
html, body
{
   height: 100%;
}
div#space
{
   width: 1px;
   height: 50%;
   margin-bottom: -735px;
   float:left
}
div#container
{
   width: 1206px;
   height: 1470px;
   margin: 0 auto;
   position: relative;
   clear: left;
}
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
@-webkit-keyframes animate-fade-in
{
   0% { opacity: 0;  }
   100% { opacity: 1;  }
}
@-moz-keyframes animate-fade-in
{
   0% { opacity: 0;  }
   100% { opacity: 1;  }
}
@-o-keyframes animate-fade-in
{
   0% { opacity: 0;  }
   100% { opacity: 1;  }
}
@-ms-keyframes animate-fade-in
{
   0% { opacity: 0;  }
   100% { opacity: 1;  }
}
@keyframes animate-fade-in
{
   0% { opacity: 0;  }
   100% { opacity: 1;  }
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
#Layer1
{
   background-color: transparent;
   background-image: url(images/CompraProductos_Layer1_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
}
#Image1
{
   border: 0px #000000 solid;
   -webkit-animation: animate-fade-in 5000ms ease-in-out 0ms infinite alternate-reverse;
   -moz-animation: animate-fade-in 5000ms ease-in-out 0ms infinite alternate-reverse;
   -ms-animation: animate-fade-in 5000ms ease-in-out 0ms infinite alternate-reverse;
   animation: animate-fade-in 5000ms ease-in-out 0ms infinite alternate-reverse;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image2
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image2:hover
{
   -webkit-transform: perspective(1px) rotateX(0deg) scale3d(1.3,1.3,1.3);
   -moz-transform: perspective(1px) rotateX(0deg) scale3d(1.3,1.3,1.3);
   -ms-transform: perspective(1px) rotateX(0deg) scale3d(1.3,1.3,1.3);
   transform: perspective(1px) rotateX(0deg) scale3d(1.3,1.3,1.3);
   -webkit-transition: -webkit-transform 200ms linear 0ms;
   -moz-transition: transform 200ms linear 0ms;
   -ms-transition: transform 200ms linear 0ms;
   transition: transform 200ms linear 0ms;
}
#wb_Form2
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#wb_Text4 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text4 div
{
   text-align: center;
}
#InlineFrame1
{
   border: 1px #C0C0C0 solid;
}
#wb_Form1
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#wb_Text8 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text8 div
{
   text-align: left;
}
#Image3
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Combobox1
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
}
</style>
<script language="JavaScript"> 
function envia2(){ 

subtotal = document.getElementById("TxtSubtotal").value;
iva = document.getElementById("TxtIVA").value;
total = document.getElementById("TxtTotal").value;

var ValidaTotal=(parseInt(subtotal)+parseInt(iva));
if (ValidaTotal==total){ 
      
     
if (confirm('¿Estas seguro que deseas registrar este egreso?')){ 
      thisform.submit();
      
    } 

 }else{
	 
	 alert('[ERROR] El Subtotal mas el IVA no corresponde al Total, por favor verifique el total debería ser: '+ValidaTotal);
	 document.getElementById("TxtTotal").value=ValidaTotal;
	 document.getElementById("TxtTotal").focus();
	 
 }
} 

function envia(){ 

 
      FormInventarios.submit();
	  
  
} 
</script> 
</head>
<body>
<div id="space"><br></div>
<div id="container">
<div id="wb_Image2" style="position:absolute;left:1109px;top:64px;width:128px;height:128px;z-index:8;">
<a href="./Egresos2.php"><img src="images/img0101.png" id="Image2" alt=""></a></div>
<div id="wb_Form2" style="position:absolute;left:5px;top:64px;width:1090px;height:208px;z-index:9;">
<form name="FrmAgregaCompras" method="post" action="CompraProductos.php" enctype="multipart/form-data" target="_self" id="Form2">
<input type="hidden" name="CmbCuentaDestino" value="1435">
<div id="Html8" style="position:absolute;left:13px;top:45px;width:1060px;height:144px;z-index:3">
<?php
$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

print('<br>Fecha: <input type="date" name="TxtFecha" step="1" min="2010-01-01" max="2200-12-31" value='.$fechaActual.'>');

print('
 Numero de Factura: <input type="text" name="TxtNumFactura" value="" placeholder="Digite el numero de factura"> 
 Forma de Pago:<select name="CmbFormaPago" size="1" id="Combobox2">
<option selected value="Contado">Contado</option>
<option value="Programado">Credito</option>
</select>');
print(' <input type="date" name="TxtFechaProg" step="1" min="2010-01-01" max="2200-12-31" value='.$fechaActual.'><br><br>');

print(' Subtotal: <input type="number" name="TxtSubtotal" id="TxtSubtotal" placeholder="Subtotal">');
print(' IVA: <input type="number" name="TxtIVA" id="TxtIVA" placeholder="IVA">');
print(' Total: <input type="number" name="TxtTotal" id="TxtTotal" placeholder="Total"><br><br>');

print(' Proveedor: <input list="Proveedores" name="CmbProveedores" value="Seleccione un Proveedor">
<datalist id="Proveedores">');

$reg = mysql_query("SELECT * FROM `proveedores` WHERE `Compra_Mercancias`='1' ",$con) or die("La consulta a cuentasfrecuentes es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      print('<option value="'.$datos["RazonSocial"].' '.$datos["Num_Identificacion"].';'.$datos["idProveedores"].'">');
   }

}



echo '</datalist>';

print(" Cuenta Origen: <select name=CmbCuentaOrigen size=1 id=CmbCuentaOrigen>
	<option value=NO>Seleccione la Cuenta Origen</option>");
	
	
$reg = mysql_query("SELECT * FROM `cuentasfrecuentes` WHERE `ClaseCuenta`='ACTIVOS' ",$con) or die("La consulta a cuentasfrecuentes es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      echo "<option value= $datos[CuentaPUC]>$datos[Nombre]</option>";
   }

}

print("</select>");



print('<input type="submit" name="AgregarCompra" value="Agregar Compra" onclick="envia2(); return false;" > ');
?></div>
<div id="wb_Text4" style="position:absolute;left:415px;top:13px;width:96px;height:16px;text-align:center;z-index:4;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Agregar:</em></strong></span></div>
<select name="CmbTipoCompra" size="1" id="Combobox1" style="position:absolute;left:511px;top:12px;width:168px;height:20px;z-index:5;">
<option selected value="FACTURA">FACTURA</option>
<option value="REMISION">REMISION</option>
</select>
</form>
</div>
<iframe name="InlineFrame1" id="InlineFrame1" style="position:absolute;left:0px;top:341px;width:1166px;height:1125px;z-index:10;" src="" frameborder="0"></iframe>
<div id="wb_Form1" style="position:absolute;left:385px;top:272px;width:396px;height:61px;z-index:11;">
<form name="FormInventarios" method="post" action="FormatoFact.php" enctype="multipart/form-data" target="InlineFrame1" id="Form1">
<div id="Html2" style="position:absolute;left:171px;top:15px;width:213px;height:29px;z-index:6">
<?php
//include("conexion.php");
$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
		 				 mysql_select_db($db,$con) or die("la base de datos no abre");
$r = mysql_query("SELECT * FROM compras_activas WHERE Usuarios_idUsuarios='$_SESSION[idUser]'",$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
echo "<select name=CbComprasActivas size=1 onchange='envia();return false;' style='position:absolute;'>";
echo "<option value=';NO;NO;NO'>Seleccione la venta</option>";

if(mysql_num_rows($r)){//Si existen resultados

   while($compras=mysql_fetch_array($r)){
      echo "<option value= '$compras[idComprasActivas]'>$compras[Tipo] No. $compras[Factura]  $compras[NombrePro]</option>";
   }

}


echo "</select>";

?></div>
<div id="wb_Text8" style="position:absolute;left:0px;top:21px;width:171px;height:16px;z-index:7;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Seleccione una compra</em></strong></span></div>
</form>
</div>
<div id="wb_Image3" style="position:absolute;left:1109px;top:192px;width:141px;height:141px;z-index:12;">
<a href="./CompraProductos.php"><img src="images/actualizar.png" id="Image3" alt=""></a></div>
</div>
<div id="Layer1" style="position:absolute;text-align:left;left:0px;top:0px;width:100%;height:64px;z-index:13;">
<div id="Html1" style="position:absolute;left:5px;top:17px;width:622px;height:33px;z-index:0">
<?php

$usuario =$_SESSION['username'];
$nombre =$_SESSION['nombre'];
$apellido =$_SESSION['apellido'];
$tipo =$_SESSION['tipouser'];
echo "<em>Sesion iniciada en SoftConTech por: $nombre $apellido</em>";			
?></div>
<div id="wb_JavaScript1" style="position:absolute;left:843px;top:22px;width:191px;height:28px;z-index:1;">
<div style="color:#000000;font-size:10px;font-family:Arial;font-weight:normal;font-style:normal;text-align:left;text-decoration:none" id="copyrightnotice"></div>
<script type="text/javascript">
   var now = new Date();
   var startYear = "2006";
   var text =  "Copyright &copy; ";
   if (startYear != '')
   {
      text = text + startYear + "-";
   }
   text = text + now.getFullYear() + ", Techno Soluciones. All rights reserved. info@technosoluciones.com";
   var copyrightnotice = document.getElementById('copyrightnotice');
   copyrightnotice.innerHTML = text;
</script>


</div>
<div id="wb_Image1" style="position:absolute;left:1065px;top:0px;width:125px;height:50px;z-index:2;">
<a href="http://www.technosoluciones.com" target="_blank"><img src="images/header-logo.png" id="Image1" alt=""></a></div>
</div>
</body>
</html>