<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>confirma</title>
<meta name="generator" content="WYSIWYG Web Builder 9 - http://www.wysiwygwebbuilder.com">
<style type="text/css">
div#container
{
   width: 1002px;
   position: relative;
   margin: 0 auto 0 auto;
   text-align: left;
}
body
{
   background-color: #FFFFFF;
   color: #000000;
   font-family: "Trebuchet MS";
   font-size: 25px;
   margin: 0;
   text-align: center;
}
</style>
<link href="cupertino/jquery.ui.all.css" rel="stylesheet" type="text/css">
<style type="text/css">
a
{
   color: #1E90FF;
   text-decoration: underline;
}
a:visited
{
   color: #FF00FF;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #F0FFF0;
   text-decoration: underline;
}
</style>
<style type="text/css">
#AdvancedButton2
{
   border: 0px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/si.png);
   background-repeat: no-repeat;
   background-position: left top;
}
.ui-dialog
{
   padding: 4px 4px 4px 4px;
}
.ui-dialog .ui-dialog-title
{
   font-family: "Trebuchet MS";
   font-size: 13px;
   font-weight: normal;
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
#AdvancedButton1
{
   border: 0px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/no.png);
   background-repeat: no-repeat;
   background-position: left top;
}
#wb_Text8 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text8 div
{
   text-align: left;
}
#wb_Form2
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#TextArea1
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: 'Trebuchet MS';
   font-size: 13px;
   text-align: left;
   resize: none;
}
#wb_Text1 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text1 div
{
   text-align: center;
}
#wb_Form1
{
   background-color: transparent;
   border: 0px #000000 solid;
}
</style>
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
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
<script type="text/javascript">
function ValidateFormBorrarItem(theForm)
{
   var regexp;
   if (theForm.TextArea1.value == "")
   {
      alert("Se requiere describir el motivo ");
      theForm.TextArea1.focus();
      return false;
   }
   if (theForm.TextArea1.value.length < 1)
   {
      alert("Se requiere describir el motivo ");
      theForm.TextArea1.focus();
      return false;
   }
   if (theForm.TextArea1.value.length > 500)
   {
      alert("Se requiere describir el motivo ");
      theForm.TextArea1.focus();
      return false;
   }
   return true;
}
</script>
<script type="text/javascript" src="wwb9.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
   var jQueryDialog1Opts =
   {
      width: 389,
      height: 282,
      position: { my: 'center top', at: 'center top', of: window },
      resizable: true,
      draggable: true,
      closeOnEscape: true,
      show: 'puff',
      hide: 'explode',
      autoOpen: false
   };
   $("#jQueryDialog1").dialog(jQueryDialog1Opts);
   
   var jQueryDialog2Opts =
   {
      width: 800,
      height: 400,
      position: { my: 'center top', at: 'center top', of: window },
      resizable: true,
      draggable: true,
      closeOnEscape: true,
      show: 'puff',
      hide: 'explode',
      autoOpen: false
   };
   $("#jQueryDialog2").dialog(jQueryDialog2Opts);
   
   var jQueryDialog3Opts =
   {
      width: 300,
      height: 400,
      position: { my: 'center top', at: 'center top', of: window },
      resizable: true,
      draggable: true,
      closeOnEscape: true,
      show: 'puff',
      hide: 'explode',
      autoOpen: false
   };
   $("#jQueryDialog3").dialog(jQueryDialog3Opts);
   
});
</script>
</head>
<body>



<?php
//include("mte2.php");
include("conexion.php");

////////////////////////////////////////////////////////////////////
//////////////////////Clase principal MyTable
///////////////////////////////////////////////////////////////////

class Mytable {

//echo "$tabla";
public function __construct($host,$db,$user,$pw,$tabla)
		{
			$this->host=$host;
			$this->database=$db;
			$this->user=$user;
			$this->pass=$pw;
			$this->backHeader="#A4A4A4";
			$this->back1="#F2F2F2";
			$this->back2="#D8D8D8";
			$this->fontHeader="white";
			$this->fontCeldas="blue";
			$this->tabla=$tabla;
			$this->tablaMovInv="movimientosinv";
			$this->TotalTabla=0;
			$this->TotalFilaCosto=0;
			$this->TotalFilaVenta=0;
		}
		
		
public function conectar()
  {
	//echo('entrando');
	 //echo "dibujando $tabla<br>";
	$conexion1 = new conexion($this->host,$this->database,$this->user,$this->pass);
	$this->con=$conexion1->conectar();
	//echo('conectado');
}  


////////////////////////////////////////////////////////////////////
//////////////////////Funcion encuentra columnas y ID
///////////////////////////////////////////////////////////////////


public function NombresColumnas($tabla)
  {
	$this->tabla=$tabla;
	$Columnas1=mysql_query("select * from $this->tabla", $this->con) or die('no se pudo conectar: ' . mysql_error());
$reg=mysql_fetch_array($Columnas1);	
$numCols=count($reg);

for ($i=0; $i<=$numCols; $i++){
	
		$this->NombreCol[$i]=mysql_field_name($Columnas1,$i);	
		if ($this->NombreCol[$i]==""){
			unset($this->NombreCol[$i]); 
			$this->NombreCol = array_values($this->NombreCol);//quito el espacio que ha quedado despues de eliminarse 
		}else{
		
			
		}
			
			
			
}

$this->ID=$this->NombreCol[0];

$numCols=count($this->NombreCol);
$this->NumCols=$numCols;
//print($this->NumCols);
//print_r($this->NombreCol);

		
	}	
	
////////////////////////////////////////////////////////////////////
//////////////////////Funcion encuentra columnas especificando una tabla y ID
///////////////////////////////////////////////////////////////////


public function NombresColumnasEsp($tabla)
  {
	//echo "Entrando a nombres ";
	$Columnas1=mysql_query("select * from $tabla", $this->con) or die('no se pudo conectar: ' . mysql_error());
$reg=mysql_fetch_array($Columnas1);	
$numCols=count($reg);

for ($i=0; $i<=$numCols; $i++){
	
		$this->NombreCol[$i]=mysql_field_name($Columnas1,$i);	
		if ($this->NombreCol[$i]==""){
			unset($this->NombreCol[$i]); 
			$this->NombreCol = array_values($this->NombreCol);//quito el espacio que ha quedado despues de eliminarse 
		}else{
		
			
		}
			
			
			
}

$this->ID=$this->NombreCol[0];

$numCols=count($this->NombreCol);
$this->NumCols=$numCols;
//return()
//echo "Saliendo de nombres ";
//print($this->NumCols);
//print_r($this->NombreCol);

		
	}		
	////////////////////////////////////////////////////////////////////
//////////////////////Funcion devuelve valores
///////////////////////////////////////////////////////////////////

	
	public function DevuelveValores($idItem)
  {
	
	$reg=mysql_query("select * from $this->tabla where $this->ID = $idItem", $this->con) or die('no se pudo consultar los valores en DevuelveValores 1: ' . mysql_error());
$reg=mysql_fetch_array($reg);	
//print (" consulta del id: $this->ID $idItem de la tabla $this->tabla ");
//print_r ($reg);
return ($reg);
	}	
	
	
	////////////////////////////////////////////////////////////////////
//////////////////////Funcion sume columna
///////////////////////////////////////////////////////////////////

	
	public function SumeColumna($Item, $item2,$filtro)
  {
	$col=$this->NombreCol[$Item];
	$sql="SELECT SUM($col) AS suma FROM $this->tabla ";
	if($filtro<>""){
		$col=$this->NombreCol[1];
		$sql=$sql." WHERE $col = '$filtro'";
		
		//$sql="SELECT SUM($col) AS suma FROM $this->tabla ";
			for($z=2;$z<$this->NumCols;$z++){
				$col=$this->NombreCol[$z];
				$sql=$sql." OR $col = '$filtro' ";
			}
		}	
	//print($sql);
	$reg=mysql_query($sql, $this->con) or die('no se pudo obtener la suma en SumeColumna: ' . mysql_error());
	$reg=mysql_fetch_array($reg);
	
	$col=$this->NombreCol[$Item2];
	$sql="SELECT SUM($col) AS suma FROM $this->tabla ";
	if($filtro<>""){
		$col=$this->NombreCol[1];
		$sql=$sql." WHERE $col = '$filtro'";
		
		//$sql="SELECT SUM($col) AS suma FROM $this->tabla ";
			for($z=2;$z<$this->NumCols;$z++){
				$col=$this->NombreCol[$z];
				$sql=$sql." OR $col = '$filtro' ";
			}
		}	
	//print($sql);
	$reg2=mysql_query($sql, $this->con) or die('no se pudo obtener la suma en SumeColumna: ' . mysql_error());
	$reg2=mysql_fetch_array($reg);
	
//print (" consulta del id: $this->ID $idItem de la tabla $this->tabla ");
//print_r ($reg);
return($reg["suma"]);
return($reg2["suma"]);
	}	

	
////////////////////////////////////////////////////////////////////
//////////////////////Funcion sume columna especifica
///////////////////////////////////////////////////////////////////

	
	public function SumeColumnaEsp($NombreColumnaSuma, $NombreColumnaFiltro,$filtro)
  {
	
	//print_r($this->NombreCol);
	$ColSuma=$this->NombreCol[$NombreColumnaSuma];
	$ColumnaFiltro=$this->NombreCol[$NombreColumnaFiltro];
	
	$sql="SELECT SUM($ColSuma) AS suma FROM $this->tabla WHERE $ColumnaFiltro = '$filtro'";
	//print($sql);
	$reg=mysql_query($sql, $this->con) or die('no se pudo obtener la suma en SumeColumna: ' . mysql_error());
	$reg=mysql_fetch_array($reg);
	
return($reg["suma"]);

	}	
	
  ////////////////////////////////////////////////////////////////////
//////////////////////Funcion guarda movimiento
///////////////////////////////////////////////////////////////////


public function guardaMovimiento($movimiento, $descripcion, $tabla, $idTabla, $nombre, $unidades, $costoUnidad, $ordenSalida )
  {
	$fecha=date("Y-m-d");
	$hora=date("h:i:s");
	$descripcion="$_SESSION[nombre] $_SESSION[apellido] siendo las $hora a escrito: ".$descripcion;
	$reg=mysql_query("select * from $this->tabla WHERE $this->ID=$idTabla", $this->con) or die('no se pudo conectar: ' . mysql_error());
	$reg=mysql_fetch_array($reg);	
	
	$sql="INSERT INTO `$this->database`.`$this->tablaMovInv` ( `Movimiento`, `Fecha`, `Descripcion`, `TablaInv` , `idTablaInv`,`Nombre`, `Unidades`, `CostoUnidad`,`OrdenesSalida_idOrdenesSalida`) 
	VALUES ('$movimiento', '$fecha', '$descripcion', '$tabla', '$idTabla', '$nombre', '$unidades', '$costoUnidad', '$ordenSalida')";
	
	mysql_query($sql, $this->con) or die('no se pudo registrar el movimiento: ' . mysql_error());	
	return(1);
	
	}	
	
	
	////////////////////////////////////////////////////////////////////
//////////////////////Funcion guarda movimiento
///////////////////////////////////////////////////////////////////


public function VerUltimoID()
  {
	
	$reg=mysql_query("select max($this->ID) as maxID from $this->tabla", $this->con) or die('no se pudo encontrar el ultimo ID en VerUltimoID: ' . mysql_error());
	$reg=mysql_fetch_array($reg);	
	
	return($reg["maxID"]);
	
	}	
	
	
////////////////////////////////////////////////////////////////////
//////////////////////Funcion averigua IVA
///////////////////////////////////////////////////////////////////


public function VerIVA()
  {
	
	$reg=mysql_query("SELECT Valor FROM impret WHERE Nombre='IVA'", $this->con) or die('no se pudo conectar: ' . mysql_error());
	$reg=mysql_fetch_array($reg);	
	$impuesto=$reg["Valor"];
	return($impuesto);
	}		
	
 ////////////////////////////////////////////////////////////////////
//////////////////////Funcion agregar registro a tabla
///////////////////////////////////////////////////////////////////


public function AgregarResgistroTabla($campos)
  {
	
	
	$sql="INSERT INTO `servitorno_inv`.`equiposoficina` (`idEquiposOficina`, `Referencia`, `Equipo`, `Existencias`, `ValorEstimado`, `Marca`, `Serial`, `Bodega`) 
			VALUES ('3', 'REF3', 'PC MESA', '3', '400000', 'HP', '3232123', 'buga');";
	
	$sql="INSERT INTO `$this->database`.`$this->tabla` ( ";
	$fin=$this->NumCols-1;
	for($i=1;$i<$this->NumCols;$i++){
		$col=$this->NombreCol[$i];
		if($fin<>$i)
			$sql=$sql."`$col`,";
		else	
			$sql=$sql."`$col`";
	}
	$sql=$sql." ) VALUES ( ";
	
	for($i=1;$i<$this->NumCols;$i++){
		$col=$campos[$i];
		if($fin<>$i)
			$sql=$sql."'$col',";
		else	
			$sql=$sql."'$col'";
	}
	
	$sql=$sql.");";
	//print_r($sql);
	mysql_query($sql, $this->con) or die('no se pudo registrar el movimiento: ' . mysql_error());	
	return(1);
	
	}
	
	
	
////////////////////////////////////////////////////////////////////
//////////////////////Funcion agregar registro a tabla
///////////////////////////////////////////////////////////////////


public function AgregaPreventa($fecha,$Cantidad,$idVentaActiva,$idProducto,$idCliente,$idUsuario)
  {
	
	
	$reg=mysql_query("select * from productosventa where idProductosVenta = '$idProducto'", $this->con) or die('no se pudo consultar los valores de productosventa en AgregaPreventa: ' . mysql_error());
	$reg=mysql_fetch_array($reg);
	$ValorUnitario=$reg["PrecioVenta"];
	$Subtotal=$ValorUnitario*$Cantidad;
	$impuesto=$reg["IVA"];
	$impuesto=$Subtotal*$impuesto;
	//$Subtotal=$Subtotal-$impuesto;
	$Total=$Subtotal+$impuesto;
	
	$sql="INSERT INTO `$this->database`.`preventa` ( `Fecha`, `Cantidad`, `VestasActivas_idVestasActivas`, `ProductosVenta_idProductosVenta`,`Clientes_idClientes`, `Usuarios_idUsuarios`, `ValorUnitario`,`ValorAcordado`, `Subtotal`, `Impuestos`, `TotalVenta`)
		VALUES ('$fecha', '$Cantidad', '$idVentaActiva', '$idProducto', '$idCliente', '$idUsuario', '$ValorUnitario','$ValorUnitario', '$Subtotal', '$impuesto', '$Total');";
	
	mysql_query($sql, $this->con) or die('no se pudo guardar el item en preventa: ' . mysql_error());	
	
	
	}	
	
	
	////////////////////////////////////////////////////////////////////
//////////////////////Funcion agregar registro a tabla
///////////////////////////////////////////////////////////////////


public function AgregarVenta($fecha,$idVentaActiva,$impuestos,$descuentos,$tipoVenta,$idCliente,$idUsuario)
  {
	
	
	$sql="INSERT INTO `$this->database`.`preventa` ( `Fecha`, `Cantidad`, `VestasActivas_idVestasActivas`, `ProductosVenta_idProductosVenta`,`Clientes_idClientes`, `Usuarios_idUsuarios`)
		VALUES ('$fecha', '$Cantidad', '$idVentaActiva', '$idProducto', '$idCliente', '$idUsuario');";
	
	mysql_query($sql, $this->con) or die('no se pudo guardar el item en preventa: ' . mysql_error());	
	
	
	}	
 ////////////////////////////////////////////////////////////////////
//////////////////////Funcion Agregar Registro
///////////////////////////////////////////////////////////////////


public function AgregarRegistro()
  {
  
	
$tbl = <<<EOD

<div id="jQueryDialog2" style="" title="Digita los campos">
<div id="wb_Form1" style="position:absolute;left:16px;top:14px;z-index:3;">
<form name="FormBorrarItem" method="post" action="EditInv.php" enctype="multipart/form-data" target="_self" id="Form1">

EOD;

print($tbl);	


for($i=1; $i<$this->NumCols; $i++)
		print('<input type="text" style="width:243px;height:50px;line-height:70px;" name="'.$this->NombreCol[$i].'" value="" placeholder="'.$this->NombreCol[$i].'"> ');
		
$tbl = <<<EOD
	

<div id="Html1" style="">
<input type="image" src="iconos/aceptar1.png" name="AgregarItem" value="$this->tabla"></div>
</form>
</div>
</div>	
<div id="wb_Form2" style="position:absolute;left:115px;top:6px;width:348px;height:178px;z-index:11;">
<form name="BorrarItem" method="post" action="EditInv.php" enctype="multipart/form-data" target="_self" id="Form2">
<button id="AdvancedButton1" type="submit" name="cancelar" value="$this->tabla;$idItem" style="position:absolute;left:40px;top:56px;width:108px;height:108px;z-index:4;">
<div style="text-align:center"></div>
</button>

<div id="wb_Text8" style="position:absolute;left:56px;top:9px;width:253px;height:16px;z-index:6;text-align:center;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Vas a agregar un nuevo registro a la tabla $this->tabla</em></strong></span></div>

</form>
</div>

EOD;

print($tbl);	
	
	}	
	


////////////////////////////////////////////////////////////////////
//////////////////////Funcion Editar Registro
///////////////////////////////////////////////////////////////////


public function EditarRegistro($idItem)
  {
  
	
$tbl = <<<EOD

<div id="jQueryDialog3" style="" title="Edita los campos">
<div id="wb_Form1" style="position:absolute;left:16px;top:14px;z-index:3;">
<form name="FormBorrarItem" method="post" action="EditInv.php" enctype="multipart/form-data" target="_self" id="Form1">

EOD;

print($tbl);	

$campos=$this->DevuelveValores($idItem);
//print_r($campos);
for($i=1; $i<$this->NumCols; $i++)
		print('<br>'.$this->NombreCol[$i].'<br><input type="text" style="width:243px;height:35px;" name="'.$this->NombreCol[$i].'" value="'.$campos[$i].'" > ');
		
$tbl = <<<EOD
	

<div id="Html1" style="">
<input type="submit" src="iconos/aceptar1.png" name="EditarItem" value="$this->tabla;$idItem"></div>
</form>
</div>
</div>	
<div id="wb_Form2" style="position:absolute;left:115px;top:6px;width:348px;height:178px;z-index:11;">
<form name="BorrarItem" method="post" action="EditInv.php" enctype="multipart/form-data" target="_self" id="Form2">
<button id="AdvancedButton1" type="submit" name="cancelar" value="$this->tabla;$idItem" style="position:absolute;left:40px;top:56px;width:108px;height:108px;z-index:4;">
<div style="text-align:center"></div>
</button>
<button id="AdvancedButton2" onclick="$('#jQueryDialog3').dialog('open');return false;" type="button" name="si" value="" style="position:absolute;left:225px;top:56px;width:108px;height:108px;z-index:5;">
<div style="text-align:center"></div>
</button>
<div id="wb_Text8" style="position:absolute;left:56px;top:9px;width:253px;height:16px;z-index:6;text-align:center;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Vas a editar el ID $idItem en la tabla $this->tabla?</em></strong></span></div>

</form>
</div>

EOD;

print($tbl);	
	
	}		
	

////////////////////////////////////////////////////////////////////
//////////////////////Funcion Editar registro en tabla
///////////////////////////////////////////////////////////////////


public function EditarResgistroTabla($Num,$columnas,$campos, $idItem)
  {
	//print_r($campos);
	//echo "entrando a editar";
	$sql="UPDATE `servitorno_inv`.`equiposoficina` SET 
	`Referencia` = 'REF', 
	`Equipo` = 'PCMESAe', 
	`Existencias` = '53', 
	`ValorEstimado` = '5500000', 
	`Marca` = 'INTEL1', 
	`Serial` = 'SN4567322', 
	`Bodega` = 'BUG'
    WHERE `equiposoficina`.`idEquiposOficina` = 4;";
				
	
	$sql="UPDATE `$this->database`.`$this->tabla` SET ";
	
	$Num=$Num-1;
	for($i=0;$i<=$Num;$i++){
		$col=$columnas[$i];
		$reg=$campos[$i];
		if($Num<>$i)
			$sql=$sql."`$col` = '$reg', ";
		else	
			$sql=$sql."`$col` = '$reg' ";
	}
	$sql=$sql." WHERE `$this->tabla`.`$this->ID` = '$idItem';";
	
	//print_r($sql);
	mysql_query($sql, $this->con) or die('no se pudo registrar el movimiento: ' . mysql_error());	
	//return(1);
	
	}
		
	


////////////////////////////////////////////////////////////////////
//////////////////////Funcion Editar valores en una tabla, se debe indicar la tabla, el numero de registros que se van a editar
//////////////////////un vector con los nombres de las columnas y otro con los valores y finalmente el filtro con su respectivo valor
///////////////////////////////////////////////////////////////////


public function EditeValoresTabla($tabla,$NumRegistros,$Columnas,$Valores,$Filtro,$idItem)
  {
	
	
	$sql="UPDATE `$this->database`.`$tabla` SET ";
	$fin=$NumRegistros-1;
	for($i=0;$i<$NumRegistros;$i++){
		$col=$Columnas[$i];
		$reg=$Valores[$i];
		if($fin<>$i)
			$sql=$sql."`$col` = '$reg', ";
		else	
			$sql=$sql."`$col` = '$reg' ";
	}
	$sql=$sql." WHERE `$tabla`.`$Filtro` = $idItem;";
	
	//print_r($sql);
	mysql_query($sql, $this->con) or die("no se pudo editar el registro $idItem de la columna $Filtro en la tabla $tabla: " . mysql_error());	
	//return(1);
	
	}	
	
////////////////////////////////////////////////////////////////////
//////////////////////Funcion Editar registro en tabla
///////////////////////////////////////////////////////////////////


public function EditarResgistroTablaEsp($tabla,$campo, $value, $filtro, $idItem)
  {
	
	$this->NombresColumnasEsp("$tabla");
	
	$sql="UPDATE `servitorno_inv`.`equiposoficina` SET 
	`Referencia` = 'REF', 
	`Equipo` = 'PCMESAe', 
	`Existencias` = '53', 
	`ValorEstimado` = '5500000', 
	`Marca` = 'INTEL1', 
	`Serial` = 'SN4567322', 
	`Bodega` = 'BUG'
    WHERE `equiposoficina`.`idEquiposOficina` = 4;";
				
	
	$sql="UPDATE `$this->database`.`$tabla` SET `$campo` = '$value' WHERE `$tabla`.`$filtro` = $idItem;";
	
	
	//print_r($sql);
	mysql_query($sql, $this->con) or die('no se pudo registrar el movimiento: ' . mysql_error());	
	//return(1);
	
	}
			
  ////////////////////////////////////////////////////////////////////
//////////////////////Confirma borrar el item
///////////////////////////////////////////////////////////////////


public function ConfirmarDelItem($idItem)
  {
	
$tbl = <<<EOD

<div id="jQueryDialog1" style="z-index:10;" title="Confirma la accion">
<div id="wb_Form1" style="position:absolute;left:16px;top:14px;width:348px;height:207px;z-index:3;">
<form name="FormBorrarItem" method="post" action="EditInv.php" enctype="multipart/form-data" target="_self" id="Form1" onsubmit="return ValidateFormBorrarItem(this)">
<textarea name="TxtDescripcion" id="TextArea1" style="position:absolute;left:22px;top:52px;width:306px;height:81px;z-index:0;" rows="3" cols="45"></textarea>
<div id="wb_Text1" style="position:absolute;left:46px;top:11px;width:253px;height:32px;text-align:center;z-index:1;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Escriba el motivo por el que se va a eliminar el item</em></strong></span></div>
<div id="Html1" style="position:absolute;left:71px;top:153px;width:212px;height:21px;z-index:2">
<input type="submit" src="iconos/aceptar1.png" name="borraItem" value="$this->tabla;$idItem"></div>
</form>
</div>
</div>

<div id="wb_Form2" style="position:absolute;left:115px;top:6px;width:348px;height:178px;z-index:11;">
<form name="BorrarItem" method="post" action="EditInv.php" enctype="multipart/form-data" target="_self" id="Form2">
<button id="AdvancedButton1" type="submit" name="cancelar" value="$this->tabla;$idItem" style="position:absolute;left:40px;top:56px;width:108px;height:108px;z-index:4;">
<div style="text-align:center">&nbsp;</div>
</button>
<button id="AdvancedButton2" onclick="$('#jQueryDialog1').dialog('open');return false;" type="button" name="si" value="" style="position:absolute;left:225px;top:56px;width:108px;height:108px;z-index:5;">
<div style="text-align:center">&nbsp;</div>
</button>
<div id="wb_Text8" style="position:absolute;left:56px;top:9px;width:253px;height:16px;z-index:6;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Realmente desea eliminar el Item?</em></strong></span></div>
</form>
</div>

EOD;

print($tbl);	
	}	

////////////////////////////////////////////////////////////////////
//////////////////////Confirma borrar el item
///////////////////////////////////////////////////////////////////


public function DelItem($tabla, $idItem)
  {
	//echo "Entrando a delete";
	mysql_query("DELETE FROM $tabla WHERE $this->ID=$idItem",$this->con) or die('no se pudo eliminar el item solicitado: ' . mysql_error());
	//print('	<center><br><h1>Se ha eliminado el Item Numero: '.$idItem.' de la tabla '.$this->tabla.'</h1><br>
	
	//</center> 
	//');
		//echo "Saliendo de delete ";
	}	
  
  
////////////////////////////////////////////////////////////////////
//////////////////////Confirma borrar el item
///////////////////////////////////////////////////////////////////


public function EliminarRegistros($tabla,$ColFiltro, $ItemElim)
  {
	//echo "Entrando a delete";
	mysql_query("DELETE FROM $tabla WHERE $ColFiltro='$ItemElim'",$this->con) or die('no se pudo eliminar el item solicitado en la tabla: $this->tabla' . mysql_error());
	//print('	<center><br><h1>Se ha eliminado el Item Numero: '.$idItem.' de la tabla '.$this->tabla.'</h1><br>
	
	//</center> 
	//');
		//echo "Saliendo de delete ";
	}	  
  
////////////////////////////////////////////////////////////////////
//////////////////////Ingresa venta
///////////////////////////////////////////////////////////////////


public function GuardaRegistroVentas($tabla, $CamposVenta)
  {
	//$sql="INSERT INTO `servitorno`.`clientes` ( `RazonSocial`, `NIT`, `Direccion`, `Telefono`, `Ciudad`, `Contacto` , `TelContacto`, `Email`) VALUES ('$_POST[TxtNombre]', '$_POST[TxtNIT]', '$_POST[TxtDireccion]', '$_POST[TxtTelefono]', '$_POST[TxtCiudad]', '$_POST[TxtContacto]', '$_POST[TxtCelConta]', '$_POST[TxtEmail]')";
		  
					$sql="INSERT INTO `$this->database`.`$tabla` ( `NumVenta`, `Fecha`, `Productos_idProductos`, `Producto`, `Referencia`, `Cantidad` , `ValorCostoUnitario`, `ValorVentaUnitario`,
					`Impuestos`, `Descuentos`, `TotalCosto`, `TotalVenta`, `TipoVenta`, `CerradoEnPeriodo` , `Especial`, `Clientes_idClientes`, `HoraVenta`, `Usuarios_idUsuarios`, `NoReclamacion`) VALUES ( ";
					
					for($z=2;$z<=20 ;$z++){
						if($z==20)
							$sql=$sql."'$CamposVenta[$z]')";
						else	
							$sql=$sql."'$CamposVenta[$z]', ";
					}
									
					//print_r($sql);
					mysql_query($sql, $this->con) or die('no se pudo registrar la venta en la tabla ventas: ' . mysql_error());	
	}	
    
  
  ////////////////////////////////////////////////////////////////////
//////////////////////Registra movimientos en una tarjeta Kardex
///////////////////////////////////////////////////////////////////


public function RegistrarKardex($tabla, $idProductoTabla, $fecha, $Movimiento, $Detalle, $idDocumento, $Cantidad, $ValorUnitario, $ValorTotal, $idProducto)
  {
	//$sql="INSERT INTO `servitorno`.`clientes` ( `RazonSocial`, `NIT`, `Direccion`, `Telefono`, `Ciudad`, `Contacto` , `TelContacto`, `Email`) VALUES ('$_POST[TxtNombre]', '$_POST[TxtNIT]', '$_POST[TxtDireccion]', '$_POST[TxtTelefono]', '$_POST[TxtCiudad]', '$_POST[TxtContacto]', '$_POST[TxtCelConta]', '$_POST[TxtEmail]')";
		  
	$sql="INSERT INTO `$this->database`.`$tabla` ( `Fecha`, `Movimiento`, `Detalle`, `idDocumento`, `Cantidad`, `ValorUnitario` , `ValorTotal`, `$idProductoTabla`)
	VALUES ( '$fecha','$Movimiento','$Detalle','$idDocumento','$Cantidad','$ValorUnitario','$ValorTotal','$idProducto')";

	mysql_query($sql, $this->con) or die('no se pudo registrar el movimiento en la tabla $tabla: ' . mysql_error());	
	
}	
    
	
	////////////////////////////////////////////////////////////////////
//////////////////////Registra movimientos en una tabla
///////////////////////////////////////////////////////////////////


public function InsertarRegistro($tabla,$NumRegistros,$Columnas,$Valores)
  {
  
  
	//$sql="INSERT INTO `$this->database`.`$tabla` ( `Fecha`, `Movimiento`, `Detalle`, `idDocumento`, `Cantidad`, `ValorUnitario` , `ValorTotal`, `$idProductoTabla`)
	//VALUES ( '$fecha','$Movimiento','$Detalle','$idDocumento','$Cantidad','$ValorUnitario','$ValorTotal','$idProducto')";
	
	
	$sql="INSERT INTO `$this->database`.`$tabla` (";
	$fin=$NumRegistros-1;
	for($i=0;$i<$NumRegistros;$i++){
		$col=$Columnas[$i];
		$reg=$Valores[$i];
		if($fin<>$i)
			$sql=$sql."`$col`,";
		else	
			$sql=$sql."`$col`)";
	}
	$sql=$sql."VALUES (";
	
	for($i=0;$i<$NumRegistros;$i++){
		
		$reg=$Valores[$i];
		if($fin<>$i)
			$sql=$sql."'$reg',";
		else	
			$sql=$sql."'$reg')";
	}
	
	//print_r($sql);
	mysql_query($sql, $this->con) or die("no se pudo ingresar el registro en la tabla $tabla: " . mysql_error());	
	//return(1);
	
}	
 
////////////////////////////////////////////////////////////////////
//////////////////////Devuelve el saldo de un producto de una tarjeta Kardex
///////////////////////////////////////////////////////////////////


public function DevuelveSaldoProducto($tabla,$idTabla,$Filtro,$idProducto)
  {
	//$sql="INSERT INTO `servitorno`.`clientes` ( `RazonSocial`, `NIT`, `Direccion`, `Telefono`, `Ciudad`, `Contacto` , `TelContacto`, `Email`) VALUES ('$_POST[TxtNombre]', '$_POST[TxtNIT]', '$_POST[TxtDireccion]', '$_POST[TxtTelefono]', '$_POST[TxtCiudad]', '$_POST[TxtContacto]', '$_POST[TxtCelConta]', '$_POST[TxtEmail]')";
		  
	$sql="SELECT MAX($idTabla) as MaxId FROM $tabla WHERE $Filtro='$idProducto' and Movimiento='SALDOS'";

	$MaxId=mysql_query($sql, $this->con) or die('no se pudo registrar el movimiento en la tabla $tabla: ' . mysql_error());
	$MaxId=mysql_fetch_array($MaxId);
	$idSaldo=$MaxId["MaxId"];
	
	$sql="SELECT Cantidad as Cantidad FROM $tabla WHERE $idTabla='$idSaldo'";

	$MaxId=mysql_query($sql, $this->con) or die('no se pudo registrar el movimiento en la tabla $tabla: ' . mysql_error());
	$MaxId=mysql_fetch_array($MaxId);
	$SaldoActual=$MaxId["Cantidad"];
	return($SaldoActual);
}	
 
  ////////////////////////////////////////////////////////////////////
//////////////////////Calcula el valor unitario de un producto segun el kardex inventario promedio
///////////////////////////////////////////////////////////////////


public function CalculeValorUnitario($TabKardex,$idTabKardex,$idProducto)
  {
	$sql="SELECT SUM(Cantidad) as Cantidad,  SUM(ValorTotal) as ValorTotal FROM `$this->database`.`$TabKardex` 
		  WHERE $idTabKardex='$idProducto' and Movimiento='ENTRADA'";
	$Resultados=mysql_query($sql, $this->con) or die('no se pudo acceder a la tabla  la venta en la tabla $TabKardex: ' . mysql_error());	
	$Resultados=mysql_fetch_array($Resultados);
	$TotalCantidad=$Resultados["Cantidad"];
	$ValorTotal=$Resultados["ValorTotal"];
	$ValorUnitario=$ValorTotal/$TotalCantidad;
	
	return($ValorUnitario);
	}	
    
  
 public function TableDrawHead()
  {
 
	
//$Columnas=mysql_query("describe $tabla", $this->con) or die('no se pudo conectar: ' . mysql_error());
//$Columnas=mysql_fetch_array($Columnas);	



$Columnas1=mysql_query("select * from $this->tabla", $this->con) or die('no se pudo conectar: ' . mysql_error());
$reg=mysql_fetch_array($Columnas1);	
$numCols=count($reg);

//print_r($Columnas1);
//print_r($Columnas);

print('<form name="formEditInv" id="formEditInv" method="POST" action="EditInv.php" target="_self">
<table border="1"  cellpadding="1" cellspacing="1" align="center" style="width:100%;border-left: 1px solid #000000;
		border-right: 1px solid #000000;
		border-top: 1px solid #000000;
		border-bottom: 1px solid #000000;">
  

 <tr> 
 <td width="200" colspan='.$numCols.' align="center" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
 <input type="submit" src="iconos/add.png" name="agregar" value="'.$this->tabla.'">Agregar a esta tabla</td>
 </tr> <tr> 
 <td width="200" align="center" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'"><h5> Opciones </h5></td>');

for ($i=0; $i<=$numCols; $i++){
	
		$NombreCol[$i]=mysql_field_name($Columnas1,$i);	
		if ($NombreCol[$i]==""){
			unset($NombreCol[$i]); 
			$NombreCol = array_values($NombreCol);//quito el espacio que ha quedado despues de eliminarse 
		}else{
		
			print('<td  width="200" align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'"><h5>'.$NombreCol[$i].'</h5></td>');
		}
			
			
			
}


print('<td width="200"  align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">Total Costo</td>');
print('<td width="200"  align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">Total Venta</td>');


$this->ID=$NombreCol[0];

$numCols=count($NombreCol);
$this->NumCols=$numCols;


	
	
	
	$NumMenor=mysql_query("SELECT MIN($this->ID) as maxnp FROM $this->tabla",$this->con) or die('no se pudo realizar la consulta de minID');
	$minID=mysql_fetch_array($NumMenor);

	$this->minID=$minID[0];
	
	$NumMayor=mysql_query("SELECT MAX($this->ID) as maxnp FROM $this->tabla",$this->con) or die('no se pudo realizar la consulta de maxID');
	$maxID=mysql_fetch_array($NumMayor);

	$this->maxID=$maxID[0];
	
    
	
	print('<tr>');
	
		
		for($i=$this->maxID;$i>=$this->minID;$i--){
			
			$sql="SELECT * FROM $this->tabla WHERE $this->ID = $i";
			$registros=mysql_query($sql, $this->con) or die('no se pudo conectar: ' . mysql_error());
			if($i%2)
						$backgroundRow=$this->back1;
					else
						$backgroundRow=$this->back2;
						
			
			if(mysql_num_rows($registros)){
				
				$registros=mysql_fetch_array($registros);
				
				print('<td align="center" style= "border: 0px solid #000099;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">
				
				<input type="submit" src="iconos/delete.png" onclick="confirmar()" name="borrar" value="'.$this->tabla.';'.$registros[0].'"> _ <input type="image" src="iconos/edit.png" name="editar" value="'.$this->tabla.';'.$registros[0].'">
				
				</td>');
						
				for($z=0;$z<$this->NumCols;$z++){
					//$mod=
					
					print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$registros[$z].'</td>');
				}
				
				$this->TotalFilaCosto=$registros[3]*$registros[4];
				$this->TotalFilaVenta=$registros[3]*$registros[5];
				$this->TotalTablaCosto=$this->TotalTablaCosto + $this->TotalFilaCosto;
				$this->TotalTablaVenta=$this->TotalTablaVenta + $this->TotalFilaVenta;
				print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$this->TotalFilaCosto.'</td>');
				print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$this->TotalFilaVenta.'</td>');
				
				print("</tr><tr nobr=true >");
			}else{
				//echo("No hay resultados");
			}
		}

$EspacioCol=$numCols+1;	
print('</tr><tr>

<td width="200" colspan='.$EspacioCol.' align="right" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
TOTALES
<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$this->TotalTablaCosto.'</td>
<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$this->TotalTablaVenta.'</td>
');

print('</tr></table></form>');

//print($this->NumCols);

} 

/////////////////////////////////////////////////////////////////////
////////////////////Funcion ver inventario para ventas//////////////
/////////////////////////////////////////////////////////////////////

public function TableDrawVender($VentasActivas)
  {
 
//print("Esta es");
//$Columnas=mysql_query("describe $tabla", $this->con) or die('no se pudo conectar: ' . mysql_error());
//$Columnas=mysql_fetch_array($Columnas);	
session_start();


$Columnas1=mysql_query("select * from $this->tabla", $this->con) or die('no se pudo conectar: ' . mysql_error());
$reg=mysql_fetch_array($Columnas1);	
$numCols=count($reg);

//print_r($Columnas1);
//print_r($Columnas);

print('
<form name="formAgregaItems" id="formAgregaItems" method="POST" action="VerInventariosVender.php" target="_self" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
<input type="hidden" name="CbVentasActivas" value="'.$VentasActivas.'">

<table border="1"  cellpadding="1" cellspacing="1" align="center" style="width:100%;border-left: 1px solid #000000;
		border-right: 1px solid #000000;
		border-top: 1px solid #000000;
		border-bottom: 1px solid #000000;">
  

 <tr> 
 <td width="200" colspan="8" align="center" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
 Seleccione un producto</td>
 </tr> <tr> ');

for ($i=0; $i<=$numCols; $i++){
	
		$NombreCol[$i]=mysql_field_name($Columnas1,$i);	
		if ($NombreCol[$i]==""){
			unset($NombreCol[$i]); 
			$NombreCol = array_values($NombreCol);//quito el espacio que ha quedado despues de eliminarse 
		}else{
			if($i<>1 and $i<7)
			print('<td  width="200" align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'"><h5>'.$NombreCol[$i].'</h5></td>');
		}
			
			
			
}


print('<td width="200"  align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">Cantidad</td>');
print('<td width="200"  align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">Agregar</td>');


$this->ID=$NombreCol[0];

$numCols=count($NombreCol);
$this->NumCols=$numCols;


	
	
	
	$NumMenor=mysql_query("SELECT MIN($this->ID) as maxnp FROM $this->tabla",$this->con) or die('no se pudo realizar la consulta de minID');
	$minID=mysql_fetch_array($NumMenor);

	$this->minID=$minID[0];
	
	$NumMayor=mysql_query("SELECT MAX($this->ID) as maxnp FROM $this->tabla",$this->con) or die('no se pudo realizar la consulta de maxID');
	$maxID=mysql_fetch_array($NumMayor);

	$this->maxID=$maxID[0];
	
    
	
	print('<tr>');
	
		
		for($i=$this->minID;$i<=$this->maxID;$i++){
			
			$sql="SELECT * FROM $this->tabla WHERE $this->ID = $i";
			$registros=mysql_query($sql, $this->con) or die('no se pudo conectar: ' . mysql_error());
			if($i%2)
						$backgroundRow=$this->back1;
					else
						$backgroundRow=$this->back2;
						
			
			if(mysql_num_rows($registros)){
				
				$registros=mysql_fetch_array($registros);
				//$idImg=$registros[11];
				//$sql2="SELECT Contenido FROM imagenesproductos WHERE idImagenesProductos = $idImg";
				//$registros3=mysql_query($sql2, $this->con) or die('no se pudo conectar: ' . mysql_error());
				//$registros3=mysql_fetch_array($registros3);
				//print_r($registros3);
				for($z=0;$z<$this->NumCols;$z++){
					//$mod=
					if($z<>1 and $z<7)
						
							print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$registros[$z].'</td>');
						
				
				}
				
			
				print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">
						<input type="number" name="'.$registros[0].'" value="1"  step="any" style="font-size:1em; color:#333; font-family:Arial, sans-serif;"></td>');
				print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">
						<input type="image" src="iconos/add.png" name="agregarItemPreventa" value="'.$registros[0].'">
						</td></td>');
				
				print("</tr><tr nobr=true >");
			}else{
				//echo("No hay resultados");
			}
		}

$EspacioCol=$numCols+1;	
print('</tr><tr>

<td width="200" colspan="8" align="CENTER" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
Techno Soluciones
</td>
');

print('</tr></table></form>');

//print($this->NumCols);

} 


/////////////////////////////////////////////////////////////////////
////////////////////Funcion ver items facturas//////////////
/////////////////////////////////////////////////////////////////////

public function TableDrawFacturas($idCotizacion,$idFactura)
  {
 

//$Columnas=mysql_query("describe $tabla", $this->con) or die('no se pudo conectar: ' . mysql_error());
//$Columnas=mysql_fetch_array($Columnas);	
session_start();


$Columnas1=mysql_query("select * from cotizaciones where NumCotizacion = '$idCotizacion'", $this->con) or die('no se pudo conectar: ' . mysql_error());
$reg=mysql_fetch_array($Columnas1);	
$numCols=count($reg);

//print_r($Columnas1);
//print_r($Columnas);

print('


<table border="1"  cellpadding="1" cellspacing="1" align="center" style="width:100%;border-left: 1px solid #000000;
		border-right: 1px solid #000000;
		border-top: 1px solid #000000;
		border-bottom: 1px solid #000000;">
  

 <tr> 
 <td width="200" colspan="8" align="center" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
 Seleccione un producto</td>
 </tr> <tr> ');

for ($i=0; $i<=$numCols; $i++){
	
		$NombreCol[$i]=mysql_field_name($Columnas1,$i);	
		if ($NombreCol[$i]==""){
			unset($NombreCol[$i]); 
			$NombreCol = array_values($NombreCol);//quito el espacio que ha quedado despues de eliminarse 
		}else{
			if($i<>1 and $i<7)
			print('<td  width="200" align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'"><h5>'.$NombreCol[$i].'</h5></td>');
		}
			
			
			
}


print('<td width="200"  align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">Cantidad</td>');


$this->ID=$NombreCol[0];

$numCols=count($NombreCol);
$this->NumCols=$numCols;


	
	print('<tr>');
	
	$reg=mysql_query("select * from cotizaciones where NumCotizacion = '$idCotizacion' AND Devuelto=''", $this->con) or die('no se pudo conectar a cotizaciones 2: ' . mysql_error());
		$i=0;
		while($datos=mysql_fetch_array($reg)){
		$i++;
		if($i%2)
						$backgroundRow=$this->back1;
					else
						$backgroundRow=$this->back2;
						
			for($z=0;$z<$this->NumCols;$z++){
					//$mod=
					if($z<>1 and $z<7)
						
							print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$datos[$z].'</td>');
						
				
				}
				
			
				print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">
				<form name="formAgregaItems'.$datos[0].'" id="formAgregaItems'.$datos[0].'" method="POST" action="VerFacturas.php" target="_self" >
				<input type="hidden" name="TxtBuscarFactura" value="'.$idFactura.'">
						<textarea type="text" name="TxtObservaciones" value="" placeholder="Observaciones"></textarea>
						<input type="number" name="TxtCantidadDev" value="'.$datos[7].'" min="0" max="'.$datos[7].'" step="any" readonly style="font-size:1em; color:#333; font-family:Arial, sans-serif;">
						<input type="hidden" name="ItemVenta" value="'.$datos[0].'">
						
						<input type="submit" name="BtnDevolver" value="Devolver"></form></td>');
				
				
				print("</tr><tr nobr=true >");
   }
   
		
		

$EspacioCol=$numCols+1;	
print('</tr><tr>

<td width="200" colspan="8" align="CENTER" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
Techno Soluciones
</td>
');

print('</tr></table>');

//print($this->NumCols);

} 


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////Dibujar Preventa/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////


public function TableDrawPreVenta($VentasActivas,$idVentaActiva,$idUsuario,$operacion)
  {
 

//$Columnas=mysql_query("describe $tabla", $this->con) or die('no se pudo conectar: ' . mysql_error());
//$Columnas=mysql_fetch_array($Columnas);	

print("<center><form action='VerInventariosVender.php' method='POST' target='_self'>
		<input type='hidden' name='CbVentasActivas' value='$VentasActivas'>
		<input type='hidden' name='Operacion' value='$operacion'>
		<input type='hidden' name='TxtVentasActivas' value='$idVentaActiva'>
		<input type='hidden' name='TxtIdUsuario' value='$idUsuario'>
		<input type='submit' name='BtnAsignarCliente' value='Asignar Cliente a esta PreVenta'>
		</form></center>
");
$registros=mysql_query("SELECT * FROM preventa PV
INNER JOIN productosventa PRD ON PV.ProductosVenta_idProductosVenta = PRD.idProductosVenta 
WHERE PV.VestasActivas_idVestasActivas='$idVentaActiva' AND PV.Usuarios_idUsuarios='$idUsuario' 

;", $this->con) or die('no se pudo conectar: ' . mysql_error());

$reg=mysql_fetch_array($registros);	


$numCols=count($reg);

//print_r($reg);
//print_r($Columnas);


	

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////Busqueda por teclado////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


print('
<form name="FormAgregaTeclado" id="FormAgregaTeclado" method="POST" action="VerInventariosVender.php" target="_self">
<input type="hidden" name="CbVentasActivas" value="'.$VentasActivas.'">
<input type="hidden" name="Operacion" value="'.$operacion.'">

<table border="1"  cellpadding="1" cellspacing="1" align="center" style="width:100%;border-left: 1px solid #000000;
		border-right: 1px solid #000000;
		border-top: 1px solid #000000;
		border-bottom: 1px solid #000000;">
  

 <tr> 
 <td width="200" colspan="8" align="center" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
 Buscar</td>
 </tr> <tr> <td  align="center" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
Por Codigo de Barras</td>

 <td  align="center" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
Por identificador</td>

 <td align="center" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
Por Nombre</td>
 <tr><td align="center"> <input type="text" name="TxtCodigoBarras" id="idTxtCodigoBarras" placeholder="Ctrl+Q para pagar" value="" onChange="cargarDesdeCB()"> </td> <td align="center">
<input list="ListProductos" name="TxtProdcutos" id="idListProductos" size="50" value="" onChange="cargaDesdeId()">
<datalist id="ListProductos" >
 ');

$reg = mysql_query("SELECT * FROM `productosventa` ",$this->con) or die("La consulta a productos venta es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      print('<option value="'.$datos["idProductosVenta"].';'.$datos["Nombre"].';'.$datos["Existencias"].';'.$datos["PrecioVenta"].';'.$datos["Tipo"].'">');
   }

}


print('</td><td  align="center">
<input list="ListProductosNombre" name="TxtProdcutosNombre" size="50" id="idListProductosNombre" value="" onChange="cargaDesdeNombre()">
<datalist id="ListProductosNombre" >
 ');

$reg = mysql_query("SELECT * FROM `productosventa` ",$this->con) or die("La consulta a productos venta es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      print('<option value="'.$datos["Nombre"].';'.$datos["idProductosVenta"].';'.$datos["Existencias"].';'.$datos["PrecioVenta"].';'.$datos["Tipo"].'">');
   }

}



print('</td></tr>

<tr> <td  align="center" colspan="8"  style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
Facturar</td></tr>
<td colspan="8" align="center">

<input type="button" id="button1" name="BtnPagar" value="Ir a Pagar" onKeypress="IrAPagar(event)">
</td>

<tr> <td  align="center" colspan="8"  style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
Agregar Item</td></tr>
<td colspan="8" align="center">
<input type="text" id="Editbox1" name="TxtIdProducto" value="" readonly>
<input type="text" id="Editbox2" name="TxtNombre" value="" readonly>
<input type="text" id="Editbox3" name="TxtValorUni" value="" readonly>
<input type="number" id="Editbox4" name="TxtCantidadTeclado" value="1" step="any" onKeypress="preguntaConfirm(event)">
</td>



');

print('</table></form>');



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

print('

<table border="1"  cellpadding="1" cellspacing="1" align="center" style="width:100%;border-left: 1px solid #000000;
		border-right: 1px solid #000000;
		border-top: 1px solid #000000;
		border-bottom: 1px solid #000000;">
  

 <tr> 
 <td width="200" colspan="8" align="center" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
 Seleccione un producto</td>
 </tr> <tr> ');

 
for ($i=0; $i<=$numCols; $i++){
	
		$NombreCol[$i]=mysql_field_name($registros,$i);	
		if ($NombreCol[$i]==""){
			unset($NombreCol[$i]); 
			$NombreCol = array_values($NombreCol);//quito el espacio que ha quedado despues de eliminarse 
		}else{
			if($i==2 or $i==15 or $i==17 or $i==19 or $i==9){
				
				if($i==19)	
					print('<td  width="200" align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'"><h5>Precio Sugerido</h5></td> ');
				else
					print('<td  width="200" align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'"><h5>'.$NombreCol[$i].'</h5></td> ');
			
			}
		
		}
			
			
			
}

print('<td  width="200" align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'"><h5>SubTotal</h5></td> ');

print("<tr>");
$this->ID=$this->NombreCol[0];

$numCols=count($this->NombreCol);
$this->NumCols=$numCols;
$this->TotalTablaVenta=0;
//print(mysql_num_rows($registros));
			//$ii=0;
			
			
$registros=mysql_query("SELECT * FROM preventa PV
INNER JOIN productosventa PRD ON PV.ProductosVenta_idProductosVenta = PRD.idProductosVenta 
WHERE PV.VestasActivas_idVestasActivas='$idVentaActiva' AND PV.Usuarios_idUsuarios='$idUsuario' ORDER BY PV.idPrecotizacion DESC

;", $this->con) or die('no se pudo conectar: ' . mysql_error());
			
			if(mysql_num_rows($registros)){
				$i=0;
				//print($i);
				
				while($registros2=mysql_fetch_array($registros)){
					$i++;
					//print_r($registros2);
					if($i%2)
						$backgroundRow=$this->back1;
					else
						$backgroundRow=$this->back2;
					
					//print('<td align="center" style= "border: 0px solid #000099;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">
					//<input type="image" src="iconos/delete.png" onclick="confirmar()" name="borrar" value="'.$this->tabla.';'.$registros2[0].'"> _ <input type="image" src="iconos/edit.png" name="editar" value="'.$this->tabla.';'.$registros2[0].'">');
					
				$h=count($registros2);
					//print($h);
					$f=0;
							
					for($z=0;$z<$h;$z++){
						//$mod=
						if($f==$this->NumCols){
						
							//$this->TotalFilaCosto=$registros2[3]*$registros2[4];
							$this->TotalFilaVenta=$registros2["Cantidad"]*$registros2["ValorAcordado"];
							$this->SubtotalFilas[$registros2[0]]=$this->TotalFilaVenta;
							//$this->TotalTablaCosto=$this->TotalTablaCosto + $this->TotalFilaCosto;
							
						//print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$this->TotalFilaCosto.'</td>');
						
						
							//print("</tr><tr>");
							$f=0;
							}
						if($z==2 or $z==15 or $z==17 or $z==19 or $z==9)	{
							if($z==2){
								print('<td width="400" style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">
								<form name="formAgregaItems'.$registros2[0].'" method="POST" action="VerInventariosVender.php" target="_self" >
								<input type="hidden" name="CbVentasActivas" value="'.$VentasActivas.'">
								<input type="hidden" name="EditarCantidad" value="'.$registros2[0].'">
								<input type="hidden" name="ValUni'.$registros2[0].'" value="'.$registros2["ValorAcordado"].'" >
								
								<input type="number" name="'.$registros2[0].'" value="'.$registros2[$z].'" step="any" style="font-size:1em; color:#333; font-family:Arial, sans-serif;">
								<input type="submit" name="BtnEditarCantidad" value="Editar" ></form>
								<form name="formAgregaItems'.$registros2[0].'" method="POST" action="VerInventariosVender.php" target="_self" >
								<input type="hidden" name="CbVentasActivas" value="'.$VentasActivas.'">
								<input type="hidden" name="BorrarItem" value="'.$registros2[0].'">
								<input type="submit" name="BtnBorrarItem" value="Borrar" style="color: #FF0000"></form></td>');
							
							}else if($z==9){
								print('<td width="400"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">
								<form name="formAgregaItems'.$registros2[0].'" method="POST" action="VerInventariosVender.php" target="_self" >
								<input type="hidden" name="CbVentasActivas" value="'.$VentasActivas.'">
								<input type="hidden" name="EditarCantidad" value="'.$registros2[0].'">
								<input type="hidden" name="'.$registros2[0].'" value="'.$registros2["Cantidad"].'">
								<input type="hidden" name="TxtPrecioMayorista" value="'.$registros2["PrecioMayorista"].'">
								<input type="hidden" name="TxtPrecioNormal" value="'.$registros2["PrecioVenta"].'">
								<input type="number" name="ValUni'.$registros2[0].'" value="'.$registros2[$z].'" step="any" min="'.$registros2["CostoUnitario"].'" style="font-size:1em; color:#333; font-family:Arial, sans-serif;" onkeypress="return event.keyCode!=13">
								');
								
								if($_SESSION['tipouser']=="administrador"){
								print('<input type="submit" name="BtnEditarCantidad" value="Libre" style="color: #00FF00">
								<input type="submit" name="BtnEditarCantidad" value="Normal" style="color: #0000FF">
								<input type="submit" name="BtnEditarCantidad" value="Mayor" style="color: #FF0000">');
								}
								print('</form></td>');
							}else{
								print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$registros2[$z].'</td>');
							
							}
						}
						
						$f++;
					}
					print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'"> $'.number_format($this->TotalFilaVenta).'</td>');
					//$this->TotalTablaVenta=$this->TotalTablaVenta + $this->TotalFilaVenta;
				print("</tr><tr>");
			}
			}
	

			
$registros=mysql_query("SELECT SUM(Descuento) AS Descuento, SUM(Impuestos) as Impuesto , SUM(TotalVenta) as TotalVenta
						FROM preventa WHERE VestasActivas_idVestasActivas=$idVentaActiva", $this->con) or die('no se pudo conectar: ' . mysql_error());

$registros=mysql_fetch_array($registros);	
$impuesto=$registros["Impuesto"];
$Descuento=$registros["Descuento"];
$this->TotalTablaVenta=$registros["TotalVenta"]-$impuesto;
$this->fontCeldas="red";	
//print_r($this->SubtotalFilas);
//$this->TotalTablaVenta=array_sum($this->SubtotalFilas);
//print(number_format($this->TotalTablaVenta));
$total=$registros["TotalVenta"];
print('</tr><tr>


<td width="200" colspan="5" align="right" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
<h1>SUBTOTAL</h1>
<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$this->back2.'"> <h1>$'.number_format($this->TotalTablaVenta).'</h1></td>
</tr><tr><td width="200" colspan="5" align="right" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
<h1>IMPUESTOS</h1>
<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$this->back1.'"><h1> $'.number_format($impuesto).'</h1></td>

</tr><tr><td width="200" colspan="5" align="right" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
<h1>TOTAL</h1>
<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$this->back2.'"> <h1>$'.number_format($total).'</h1></td>

<tr><td width="200" colspan="5" align="right" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
DESCUENTOS APLICADOS A ESTA VENTA
<td width="200" style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$this->back1.'"> $'.number_format($Descuento).'</td>

<tr><td colspan="1" align="center" valign="middle" style="vertical-align: text-middle;" >


');

echo "Genera Comisión?<br><select name=CmbColaboradores size=1 id=CmbColaboradores>
<option value='NO'>Persona que comisiona</option>";

$registros=mysql_query("SELECT * FROM colaboradores", $this->con) or die('no se pudo conectar: ' . mysql_error());
			
	if(mysql_num_rows($registros)){
		while($registros2=mysql_fetch_array($registros)){
			print("<option value='$registros2[idColaboradores]'>$registros2[Nombre]</option>");
		}
}

echo "</select> ";

echo "<br><br><select name=CmbComisiones size=1 id=CmbComisiones>
<option value='NO'>Seleccione el porcentaje</option>";

$registros=mysql_query("SELECT * FROM comisiones", $this->con) or die('no se pudo conectar: ' . mysql_error());
			
	if(mysql_num_rows($registros)){
		while($registros2=mysql_fetch_array($registros)){
			print("<option value='$registros2[Porcentaje]'>$registros2[Porcentaje] %</option>");
		}
}

echo "</select>";

echo '</td><td colspan="2" align="center" valign="middle" style="vertical-align: text-middle;" >
Cotizar<br><a href="Cotizar.php"><img src="iconos/cotizacion.png" style=width:150px;height:150px;></a>';

echo '</td><td colspan="3" align="center" valign="middle" style="vertical-align: text-middle;" >
<br>
<form name="formAgregaItems'.$registros2[0].'" method="POST" action="VerInventariosVender.php" target="_self" >
								<input type="hidden" name="CbVentasActivas" value="'.$VentasActivas.'">
								
Tipo de Venta: <select name=CmbTipoVenta size=1 id=CmbTipoVenta>
	<option value=0>Contado</option>
	<option value=15>a 15 días</option>
	<option value=30>a 30 días</option>
	<option value=45>a 45 días</option>
	<option value=60>a 60 días</option>
	<option value=90>a 90 días</option>
</select>

 <select name=CmbCuentaDestino size=1 id=CmbCuentaDestino>
	<option value=110510>Seleccione la Cuenta Destino</option>';
	
	
$reg = mysql_query("SELECT * FROM `cuentasfrecuentes` WHERE `ClaseCuenta`='ACTIVOS' ",$this->con) or die("La consulta a cuentasfrecuentes es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      echo "<option value= $datos[CuentaPUC]>$datos[Nombre]</option>";
   }

}


echo '</select><br>

<br>Paga: $<input type="number" name="paga" id="paga" step="any" placeholder="Ctrl+S para Guardar" style="font-size:1em; color:#333; font-family:Arial, sans-serif;"
onKeypress="if(event.keyCode == 13) event.returnValue = false;"><br>
<br>Presione para vender:<br><input type="submit" name="Vender" id=Vender value='.$idVentaActiva.'  style=width:150px;height:150px;></input>
<input type=hidden name="TxtBuscar" value=""></input>
<input type=hidden name="Operacion" value=""></input></form>';
print('</tr></table>');

//print($this->NumCols);

} 





////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////Registre Comision/////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////

public function RegistreComision($fecha,$ValorComision, $TipoVenta,$comisionista,$idVenta,$Paga)
{

					
		$tabla="comisionesporventas";
		$NumRegistros=8;
	
		$this->NombresColumnas("colaboradores");
		
		$DatosColaborador=$this->DevuelveValores($comisionista);
							
		$CuentaPUC="233520$comisionista";
		$NombreCuenta="Comision por pagar del colaborador $DatosColaborador[Nombre] CC $DatosColaborador[Identificacion]";
		
		
		
		
		$Columnas[0]="Fecha";							$Valores[0]=$fecha;
		$Columnas[1]="CuentaPUC";						$Valores[1]=$CuentaPUC;
		$Columnas[2]="NombreCuenta";					$Valores[2]=$NombreCuenta;
		$Columnas[3]="Valor";							$Valores[3]=$ValorComision;
		$Columnas[4]="TipoVenta";						$Valores[4]=$TipoVenta;
		$Columnas[5]="Colaboradores_idColaboradores";	$Valores[5]=$comisionista;
		$Columnas[6]="Ventas_NumVenta";					$Valores[6]=$idVenta;
		$Columnas[7]="Paga";							$Valores[7]=$Paga;
							
		$this->InsertarRegistro($tabla,$NumRegistros,$Columnas,$Valores);


}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////Registra venta/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////


public function RegistreVenta($idVentaActiva,$TipoVenta,$CuentaDestino,$Comision,$Comisionista)
  {
 
 $fecha=date("Y-m-d");
 $Hora=date("H:i:s");
 
 //////// Averiguamos el ultimo numero de venta/////////////////////////////////////////////////////////////////////////////////

$this->NombresColumnas("ventas");
$maxID=$this->VerUltimoID();
$campos=$this->DevuelveValores($maxID);
$NumVenta=$campos["NumVenta"];
$NumVenta=$NumVenta+1;

//////// Averiguamos el ultimo numero de factura/////////////////////////////////////////////////////////////////////////////////

$this->NombresColumnas("facturas");
$maxID=$this->VerUltimoID();
$campos=$this->DevuelveValores($maxID);
$NumFact=$campos["idFacturas"];
$NumFact=$NumFact+1;

//////// Averiguamos el ultimo numero de cotizacion/////////////////////////////////////////////////////////////////////////////////

$this->NombresColumnas("cotizaciones");
$maxID=$this->VerUltimoID();
$idCoti=$maxID+1;
$campos=$this->DevuelveValores($maxID);
$NumCot=$campos["NumCotizacion"];
$NumCot=$NumCot+1;

//print("max id de ventas: $maxID, Numero de Venta: $NumVenta");

$DatosVentaActiva=mysql_query("SELECT * FROM vestasactivas WHERE idVestasActivas='$idVentaActiva';", $this->con) or die('problemas para consultas vestasactivas: ' . mysql_error());
$DatosVentaActiva=mysql_fetch_array($DatosVentaActiva);
$idCliente=$DatosVentaActiva["Clientes_idClientes"];

$registros=mysql_query("SELECT * FROM preventa WHERE VestasActivas_idVestasActivas='$idVentaActiva';", $this->con) or die('no se pudo conectar: ' . mysql_error());

//$registros1=mysql_fetch_array($registros);	
			//$this->NombresColumnas("productosventa");
			if(mysql_num_rows($registros)){
				$i=0;
				//print($i);
				
				while($registros2=mysql_fetch_array($registros)){
					$i++;			
					//print("fila $i:///////////////////////////////////////////////////////////////<br>");		
							
					//print_r($registros2);
					$this->NombresColumnas("productosventa");
					$idProducto=$registros2["ProductosVenta_idProductosVenta"];
					$campos=$this->DevuelveValores($idProducto);
					$TotalVenta=$registros2["TotalVenta"]+$registros2["Descuento"];
					$IVA=$registros2["Impuestos"];
					$TotalCostoP=$registros2["Cantidad"]*$campos["CostoUnitario"]; 
					////////empezamos a formar el registro que se hará en ventas empezamos desde porque el id  es autoincrement y el numcuentapuc es conocido
					
					$CamposVenta[2]=$NumVenta;
					$CamposVenta[3]=$fecha;
					$CamposVenta[4]=$idProducto;
					$CamposVenta[5]=$campos["Nombre"];
					$CamposVenta[6]=$campos["Referencia"];
					$CamposVenta[7]=$registros2["Cantidad"];
					$CamposVenta[8]=$campos["CostoUnitario"];
					$CamposVenta[9]=$registros2["ValorAcordado"];
					$CamposVenta[10]=$registros2["Impuestos"];
					$CamposVenta[11]=$registros2["Descuento"];
					$CamposVenta[12]=$registros2["Cantidad"]*$campos["CostoUnitario"]; //Total costo
					$CamposVenta[13]=$TotalVenta;
					$CamposVenta[14]=$TipoVenta;
					$CamposVenta[15]="NO";               //cerrado en periodo
					$CamposVenta[16]=$campos["Especial"];
					$CamposVenta[17]=$idCliente;
					$CamposVenta[18]=$Hora;
					$CamposVenta[19]=$registros2["Usuarios_idUsuarios"];
					$CamposVenta[20]=$NumFact;
					//print_r($CamposVenta);
					
					///////////////////////////Inserto el registro en la tabla ventas
					if($TipoVenta=="Credito" and $idCliente==0)
						exit("Usted está intentando Registrar una venta a credito sin seleccionar un cliente, por favor asignelo a esta venta antes de continuar");
					else	
						$this->GuardaRegistroVentas("ventas", $CamposVenta);
					///////////////////////////Registro el movimiento de SALIDA DE LA VENTA de los productos al Kardex
					
					$Movimiento="SALIDA";
					$Detalle="VENTA";
					$idDocumento=$NumVenta;
					$Cantidad=$registros2["Cantidad"];
					$ValorUnitario=$campos["CostoUnitario"];
					$ValorTotalSalidas=round($Cantidad*$ValorUnitario);
					
					$this->RegistrarKardex("kardexmercancias","ProductosVenta_idProductosVenta",$fecha, $Movimiento, $Detalle, $idDocumento, $Cantidad, $ValorUnitario, $ValorTotalSalidas, $idProducto);
					
					///////////////////////////Registro el movimiento de SALDOS DESPUES DE LA VENTA de los productos al Kardex
					
					$Movimiento="SALDOS";
					$CantidadSaldo=$campos["Existencias"];
					$NuevoSaldo=$CantidadSaldo-$Cantidad;
					$ValorTotal=$NuevoSaldo*$ValorUnitario;
					$this->RegistrarKardex("kardexmercancias","ProductosVenta_idProductosVenta",$fecha, $Movimiento, $Detalle, $idDocumento, $NuevoSaldo, $ValorUnitario, $ValorTotal, $idProducto);
					
					///////////////////////////Actualiza tabla de productos venta
					
					$tabla="productosventa";
					$NumRegistros=1;
					$Columnas[0]="Existencias";
					//$Columnas[1]="CostoUnitario";
					//$Columnas[2]="CostoTotal";
					$Valores[0]=$NuevoSaldo;
					//$Valores[1]=$ValorUnitario;
					//$Valores[2]=$ValorTotal;
					$Filtro="idProductosVenta";
					
					$this->EditeValoresTabla($tabla,$NumRegistros,$Columnas,$Valores,$Filtro,$idProducto);
					
					///////////////////////////Ingresar a Cotizaciones 
					
					
					$tabla="cotizaciones";
					$NumRegistros=16;  
										
					
					$Columnas[0]="Fecha";					$Valores[0]=$fecha;
					$Columnas[1]="NumCotizacion";			$Valores[1]=$NumCot;
					$Columnas[2]="Descripcion";				$Valores[2]=$campos["Nombre"];
					$Columnas[3]="Referencia";				$Valores[3]=$campos["Referencia"];
					$Columnas[4]="ValorUnitario";			$Valores[4]=$registros2["ValorAcordado"];
					$Columnas[5]="Cantidad";				$Valores[5]=$registros2["Cantidad"];
					$Columnas[6]="Subtotal";				$Valores[6]=$registros2["Subtotal"];
					$Columnas[7]="IVA";						$Valores[7]=$IVA;
					$Columnas[8]="Total";					$Valores[8]=round($registros2["Subtotal"]+$IVA);
					$Columnas[9]="Descuento";				$Valores[9]=0;
					$Columnas[10]="ValorDescuento";			$Valores[10]=$registros2["Descuento"];
					$Columnas[11]="Clientes_idClientes";	$Valores[11]=$idCliente;
					$Columnas[12]="Usuarios_idUsuarios";	$Valores[12]=$registros2["Usuarios_idUsuarios"];
					$Columnas[13]="TipoItem";				$Valores[13]="PR";
					$Columnas[14]="PrecioCosto";			$Valores[14]=round($campos["CostoUnitario"]);
					$Columnas[15]="SubtotalCosto";			$Valores[15]=round($campos["CostoUnitario"]*$registros2["Cantidad"]);
					
					$this->InsertarRegistro($tabla,$NumRegistros,$Columnas,$Valores);
					
					
			}
			
			
						
			}
return($NumVenta);	
//echo "Venta Registrada";

} 




////////////////////////////////////////////////////////////////////
//////////////////////Funcion Ver movimientos
///////////////////////////////////////////////////////////////////

public function VerMovimiento($tablaMov,$item)
  {
	
	
//print("buscando $item");
$key_words="$item";

$Columnas1=mysql_query("select * from $tablaMov", $this->con) or die('no se pudo conectar: ' . mysql_error());
$reg=mysql_fetch_array($Columnas1);	
$numCols=count($reg);

//print_r($Columnas1);
//print_r($Columnas);

print('	
<table border="1"  cellpadding="1" cellspacing="1" align="center" style="width:100%;border-left: 1px solid #000000;
		border-right: 1px solid #000000;
		border-top: 1px solid #000000;
		border-bottom: 1px solid #000000;">
  

 <tr> 
 <td width="200" colspan="11" align="center" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
 Movimientos de la tabla '.$this->tabla.'
 </tr> <tr> ');

for ($i=0; $i<=$numCols; $i++){
	
		$NombreCol[$i]=mysql_field_name($Columnas1,$i);	
		if ($NombreCol[$i]==""){
			unset($NombreCol[$i]); 
			$NombreCol = array_values($NombreCol);//quito el espacio que ha quedado despues de eliminarse 
		}else{
		
			print('<td  width="200" align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'"><h5>'.$NombreCol[$i].'</h5></td>');
		}
			
			
			
}

print('<td width="200"  align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">Total Costo</td>');
//print('<td width="200"  align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">Total Venta</td>');

$this->ID=$NombreCol[0];

$numCols=count($NombreCol);
$this->NumCols=$numCols;


	print('
  

		<tr> 
		');
	
		
			$sql="SELECT * FROM $tablaMov WHERE $NombreCol[4] LIKE '%$this->tabla%' ORDER BY $this->ID DESC";
			//for($z=2;$z<$this->NumCols;$z++){
			//	$sql=$sql." OR $NombreCol[$z] LIKE '%$key_words%' ";
			//}
			$registros=mysql_query($sql, $this->con) or die('no se pudo conectar: ' . mysql_error());
			
						
			//print(mysql_num_rows($registros));	
			if(mysql_num_rows($registros)){
				$i=0;
				while($registros2=mysql_fetch_array($registros)){
					$i++;
					if($i%2)
						$backgroundRow=$this->back1;
					else
						$backgroundRow=$this->back2;
					
					//print('<td align="center" style= "border: 0px solid #000099;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">
					//<input type="image" src="iconos/delete.png" onclick="confirmar()" name="borrar" value="'.$this->tabla.';'.$registros2[0].'"> _ <input type="image" src="iconos/edit.png" name="editar" value="'.$this->tabla.';'.$registros2[0].'">');
					
				$h=count($registros2);
					//print($h);
					$f=0;
					for($z=0;$z<$h;$z++){
						//$mod=
						if($f==$this->NumCols){
						
						$this->TotalFilaCosto=$registros2[7]*$registros2[8];
						//$this->TotalFilaVenta=$registros2[3]*$registros2[5];
						$this->TotalTablaCosto=$this->TotalTablaCosto + $this->TotalFilaCosto;
						//$this->TotalTablaVenta=$this->TotalTablaVenta + $this->TotalFilaVenta;
						print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$this->TotalFilaCosto.'</td>');
						//print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$this->TotalFilaVenta.'</td>');
							print("</tr><tr>");
							$f=0;
							}
						print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$registros2[$z].'</td>');
						$f++;
						
					}
					
				print("</tr><tr>");
			}
			}
			
$EspacioCol=$numCols;	
print('</tr><tr>

<td width="200" colspan='.$EspacioCol.' align="right" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
TOTAL
<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$this->TotalTablaCosto.'</td>

');

print('</tr></table></form>');


  }
//print_r($NombreCol);	
//echo"$Columnas[0], $Columnas[1], $Columnas[5]";
	


	
	
/////////////////////////////////////////////////////////////////////
////////////////////Funcion Buscar en inventario para ventas//////////////
/////////////////////////////////////////////////////////////////////

public function BuscarInventario($VentasActivas,$item)
  {
 
//echo("Entrando a buscar");
//$Columnas=mysql_query("describe $tabla", $this->con) or die('no se pudo conectar: ' . mysql_error());
//$Columnas=mysql_fetch_array($Columnas);	
session_start();

$key_words="$item";



//print_r($Columnas1);
//print_r($Columnas);

print('
<form name="formAgregaItems" id="formAgregaItems" method="POST" action="VerInventariosVender.php" target="_self">
<input type="hidden" name="CbVentasActivas" value="'.$VentasActivas.'">

<table border="1"  cellpadding="1" cellspacing="1" align="center" style="width:100%;border-left: 1px solid #000000;
		border-right: 1px solid #000000;
		border-top: 1px solid #000000;
		border-bottom: 1px solid #000000;">
  

 <tr> 
 <td width="200" colspan="8" align="center" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
 Seleccione un producto</td>
 </tr> <tr> ');


for ($i=0; $i<=$this->NumCols; $i++){
	
	
			if($i<>1 and $i<7)
			print('<td  width="200" align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'"><h5>'.$this->NombreCol[$i].'</h5></td>');
		
			
			
			
}
 

print('<td width="200"  align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">Cantidad</td>');
print('<td width="200"  align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">Agregar</td>');
    
	
	print('<tr>');
	
		
		//for($i=$this->maxID;$i>=$this->minID;$i--){
			//print_r($this->NombreCol);
			$sql="SELECT * FROM $this->tabla WHERE ".$this->NombreCol[1]." LIKE '%$key_words%' ";
			for($z=2;$z<$this->NumCols;$z++){
				$sql=$sql." OR ".$this->NombreCol[$z]." LIKE '%$key_words%' ";
			}
			
			//print_r($sql);
			$registros=mysql_query($sql, $this->con) or die('no se pudo conectar: ' . mysql_error());
			//$registros=mysql_fetch_array($registros);
			//print_r($registros);
			if($i%2)
						$backgroundRow=$this->back1;
					else
						$backgroundRow=$this->back2;
						
			
			if(mysql_num_rows($registros)){
				
				while($registros2=mysql_fetch_array($registros)){
				//$idImg=$registros[11];
				//$sql2="SELECT Contenido FROM imagenesproductos WHERE idImagenesProductos = $idImg";
				//$registros3=mysql_query($sql2, $this->con) or die('no se pudo conectar: ' . mysql_error());
				//$registros3=mysql_fetch_array($registros3);
				//print_r($registros3);
				for($z=0;$z<$this->NumCols;$z++){
					//$mod=
					if($z<>1 and $z<7)
						
							print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$registros2[$z].'</td>');
						
				
				}
				
			
				print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">
						<input type="number" name="'.$registros2[0].'" value="1"  step="any" style="font-size:1em; color:#333; font-family:Arial, sans-serif;"></td>');
				print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">
						<input type="submit" src="iconos/add.png" name="agregarItemPreventa" value="'.$registros2[0].'">
						</td></td>');
				
				print("</tr><tr nobr=true >");
				
				}
			}else{
				//echo("No hay resultados");
			}
		

$EspacioCol=$numCols+1;	
print('</tr><tr>

<td width="200" colspan="8" align="CENTER" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
Techno Soluciones
</td>
');

print('</tr></table></form>');

//print($this->NumCols);

} 

////////////////////////////////////////////////////////////////////
//////////////////////Funcion Buscar Item
///////////////////////////////////////////////////////////////////

public function BuscaItem($item)
  {
	
	
//print("buscando $item");
$key_words="$item";


$Columnas1=mysql_query("select * from $this->tabla", $this->con) or die('no se pudo conectar: ' . mysql_error());
$reg=mysql_fetch_array($Columnas1);	
$numCols=count($reg);

//print_r($Columnas1);
//print_r($Columnas);

print('	<form name="formEditInv" id="formEditInv" method="POST" action="EditInv.php" target="_self">
<table border="1"  cellpadding="1" cellspacing="1" align="center" style="width:100%;border-left: 1px solid #000000;
		border-right: 1px solid #000000;
		border-top: 1px solid #000000;
		border-bottom: 1px solid #000000;">
  

 <tr> 
 <td width="200" colspan='.$numCols.' align="center" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
 <input type="submit" src="iconos/add.png" onclick="confirmar()" name="agregar" value="'.$this->tabla.';0">Agregar a esta tabla</td>
 
 </tr> <tr> 
 <td width="200" align="center" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'"><h5> Opciones </h5></td>');

for ($i=0; $i<=$numCols; $i++){
	
		$NombreCol[$i]=mysql_field_name($Columnas1,$i);	
		if ($NombreCol[$i]==""){
			unset($NombreCol[$i]); 
			$NombreCol = array_values($NombreCol);//quito el espacio que ha quedado despues de eliminarse 
		}else{
		
			print('<td  width="200" align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'"><h5>'.$NombreCol[$i].'</h5></td>');
		}
			
			
			
}

print('<td width="200"  align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">Total Costo</td>');
print('<td width="200"  align="center" style= "border: 0px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">Total Venta</td>');

$this->ID=$NombreCol[0];

$numCols=count($NombreCol);
$this->NumCols=$numCols;


	print('
  

		<tr> 
		');
	
		
			$sql="SELECT * FROM $this->tabla WHERE $NombreCol[1] LIKE '%$key_words%' ";
			for($z=2;$z<$this->NumCols;$z++){
				$sql=$sql." OR $NombreCol[$z] LIKE '%$key_words%' ";
			}
			$registros=mysql_query($sql, $this->con) or die('no se pudo conectar: ' . mysql_error());
			
						
			//print(mysql_num_rows($registros));	
			if(mysql_num_rows($registros)){
				$i=0;
				while($registros2=mysql_fetch_array($registros)){
					$i++;
					if($i%2)
						$backgroundRow=$this->back1;
					else
						$backgroundRow=$this->back2;
					
					print('<td align="center" style= "border: 0px solid #000099;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">
					<input type="submit" src="iconos/delete.png" onclick="confirmar()" name="borrar" value="'.$this->tabla.';'.$registros2[0].'"> _ <input type="submit" src="iconos/edit.png" name="editar" value="'.$this->tabla.';'.$registros2[0].'">');
					
				$h=count($registros2);
					//print($h);
					$f=0;
					for($z=0;$z<$h;$z++){
						//$mod=
						if($f==$this->NumCols){
						
						$this->TotalFilaCosto=$registros2[3]*$registros2[4];
						$this->TotalFilaVenta=$registros2[3]*$registros2[5];
						$this->TotalTablaCosto=$this->TotalTablaCosto + $this->TotalFilaCosto;
						$this->TotalTablaVenta=$this->TotalTablaVenta + $this->TotalFilaVenta;
						print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$this->TotalFilaCosto.'</td>');
						print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$this->TotalFilaVenta.'</td>');
							print("</tr><tr>");
							$f=0;
							}
						print('<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$registros2[$z].'</td>');
						$f++;
						
					}
					
				print("</tr><tr>");
			}
			}
			
$EspacioCol=$numCols+1;	
print('</tr><tr>

<td width="200" colspan='.$EspacioCol.' align="right" style= "border: 1px solid #000099;color:'.$this->fontHeader.';font: oblique 100% sans-serif bold;background-color:'.$this->backHeader.'">
TOTALES
<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$this->TotalTablaCosto.'</td>
<td width="200"  style= "border: 0px solid #000000;color:'.$this->fontCeldas.';font: oblique 100% sans-serif bold;background-color:'.$backgroundRow.'">'.$this->TotalTablaVenta.'</td>
');

print('</tr></table></form>');


  }
//print_r($NombreCol);	
//echo"$Columnas[0], $Columnas[1], $Columnas[5]";
	

}



?>


</body>
</html>
