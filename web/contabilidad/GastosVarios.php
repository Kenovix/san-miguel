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
<title>GastosVarios</title>
<style type="text/css">
html, body
{
   height: 100%;
}
div#space
{
   width: 1px;
   height: 50%;
   margin-bottom: -713px;
   float:left
}
div#container
{
   width: 970px;
   height: 1427px;
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
   background-image: url(images/GastosVarios_Layer1_bkgrnd.png);
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
#Layer2
{
   background-color: #E6E6FA;
   -moz-box-shadow: 5px 5px 5px #000000;
   -webkit-box-shadow: 5px 5px 5px #000000;
   box-shadow: 5px 5px 5px #000000;
}
#wb_Form1
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
#AdvancedButton1
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/guardar.png);
   background-repeat: no-repeat;
   background-position: left top;
}
#Editbox2
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 21px;
   text-align: left;
   vertical-align: middle;
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
#Image4
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
#InlineFrame1
{
   border: 0px #C0C0C0 solid;
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
#Editbox1
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 21px;
   text-align: left;
   vertical-align: middle;
}
#Editbox3
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 21px;
   text-align: left;
   vertical-align: middle;
}
#Editbox4
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 21px;
   text-align: left;
   vertical-align: middle;
}
#wb_Text12 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text12 div
{
   text-align: center;
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
</style>
<script language="JavaScript"> 
function envia(){ 

subtotal = document.getElementById("Editbox1").value;
iva = document.getElementById("Editbox3").value;
total = document.getElementById("Editbox4").value;

var ValidaTotal=(parseInt(subtotal)+parseInt(iva));
if (ValidaTotal==total){ 
      
     
if (confirm('¿Estas seguro que deseas registrar este egreso?')){ 
      document.FrmArriendos.submit();
      document.FrmArriendos.reset();
    } 

 }else{
	 
	 alert('[ERROR] El Subtotal mas el IVA no corresponde al Total, por favor verifique el total debería ser: '+ValidaTotal);
	 document.getElementById("Editbox4").focus();
 }
} 
</script> 
</head>
<body>
<div id="space"><br></div>
<div id="container">
<div id="wb_Image2" style="position:absolute;left:840px;top:78px;width:128px;height:128px;z-index:51;">
<a href="./Egresos2.php"><img src="images/img0036.png" id="Image2" alt=""></a></div>
<div id="Layer2" style="position:absolute;text-align:left;left:35px;top:358px;width:903px;height:1066px;z-index:52;">
<div id="wb_Form1" style="position:absolute;left:15px;top:16px;width:634px;height:1025px;z-index:26;">
<form name="FrmArriendos" method="post" action="Gastos.php" enctype="multipart/form-data" target="FrameMensajes" id="Form1">
<input type="hidden" name="TxtPagaServicios" value="1">
<div id="wb_Text1" style="position:absolute;left:195px;top:94px;width:255px;height:48px;text-align:center;z-index:3;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Seleccione la cuenta origen para realizar el pago</em></span></div>
<div id="Html2" style="position:absolute;left:219px;top:149px;width:210px;height:42px;z-index:4">
<?php

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

print(" <select name=CmbCuentaOrigen size=1 id=CmbCuentaOrigen>
	<option value=NO>Seleccione la Cuenta Origen</option>");
	
	
$reg = mysql_query("SELECT * FROM `cuentasfrecuentes` WHERE `ClaseCuenta`='ACTIVOS' ",$con) or die("La consulta a cuentasfrecuentes es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      echo "<option value= $datos[CuentaPUC]>$datos[Nombre]</option>";
   }

}


echo '</select><br>';
?></div>
<div id="Html3" style="position:absolute;left:219px;top:411px;width:210px;height:42px;z-index:5">
<?php

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

print(" <select name=CmbCuentaDestino size=1 id=CmbCuentaDestino>
	<option value=NO>Seleccione la Cuenta Destino</option>");
	
	
$reg = mysql_query("SELECT * FROM `subcuentas` WHERE `Cuentas_idPUC`='5195' OR `Cuentas_idPUC`='5140' ",$con) or die("La consulta a cuentasfrecuentes es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      echo "<option value= $datos[PUC]>$datos[Nombre] $datos[Cuentas_idPUC]</option>";
   }
      
}


echo '</select><br>';
?></div>
<div id="wb_Text2" style="position:absolute;left:191px;top:353px;width:255px;height:24px;text-align:center;z-index:6;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Seleccione la cuenta destino</em></span></div>
<div id="wb_Text3" style="position:absolute;left:266px;top:12px;width:110px;height:24px;text-align:center;z-index:7;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Fecha</em></span></div>
<textarea name="TxtConcepto" id="TextArea1" style="position:absolute;left:5px;top:688px;width:283px;height:137px;z-index:8;" rows="7" cols="44" required></textarea>
<div id="wb_Text4" style="position:absolute;left:87px;top:648px;width:132px;height:24px;text-align:center;z-index:9;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Concepto</em></span></div>
<div id="Html4" style="position:absolute;left:263px;top:50px;width:113px;height:24px;z-index:10">
<?php

print('<input type="date" name="TxtFecha" step="1" min="2010-01-01" max="2200-12-31" value='.$fecha.'>');

?></div>
<button id="AdvancedButton1" type="button" style="position:absolute;left:253px;top:866px;width:134px;height:136px;z-index:11;" onclick="envia();" name="BtnPagaServicios" value="">
<div style="text-align:center">&nbsp;</div>
</button>
<input type="text" id="Editbox2" style="position:absolute;left:192px;top:522px;width:272px;height:26px;line-height:26px;z-index:12;" name="TxtNumFactura" value="" placeholder="Digite el numero de factura">
<div id="wb_Text6" style="position:absolute;left:201px;top:481px;width:255px;height:24px;text-align:center;z-index:13;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Numero de la factura</em></span></div>
<div id="Html5" style="position:absolute;left:219px;top:272px;width:210px;height:42px;z-index:14">
<?php

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

print(" <select name=CmbProveedor size=1 id=Proveedor>
	<option value=NO>Seleccione el proveedor</option>");
	
	
$reg = mysql_query("SELECT * FROM `proveedores` WHERE `Gastos_Diversos`='1' ",$con) or die("La consulta a cuentasfrecuentes es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      echo "<option value= $datos[idProveedores]>$datos[RazonSocial] $datos[NIT]</option>";
   }

}


echo '</select><br>';
?></div>
<div id="wb_Text7" style="position:absolute;left:193px;top:214px;width:255px;height:48px;text-align:center;z-index:15;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Seleccione el proveedor de este servicio</em></span></div>
<input type="radio" id="RadioButton4" name="TipoPago" value="Contado" checked style="position:absolute;left:356px;top:573px;z-index:16;">
<input type="radio" id="RadioButton5" name="TipoPago" value="Programado" style="position:absolute;left:356px;top:603px;z-index:17;">
<div id="wb_Text8" style="position:absolute;left:171px;top:569px;width:177px;height:24px;text-align:center;z-index:18;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Pago de contado</em></span></div>
<div id="wb_Text9" style="position:absolute;left:171px;top:599px;width:177px;height:24px;text-align:center;z-index:19;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Pago programado</em></span></div>
<div id="Html6" style="position:absolute;left:399px;top:599px;width:113px;height:24px;z-index:20">
<?php

print('<input type="date" name="TxtFechaProgram" step="1" min="2010-01-01" max="2200-12-31" value='.$fecha.'>');

?></div>
<input type="number" id="Editbox1" style="position:absolute;left:356px;top:688px;width:233px;height:37px;line-height:37px;z-index:21;" name="TxtSubtotal" value="" required placeholder="Subtotal">
<input type="number" id="Editbox3" style="position:absolute;left:356px;top:739px;width:233px;height:37px;line-height:37px;z-index:22;" name="TxtIVA" value="" required placeholder="IVA si aplica">
<input type="number" id="Editbox4" style="position:absolute;left:356px;top:788px;width:233px;height:37px;line-height:37px;z-index:23;" name="TxtValor" value="" required placeholder="Digite el total del pago">
<div id="wb_Text5" style="position:absolute;left:325px;top:803px;width:31px;height:24px;text-align:center;z-index:24;">
<span style="color:#FF0000;font-family:'Trebuchet MS';font-size:19px;"><em>*</em></span></div>
<div id="wb_Text10" style="position:absolute;left:324px;top:698px;width:31px;height:24px;text-align:center;z-index:25;">
<span style="color:#FF0000;font-family:'Trebuchet MS';font-size:19px;"><em>*</em></span></div>
</form>
</div>
<div id="wb_Text12" style="position:absolute;left:670px;top:732px;width:221px;height:72px;text-align:center;z-index:27;">
<span style="color:#FF0000;font-family:'Trebuchet MS';font-size:19px;"><em>Recuerda que si no se paga IVA el Subtotal debe ser Igual al Total</em></span></div>
</div>
<div id="wb_Image4" style="position:absolute;left:0px;top:68px;width:115px;height:62px;z-index:53;">
<img src="images/tslogo.png" id="Image4" alt=""></div>
<div id="wb_Image5" style="position:absolute;left:684px;top:297px;width:350px;height:350px;z-index:54;">
<img src="images/mensaje3.png" id="Image5" alt=""></div>
<iframe name="FrameMensajes" id="InlineFrame1" style="position:absolute;left:753px;top:384px;width:210px;height:157px;z-index:55;" src="http://" frameborder="0"></iframe>
<div id="wb_Image3" style="position:absolute;left:326px;top:95px;width:247px;height:213px;z-index:56;">
<a href="./GastosVarios.php"><img src="images/img0039.png" id="Image3" alt=""></a></div>
</div>
<div id="Layer1" style="position:absolute;text-align:left;left:0px;top:0px;width:100%;height:64px;z-index:57;">
<div id="wb_Image1" style="position:absolute;left:851px;top:8px;width:125px;height:50px;z-index:0;">
<a href="http://www.technosoluciones.com" target="_blank"><img src="images/header-logo.png" id="Image1" alt=""></a></div>
<div id="Html1" style="position:absolute;left:5px;top:17px;width:622px;height:33px;z-index:1">
<?php

$usuario =$_SESSION['username'];
$nombre =$_SESSION['nombre'];
$apellido =$_SESSION['apellido'];
$tipo =$_SESSION['tipouser'];
echo "<em>Sesion iniciada en SoftConTech por: $nombre $apellido</em>";			
?></div>
<div id="wb_JavaScript1" style="position:absolute;left:655px;top:20px;width:191px;height:28px;z-index:2;">
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