<?php
session_start();
   if(!isset($_SESSION["username"]))
      header("Location: index.php");
   		
include("conexion.php");
$fecha=date("Y-m-d");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>SoftConTech</title>
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
#Image23
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
#Layer2
{
   background-color: #F5F5F5;
}
#wb_CssMenu1
{
   border: 0px #C0C0C0 solid;
   background-color: transparent;
}
#wb_CssMenu1 ul
{
   list-style-type: none;
   margin: 0;
   padding: 0;
   width: 138px;
}
#wb_CssMenu1 li
{
   float: left;
   margin: 0;
   padding: 0px 0px 4px 0px;
   width: 138px;
}
#wb_CssMenu1 a
{
   display: block;
   color: #FFFFFF;
   border: 1px #C0C0C0 solid;
   background-color: #48494A;
   background: -moz-linear-gradient(315deg,#000104 0%,#02070B 49%,#33373D 49%,#757A7C 92%,#A0A1A3 95%,#48494A 100%);
   background: -webkit-linear-gradient(315deg,#000104 0%,#02070B 49%,#33373D 49%,#757A7C 92%,#A0A1A3 95%,#48494A 100%);
   background: -o-linear-gradient(315deg,#000104 0%,#02070B 49%,#33373D 49%,#757A7C 92%,#A0A1A3 95%,#48494A 100%);
   background: -ms-linear-gradient(315deg,#000104 0%,#02070B 49%,#33373D 49%,#757A7C 92%,#A0A1A3 95%,#48494A 100%);
   background: linear-gradient(315deg,#000104 0%,#02070B 49%,#33373D 49%,#757A7C 92%,#A0A1A3 95%,#48494A 100%);
   font-family: "Trebuchet MS";
   font-weight: normal;
   font-size: 16px;
   font-style: normal;
   text-decoration: none;
   width: 126px;
   height: 26px;
   line-height: 26px;
   padding: 0px 5px 0px 5px;
   vertical-align: middle;
   text-align: center;
}
#wb_CssMenu1 li:hover a, #wb_CssMenu1 a:hover, #wb_CssMenu1 .active
{
   color: #FFFFFF;
   background-color: #000183;
   background: -moz-linear-gradient(315deg,#0046FE 0%,#000183 16%,#0046FE 30%,#000183 43%,#0046FE 58%,#000183 72%,#0046FE 86%,#000183 100%);
   background: -webkit-linear-gradient(315deg,#0046FE 0%,#000183 16%,#0046FE 30%,#000183 43%,#0046FE 58%,#000183 72%,#0046FE 86%,#000183 100%);
   background: -o-linear-gradient(315deg,#0046FE 0%,#000183 16%,#0046FE 30%,#000183 43%,#0046FE 58%,#000183 72%,#0046FE 86%,#000183 100%);
   background: -ms-linear-gradient(315deg,#0046FE 0%,#000183 16%,#0046FE 30%,#000183 43%,#0046FE 58%,#000183 72%,#0046FE 86%,#000183 100%);
   background: linear-gradient(315deg,#0046FE 0%,#000183 16%,#0046FE 30%,#000183 43%,#0046FE 58%,#000183 72%,#0046FE 86%,#000183 100%);
   border: 1px #C0C0C0 solid;
}
#wb_CssMenu1 .firstmain a
{
   margin-top: 0px;
}
#wb_CssMenu1 li.lastmain
{
   padding-bottom: 0px;
}
#wb_CssMenu1 li:hover, #wb_CssMenu1 li a:hover
{
   position: relative;
}
#wb_CssMenu1 a.withsubmenu
{
   padding: 0 5px 0 5px;
   width: 126px;
}
#wb_CssMenu1 li:hover a.withsubmenu, #wb_CssMenu1 a.withsubmenu:hover
{
}
#wb_CssMenu1 ul ul
{
   position: absolute;
   left: -9999px;
   top: -9999px;
   width: 100px;
   height: auto;
   border: none;
   background-color: transparent;
}
#wb_CssMenu1 ul :hover ul
{
   left: 138px;
   top: 0px;
   padding-top: 0px;
}
#wb_CssMenu1 .firstmain:hover ul
{
   top: 0px;
   padding-top: 0px;
}
#wb_CssMenu1 li li
{
   width: 100px;
   padding: 0 0px 0px 0px;
   border: 0px #C0C0C0 solid;
   border-width: 0 0px;
}
#wb_CssMenu1 li li.firstitem
{
   border-top: 0px #C0C0C0 solid;
}
#wb_CssMenu1 li li.lastitem
{
   border-bottom: 0px #C0C0C0 solid;
}
#wb_CssMenu1 ul ul a, #wb_CssMenu1 ul :hover ul a
{
   float: none;
   margin: 0;
   width: 86px;
   height: auto;
   white-space: normal;
   padding: 7px 6px 6px 6px;
   background-color: #AEBFCA;
   background: -moz-linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   background: -webkit-linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   background: -o-linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   background: -ms-linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   background: linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   border: 1px #C0C0C0 solid;
   color: #FFFFFF;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   font-style: normal;
   line-height: 13px;
   text-align: left;
   text-decoration: none;
}
#wb_CssMenu1 ul :hover ul .firstitem a
{
   margin-top: 0px;
}
#wb_CssMenu1 ul ul :hover a, #wb_CssMenu1 ul ul a:hover, #wb_CssMenu1 ul ul :hover ul :hover a, #wb_CssMenu1 ul ul :hover ul a:hover
{
   background-color: #F85032;
   background: -moz-linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   background: -webkit-linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   background: -o-linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   background: -ms-linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   background: linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   border: 1px #C0C0C0 solid;
   color: #FFFFFF;
}
#wb_CssMenu1 br
{
   clear: both;
   font-size: 1px;
   height: 0;
   line-height: 0;
}
#Layer1
{
   background-color: transparent;
   background-image: url(images/Facturar_Layer1_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
}
#Image11
{
   border: 0px #FFFFFF outset;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
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
#wb_Form2
{
   background-color: transparent;
   border: 0px #000000 solid;
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
#Button1
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/Facturar_Button1_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color: #FFFFFF;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
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
#InlineFrame4
{
   border: 1px #D3D3D3 solid;
}
#wb_Form1
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#Editbox1
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
#Button2
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/Facturar_Button2_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color: #FFFFFF;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
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
#InlineFrame1
{
   border: 1px #D3D3D3 solid;
}
#wb_Text2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: justify;
}
#wb_Text2 div
{
   text-align: justify;
}
#Image15
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image15:hover
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
#wb_Form3
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#Editbox2
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
#TextArea1
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   resize: none;
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
#Button3
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/Facturar_Button3_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color: #FFFFFF;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
}
#InlineFrame2
{
   border: 1px #D3D3D3 solid;
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
</style>
<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.mouse.min.js"></script>
<script type="text/javascript" src="jquery.ui.sortable.min.js"></script>
<script type="text/javascript" src="jquery.ui.tabs.min.js"></script>
<script type="text/javascript">
function ValidateFrmAnular(theForm)
{
   var regexp;
   if (theForm.Editbox2.value == "")
   {
      alert("Por favor escriba un numero valido, sin espacios.");
      theForm.Editbox2.focus();
      return false;
   }
   if (theForm.Editbox2.value.length < 1)
   {
      alert("Por favor escriba un numero valido, sin espacios.");
      theForm.Editbox2.focus();
      return false;
   }
   if (theForm.TextArea1.value == "")
   {
      alert("Debe escribir las observaciones");
      theForm.TextArea1.focus();
      return false;
   }
   if (theForm.TextArea1.value.length < 3)
   {
      alert("Debe escribir las observaciones");
      theForm.TextArea1.focus();
      return false;
   }
   return true;
}
</script>
<script type="text/javascript">
$(document).ready(function()
{
   var jQueryTabs1Opts =
   {
      show: false,
      event: 'click',
      collapsible: true
   };
   $("#jQueryTabs1").tabs(jQueryTabs1Opts).find(".ui-tabs-nav").sortable();
});
</script>
<script language="JavaScript"> 
function pregunta(){ 
    if (confirm('¿Estas seguro que deseas ingresar el empleado?')){ 
       document.FormSubirHoja.submit() 
      
    } 
} 
</script> 
</head>
<body>
<div id="Layer2" style="position:absolute;text-align:right;left:0px;top:0px;width:159px;height:100%;z-index:41;">
<div id="Layer2_Container" style="width:159px;position:relative;margin-left:auto;margin-right:0;text-align:left;">
<div id="wb_CssMenu1" style="position:absolute;left:6px;top:189px;width:138px;height:455px;z-index:0;">
<ul>
<li class="firstmain"><a href="./Menu.php" target="_self">Menu</a>
</li>
<li><a href="./Administrar.php" target="_self">Administrar</a>
</li>
<li><a class="active" href="./Facturar.php" target="_self">Facturar</a>
</li>
<li><a href="./Cartera.php" target="_self">Cartera</a>
</li>
<li><a class="withsubmenu" href="./Ingresos.php" target="_self">Ingresos</a>

<ul>
<li class="firstitem lastitem"><a href="./Rendimientos.php" target="_self">Rendimientos</a>
</li>
</ul>
</li>
<li><a href="./Egresos2.php" target="_self">Egresos</a>
</li>
<li><a href="./PagarCuentas.php" target="_self">CuentasXPagar</a>
</li>
<li><a class="withsubmenu" href="./Inventarios2.php" target="_self">Inventarios</a>

<ul>
<li class="firstitem"><a href="./Baja.php" target="_self">Bajas</a>
</li>
<li><a href="./SincPrecios.php" target="_self">Sincronizar</a>
</li>
<li><a href="./PrintBarras.php" target="_self">Barras</a>
</li>
<li class="lastitem"><a href="./kits.php" target="_self">Bajas</a>
</li>
</ul>
</li>
<li><a href="./Informes.php" target="_self">Informes</a>
</li>
</ul>
<br>
</div>
<div id="wb_Image11" style="position:absolute;left:24px;top:91px;width:120px;height:48px;z-index:1;">
<a href="http://www.technosoluciones.com/" target="_blank"><img src="images/img0037.png" id="Image11" alt=""></a></div>
</div>
</div>
<div id="Layer1" style="position:absolute;text-align:left;left:0px;top:0px;width:115%;height:64px;z-index:42;">
<div id="wb_Image23" style="position:absolute;left:981px;top:1px;width:125px;height:50px;z-index:2;">
<a href="http://www.technosoluciones.com" target="_blank"><img src="images/header-logo.png" id="Image23" alt=""></a></div>
<div id="Html2" style="position:absolute;left:6px;top:18px;width:627px;height:33px;z-index:3">
<?php

$usuario =$_SESSION['username'];
$nombre =$_SESSION['nombre'];
$apellido =$_SESSION['apellido'];
$tipo =$_SESSION['tipouser'];
echo "<em>Bienvenid@ a SoftConTech $nombre $apellido, qué deseas hacer?</em>";			
?></div>
<div id="wb_JavaScript2" style="position:absolute;left:654px;top:22px;width:191px;height:28px;z-index:4;">
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
</div>
<div id="jQueryTabs1" style="position:absolute;left:159px;top:64px;width:962px;z-index:43;">
<ul>
<li><a href="#jquerytabs1-page-0"><span>Edicion de Facturas</span></a></li>
<li><a href="#jquerytabs1-page-1"><span>Instructivo</span></a></li>
<li><a href="#jquerytabs1-page-2"><span>Asociar</span></a></li>
<li><a href="#jquerytabs1-page-3"><span>Buscar Factura</span></a></li>
<li><a href="#jquerytabs1-page-4"><span>Anular Factura</span></a></li>
</ul>
<div style="height:629px;overflow:auto;padding:0;" id="jquerytabs1-page-0">
<div id="wb_Image15" style="position:absolute;left:207px;top:154px;width:378px;height:207px;z-index:5;">
<a href="admin/facturas.php" target="_blank"><img src="images/img0050.png" id="Image15" alt=""></a></div>
<div id="wb_Text3" style="position:absolute;left:326px;top:67px;width:161px;height:16px;z-index:6;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Historial de Fácturas</em></strong></span></div>
</div>
<div style="height:629px;overflow:auto;padding:0;" id="jquerytabs1-page-1">
<div id="wb_Text2" style="position:absolute;left:53px;top:79px;width:757px;height:144px;text-align:justify;z-index:7;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Para asociar una cotizacion escriba el numero de la cotizacion y guardela.<br><br>Para asociar varias cotizaciones debe escribir el numero de cada cotizacion separada por un &quot;;&quot;<br><br>Ejemplo: <br><br>Se quieren asociar tres cotizaciones a una factura, las cotizaciones 10, 20 y 22, Usted deberá escribir en la pestaña &quot;Asociar una Cotizacion&quot;: 10;20;22&nbsp;&nbsp;&nbsp;&nbsp; <br>de esta forma se realizará una factura para las tres primeras cotizaciones</em></strong></span></div>
</div>
<div style="height:629px;overflow:auto;padding:0;" id="jquerytabs1-page-2">
<div id="wb_Form2" style="position:absolute;left:264px;top:49px;width:422px;height:65px;z-index:11;">
<form name="Form3" method="post" action="BuscarCotiFact.php" enctype="multipart/form-data" target="FrameBuscarCoti" id="Form2">
<input type="text" id="Editbox7" style="position:absolute;left:13px;top:30px;width:267px;height:19px;line-height:19px;z-index:8;" name="TxtBusqueda" value="" placeholder="Digite el numero de la cotizaci&#243;n">
<input type="submit" id="Button1" name="Actualizar Informacion" value="Buscar" style="position:absolute;left:292px;top:27px;width:118px;height:25px;z-index:9;">
<div id="wb_Text11" style="position:absolute;left:33px;top:4px;width:346px;height:16px;z-index:10;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Digite la o las cotizaciones que desea asociar</em></strong></span></div>
</form>
</div>
<iframe name="FrameBuscarCoti" id="InlineFrame4" style="position:absolute;left:10px;top:114px;width:935px;height:540px;z-index:12;" src="http://" frameborder="0"></iframe>
</div>
<div style="height:629px;overflow:auto;padding:0;" id="jquerytabs1-page-3">
<div id="wb_Form1" style="position:absolute;left:273px;top:51px;width:422px;height:65px;z-index:16;">
<form name="Form3" method="post" action="BuscarFact.php" enctype="multipart/form-data" target="FrameBuscarFact" id="Form1">
<input type="text" id="Editbox1" style="position:absolute;left:13px;top:30px;width:267px;height:19px;line-height:19px;z-index:13;" name="TxtBusqueda" value="" placeholder="Digite alg&#250;n dato asociado a la factura">
<input type="submit" id="Button2" name="Actualizar Informacion" value="Buscar" style="position:absolute;left:292px;top:27px;width:118px;height:25px;z-index:14;">
<div id="wb_Text1" style="position:absolute;left:35px;top:5px;width:235px;height:16px;z-index:15;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Digite el numero de la factura</em></strong></span></div>
</form>
</div>
<iframe name="FrameBuscarFact" id="InlineFrame1" style="position:absolute;left:13px;top:116px;width:932px;height:387px;z-index:17;" src="http://" frameborder="0"></iframe>
</div>
<div style="height:629px;overflow:auto;padding:0;" id="jquerytabs1-page-4">
<div id="wb_Form3" style="position:absolute;left:316px;top:92px;width:339px;height:226px;z-index:25;">
<form name="FrmAnular" method="post" action="AnularFact.php" enctype="multipart/form-data" target="FrameAnularFactura" id="Form3" onsubmit="return ValidateFrmAnular(this)">
<input type="text" id="Editbox2" style="position:absolute;left:36px;top:33px;width:68px;height:22px;line-height:22px;z-index:18;" name="TxtFactAnular" value="" placeholder="Factura">
<div id="Html4" style="position:absolute;left:198px;top:33px;width:113px;height:24px;z-index:19">
<?php

print('<input type="date" name="TxtFechaAnul" step="1" min="2010-01-01" max="2200-12-31" value='.$fecha.'>');

?></div>
<div id="wb_Text5" style="position:absolute;left:18px;top:9px;width:134px;height:16px;z-index:20;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Factura a Anular</em></strong></span></div>
<div id="wb_Text6" style="position:absolute;left:189px;top:9px;width:134px;height:16px;z-index:21;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Fecha Anulación</em></strong></span></div>
<textarea name="TxtObservacionesFact" id="TextArea1" style="position:absolute;left:36px;top:100px;width:273px;height:75px;z-index:22;" rows="3" cols="42" placeholder="Escriba el por qu&#233; anula la factura"></textarea>
<div id="wb_Text7" style="position:absolute;left:102px;top:77px;width:134px;height:16px;z-index:23;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Por qué se anula?</em></strong></span></div>
<input type="submit" id="Button3" name="BtnAnular" value="Anular" style="position:absolute;left:34px;top:184px;width:277px;height:25px;z-index:24;">
</form>
</div>
<iframe name="FrameAnularFactura" id="InlineFrame2" style="position:absolute;left:13px;top:331px;width:932px;height:225px;z-index:26;" src="http://" frameborder="0"></iframe>
<div id="wb_Text4" style="position:absolute;left:402px;top:61px;width:179px;height:16px;z-index:27;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Anulación de Facturas</em></strong></span></div>
</div>
</div>
</body>
</html>