<?php
session_start();
   if(!isset($_SESSION["username"])){
   header("Location: index.php");
}
   $tipo = $_SESSION['tipouser'];
   if($tipo<>"administrador"){
   header("Location: Menu.php");   
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
#Layer2
{
   background-color: #F5F5F5;
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
#Image6
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
#Layer1
{
   background-color: transparent;
   background-image: url(images/Administrar_Layer1_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
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
#Image1
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image1:hover
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
#Image12
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image12:hover
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
#Image13
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image13:hover
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
#Image14
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image14:hover
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
#Image2
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
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
#Image11
{
   border: 0px #FFFFFF outset;
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
<div id="Layer2" style="position:absolute;text-align:right;left:0px;top:0px;width:159px;height:100%;z-index:19;">
<div id="Layer2_Container" style="width:159px;position:relative;margin-left:auto;margin-right:0;text-align:left;">
<div id="wb_CssMenu1" style="position:absolute;left:6px;top:174px;width:138px;height:455px;z-index:0;">
<ul>
<li class="firstmain"><a href="./Menu.php" target="_self">Menu</a>
</li>
<li><a class="active" href="./Administrar.php" target="_self">Administrar</a>
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
<div id="wb_Image11" style="position:absolute;left:16px;top:89px;width:120px;height:48px;z-index:1;">
<a href="http://www.technosoluciones.com/" target="_blank"><img src="images/img0019.png" id="Image11" alt=""></a></div>
</div>
</div>
<div id="jQueryTabs1" style="position:absolute;left:159px;top:64px;width:931px;z-index:20;">
<ul>
<li><a href="#jquerytabs1-page-0"><span>Finanzas</span></a></li>
<li><a href="#jquerytabs1-page-1"><span>Gestion de Colaboradores</span></a></li>
<li><a href="#jquerytabs1-page-2"><span>Impuestos y Retenciones</span></a></li>
</ul>
<div style="height:527px;overflow:auto;padding:0;" id="jquerytabs1-page-0">
<div id="wb_Image1" style="position:absolute;left:36px;top:92px;width:142px;height:91px;z-index:2;">
<a href="admin/librodiario.php" target="_blank"><img src="images/img0131.png" id="Image1" alt=""></a></div>
<div id="wb_Image12" style="position:absolute;left:266px;top:87px;width:140px;height:96px;z-index:3;">
<a href="admin/libromayorbalances.php" target="_blank"><img src="images/img0132.png" id="Image12" alt=""></a></div>
<div id="wb_Image13" style="position:absolute;left:490px;top:64px;width:119px;height:119px;z-index:4;">
<a href="admin/cuentas.php" target="_blank"><img src="images/img0133.png" id="Image13" alt=""></a></div>
<div id="wb_Image14" style="position:absolute;left:699px;top:64px;width:128px;height:128px;z-index:5;">
<a href="admin/cuentasfrecuentes.php" target="_blank"><img src="images/img0134.png" id="Image14" alt=""></a></div>
<div id="wb_Image15" style="position:absolute;left:311px;top:322px;width:211px;height:115px;z-index:6;">
<a href="admin/facturas.php" target="_blank"><img src="images/img0135.png" id="Image15" alt=""></a></div>
<div id="wb_Text4" style="position:absolute;left:52px;top:201px;width:103px;height:16px;z-index:7;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Libro Diario</em></strong></span></div>
<div id="wb_Text5" style="position:absolute;left:280px;top:201px;width:103px;height:16px;z-index:8;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Libro Mayor</em></strong></span></div>
<div id="wb_Text6" style="position:absolute;left:509px;top:201px;width:75px;height:16px;z-index:9;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Cuentas</em></strong></span></div>
<div id="wb_Text7" style="position:absolute;left:693px;top:201px;width:157px;height:16px;z-index:10;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Cuentas Frecuentes</em></strong></span></div>
<div id="wb_Text8" style="position:absolute;left:361px;top:453px;width:204px;height:16px;z-index:11;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Informe de Facturacion</em></strong></span></div>
</div>
<div style="height:527px;overflow:auto;padding:0;" id="jquerytabs1-page-1">
<div id="wb_Image2" style="position:absolute;left:266px;top:160px;width:243px;height:256px;z-index:12;">
<a href="admin/colaboradoresact.php"><img src="images/img0002.png" id="Image2" alt=""></a></div>
<div id="wb_Text9" style="position:absolute;left:256px;top:84px;width:276px;height:16px;z-index:13;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Click para gestion de Colaboradores</em></strong></span></div>
</div>
<div style="height:527px;overflow:auto;padding:0;" id="jquerytabs1-page-2">
<div id="wb_Image6" style="position:absolute;left:195px;top:138px;width:418px;height:335px;z-index:14;">
<a href="admin/impret.php"><img src="images/img0130.png" id="Image6" alt=""></a></div>
<div id="wb_Text3" style="position:absolute;left:237px;top:94px;width:376px;height:16px;z-index:15;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Click para Agregar o Modificar Retenciones</em></strong></span></div>
</div>
</div>
<div id="Layer1" style="position:absolute;text-align:left;left:0px;top:0px;width:100%;height:64px;z-index:21;">
<div id="wb_Image23" style="position:absolute;left:851px;top:8px;width:125px;height:50px;z-index:16;">
<a href="http://www.technosoluciones.com" target="_blank"><img src="images/header-logo.png" id="Image23" alt=""></a></div>
<div id="Html2" style="position:absolute;left:6px;top:18px;width:627px;height:33px;z-index:17">
<?php

$usuario =$_SESSION['username'];
$nombre =$_SESSION['nombre'];
$apellido =$_SESSION['apellido'];
$tipo =$_SESSION['tipouser'];
echo "<em>Bienvenid@ a SoftConTech $nombre $apellido, qué deseas hacer?</em>";			
?></div>
<div id="wb_JavaScript2" style="position:absolute;left:654px;top:22px;width:191px;height:28px;z-index:18;">
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
</body>
</html><?php
include("conexion.php");  
$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");
$sql="SELECT * FROM empresapro WHERE idEmpresaPro=1";
$sel=mysql_query($sql) or die ("no se pudo conectar a la tabla empresapro pongase en contacto con su proveedor 3177740609");
$registros=mysql_fetch_array($sel);		

$nombre = $registros["RazonSocial"];
$nit = $registros["NIT"];
$direccion = $registros["Direccion"];
$ciudad = $registros["Ciudad"];
$telefono = $registros["Telefono"];
$celular = $registros["Celular"];
$email = $registros["Email"];
$resdian = $registros["ResolucionDian"];
$web = $registros["WEB"];

$sql="SELECT * FROM impret WHERE idImpRet=1";
$sel=mysql_query($sql) or die ("no se pudo conectar a la tabla empresapro pongase en contacto con su proveedor 3177740609");
$registros=mysql_fetch_array($sel);

$IVA = $registros["IVA"];
$retefuente = $registros["Retefuente"];
$incomer = $registros["IndComer"];
$factoring = $registros["Factoring"];
$reteiva = $registros["ReteIVA"];

echo "<script> document.getElementById('Editbox1').value='$nombre' 
				document.getElementById('Editbox2').value='$nit' 
				document.getElementById('Editbox3').value='$direccion' 
				document.getElementById('Editbox4').value='$ciudad' 
				document.getElementById('Editbox5').value='$telefono' 
				document.getElementById('Editbox8').value='$celular' 
				document.getElementById('Editbox6').value='$email' 
				document.getElementById('Editbox7').value='$web' 
				document.getElementById('TextArea1').innerHTML='$resdian'

                                document.getElementById('Editbox17').value='$IVA' 
				document.getElementById('Editbox18').value='$retefuente' 
				document.getElementById('Editbox19').value='$incomer' 
				document.getElementById('Editbox20').value='$factoring' 
				document.getElementById('Editbox21').value='$reteiva'  

</script>";


			
?>