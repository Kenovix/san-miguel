<?php
session_start();
   if(!isset($_SESSION["username"])){
   header("Location: index.php");
   		
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
#Image2
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
#Image3
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
#Image5
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
   text-align: left;
}
#wb_Text4 div
{
   text-align: left;
}
#Image6
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
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
#Image7
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
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
#Image8
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
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
#Image10
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
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
#Image14
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Image13
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
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
#Image11
{
   border: 0px #FFFFFF outset;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Layer2
{
   background-color: #F5F5F5;
}
#Layer1
{
   background-color: transparent;
   background-image: url(images/Menu_Layer1_bkgrnd.png);
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
</style>
</head>
<body>
<div id="wb_Image2" style="position:absolute;left:181px;top:92px;width:92px;height:92px;z-index:5;">
<a href="./Administrar.php"><img src="images/img0003.png" id="Image2" alt=""></a></div>
<div id="wb_Text1" style="position:absolute;left:190px;top:189px;width:87px;height:42px;z-index:6;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Administrar</em></strong></span></div>
<div id="wb_Image3" style="position:absolute;left:612px;top:101px;width:83px;height:83px;z-index:7;">
<a href="./Ingresos.php"><img src="images/img0005.png" id="Image3" alt=""></a></div>
<div id="wb_Text2" style="position:absolute;left:617px;top:187px;width:81px;height:21px;z-index:8;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Ingresos</em></strong></span></div>
<div id="wb_Image5" style="position:absolute;left:401px;top:92px;width:99px;height:99px;z-index:9;">
<a href="./Egresos2.php"><img src="images/img0009.png" id="Image5" alt=""></a></div>
<div id="wb_Text4" style="position:absolute;left:413px;top:187px;width:87px;height:21px;z-index:10;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Egresos</em></strong></span></div>
<div id="wb_Image6" style="position:absolute;left:592px;top:319px;width:84px;height:84px;z-index:11;">
<a href="admin/clientes.php" target="_blank"><img src="images/img0011.png" id="Image6" alt=""></a></div>
<div id="wb_Text5" style="position:absolute;left:601px;top:408px;width:87px;height:21px;z-index:12;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Clientes</em></strong></span></div>
<div id="wb_Image7" style="position:absolute;left:782px;top:303px;width:100px;height:100px;z-index:13;">
<a href="admin/proveedores.php"><img src="images/img0013.png" id="Image7" alt=""></a></div>
<div id="wb_Text6" style="position:absolute;left:795px;top:413px;width:87px;height:42px;z-index:14;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Proveedores</em></strong></span></div>
<div id="wb_Image8" style="position:absolute;left:200px;top:303px;width:88px;height:87px;z-index:15;">
<a href="./Informes.php"><img src="images/img0015.png" id="Image8" alt=""></a></div>
<div id="wb_Text7" style="position:absolute;left:210px;top:403px;width:87px;height:21px;z-index:16;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Informes</em></strong></span></div>
<div id="wb_Text8" style="position:absolute;left:547px;top:619px;width:45px;height:21px;z-index:17;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Salir</em></strong></span></div>
<div id="wb_Image10" style="position:absolute;left:500px;top:494px;width:112px;height:112px;z-index:18;">
<a href="destruir.php"><img src="images/img0018.png" id="Image10" alt=""></a></div>
<div id="wb_Text10" style="position:absolute;left:812px;top:184px;width:75px;height:21px;z-index:19;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Cartera</em></strong></span></div>
<div id="wb_Image14" style="position:absolute;left:795px;top:101px;width:82px;height:82px;z-index:20;">
<a href="./Cartera.php"><img src="images/img0023.png" id="Image14" alt=""></a></div>
<div id="wb_Image13" style="position:absolute;left:385px;top:319px;width:123px;height:71px;z-index:21;">
<a href="./PagarCuentas.php"><img src="images/img0025.png" id="Image13" alt=""></a></div>
<div id="wb_Text11" style="position:absolute;left:385px;top:406px;width:153px;height:21px;z-index:22;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Cuentas por pagar</em></strong></span></div>
<div id="Layer2" style="position:absolute;text-align:right;left:0px;top:0px;width:159px;height:100%;z-index:23;">
<div id="Layer2_Container" style="width:159px;position:relative;margin-left:auto;margin-right:0;text-align:left;">
<div id="wb_CssMenu1" style="position:absolute;left:6px;top:185px;width:138px;height:455px;z-index:0;">
<ul>
<li class="firstmain"><a class="active" href="./Menu.php" target="_self">Menu</a>
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
<div id="wb_Image11" style="position:absolute;left:15px;top:92px;width:120px;height:48px;z-index:1;">
<a href="http://www.technosoluciones.com/" target="_blank"><img src="images/img0012.png" id="Image11" alt=""></a></div>
</div>
</div>
<div id="Layer1" style="position:absolute;text-align:left;left:0px;top:0px;width:101%;height:64px;z-index:24;">
<div id="wb_Image23" style="position:absolute;left:851px;top:8px;width:125px;height:50px;z-index:2;">
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
</body>
</html>