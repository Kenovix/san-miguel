<?php
include("conexion.php");
session_start();
   if(!isset($_SESSION["username"]))
      header("Location: index.php");
   		
if(isset($_POST["AgregarVenta"])){
   
  $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
	mysql_select_db($db,$con) or die("la base de datos no abre");
	
	$reg=mysql_query("SELECT MAX(NumVenta) as NumVenta, MAX(NumFactura) as NumFactura, MAX(NumCotizacion) NumCotizacion FROM vestasactivas",$con) 
	or die("Problemas al consultar los datos de ventas activas".mysql_error());
	$reg=mysql_fetch_array($reg);

	
	
	
	
	$NumVenta=$reg["NumVenta"]+1;
	$NumFactura=$reg["NumFactura"]+1;
	$NumCotizacion=$reg["NumCotizacion"]+1;
	
	$sql="INSERT INTO `$db`.`vestasactivas` ( `Nombre`, `Usuario_idUsuario`, `NumVenta`, `NumFactura`, `NumCotizacion`,`Clientes_idClientes`) 
											VALUES ('Venta por: $_SESSION[nombre]', '$_SESSION[idUser]','$NumVenta', '$NumFactura','$NumCotizacion','1')";

	mysql_query($sql,$con) or die("Problemas al ingresar la nueva venta a la base de datos ".mysql_error());
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>SoftConTech</title>
<link href="technoIco.ico" rel="shortcut icon" type="image/x-icon">
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
</style>
<link href="cupertino/jquery.ui.all.css" rel="stylesheet" type="text/css">
<style type="text/css">
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
#jQueryTabs1
{
   padding: 4px 4px 4px 4px;
}
#jQueryTabs1 .ui-tabs-nav
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   padding: 4px 4px 0px 4px;
}
#jQueryTabs1 .ui-tabs-nav li
{
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   margin: 0px 2px -1px 0px;
}
#jQueryTabs1 .ui-tabs-nav li a
{
   padding: 8px 10px 8px 10px;
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
#Combobox3
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
}
#wb_Text9 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text9 div
{
   text-align: left;
}
#Editbox5
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: "Trebuchet MS";
   font-weight: normal;
   font-size: 19px;
   text-align: center;
   vertical-align: middle;
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
#InlineFrame1
{
   border: 0px #C0C0C0 solid;
}
#wb_Form2
{
   background-color: transparent;
   border: 0px #000000 solid;
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
#Image4
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_Text2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text2 div
{
   text-align: left;
}
#Image1
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_Text3 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text3 div
{
   text-align: left;
}
.ui-dialog
{
   padding: 4px 4px 4px 4px;
}
.ui-dialog .ui-dialog-title
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   font-style: normal;
   color: #222222;
}
.ui-dialog .ui-dialog-titlebar
{
   padding: 10px 10px 10px 30px;
}
.ui-dialog .ui-dialog-titlebar-close
{
   right: 10px;
}
#wb_Text4 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text4 div
{
   text-align: left;
}
#wb_Text5 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text5 div
{
   text-align: left;
}
#wb_Text6 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text6 div
{
   text-align: left;
}
#wb_Text7 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text7 div
{
   text-align: left;
}
#wb_Text11 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text11 div
{
   text-align: left;
}
#wb_Text12 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text12 div
{
   text-align: left;
}
#wb_Text13 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text13 div
{
   text-align: left;
}
#wb_Text14 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text14 div
{
   text-align: left;
}
#Image2
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image3
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image3:hover
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
.ui-dialog
{
   padding: 4px 4px 4px 4px;
}
.ui-dialog .ui-dialog-title
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   font-style: normal;
   color: #222222;
}
.ui-dialog .ui-dialog-titlebar
{
   padding: 10px 10px 10px 30px;
}
.ui-dialog .ui-dialog-titlebar-close
{
   right: 10px;
}
#InlineFrame2
{
   border: 1px #C0C0C0 solid;
}
#wb_Text15 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text15 div
{
   text-align: center;
}
#Image5
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
</style>
<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.mouse.min.js"></script>
<script type="text/javascript" src="jquery.ui.sortable.min.js"></script>
<script type="text/javascript" src="jquery.ui.tabs.min.js"></script>
<script type="text/javascript" src="jquery.ui.button.min.js"></script>
<script type="text/javascript" src="jquery.ui.draggable.min.js"></script>
<script type="text/javascript" src="jquery.ui.position.min.js"></script>
<script type="text/javascript" src="jquery.ui.resizable.min.js"></script>
<script type="text/javascript" src="jquery.ui.dialog.min.js"></script>
<script type="text/javascript" src="jquery.ui.effect.min.js"></script>
<script type="text/javascript" src="jquery.ui.effect-blind.min.js"></script>
<script type="text/javascript" src="jquery.ui.effect-explode.min.js"></script>
<script type="text/javascript" src="wwb10.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
   var jQueryTabs1Opts =
   {
      show: false,
      event: 'click',
      collapsible: false
   };
   $("#jQueryTabs1").tabs(jQueryTabs1Opts);
   var jQueryDialog1Opts =
   {
      width: 448,
      height: 304,
      position: { my: 'center', at: 'center', of: window },
      resizable: true,
      draggable: true,
      closeOnEscape: true,
      show: 'blind',
      hide: 'explode',
      autoOpen: false
   };
   $("#jQueryDialog1").dialog(jQueryDialog1Opts);
   var jQueryDialog2Opts =
   {
      width: 473,
      height: 531,
      position: { my: 'center', at: 'center', of: window },
      resizable: true,
      draggable: true,
      closeOnEscape: true,
      show: 'blind',
      hide: 'explode',
      autoOpen: false
   };
   $("#jQueryDialog2").dialog(jQueryDialog2Opts);
});
</script>
<script language="JavaScript"> 
function VerInv(){ 
    
      document.getElementById("Form1").submit(); 
      
   
} 
</script> 
</head>
<body>
<div id="jQueryTabs1" style="position:absolute;left:0px;top:0px;width:1357px;height:801px;z-index:45;">
<ul>
<li><a href="#jquerytabs1-page-0"><span>Ventas</span></a></li>
</ul>
<div style="height:761px;overflow:auto;padding:0;" id="jquerytabs1-page-0">
<div id="wb_Form1" style="position:absolute;left:284px;top:51px;width:747px;height:96px;z-index:17;">
<form name="FormInventarios" method="post" action="VerInventariosVender.php" enctype="multipart/form-data" target="InlineFrame1" id="Form1">
<div id="wb_Text8" style="position:absolute;left:7px;top:21px;width:155px;height:16px;z-index:0;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Seleccione una venta</em></strong></span></div>
<select name="Operacion" size="1" id="Combobox3" onchange="VerInv();return false;" style="position:absolute;left:179px;top:56px;width:184px;height:20px;z-index:1;">
<option value="VerVenta">Agregar Item</option>
<option selected value="VerPreVenta">Ver Esta Venta</option>
</select>
<div id="wb_Text9" style="position:absolute;left:79px;top:57px;width:86px;height:16px;z-index:2;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Operacion</em></strong></span></div>
<input type="text" id="Editbox5" onkeypress="VerInv() ;return true;return false;" style="position:absolute;left:445px;top:44px;width:243px;height:30px;line-height:30px;z-index:3;" name="TxtBuscar" value="" placeholder="Buscar">
<div id="wb_Text10" style="position:absolute;left:526px;top:17px;width:73px;height:16px;z-index:4;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Busqueda</em></strong></span></div>
<div id="Html1" style="position:absolute;left:178px;top:15px;width:213px;height:29px;z-index:5">
<?php
//include("conexion.php");
$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
		 				 mysql_select_db($db,$con) or die("la base de datos no abre");
$r = mysql_query("SELECT * FROM vestasactivas WHERE Usuario_idUsuario='$_SESSION[idUser]'",$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
echo "<select name=CbVentasActivas size=1 id=CbVentasActivas onchange='VerInv();return false;' style='position:absolute;'>";
echo "<option value=';NO;NO;NO'>Seleccione la venta</option>";

if(mysql_num_rows($r)){//Si existen resultados

   while($ventas=mysql_fetch_array($r)){
      echo "<option value= ';$ventas[idVestasActivas];$ventas[Nombre];$ventas[Usuario_idUsuario]'>$ventas[Nombre] No. $ventas[idVestasActivas]</option>";
   }

}


echo "</select>";

?></div>
</form>
</div>
<iframe name="InlineFrame1" id="InlineFrame1" style="position:absolute;left:12px;top:160px;width:1336px;height:643px;z-index:18;" src="" frameborder="0"></iframe>
<div id="wb_Form2" style="position:absolute;left:14px;top:46px;width:162px;height:116px;z-index:19;">
<form name="FormAgregaVenta" method="post" action="Vender.php" enctype="multipart/form-data" target="_self" id="Form2">
<div id="Html3" style="position:absolute;left:22px;top:34px;width:93px;height:70px;z-index:6">
<?php

print('<input type="hidden" name="AgregarVenta" value="'.$_SESSION['idUser'].'">
<input type="image" src="iconos/agregaVenta.png" name="BtnAgregarVenta" value="'.$_SESSION['idUser'].'">');

?></div>
<div id="wb_Text1" style="position:absolute;left:19px;top:5px;width:81px;height:32px;text-align:center;z-index:7;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Agregar Venta</em></strong></span></div>
</form>
</div>
<div id="wb_Image4" style="position:absolute;left:1297px;top:51px;width:51px;height:51px;z-index:20;">
<a href="admin/clientes.php" target="_blank"><img src="images/img0066.png" id="Image4" alt=""></a></div>
<div id="wb_Text2" style="position:absolute;left:1190px;top:67px;width:99px;height:16px;z-index:21;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Crear cliente</em></strong></span></div>
<div id="wb_Image1" style="position:absolute;left:1297px;top:102px;width:45px;height:45px;z-index:22;">
<a href="#" onclick="$('#jQueryDialog1').dialog('open');return false;"><img src="images/img0044.png" id="Image1" alt=""></a></div>
<div id="wb_Text3" style="position:absolute;left:1148px;top:117px;width:150px;height:16px;z-index:23;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Lista de Comandos</em></strong></span></div>
<div id="jQueryDialog1" style="z-index:24;" title="Lista de Comandos">
<div id="wb_Text4" style="position:absolute;left:20px;top:8px;width:329px;height:16px;z-index:8;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Ctrl+Q: Posicionarse en la caja de texto Pagar</em></strong></span></div>
<div id="wb_Text5" style="position:absolute;left:20px;top:35px;width:342px;height:16px;z-index:9;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Ctrl+E: Posicionarse para leer codigo de barras</em></strong></span></div>
<div id="wb_Text6" style="position:absolute;left:20px;top:62px;width:209px;height:16px;z-index:10;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Ctrl+S: Guardar la Venta</em></strong></span></div>
<div id="wb_Text7" style="position:absolute;left:20px;top:91px;width:272px;height:16px;z-index:11;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Asignar una venta a un cliente:</em></strong></span></div>
<div id="wb_Text11" style="position:absolute;left:20px;top:124px;width:359px;height:16px;z-index:12;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Click en el boton Asignar Cliente a esta Preventa</em></strong></span></div>
<div id="wb_Text12" style="position:absolute;left:20px;top:151px;width:359px;height:16px;z-index:13;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Buscar Cliente</em></strong></span></div>
<div id="wb_Text13" style="position:absolute;left:20px;top:176px;width:359px;height:16px;z-index:14;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Seleccionar Cliente</em></strong></span></div>
<div id="wb_Text14" style="position:absolute;left:20px;top:205px;width:359px;height:48px;z-index:15;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Si la venta es a credito debe seleccionar una opcion diferente a Contado en tipo de Venta, antes de guardar</em></strong></span></div>
</div>

<div id="jQueryDialog2" style="z-index:25;" title="Ingreso y Salida">
<iframe name="InlineFrame2" id="InlineFrame2" style="position:absolute;left:10px;top:15px;width:439px;height:461px;z-index:16;" src="HoraEntradaSalida.php" frameborder="0"></iframe>
</div>

<div id="wb_Text15" style="position:absolute;left:176px;top:46px;width:81px;height:48px;text-align:center;z-index:26;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Registre ingreso o salida</em></strong></span></div>
<div id="wb_Image5" style="position:absolute;left:185px;top:84px;width:69px;height:69px;z-index:27;">
<a href="admin/clientes.php" target="_blank" onclick="$('#jQueryDialog2').dialog('open');return false;"><img src="images/img0067.png" id="Image5" alt=""></a></div>
</div>
</div>
<div id="wb_Image2" style="position:absolute;left:635px;top:1px;width:127px;height:50px;z-index:46;">
<a href="www.technosoluciones.com" target="_blank"><img src="images/img0045.png" id="Image2" alt=""></a></div>
<div id="wb_Image3" style="position:absolute;left:1298px;top:5px;width:41px;height:41px;z-index:47;">
<a href="./Ventas.php"><img src="images/img0046.png" id="Image3" alt=""></a></div>
</body>
</html>