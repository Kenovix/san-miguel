<?php
session_start();
   if(!isset($_SESSION["username"])){
   header("Location: index.php");
}
  $tipo = $_SESSION['tipouser'];
   if($tipo<>"administrador"){
   header("Location: Menu.php");   
	  
}


include("conexion.php");
	
$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

$fecha=date("Y-m-d");
	
$key=$_POST["TxtCodigo"];

$sql = "SELECT Usuarios_idUsuarios FROM usuarios_keys WHERE KeyUsuario='$key'";
$r = mysql_query($sql,$con) or die("Error al leer la tabla KeyUsuario.".mysql_error());
$idUsuarioKey=mysql_fetch_array($r);
$idUsuarioKey=$idUsuarioKey["Usuarios_idUsuarios"];
if($idUsuarioKey<1){
	
	exit("<script language=JavaScript> alert('Clave incorrecta, no esta autorizado a ingresar') </script><a href='InformesO.php'>Volver</a>");
	
}






?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Informes</title>
<style type="text/css">
html, body
{
   height: 100%;
}
div#space
{
   width: 1px;
   height: 50%;
   margin-bottom: -256px;
   float:left
}
div#container
{
   width: 813px;
   height: 512px;
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
#Layer1
{
   background-color: transparent;
}
#wb_Form2
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#jQueryDatePicker3
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/porcen_jQueryDatePicker3_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color :#FFFFFF;
   font-family: "Bookman Old Style";
   font-weight: bold;
   font-style: italic;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
.ui-datepicker
{
   font-family: "Bookman Old Style";
   font-weight: normal;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
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
#Line2
{
   color: #0000FF;
   background-color: #0000FF;
   border-width: 0;
   margin: 0;
   padding: 0;
   -moz-box-shadow: 6px 6px 2px #000000;
   -webkit-box-shadow: 6px 6px 2px #000000;
   box-shadow: 6px 6px 2px #000000;
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
#jQueryDatePicker4
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/porcen_jQueryDatePicker4_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color :#FFFFFF;
   font-family: "Bookman Old Style";
   font-weight: bold;
   font-style: italic;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
.ui-datepicker
{
   font-family: "Bookman Old Style";
   font-weight: normal;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
#Button2
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/porcen_Button2_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color: #FFFFFF;
   font-family: "Bookman Old Style";
   font-weight: bold;
   font-style: italic;
   font-size: 13px;
}
#Image1
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_Text1 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text1 div
{
   text-align: left;
}
#Editbox1
{
   border: 1px #A9A9A9 solid;
   -moz-border-radius: 4px;
   -webkit-border-radius: 4px;
   border-radius: 4px;
   background-color: transparent;
   background-image: url(images/porcen_Editbox1_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color :#FFFFFF;
   font-family: Arial;
   font-weight: bold;
   font-size: 20px;
   text-align: left;
   vertical-align: middle;
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
#Button1
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/porcen_Button1_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color: #FFFFFF;
   font-family: "Bookman Old Style";
   font-weight: bold;
   font-style: italic;
   font-size: 13px;
}
</style>
<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker-es.js"></script>
<script type="text/javascript">

function envia(){ 

if (confirm('¿Estas seguro que deseas aplicar este porcentaje?, esta operacion es irreversible')){ 
     
	  document.this.form.submit();
     
    } 
	 
}


</script>
<script type="text/javascript">
$(document).ready(function()
{
   var jQueryDatePicker3Opts =
   {
      dateFormat: 'yy-mm-dd',
      changeMonth: false,
      changeYear: false,
      showButtonPanel: false,
      showAnim: 'slideDown'
   };
   $("#jQueryDatePicker3").datepicker(jQueryDatePicker3Opts);
   $("#jQueryDatePicker3").datepicker("setDate", "new Date()");
   $("#jQueryDatePicker3").datepicker("option", $.datepicker.regional['es']);
   var jQueryDatePicker4Opts =
   {
      dateFormat: 'yy-mm-dd',
      changeMonth: false,
      changeYear: false,
      showButtonPanel: false,
      showAnim: 'slideDown'
   };
   $("#jQueryDatePicker4").datepicker(jQueryDatePicker4Opts);
   $("#jQueryDatePicker4").datepicker("setDate", "new Date()");
   $("#jQueryDatePicker4").datepicker("option", $.datepicker.regional['es']);
});
</script>
</head>
<body>
<div id="space"><br></div>
<div id="container">
</div>
<div id="Layer1" style="position:absolute;text-align:left;left:0px;top:0px;width:101%;height:100%;z-index:26;">
<div id="wb_Form2" style="position:absolute;left:16px;top:186px;width:772px;height:291px;z-index:12;">
<form name="FormPorcentaje" method="post" action="tcpdf/examples/imprimaporcentaje.php" enctype="multipart/form-data" target="_blank" id="Form2" >
<input type="text" id="jQueryDatePicker3" style="position:absolute;left:231px;top:92px;width:88px;height:18px;line-height:18px;z-index:0;" name="TxtFechaIni" value="2014-05-30">
<div id="wb_Text9" style="position:absolute;left:126px;top:94px;width:102px;height:16px;z-index:1;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Fecha Inicial</em></strong></span></div>
<div id="wb_Text10" style="position:absolute;left:217px;top:61px;width:323px;height:16px;z-index:2;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Seleccione el rango de fecha para el reporte</em></strong></span></div>
<hr id="Line2" style="position:absolute;left:95px;top:32px;width:566px;height:5px;z-index:3;">
<div id="wb_Text11" style="position:absolute;left:295px;top:8px;width:187px;height:16px;z-index:4;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Vista previa procentajes</em></strong></span></div>
<div id="wb_Text12" style="position:absolute;left:412px;top:95px;width:102px;height:16px;z-index:5;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Fecha Final</em></strong></span></div>
<input type="text" id="jQueryDatePicker4" style="position:absolute;left:514px;top:93px;width:88px;height:18px;line-height:18px;z-index:6;" name="TxtFechaFinal" value="2014-05-30">
<input type="submit" id="Button2" name="BtnVistaPrevia" value="Imprimir Vista Previa" style="position:absolute;left:12px;top:187px;width:744px;height:36px;z-index:7;">
<div id="wb_Text1" style="position:absolute;left:427px;top:137px;width:87px;height:16px;z-index:8;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Porcentaje</em></strong></span></div>
<input type="number" id="Editbox1" style="position:absolute;left:514px;top:132px;width:58px;height:26px;line-height:26px;z-index:9;" name="TxtProcentaje" value="100" min=5 max=100 required>
<div id="wb_Text2" style="position:absolute;left:582px;top:132px;width:30px;height:24px;z-index:10;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:20px;"><strong><em>%</em></strong></span></div>
<input type="submit" id="Button1" onclick="envia();return false;" name="BtnAplicarP" value="Aplicar" style="position:absolute;left:243px;top:236px;width:283px;height:35px;z-index:11;">
</form>
</div>
<div id="wb_Image1" style="position:absolute;left:337px;top:30px;width:126px;height:133px;z-index:13;">
<img src="images/img0064.png" id="Image1" alt=""></div>
</div>
</body>
</html>