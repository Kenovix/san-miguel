<?php

include('conexion.php');
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.php");
 $fecha=date("Y-m-d"); 
$con=mysql_connect($host,$user,$pw) or die('problemas con el servidor');
mysql_select_db($db,$con) or die('la base de datos no abre');

$reg=mysql_query("SELECT Valor FROM impret WHERE idImpRet=1",$con)
		  or die("Problemas al seleccionar los datos");
		  $re=mysql_fetch_array($reg);
		  
		  $IVA = $re["Valor"];


	$idHV = substr($_POST['btnCargaCoti'], 19);
	
	$sql="SELECT * FROM clientes WHERE idClientes=$idHV";
	
	$r = mysql_query($sql,$con) or die('La consulta a nuestra base de datos es erronea.'.mysql_error());
                       
    if(mysql_num_rows($r)){//Si existen resultados
        $DatosCoti= mysql_fetch_array($r);
		$IDCliente=$DatosCoti['idClientes'];
		$RazonSocial=$DatosCoti['RazonSocial'];
		$NIT=$DatosCoti['Num_Identificacion'];
		$Direccion=$DatosCoti['Direccion'];
		$Ciudad=$DatosCoti['Ciudad'];
		$Telefono=$DatosCoti['Telefono'];
		$Email=$DatosCoti['Email'];
		
$tbl = <<<EOD

<div id="wb_Form1" style="position:absolute;width:835px;height:409px;">
<form name="Form1" method="post" action="VerProductos.php" target="FramePrecoti" id="Form1" onsubmit="return ValidateForm1(this)">
<input type="hidden" name="TxtIDCliente" value="$IDCliente">
<div id="wb_Text1" style="position:absolute;left:60px;top:297px;width:300px;height:21px;z-index:93;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Lista de productos o servicios</em></strong></span></div>
<select name="Combobox1" size="1" id="Combobox1" style="position:absolute;left:125px;top:327px;width:129px;height:20px;z-index:94;">
<option selected value="precioscctv">Seleccione</option>

EOD;
echo ($tbl);

////Creamos un espacio en ventasactivas


$sql="SELECT * FROM prod_departamentos";

	
	$dep = mysql_query($sql,$con) or die('La consulta a nuestra base de datos es erronea.'.mysql_error());
                       
    if(mysql_num_rows($dep)){//Si existen resultados

while($Departamentos=mysql_fetch_array($dep)){
	
print("<option value=$Departamentos[idDepartamentos]>$Departamentos[Nombre]</option>");


}
	}
	
$tbl = <<<EOD

</select>
<div id="wb_Text3" style="position:absolute;left:20px;top:325px;width:50px;height:21px;z-index:95;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Departamento</em></strong></span></div>
<input type="submit" id="Button1" name="" value="Cargar" style="position:absolute;left:155px;top:355px;width:96px;height:25px;z-index:96;">
<div id="wb_Text5" style="position:absolute;left:330px;top:301px;width:155px;height:21px;z-index:97;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Aplicar a cotizacion</em></strong></span></div>
<select name="Combobox2" size="1" id="Combobox2" style="position:absolute;left:424px;top:328px;width:54px;height:20px;z-index:98;">
<option selected value="0">0</option>
<option value="5">5</option>
<option value="10">10</option>
<option value="15">15</option>
<option value="20">20</option>
</select>
<div id="wb_Text6" style="position:absolute;left:316px;top:325px;width:110px;height:21px;z-index:99;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Descuentos %</em></strong></span></div>
<div id="wb_Text8" style="position:absolute;left:320px;top:355px;width:101px;height:21px;z-index:100;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Impuestos %</em></strong></span></div>
<hr id="Line1" style="margin:0;padding:0;position:absolute;left:86px;top:184px;width:409px;height:2px;z-index:101;">
<select name="Combobox3" size="1" id="Combobox3" style="position:absolute;left:424px;top:357px;width:54px;height:20px;z-index:102;">
<option selected value="$IVA">$IVA</option>
<option value="0">0</option>
<option value="8">8</option>
<option value="16">16</option>
<option value="24">24</option>
<option value="32">32</option>
</select>
<input type="text" id="Editbox1" style="position:absolute;left:84px;top:46px;width:412px;height:20px;line-height:20px;z-index:103;" name="TxtNombre" value="$RazonSocial" placeholder="Escriba el nombre del cliente">
<div id="wb_Text9" style="position:absolute;left:19px;top:43px;width:65px;height:21px;z-index:104;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Nombre</em></strong></span></div>
<div id="wb_Text10" style="position:absolute;left:198px;top:7px;width:173px;height:21px;z-index:105;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Modulo Cotizador TS</em></strong></span></div>
<div id="wb_Text11" style="position:absolute;left:14px;top:115px;width:65px;height:42px;z-index:106;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Telefono</em></strong></span></div>
<input type="text" id="Editbox2" style="position:absolute;left:84px;top:79px;width:233px;height:20px;line-height:20px;z-index:107;" name="TxtDireccion" value="$Direccion" placeholder="escriba la direccion">
<div id="wb_Text12" style="position:absolute;left:204px;top:116px;width:50px;height:21px;z-index:108;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Email</em></strong></span></div>
<input type="text" id="Editbox3" style="position:absolute;left:397px;top:82px;width:100px;height:20px;line-height:20px;z-index:109;" name="TxtCiudad" value="$Ciudad" placeholder="Escriba un correo electronico">
<div id="wb_Text13" style="position:absolute;left:10px;top:77px;width:85px;height:21px;z-index:110;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Direccion</em></strong></span></div>
<input type="text" id="Editbox4" style="position:absolute;left:84px;top:116px;width:111px;height:20px;line-height:20px;z-index:111;" name="TxtTelefono" value="$Telefono" placeholder="Escriba el tel">
<div id="wb_Text14" style="position:absolute;left:335px;top:81px;width:59px;height:21px;z-index:112;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Ciudad</em></strong></span></div>
<input type="text" id="Editbox5" style="position:absolute;left:259px;top:115px;width:238px;height:20px;line-height:20px;z-index:113;" name="TxtEmail" value="$Email" placeholder="Escriba el email">
<div id="wb_Text15" style="position:absolute;left:514px;top:45px;width:65px;height:21px;z-index:114;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Fecha</em></strong></span></div>
<input type="text" id="Editbox6" style="position:absolute;left:85px;top:150px;width:205px;height:20px;line-height:20px;z-index:115;" name="TxtNit" value="$NIT" placeholder="Escriba el numero de cedula o NIT">
<div id="wb_Text17" style="position:absolute;left:8px;top:152px;width:77px;height:21px;z-index:116;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>CC o NIT</em></strong></span></div>
<div id="wb_Text18" style="position:absolute;left:223px;top:190px;width:132px;height:21px;z-index:117;text-align:left;">
<span style="color:#0000CD;font-family:'Comic Sans MS';font-size:15px;"><strong><em>Observaciones</em></strong></span></div>
<textarea name="TxtObservaciones" id="TextArea1" style="position:absolute;left:87px;top:218px;width:407px;height:70px;z-index:118;" rows="3" cols="62"></textarea>
<input type="date" id="date1" style="position:absolute;left:571px;top:48px;width:140px;height:24px;line-height:18px;z-index:119;" name="TxtFecha" value="$fecha" min="2000-01-01" max="2100-01-01"">
</form>
</div>

EOD;
		
echo ($tbl);

        
}else{
	exit ('No se encontraron datos para la consulta');	
}




?>