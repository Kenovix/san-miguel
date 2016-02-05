<?php
//include("conexion.php");
error_reporting(0);
include("classes_servi/CreaTablasMysql.php");
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.php");
   
if(    isset($_POST["TxtPago"]) &&  is_numeric($_POST["TxtPago"]) && !empty($_POST["TxtPago"]) 
			
		)
	   {
		   
////////////////////////////////////////////////////////////////////
/////////////////////se registra en ingresos/////////////////////////////
////////////////////////////////////////////////////////////////////

	
		  $fecha=$_POST["TxtFechaPago"];
		  $hora=date("H:i:s");
		  if (isset($_POST["TxtObservacionesPago"])){
			  $Observaciones="Pago ingresado por: $_SESSION[nombre] $_SESSION[apellido] el $fecha siendo las $hora y escribió: $_POST[TxtObservacionesPago]";
		  }else{
			  $Observaciones="Pago ingresado por: $_SESSION[nombre] $_SESSION[apellido] el $fecha siendo las $hora sin registrar observaciones";
		  }
		  
		  
		  $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
		  mysql_select_db($db,$con) or die("la base de datos no abre");
		  
		  $sql="INSERT INTO `ingresos` ( `Observaciones`, `Total`, `Fecha`,`Facturas_idFacturas`,`Usuarios_idUsuarios` ) 
		  VALUES ('$Observaciones', '$_POST[TxtSaldo]',  '$fecha', '$_POST[idFactura]','$_SESSION[idUser]')";
		  
		 mysql_query($sql,$con) or die("Problemas al ingresar el pago a la base de datos");
		 
		 
////////////////////////////////////////////////////////////////////
/////////////////////ingresa a la caja/////////////////////////////
////////////////////////////////////////////////////////////////////	

$Sal = mysql_query("SELECT MAX(idCaja) as MaxItem FROM caja",$con) or die("Problemas en la consulta a la caja");	
$Sal = mysql_fetch_array($Sal);
 $idCaja=$Sal["MaxItem"];
 
 $Sal = mysql_query("SELECT MAX(idIngresos) as MaxItem FROM ingresos",$con) or die("Problemas en la consulta a la caja");	
$Sal = mysql_fetch_array($Sal);
$idIngresos=$Sal["MaxItem"];

 $Sal = mysql_query("SELECT Saldo FROM caja WHERE idCaja = '$idCaja'",$con) or die("Problemas en la consulta a la caja");	
 $Sal = mysql_fetch_array($Sal);
 $Saldo=$Sal["Saldo"];
 
 $Saldo=$Saldo + $_POST["TxtPago"];
 
$sql="INSERT INTO `caja` ( `Fecha`, `Movimiento`, `Hora`, `Observaciones`, `MontoMov`, `Saldo`, `Ingresos_idIngresos`, `Egresos_idEgresos` )
 VALUES ('$fecha', 'INGRESO', '$hora', '$Observaciones', '$_POST[TxtPago]', '$Saldo' , '$idIngresos' , 'NO');";
	 mysql_query($sql,$con) or die("No se ingresaron los datos en la caja");	 

////////////////////////////////////////////////////////////////////
/////////////////////Retirar factura de cartera a la caja/////////////////////////////
////////////////////////////////////////////////////////////////////	

mysql_query("DELETE FROM cartera WHERE Facturas_idFacturas='$_POST[idFactura]'",$con) or die("No se pudo borrar la factura de la cartera");	

////////////////////////////////////////////////////////////////////
/////////////////////Obtengo Datos del Cliente/////////////////////////////
////////////////////////////////////////////////////////////////////	

$IDCliente=$_POST['IDCliente'];
$idFacturas=$_POST["idFactura"];
$sel1=mysql_query("SELECT * FROM `clientes` WHERE idClientes= '$IDCliente' ",$con) or die("Problemas al consultar los datos en clientes");
$DatosCliente=mysql_fetch_array($sel1);		
		
///////////////////////////////////////////////////////////
/////////////Se realizan asientos contables ///////////////
///////////////////////////////////////////////////////////
		
		
		$tab="librodiario";
		$tabla=  new Mytable($servi,$baseDatos,$usuario,$passsword,$tab);
		$tabla->conectar();
		
		
		/////////////////////////////////////////////////////////////////
		//////registramos en libro diario
		
		$tab="librodiario";
		$NumRegistros=24;
		$CuentaPUC="130505$IDCliente";
		$NombreCuenta="Cartera del cliente $DatosCliente[RazonSocial] NIT $DatosCliente[Num_Identificacion]";
		$Detalle="Pago de factura";	
		$NIT=$DatosCliente['Num_Identificacion'];
		
		$Columnas[0]="Fecha";					$Valores[0]=$fecha;
		$Columnas[1]="Tipo_Documento_Intero";	$Valores[1]="FACTURA";
		$Columnas[2]="Num_Documento_Interno";	$Valores[2]=$idFacturas;
		$Columnas[3]="Tercero_Tipo_Documento";	$Valores[3]=$DatosCliente['Tipo_Documento'];
		$Columnas[4]="Tercero_Identificacion";	$Valores[4]=$NIT;
		$Columnas[5]="Tercero_DV";				$Valores[5]=$DatosCliente['DV'];
		$Columnas[6]="Tercero_Primer_Apellido";	$Valores[6]=$DatosCliente['Primer_Apellido'];
		$Columnas[7]="Tercero_Segundo_Apellido";$Valores[7]=$DatosCliente['Segundo_Apellido'];
		$Columnas[8]="Tercero_Primer_Nombre";	$Valores[8]=$DatosCliente['Primer_Nombre'];
		$Columnas[9]="Tercero_Otros_Nombres";	$Valores[9]=$DatosCliente['Otros_Nombres'];
		$Columnas[10]="Tercero_Razon_Social";	$Valores[10]=$DatosCliente["RazonSocial"];
		$Columnas[11]="Tercero_Direccion";		$Valores[11]=$DatosCliente['Direccion'];
		$Columnas[12]="Tercero_Cod_Dpto";		$Valores[12]=$DatosCliente['Cod_Dpto'];
		$Columnas[13]="Tercero_Cod_Mcipio";		$Valores[13]=$DatosCliente['Cod_Mcipio'];
		$Columnas[14]="Tercero_Pais_Domicilio";  $Valores[14]=$DatosCliente['Pais_Domicilio'];
		
		$Columnas[15]="CuentaPUC";				$Valores[15]=$CuentaPUC;
		$Columnas[16]="NombreCuenta";			$Valores[16]=$NombreCuenta;
		$Columnas[17]="Detalle";				$Valores[17]=$Detalle;
		$Columnas[18]="Debito";					$Valores[18]=0;
		$Columnas[19]="Credito";				$Valores[19]=round($_POST["TxtTotal"]);
		$Columnas[20]="Neto";					$Valores[20]=$Valores[19]*(-1);
		$Columnas[21]="Mayor";					$Valores[21]="NO";
		$Columnas[22]="Esp";					$Valores[22]="NO";
		$Columnas[23]="Concepto";				$Valores[23]=$Detalle;
							
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		///////////////////////////////////////////////////////////////
		////////////Registramos Ingreso
		
			$CuentaPUC=$_POST['CmbCuentaDestino']; 
			$tabla->NombresColumnas("cuentasfrecuentes");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=$_POST["TxtPago"];     //Valor Final que pagó el cliente
			$Valores[19]=0; 			
			$Valores[20]=$_POST["TxtPago"];  	//para la sumatoria contemplar el balance
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		
		///////////////////////////////////////////////////////////////
		////////////Se verifica si hay retenciones y se realizan asientos
		$sel1=mysql_query("SELECT * FROM facturas_reten_aplicadas RFact INNER JOIN impret Ret ON RFact.idImpRet=Ret.idImpRet
		WHERE RFact.Facturas_idFacturas= '$idFacturas' ",$con) or die("Problemas al consultar los datos en retenciones facturas ".mysql_error());

		if(mysql_num_rows($sel1)){
	
			while($DatosRetenciones = mysql_fetch_array($sel1)){	
		
				$CuentaPUC=$DatosRetenciones['CuentaRetFavor']; //  Cuentas por pagar Autorretenciones CREE
				$tabla->NombresColumnas("subcuentas");
				$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
				$NombreCuenta=$DatosCuenta["Nombre"];
				
				$Valores[15]=$CuentaPUC;
				$Valores[16]=$NombreCuenta;
				$Valores[18]=round($DatosRetenciones['Monto']);
				$Valores[19]= 0;			
				$Valores[20]=$Valores[18];  	//para la sumatoria contemplar el balance
				
				$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
			}
		}
		
////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////		
		 echo "Se agregó el pago a la base de datos, a la caja y se retiró la factura de la cartera";
	}else{
		echo "por favor digite un pago valido solo numeros y/o punto "." como separador decimal";
	}
			
?>