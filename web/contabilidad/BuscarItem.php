<?php
session_start();
   if(!isset($_SESSION["username"])){
   header("Location: index.php");
}
   $tipo = $_SESSION['tipouser'];
  
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
#Layer3
{
   background-color: #FFFFFF;
}
#Layer1
{
   background-color: transparent;
   background-image: url(images/BuscarItem_Layer1_bkgrnd.png);
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
#Layer2
{
   background-color: transparent;
   background-image: url(images/BuscarItem_Layer2_bkgrnd.png);
   background-repeat: repeat;
   background-position: left top;
}
#Image2
{
   border: 0px #000000 solid;
   -moz-box-shadow: 4px 4px 10px #000000;
   -webkit-box-shadow: 4px 4px 10px #000000;
   box-shadow: 4px 4px 10px #000000;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
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
#wb_CssMenu1 ul ul a, #wb_CssMenu1 ul :hover ul a, #wb_CssMenu1 ul :hover ul :hover ul a
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
#wb_CssMenu1 ul :hover ul .firstitem a, #wb_CssMenu1 ul :hover ul :hover ul .firstitem a
{
   margin-top: 0px;
}
#wb_CssMenu1 ul ul :hover a, #wb_CssMenu1 ul ul a:hover, #wb_CssMenu1 ul ul :hover ul :hover a, #wb_CssMenu1 ul ul :hover ul a:hover, #wb_CssMenu1 ul ul :hover ul :hover ul :hover a, #wb_CssMenu1 ul ul :hover ul :hover ul a:hover
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
#wb_CssMenu1 ul ul a.withsubmenu, #wb_CssMenu1 ul :hover ul a.withsubmenu, #wb_CssMenu1 ul :hover ul :hover ul a.withsubmenu
{
   width: 88px;
   padding: 7px 5px 6px 5px;
   background: -moz-linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   background: -webkit-linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   background: -o-linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   background: -ms-linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   background: linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
}
#wb_CssMenu1 ul ul :hover a.withsubmenu, #wb_CssMenu1 ul ul a.withsubmenu:hover, #wb_CssMenu1 ul ul :hover ul :hover a.withsubmenu, #wb_CssMenu1 ul ul a.withsubmenu:hover a.withsubmenu:hover
{
   background: -moz-linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   background: -webkit-linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   background: -o-linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   background: -ms-linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   background: linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
}
#wb_CssMenu1 ul :hover ul ul, #wb_CssMenu1 ul :hover ul :hover ul ul
{
   position: absolute;
   left: -9999px;
   top: -9999px;
}
#wb_CssMenu1 ul :hover ul :hover ul, #wb_CssMenu1 ul :hover ul :hover ul :hover ul
{
   left: 100px;
   top: 0px;
}
#wb_CssMenu1 ul :hover ul .firstitem:hover ul, #wb_CssMenu1 ul :hover ul :hover ul .firstitem:hover ul
{
   top: 0px;
}
#wb_CssMenu1 br
{
   clear: both;
   font-size: 1px;
   height: 0;
   line-height: 0;
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
   text-align: center;
}
#wb_Text10 div
{
   text-align: center;
}
#InlineFrame1
{
   border: 0px #C0C0C0 solid;
}
</style>
<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.mouse.min.js"></script>
<script type="text/javascript" src="jquery.ui.sortable.min.js"></script>
<script type="text/javascript" src="jquery.ui.tabs.min.js"></script>
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
<div id="Layer3" style="position:absolute;overflow:auto;text-align:left;left:3px;top:2px;width:63%;height:76%;z-index:11;">
</div>
<div id="Layer1" style="position:absolute;text-align:left;left:1px;top:0px;width:100%;height:64px;z-index:12;">
<div id="Html1" style="position:absolute;left:4px;top:15px;width:608px;height:33px;z-index:0">
<?php

$usuario =$_SESSION['username'];
$nombre =$_SESSION['nombre'];
$apellido =$_SESSION['apellido'];
$tipo =$_SESSION['tipouser'];
echo "<em>Sesion iniciada en SoftConTech por: $nombre $apellido</em>";			
?></div>
<div id="wb_JavaScript1" style="position:absolute;left:652px;top:15px;width:191px;height:28px;z-index:1;">
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
<div id="wb_Image1" style="position:absolute;left:1316px;top:2px;width:125px;height:50px;z-index:2;">
<a href="http://www.technosoluciones.com" target="_blank"><img src="images/header-logo.png" id="Image1" alt=""></a></div>
</div>
<div id="Layer2" style="position:absolute;overflow:auto;text-align:right;left:0%;top:65px;width:159px;height:95%;z-index:13;">
<div id="Layer2_Container" style="width:159px;position:relative;margin-left:auto;margin-right:0;text-align:left;">
<div id="wb_Image2" style="position:absolute;left:14px;top:10px;width:115px;height:62px;z-index:3;">
<img src="images/tslogo.png" id="Image2" alt=""></div>
<div id="wb_CssMenu1" style="position:absolute;left:4px;top:90px;width:138px;height:455px;z-index:4;">
<ul>
<li class="firstmain"><a href="./Menu.php" target="_self">Menu</a>
</li>
<li><a href="./Administrar.php" target="_self">Administrar</a>
</li>
<li><a class="withsubmenu" href="./Ventas.php" target="_self">Ventas</a>

<ul>
<li class="firstitem"><a href="./Vender.php" target="_self">Locales</a>
</li>
<li><a href="./Cotizar.php" target="_self">Cotizar</a>
</li>
<li><a href="./Devoluciones.php" target="_self">Devoluciones</a>
</li>
<li><a href="./ReporteVentas.php" target="_self">Reportes</a>
</li>
<li class="lastitem"><a class="active" href="./BuscarItem.php" target="_self">Buscar&nbsp;Item</a>
</li>
</ul>
</li>
<li><a href="./Facturar.php" target="_self">Facturar</a>
</li>
<li><a href="./Cartera.php" target="_self">Cartera</a>
</li>
<li><a class="withsubmenu" href="./Ingresos.php" target="_self">Ingresos</a>

<ul>
<li class="firstitem lastitem"><a href="./Rendimientos.php" target="_self">Rendimientos</a>
</li>
</ul>
</li>
<li><a class="withsubmenu" href="./Egresos2.php" target="_self">Egresos</a>

<ul>
<li class="firstitem"><a href="./Arriendos.php" target="_self">Arriendos</a>
</li>
<li><a href="./Servicios.php" target="_self">Servicios</a>
</li>
<li><a href="./GastosVarios.php" target="_self">GastosVarios</a>
</li>
<li><a href="./PagarBancos.php" target="_self">Bancos</a>
</li>
<li><a href="./CompraMercancias.php" target="_self">CompraEquipos</a>
</li>
<li><a href="./CompraProductos.php" target="_self">CompraProductos</a>
</li>
<li><a href="./Conciliaciones.php" target="_self">Financieros</a>
</li>
<li><a href="./Contratistas.php" target="_self">Servicios</a>
</li>
<li class="lastitem"><a class="withsubmenu" href="./PagaImpuestos.php" target="_self">Impuestos</a>

<ul>
<li class="firstitem"><a href="./PagaCREE.php" target="_self">CREE</a>
</li>
<li><a href="./PagarIVA.php" target="_self">IVA</a>
</li>
<li class="lastitem"><a href="./PagarICA.php" target="_self">ICA</a>
</li>
</ul>
</li>
</ul>
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
</div>
</div>
<div id="jQueryTabs1" style="position:absolute;left:160px;top:64px;width:1357px;height:1212px;z-index:14;">
<ul>
<li><a href="#jquerytabs1-page-0"><span>Buscar Item</span></a></li>
</ul>
<div style="height:1172px;overflow:auto;padding:0;" id="jquerytabs1-page-0">
<div id="wb_Form1" style="position:absolute;left:19px;top:53px;width:1318px;height:96px;z-index:7;">
<form name="FormInventarios" method="post" action="VerFacturasItem.php" enctype="multipart/form-data" target="InlineFrame1" id="Form1">
<input type="text" id="Editbox5" onchange="VerInv() ;return true;return false;" style="position:absolute;left:445px;top:44px;width:243px;height:30px;line-height:30px;z-index:5;" name="TxtBuscarFactura" value="" placeholder="Buscar">
<div id="wb_Text10" style="position:absolute;left:445px;top:6px;width:221px;height:32px;text-align:center;z-index:6;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Digite un item o dato asociado a la factura</em></strong></span></div>
</form>
</div>
<iframe name="InlineFrame1" id="InlineFrame1" style="position:absolute;left:12px;top:160px;width:1336px;height:990px;z-index:8;" src="" frameborder="0"></iframe>
</div>
</div>
</body>
</html>