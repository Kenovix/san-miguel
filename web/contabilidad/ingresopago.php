<?php
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.php");

$NombreUsuario="$_SESSION[nombre] $_SESSION[apellido]";
$idUsuario=$_SESSION["idUser"];

error_reporting(0);
include("classes_servi/CreaTablasMysql.php");
$tab = "librodiario";
 $tabla=  new Mytable($servi,$baseDatos,$usuario,$passsword,$tab);
$tabla->conectar();

  $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

$CuentaOrigen=$_POST["CmbCuentaOrigen"];  
$fecha=date("Y-m-d");
$hora=date("H:i:s");
$Observaciones=$_POST["TxtObservaciones"];
$idEgresos=$_POST["idEgresos"];

$Sal = mysql_query("SELECT * FROM egresos WHERE idEgresos='$idEgresos'",$con) or die("Problemas en la consulta a egresos");	
$Sal = mysql_fetch_array($Sal);
$Cuenta=$Sal["Cuenta"];
$idProveedor=$Sal["idProveedor"];
$Valor=$Sal["Valor"];
 

	$Cuenta="caja";

	$idCuenta="idCaja";

 
$Sal = mysql_query("SELECT MAX($idCuenta) as MaxItem FROM $Cuenta",$con) or die("Problemas en la consulta a $Cuenta");	
$Sal = mysql_fetch_array($Sal);
 $idCaja=$Sal["MaxItem"];
 
 
 
 $Sal = mysql_query("SELECT Saldo FROM $Cuenta WHERE $idCuenta = '$idCaja'",$con) or die("Problemas en la consulta $Cuenta saldo");	
 $Sal = mysql_fetch_array($Sal);
 $Saldo=$Sal["Saldo"];
 
 $Saldo=$Saldo - $_POST["TxtValor"];
 
 
 
$sql="INSERT INTO `$Cuenta` ( `Fecha`, `Movimiento`, `Hora`, `Observaciones`, `MontoMov`, `Saldo`, `Ingresos_idIngresos`, `Egresos_idEgresos` ) VALUES ('$fecha', 'EGRESO', '$hora', '$Observaciones', '$_POST[TxtValor]', '$Saldo' , 'NO' , '$idEgresos');";
	 mysql_query($sql,$con) or die("No se ingresaron los datos en la caja");	 

////////////////////////////////////////////////////////////////////
/////////////////////Actualizo el estado del egreso/////////////////
////////////////////////////////////////////////////////////////////	

$sql = "UPDATE `egresos` SET `PagoProg` = 'Pagado',
			`FechaPago` = '$fecha',
			`Usuario_idUsuario` = '$idUsuario',
			`CerradoDiario` = ''
 WHERE `egresos`.`idEgresos` = '$idEgresos'; ";
$r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
 

 /////////////////////////////////////////////////////////////////
		//////registramos en libro diario
		
		$tabla->NombresColumnas("proveedores");
		$DatosProveedor=$tabla->DevuelveValores($idProveedor);
		$RazonSocial=$DatosProveedor["RazonSocial"];
		$NIT=$DatosProveedor["Num_Identificacion"];
		
		$tab="librodiario";
		
		$NumRegistros=24;
		$CuentaPUC="2205".$idProveedor;   
		
		$NombreCuenta="Proveedores Nacionales $RazonSocial $NIT";
		
		
		
		$Columnas[0]="Fecha";					$Valores[0]=$fecha;
		$Columnas[1]="Tipo_Documento_Intero";	$Valores[1]="CompEgreso";
		$Columnas[2]="Num_Documento_Interno";	$Valores[2]=$idEgresos;
		$Columnas[3]="Tercero_Tipo_Documento";	$Valores[3]=$DatosProveedor['Tipo_Documento'];
		$Columnas[4]="Tercero_Identificacion";	$Valores[4]=$NIT;
		$Columnas[5]="Tercero_DV";				$Valores[5]=$DatosProveedor['DV'];
		$Columnas[6]="Tercero_Primer_Apellido";	$Valores[6]=$DatosProveedor['Primer_Apellido'];
		$Columnas[7]="Tercero_Segundo_Apellido";$Valores[7]=$DatosProveedor['Segundo_Apellido'];
		$Columnas[8]="Tercero_Primer_Nombre";	$Valores[8]=$DatosProveedor['Primer_Nombre'];
		$Columnas[9]="Tercero_Otros_Nombres";	$Valores[9]=$DatosProveedor['Otros_Nombres'];
		$Columnas[10]="Tercero_Razon_Social";	$Valores[10]=$RazonSocial;
		$Columnas[11]="Tercero_Direccion";		$Valores[11]=$DatosProveedor['Direccion'];
		$Columnas[12]="Tercero_Cod_Dpto";		$Valores[12]=$DatosProveedor['Cod_Dpto'];
		$Columnas[13]="Tercero_Cod_Mcipio";		$Valores[13]=$DatosProveedor['Cod_Mcipio'];
		$Columnas[14]="Tercero_Pais_Domicilio";  $Valores[14]=$DatosProveedor['Pais_Domicilio'];
		
		$Columnas[15]="CuentaPUC";				$Valores[15]=$CuentaPUC;
		$Columnas[16]="NombreCuenta";			$Valores[16]=$NombreCuenta;
		$Columnas[17]="Detalle";				$Valores[17]="Pago a Proveedor";
		$Columnas[18]="Debito";					$Valores[18]=$Valor;
		$Columnas[19]="Credito";				$Valores[19]="0";
		$Columnas[20]="Neto";					$Valores[20]=$Valor;
		$Columnas[21]="Mayor";					$Valores[21]="NO";
		$Columnas[22]="Esp";					$Valores[22]="NO";
		$Columnas[23]="Concepto";				$Valores[23]="Pagos";
							
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		/////////////////////////////////////////////////////////////////
		//////contra partida
		
			
			
		$CuentaPUC=$CuentaOrigen; //cuenta de donde sacaremos el valor del egreso
		$tabla->NombresColumnas("cuentasfrecuentes");
		$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
		$NombreCuenta=$DatosCuenta["Nombre"];
		
				
		$Valores[15]=$CuentaPUC;
		$Valores[16]=$NombreCuenta;
		$Valores[18]="0";
		$Valores[19]=$Valor; 						//Credito se escribe el total de la venta menos los impuestos
		$Valores[20]=$Valor*(-1);  											//Credito se escribe el total de la venta menos los impuestos
		
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
 
		 echo "Se agregó el pago a la base de datos, se actualizó $Cuenta y se retiró el egreso de pagos pendientes";
	
			
?>