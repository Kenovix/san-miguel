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
<title>Servicios</title>
<style type="text/css">
html, body
{
   height: 100%;
}
div#space
{
   width: 1px;
   height: 50%;
   margin-bottom: -685px;
   float:left
}
div#container
{
   width: 970px;
   height: 1371px;
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
   background-image: url(images/Contratistas_Layer1_bkgrnd.png);
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
#Layer4
{
   background-color: transparent;
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
#Combobox2
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
}
#wb_Text13 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text13 div
{
   text-align: center;
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
#wb_Text14 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text14 div
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
#InlineFrame1
{
   border: 0px #C0C0C0 solid;
   -moz-box-shadow: 10px 10px 2px #000000;
   -webkit-box-shadow: 10px 10px 2px #000000;
   box-shadow: 10px 10px 2px #000000;
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
#wb_Text11 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_Text11 div
{
   text-align: center;
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
</style>
<script type="text/javascript">
function ValidateFrmArriendos(theForm)
{
   var regexp;
   if (theForm.Editbox1.value.length < 1)
   {
      alert("Por favor digite un numero valido en Valor");
      theForm.Editbox1.focus();
      return false;
   }
   if (theForm.Editbox1.value.length > 20)
   {
      alert("Por favor digite un numero valido en Valor");
      theForm.Editbox1.focus();
      return false;
   }
   return true;
}
</script>
<script language="JavaScript"> 
function envia(){ 

subtotal = document.getElementById("Editbox2").value;
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
<div id="wb_Image3" style="position:absolute;left:159px;top:64px;width:243px;height:256px;z-index:71;">
<a href="./Contratistas.php"><img src="images/img0123.png" id="Image3" alt=""></a></div>
<div id="wb_Image2" style="position:absolute;left:0px;top:164px;width:128px;height:128px;z-index:72;">
<a href="./Egresos2.php"><img src="images/img0124.png" id="Image2" alt=""></a></div>
<div id="Layer2" style="position:absolute;text-align:left;left:35px;top:358px;width:903px;height:1003px;z-index:73;">
<div id="wb_Form1" style="position:absolute;left:14px;top:48px;width:877px;height:930px;z-index:31;">
<form name="FrmArriendos" method="post" action="Gastos.php" enctype="multipart/form-data" target="FrameMensajes" id="Form1" onsubmit="return ValidateFrmArriendos(this)">
<input type="hidden" name="TxtPagaContratistas" value="1">
<div id="wb_Text3" style="position:absolute;left:29px;top:18px;width:110px;height:24px;text-align:center;z-index:14;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Fecha</em></span></div>
<div id="Html4" style="position:absolute;left:327px;top:18px;width:113px;height:24px;z-index:15">
<?php

print('<input type="date" name="TxtFecha" step="1" min="2010-01-01" max="2200-12-31" value='.$fecha.'>');

?></div>
<button id="AdvancedButton1" type="button" style="position:absolute;left:688px;top:762px;width:134px;height:136px;z-index:16;" onclick="envia();" name="BtnPagaArriendo" value="">
<div style="text-align:center">&nbsp;</div>
</button>
<div id="Layer3" style="position:absolute;overflow:auto;text-align:left;left:29px;top:381px;width:818px;height:269px;z-index:17;">
<div id="Html5" style="position:absolute;left:18px;top:8px;width:754px;height:220px;z-index:3">
<?php

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");


$reg = mysql_query("SELECT * FROM `impret` WHERE `Tipo`='RetencionAplicada' ",$con) 
or die("La consulta a cuentasfrecuentes es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      print(" <input type='checkbox' name='CkRetenciones[]' value='$datos[idImpRet];$datos[Valor];$datos[Nombre];$datos[CuentaRetRealizadas];$datos[Aplicable_A]'> $datos[Nombre] por: $datos[Valor]<br><hr><br>");
   }

}
?></div>
</div>
<div id="Layer4" style="position:absolute;overflow:auto;text-align:left;left:29px;top:42px;width:818px;height:315px;z-index:18;">
<div id="wb_Text1" style="position:absolute;left:15px;top:23px;width:255px;height:48px;text-align:center;z-index:4;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Seleccione la cuenta origen para realizar el pago</em></span></div>
<div id="Html2" style="position:absolute;left:297px;top:29px;width:475px;height:42px;z-index:5">
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
<div id="wb_Text2" style="position:absolute;left:15px;top:194px;width:255px;height:48px;text-align:center;z-index:6;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Seleccione el proveedor de este servicio</em></span></div>
<div id="Html3" style="position:absolute;left:297px;top:195px;width:475px;height:42px;z-index:7">
<?php

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

print(" <select name=CmbProveedores size=1 id=CmbProveedores>
	<option value=NO>Seleccione la Cuenta Destino</option>");
	
	
$reg = mysql_query("SELECT * FROM `proveedores` WHERE `Contratistas`='1' ",$con) or die("La consulta a cuentasfrecuentes es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      echo "<option value= $datos[idProveedores]>$datos[RazonSocial] $datos[Num_Identificacion]</option>";
   }

}


echo '</select><br>';
?></div>
<div id="Html6" style="position:absolute;left:297px;top:111px;width:478px;height:42px;z-index:8">
<?php

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

print(" <select name=CmbCuentaDestino size=1 id=CmbCuentaDestino>
	<option value=NO>Seleccione la Cuenta Destino</option>");
	
	
$reg = mysql_query("SELECT * FROM `subcuentas` WHERE `Cuentas_idPUC`='5135' ",$con) or die("La consulta a cuentasfrecuentes es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      echo "<option value= $datos[PUC]>$datos[Nombre]</option>";
   }

}


echo '</select><br>';
?></div>
<div id="wb_Text7" style="position:absolute;left:15px;top:111px;width:255px;height:48px;text-align:center;z-index:9;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Seleccione la cuenta destino de este servicio</em></span></div>
<select name="CmbFormaPago" size="1" id="Combobox2" style="position:absolute;left:298px;top:269px;width:133px;height:24px;z-index:10;">
<option selected value="Contado">Contado</option>
<option value="Programado">Credito</option>
</select>
<div id="wb_Text13" style="position:absolute;left:15px;top:269px;width:255px;height:24px;text-align:center;z-index:11;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Forma de Pago</em></span></div>
<div id="Html7" style="position:absolute;left:662px;top:269px;width:113px;height:24px;z-index:12">
<?php

print('<input type="date" name="TxtFechaProgram" step="1" min="2010-01-01" max="2200-12-31" value='.$fecha.'>');

?></div>
<div id="wb_Text15" style="position:absolute;left:440px;top:269px;width:222px;height:24px;text-align:center;z-index:13;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Fecha Pago Programado</em></span></div>
</div>
<div id="wb_Text6" style="position:absolute;left:299px;top:357px;width:255px;height:24px;text-align:center;z-index:19;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Aplicar Retenciones</em></span></div>
<div id="wb_Text4" style="position:absolute;left:142px;top:668px;width:132px;height:24px;text-align:center;z-index:20;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Concepto</em></span></div>
<textarea name="TxtConcepto" id="TextArea1" style="position:absolute;left:29px;top:696px;width:347px;height:119px;z-index:21;" rows="6" cols="55"></textarea>
<input type="number" id="Editbox2" style="position:absolute;left:412px;top:696px;width:233px;height:37px;line-height:37px;z-index:22;" name="TxtSubtotal" value="" required placeholder="Subtotal de la compra">
<input type="number" id="Editbox3" style="position:absolute;left:412px;top:778px;width:233px;height:37px;line-height:37px;z-index:23;" name="TxtIVA" value="" required placeholder="IVA si aplica">
<input type="number" id="Editbox4" style="position:absolute;left:412px;top:859px;width:233px;height:37px;line-height:37px;z-index:24;" name="TxtValor" value="" required placeholder="Digite el total del pago">
<div id="wb_Text5" style="position:absolute;left:460px;top:668px;width:132px;height:24px;text-align:center;z-index:25;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Subtotal</em></span></div>
<div id="wb_Text8" style="position:absolute;left:460px;top:748px;width:132px;height:24px;text-align:center;z-index:26;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>IVA</em></span></div>
<div id="wb_Text9" style="position:absolute;left:460px;top:826px;width:132px;height:24px;text-align:center;z-index:27;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Total</em></span></div>
<div id="wb_Text10" style="position:absolute;left:690px;top:711px;width:132px;height:24px;text-align:center;z-index:28;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Guardar</em></span></div>
<input type="text" id="Editbox1" style="position:absolute;left:29px;top:859px;width:347px;height:37px;line-height:37px;z-index:29;" name="TxtNumFactura" value="" placeholder="Digite el numero de factura">
<div id="wb_Text14" style="position:absolute;left:102px;top:826px;width:224px;height:24px;text-align:center;z-index:30;">
<span style="color:#000000;font-family:'Trebuchet MS';font-size:19px;"><em>Numero de Documento</em></span></div>
</form>
</div>
</div>
<div id="wb_Image4" style="position:absolute;left:0px;top:68px;width:115px;height:62px;z-index:74;">
<img src="images/tslogo.png" id="Image4" alt=""></div>
<iframe name="FrameMensajes" id="InlineFrame1" style="position:absolute;left:450px;top:79px;width:488px;height:263px;z-index:75;" src="" frameborder="0"></iframe>
<div id="wb_Text12" style="position:absolute;left:951px;top:1184px;width:221px;height:16px;text-align:center;z-index:76;">
<span style="color:#FF0000;font-family:'Trebuchet MS';font-size:19px;"><em>Recuerda que si no se paga IVA el Subtotal debe ser Igual al Total</em></span></div>
<div id="wb_Text11" style="position:absolute;left:979px;top:138px;width:147px;height:16px;text-align:center;z-index:77;">
<span style="color:#FF0000;font-family:'Trebuchet MS';font-size:19px;"><em>Esta ventana mostrará si se realizó o no el registro</em></span></div>
</div>
<div id="Layer1" style="position:absolute;text-align:left;left:0px;top:0px;width:119%;height:64px;z-index:78;">
<div id="Html1" style="position:absolute;left:5px;top:17px;width:622px;height:33px;z-index:0">
<?php

$usuario =$_SESSION['username'];
$nombre =$_SESSION['nombre'];
$apellido =$_SESSION['apellido'];
$tipo =$_SESSION['tipouser'];
echo "<em>Sesion iniciada en SoftConTech por: $nombre $apellido</em>";			
?></div>
<div id="wb_JavaScript1" style="position:absolute;left:655px;top:20px;width:191px;height:28px;z-index:1;">
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
<div id="wb_Image1" style="position:absolute;left:1024px;top:14px;width:125px;height:50px;z-index:2;">
<a href="http://www.technosoluciones.com" target="_blank"><img src="images/header-logo.png" id="Image1" alt=""></a></div>
</div>
</body>
</html>