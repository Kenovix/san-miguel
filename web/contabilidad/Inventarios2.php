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
<title>Inventarios</title>
<style type="text/css">
html, body
{
   height: 100%;
}
div#space
{
   width: 1px;
   height: 50%;
   margin-bottom: -515px;
   float:left
}
div#container
{
   width: 970px;
   height: 1030px;
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
#Image22
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image22:hover
{
   -webkit-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -moz-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -ms-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -webkit-transition: -webkit-transform 200ms linear 0ms;
   -moz-transition: transform 200ms linear 0ms;
   -ms-transition: transform 200ms linear 0ms;
   transition: transform 200ms linear 0ms;
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
#InlineFrame3
{
   border: 0px #C0C0C0 solid;
}
#Image4
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
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
   -webkit-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -moz-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -ms-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
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
   text-align: center;
}
#wb_Text3 div
{
   text-align: center;
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
   background-image: url(images/Inventarios2_Layer2_bkgrnd.png);
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
#Image5
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image5:hover
{
   -webkit-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -moz-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -ms-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -webkit-transition: -webkit-transform 200ms linear 0ms;
   -moz-transition: transform 200ms linear 0ms;
   -ms-transition: transform 200ms linear 0ms;
   transition: transform 200ms linear 0ms;
}
#wb_Text5 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text5 div
{
   text-align: center;
}
#Image6
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image6:hover
{
   -webkit-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -moz-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -ms-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -webkit-transition: -webkit-transform 200ms linear 0ms;
   -moz-transition: transform 200ms linear 0ms;
   -ms-transition: transform 200ms linear 0ms;
   transition: transform 200ms linear 0ms;
}
#wb_Text6 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text6 div
{
   text-align: center;
}
#Image7
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image7:hover
{
   -webkit-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -moz-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -ms-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -webkit-transition: -webkit-transform 200ms linear 0ms;
   -moz-transition: transform 200ms linear 0ms;
   -ms-transition: transform 200ms linear 0ms;
   transition: transform 200ms linear 0ms;
}
#wb_Text7 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text7 div
{
   text-align: center;
}
.ui-dialog
{
   padding: 4px 4px 4px 4px;
}
.ui-dialog .ui-dialog-title
{
   font-family: "Trebuchet MS";
   font-weight: normal;
   font-size: 19px;
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
#Layer1
{
   background-color: transparent;
   background-image: url(images/Inventarios2_Layer1_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
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
   width: 165px;
}
#wb_CssMenu1 li
{
   float: left;
   margin: 0;
   padding: 0px 0px 4px 0px;
   width: 165px;
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
   width: 153px;
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
   width: 153px;
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
   left: 165px;
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
#Image8
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image8:hover
{
   -webkit-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -moz-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -ms-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -webkit-transition: -webkit-transform 200ms linear 0ms;
   -moz-transition: transform 200ms linear 0ms;
   -ms-transition: transform 200ms linear 0ms;
   transition: transform 200ms linear 0ms;
}
#wb_Text8 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text8 div
{
   text-align: center;
}
#Image9
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image9:hover
{
   -webkit-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -moz-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -ms-transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   transform: rotateX(0deg) scale3d(1.3,1.3,1.3);
   -webkit-transition: -webkit-transform 200ms linear 0ms;
   -moz-transition: transform 200ms linear 0ms;
   -ms-transition: transform 200ms linear 0ms;
   transition: transform 200ms linear 0ms;
}
#wb_Text9 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text9 div
{
   text-align: center;
}
</style>
<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.mouse.min.js"></script>
<script type="text/javascript" src="jquery.ui.button.min.js"></script>
<script type="text/javascript" src="jquery.ui.draggable.min.js"></script>
<script type="text/javascript" src="jquery.ui.position.min.js"></script>
<script type="text/javascript" src="jquery.ui.resizable.min.js"></script>
<script type="text/javascript" src="jquery.ui.dialog.min.js"></script>
<script type="text/javascript" src="jquery.ui.effect.min.js"></script>
<script type="text/javascript" src="jquery.ui.effect-explode.min.js"></script>
<script type="text/javascript" src="jquery.ui.effect-scale.min.js"></script>
<script type="text/javascript" src="wwb10.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
   var jQueryDialog1Opts =
   {
      width: 439,
      height: 485,
      position: { my: 'center', at: 'center', of: window },
      resizable: true,
      draggable: true,
      closeOnEscape: true,
      show: 'explode',
      hide: 'puff',
      autoOpen: false
   };
   $("#jQueryDialog1").dialog(jQueryDialog1Opts);
});
</script>
<script language="JavaScript"> 
function envia(){ 
if (confirm('¿Estas seguro que deseas registrar este egreso?')){ 
      document.FrmArriendos.submit();
      document.FrmArriendos.reset();
    } 

 
} 
</script> 
</head>
<body>
<div id="space"><br></div>
<div id="container">
</div>
<div id="Layer3" style="position:absolute;overflow:auto;text-align:left;left:0px;top:0px;width:100%;height:100%;z-index:30;">
<div id="wb_Text1" style="position:absolute;left:411px;top:73px;width:220px;height:24px;z-index:5;text-align:left;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Gestion de Inventarios</em></span></div>
<div id="wb_Image22" style="position:absolute;left:212px;top:150px;width:143px;height:143px;z-index:6;">
<a href="admin/productosventa.php" target="_blank"><img src="images/img0078.png" id="Image22" alt=""></a></div>
<div id="wb_Text2" style="position:absolute;left:222px;top:294px;width:112px;height:48px;text-align:center;z-index:7;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Gestión de Inventarios</em></span></div>
<div id="wb_Image3" style="position:absolute;left:462px;top:166px;width:118px;height:118px;z-index:8;">
<a href="tablasview/administrar/ProductosVenta.php" target="_blank" onclick="$('#jQueryDialog1').dialog('open');return false;"><img src="images/img0081.jpg" id="Image3" alt=""></a></div>
<div id="wb_Text3" style="position:absolute;left:462px;top:303px;width:112px;height:48px;text-align:center;z-index:9;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Inicializar inventarios</em></span></div>
<div id="wb_Image5" style="position:absolute;left:694px;top:159px;width:135px;height:134px;z-index:10;">
<a href="./Baja.php" target="_blank"><img src="images/img0053.png" id="Image5" alt=""></a></div>
<div id="wb_Text5" style="position:absolute;left:706px;top:303px;width:112px;height:24px;text-align:center;z-index:11;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;">Dar de Baja</span></div>
<div id="wb_Image6" style="position:absolute;left:212px;top:433px;width:137px;height:137px;z-index:12;">
<a href="./SincPrecios.php" target="_blank"><img src="images/img0073.png" id="Image6" alt=""></a></div>
<div id="wb_Text6" style="position:absolute;left:222px;top:580px;width:112px;height:72px;text-align:center;z-index:13;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;">Sincronizar precios de venta</span></div>
<div id="wb_Image7" style="position:absolute;left:456px;top:433px;width:128px;height:128px;z-index:14;">
<a href="./PrintBarras.php" target="_blank"><img src="images/img0080.png" id="Image7" alt=""></a></div>
<div id="wb_Text7" style="position:absolute;left:462px;top:580px;width:112px;height:72px;text-align:center;z-index:15;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;">Imprimir códigos de Barra</span></div>
<div id="jQueryDialog1" style="z-index:16;" title="Subir lista de precios">
<iframe name="InlineFrame3" id="InlineFrame3" style="position:absolute;left:47px;top:161px;width:345px;height:241px;z-index:0;" src="upload2.php" frameborder="0"></iframe>
<div id="wb_Image4" style="position:absolute;left:21px;top:27px;width:98px;height:98px;z-index:1;">
<img src="images/warning.png" id="Image4" alt=""></div>
<div id="wb_Text4" style="position:absolute;left:145px;top:26px;width:268px;height:96px;text-align:center;z-index:2;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Esta accion reiniciará todos los inventarios y Kardex, se recomienda realizar un Backup antes de continuar</em></span></div>
</div>

<div id="Layer2" style="position:absolute;text-align:right;left:0%;top:0px;width:187px;height:100%;z-index:17;">
<div id="Layer2_Container" style="width:187px;position:relative;margin-left:auto;margin-right:0;text-align:left;">
<div id="wb_Image2" style="position:absolute;left:26px;top:75px;width:115px;height:62px;z-index:3;">
<img src="images/tslogo.png" id="Image2" alt=""></div>
<div id="wb_CssMenu1" style="position:absolute;left:9px;top:159px;width:165px;height:329px;z-index:4;">
<ul>
<li class="firstmain"><a href="./Menu.php" target="_self">Menu</a>
</li>
<li><a href="./Administrar.php" target="_self">Administrar</a>
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
<li><a class="withsubmenu active" href="./Inventarios2.php" target="_self">Inventarios</a>

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
<div id="wb_Image8" style="position:absolute;left:694px;top:433px;width:135px;height:135px;z-index:18;">
<a href="./kits.php" target="_blank"><img src="images/img0051.png" id="Image8" alt=""></a></div>
<div id="wb_Text8" style="position:absolute;left:694px;top:570px;width:112px;height:48px;text-align:center;z-index:19;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;">Gestión de Kits</span></div>
<div id="wb_Image9" style="position:absolute;left:456px;top:677px;width:128px;height:120px;z-index:20;">
<a href="VAtencion/OrdenesActivos.php" target="_blank"><img src="images/img0031.png" id="Image9" alt=""></a></div>
<div id="wb_Text9" style="position:absolute;left:462px;top:819px;width:112px;height:96px;text-align:center;z-index:21;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;">Ordenes de Salida y Entrada Activos</span></div>
</div>
<div id="Layer1" style="position:absolute;text-align:left;left:0px;top:0px;width:100%;height:64px;z-index:31;">
<div id="wb_Image1" style="position:absolute;left:851px;top:8px;width:125px;height:50px;z-index:27;">
<a href="http://www.technosoluciones.com" target="_blank"><img src="images/header-logo.png" id="Image1" alt=""></a></div>
<div id="Html1" style="position:absolute;left:5px;top:18px;width:625px;height:33px;z-index:28">
<?php

$usuario =$_SESSION['username'];
$nombre =$_SESSION['nombre'];
$apellido =$_SESSION['apellido'];
$tipo =$_SESSION['tipouser'];
echo "<em>Sesion iniciada en SoftConTech por: $nombre $apellido</em>";			
?></div>
<div id="wb_JavaScript1" style="position:absolute;left:652px;top:21px;width:191px;height:28px;z-index:29;">
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
</html>