<?php
 session_start();
   if(!isset($_SESSION["username"])){
   header("Location: index.php");
}


$fechaActual=date("Y-m-d");

error_reporting(0);

//include("conexion.php");
include("classes_servi/CreaTablasMysql.php");

$tab = "librodiario";
$fecha = $_POST["TxtFecha"];
$hora=date("H:i:s");
$idUsuario=$_SESSION["idUser"];

$tabla=  new Mytable($servi,$baseDatos,$usuario,$passsword,$tab);
$tabla->conectar();
//$tabla->NombresColumnas($tab);

if(isset($_POST["TxtPagaArriendo"]))
	$accion="PagaArriendo";
if(isset($_POST["TxtPagaServicios"]))
	$accion="PagaServicios";
if(isset($_POST["TxtGastosVarios"]))
	$accion="GastosVarios";
if(isset($_POST["TxPagarBancos"]))
	$accion="PagarBancos";
if(isset($_POST["TxtCompraMercancias"]))
	$accion="CompraMercancias";
if(isset($_POST["TxtPagaContratistas"]))
	$accion="PagaContratistas";


$TotalRetenciones=0;
/////////////////////////////////////////////////////////
///////////////Ingresamos un pago de arriendo///////////
////////////////////////////////////////////////////////
if($accion=="PagaArriendo"){

	if(
		isset($_POST["TxtConcepto"]) and !empty($_POST["TxtConcepto"]) and
		isset($_POST["TxtValor"]) and is_numeric($_POST["TxtValor"]) 
		
		
		){
		
		if($_POST["CmbCuentaOrigen"]=="NO" or $_POST["CmbCuentaDestino"]=="NO")
			exit("Debe seleccionar una cuenta Origen y una Cuenta Destino");
		//echo"entra a paga arriendo";
		
		$CuentaOrigen=$_POST["CmbCuentaOrigen"];
		$idProveedor=$_POST["CmbCuentaDestino"];
		$Concepto=$_POST["TxtConcepto"];
		//$Concepto=$Concepto." Arriendos Egreso registrado por $_SESSION[nombre] $_SESSION[apellido] el $fechaActual";
		$Valor=$_POST["TxtValor"];
		
		//////registramos en egresos
		
		$NumRegistros=16;
		$tabla->NombresColumnas("proveedores");
		$DatosProveedor=$tabla->DevuelveValores($idProveedor);
		$RazonSocial=$DatosProveedor["RazonSocial"];
		$NIT=$DatosProveedor["Num_Identificacion"];
		
		
		
		$Columnas[0]="Fecha";				$Valores[0]=$fecha;
		$Columnas[1]="Beneficiario";		$Valores[1]=$RazonSocial;
		$Columnas[2]="NIT";					$Valores[2]=$NIT;
		$Columnas[3]="Concepto";			$Valores[3]=$Concepto;
		$Columnas[4]="Valor";				$Valores[4]=$Valor;
		$Columnas[5]="Usuario_idUsuario";	$Valores[5]=$idUsuario;
		$Columnas[6]="PagoProg";			$Valores[6]=$_POST["TipoPago"];
		$Columnas[7]="FechaPagoPro";		$Valores[7]=$_POST["TxtFechaProgram"];
		$Columnas[8]="TipoEgreso";			$Valores[8]="Arriendos";
		$Columnas[9]="Direccion";			$Valores[9]=$DatosProveedor["Direccion"];
		$Columnas[10]="Ciudad";				$Valores[10]=$DatosProveedor["Ciudad"];
		$Columnas[11]="Subtotal";			$Valores[11]=$Valor;
		$Columnas[12]="IVA";				$Valores[12]=0;
		$Columnas[13]="NumFactura";			$Valores[13]="";
		$Columnas[14]="idProveedor";		$Valores[14]=$idProveedor;
		$Columnas[15]="Cuenta";				$Valores[15]=$CuentaOrigen;
							
		$tabla->InsertarRegistro("egresos",$NumRegistros,$Columnas,$Valores);
		
		/////////////////////////////////////////////////////////////////
		//////registramos en libro diario
		
		$tab="librodiario";
		$tabla->NombresColumnas("egresos");
		$NumEgreso=$tabla->VerUltimoID();
		$NumRegistros=24;
		$CuentaPUC=5220;   /////Arrendamientos
		$tabla->NombresColumnas("cuentas");
		$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
		$NombreCuenta=$DatosCuenta["Nombre"];
		
		
		
		$Columnas[0]="Fecha";					$Valores[0]=$fecha;
		$Columnas[1]="Tipo_Documento_Intero";	$Valores[1]="CompEgreso";
		$Columnas[2]="Num_Documento_Interno";	$Valores[2]=$NumEgreso;
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
		$Columnas[17]="Detalle";				$Valores[17]="egresos";
		$Columnas[18]="Debito";					$Valores[18]=$Valor;
		$Columnas[19]="Credito";				$Valores[19]="0";
		$Columnas[20]="Neto";					$Valores[20]=$Valor;
		$Columnas[21]="Mayor";					$Valores[21]="NO";
		$Columnas[22]="Esp";					$Valores[22]="NO";
		$Columnas[23]="Concepto";				$Valores[23]=$Concepto;
							
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		/////////////////////////////////////////////////////////////////
		//////contra partida
		if($_POST["TipoPago"]=="Contado"){
			
			
			$CuentaPUC=$CuentaOrigen; //cuenta de donde sacaremos el valor del egreso
			$tabla->NombresColumnas("cuentasfrecuentes");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
		}
		if($_POST["TipoPago"]=="Programado"){
			$CuentaPUC="2205".$idProveedor;
			$NombreCuenta="Proveedor Nacional $RazonSocial $NIT";
		}
		
		
		$Valores[15]=$CuentaPUC;
		$Valores[16]=$NombreCuenta;
		$Valores[18]="0";
		$Valores[19]=$Valor; 						//Credito se escribe el total de la venta menos los impuestos
		$Valores[20]=$Valor*(-1);  											//Credito se escribe el total de la venta menos los impuestos
		
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		////////////////////////////////////////////////////////////////////
/////////////////////ingresa a la caja/////////////////////////////
////////////////////////////////////////////////////////////////////	

		if($_POST["TipoPago"]=="Contado"){
			
			$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
			mysql_select_db($db,$con) or die("la base de datos no abre");
		
			$Sal = mysql_query("SELECT MAX(idCaja) as MaxItem FROM caja",$con) or die("Problemas en la consulta a la caja ".mysql_error());	
			$Sal = mysql_fetch_array($Sal);
			$idCaja=$Sal["MaxItem"];
			 
			 $Sal = mysql_query("SELECT Saldo FROM caja WHERE idCaja = '$idCaja'",$con) or die("Problemas en la consulta a la caja ".mysql_error());	
			 $Sal = mysql_fetch_array($Sal);
			 $Saldo=$Sal["Saldo"];
			$MontoMov = $_POST["TxtValor"]-$TotalRetenciones;
			 $Saldo=$Saldo - $MontoMov;
			 
			$sql="INSERT INTO `caja` ( `Fecha`, `Movimiento`, `Hora`, `Observaciones`, `MontoMov`, `Saldo`, `Ingresos_idIngresos`, `Egresos_idEgresos` )
			VALUES ('$fecha', 'EGRESO', '$hora', '$Concepto', '$MontoMov', '$Saldo' , 'NO', '$NumEgreso' );";
				 mysql_query($sql,$con) or die("No se ingresaron los datos en la caja");	
			 
		}
		echo"Egreso Registrado";
	}else{
	 exit("Debe completar todos los campos");
	}

}




/////////////////////////////////////////////////////////
///////////////Ingresamos gastos varios, servicios y compra de equipos y mercancias///////////
////////////////////////////////////////////////////////
if($accion=="GastosVarios" or $accion=="PagaServicios" or $accion=="CompraMercancias"){

	if( isset($_POST["TxtNumFactura"]) and !empty($_POST["TxtNumFactura"]) and
		isset($_POST["TxtSubtotal"]) and !empty($_POST["TxtSubtotal"]) and
		isset($_POST["TxtConcepto"]) and !empty($_POST["TxtConcepto"]) and
		isset($_POST["TxtValor"]) and is_numeric($_POST["TxtValor"]) 
		
		
		){
		
		if($_POST["CmbCuentaOrigen"]=="NO" or $_POST["CmbCuentaDestino"]=="NO" or $_POST["CmbProveedor"]=="NO")
			exit("Debe seleccionar una cuenta Origen, un proveedor y una Cuenta Destino");
		
		
		if(isset($_POST["TxtNumFactura"]))
			$NumFact=$_POST["TxtNumFactura"];
		else
			$NumFact="NO";
		
		
		$CuentaOrigen=$_POST["CmbCuentaOrigen"];
		$CuentaDestino=$_POST["CmbCuentaDestino"];
		$idProveedor=$_POST["CmbProveedor"];
		$Concepto=$_POST["TxtConcepto"];
		//$Concepto=$Concepto." Gastos Varios Egreso registrado por $_SESSION[nombre] $_SESSION[apellido] el $fechaActual";
		$Subtotal=$_POST["TxtSubtotal"];
		$Valor=$_POST["TxtValor"];
		if(isset($_POST["TxtIVA"]) and is_numeric($_POST["TxtIVA"]) and ($_POST["TxtIVA"])<>0) {
			$IVA=$_POST["TxtIVA"];
			$TotalComp=$Subtotal+$IVA;
			if($TotalComp<>$Valor)
				exit("El Subtotal e IVA ingresados no son iguales al Total, por favor verifique y vuelvalo a intentar");
		
		}else{	
			$IVA=0;
			if($Subtotal<>$Valor)
				exit("No se digitó el IVA o fue digitado con una letra, en este caso el Total debe ser igual al Subtotal, por favor verifique y vuelvalo a intentar");
			}
		
		
		//////registramos en egresos
		
		$NumRegistros=16;
		$tabla->NombresColumnas("proveedores");
		$DatosProveedor=$tabla->DevuelveValores($idProveedor);
		$RazonSocial=$DatosProveedor["RazonSocial"];
		$NIT=$DatosProveedor["Num_Identificacion"];
		
		
		
		$Columnas[0]="Fecha";				$Valores[0]=$fecha;
		$Columnas[1]="Beneficiario";		$Valores[1]=$RazonSocial;
		$Columnas[2]="NIT";					$Valores[2]=$NIT;
		$Columnas[3]="Concepto";			$Valores[3]=$Concepto;
		$Columnas[4]="Valor";				$Valores[4]=$Valor;
		$Columnas[5]="Usuario_idUsuario";	$Valores[5]=$idUsuario;
		$Columnas[6]="PagoProg";			$Valores[6]=$_POST["TipoPago"];
		$Columnas[7]="FechaPagoPro";		$Valores[7]=$_POST["TxtFechaProgram"];
		$Columnas[8]="TipoEgreso";			$Valores[8]=$accion;
		$Columnas[9]="Direccion";			$Valores[9]=$DatosProveedor["Direccion"];
		$Columnas[10]="Ciudad";				$Valores[10]=$DatosProveedor["Ciudad"];
		$Columnas[11]="Subtotal";			$Valores[11]=$Subtotal;
		$Columnas[12]="IVA";				$Valores[12]=$IVA;
		$Columnas[13]="NumFactura";			$Valores[13]=$NumFact;
		$Columnas[14]="idProveedor";		$Valores[14]=$idProveedor;
		$Columnas[15]="Cuenta";				$Valores[15]=$CuentaOrigen;
							
		$tabla->InsertarRegistro("egresos",$NumRegistros,$Columnas,$Valores);
		
		/////////////////////////////////////////////////////////////////
		//////registramos en libro diario
		
		$tab="librodiario";
		$tabla->NombresColumnas("egresos");
		$NumEgreso=$tabla->VerUltimoID();
		$NumRegistros=24;
		$CuentaPUC=$CuentaDestino;  			 /////Servicios
		$tabla->NombresColumnas("subcuentas");
		$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
		$NombreCuenta=$DatosCuenta["Nombre"];
		
		
		
		$Columnas[0]="Fecha";					$Valores[0]=$fecha;
		$Columnas[1]="Tipo_Documento_Intero";	$Valores[1]="CompEgreso";
		$Columnas[2]="Num_Documento_Interno";	$Valores[2]=$NumEgreso;
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
		$Columnas[14]="Tercero_Pais_Domicilio"; $Valores[14]=$DatosProveedor['Pais_Domicilio'];
		$Columnas[15]="CuentaPUC";				$Valores[15]=$CuentaPUC;
		$Columnas[16]="NombreCuenta";			$Valores[16]=$NombreCuenta;
		$Columnas[17]="Detalle";				$Valores[17]="egresos";
		
		$Columnas[18]="Debito";					$Valores[18]=$Subtotal;
		$Columnas[19]="Credito";				$Valores[19]="0";
		$Columnas[20]="Neto";					$Valores[20]=$Subtotal;
		$Columnas[21]="Mayor";					$Valores[21]="NO";
		$Columnas[22]="Esp";					$Valores[22]="NO";
		$Columnas[23]="Concepto";				$Valores[23]=$Concepto;
							
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		/////////////////////////////////////////////////////////////////
		//////contra partida
		if($_POST["TipoPago"]=="Contado"){
			
			
			$CuentaPUC=$CuentaOrigen; //cuenta de donde sacaremos el valor del egreso
			$tabla->NombresColumnas("cuentasfrecuentes");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
		}
		if($_POST["TipoPago"]=="Programado"){
			$CuentaPUC="2205".$idProveedor;
			$NombreCuenta="Proveedor Nacional $RazonSocial $NIT";
		}
		
		
		$Valores[15]=$CuentaPUC;
		$Valores[16]=$NombreCuenta;
		$Valores[18]="0";
		$Valores[19]=$Valor; 						//Credito se escribe el total de la venta menos los impuestos
		$Valores[20]=$Valor*(-1);  											//Credito se escribe el total de la venta menos los impuestos
		
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		/////////////////////////////////////////////////////////////////
		//////Si hay IVA
		if($IVA<>0){
		
			$CuentaPUC=2408; //cuenta de donde sacaremos el valor del egreso
			$tabla->NombresColumnas("cuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=$IVA;
			$Valores[19]=0; 						
			$Valores[20]=$IVA;  											//Credito se escribe el total de la venta menos los impuestos
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		}
		
		////////////////////////////////////////////////////////////////////
/////////////////////ingresa a la caja/////////////////////////////
////////////////////////////////////////////////////////////////////	

		if($_POST["TipoPago"]=="Contado"){
			
			$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
			mysql_select_db($db,$con) or die("la base de datos no abre");
		
			$Sal = mysql_query("SELECT MAX(idCaja) as MaxItem FROM caja",$con) or die("Problemas en la consulta a la caja ".mysql_error());	
			$Sal = mysql_fetch_array($Sal);
			$idCaja=$Sal["MaxItem"];
			 
			 $Sal = mysql_query("SELECT Saldo FROM caja WHERE idCaja = '$idCaja'",$con) or die("Problemas en la consulta a la caja ".mysql_error());	
			 $Sal = mysql_fetch_array($Sal);
			 $Saldo=$Sal["Saldo"];
			$MontoMov = $_POST["TxtValor"]-$TotalRetenciones;
			 $Saldo=$Saldo - $MontoMov;
			 
			$sql="INSERT INTO `caja` ( `Fecha`, `Movimiento`, `Hora`, `Observaciones`, `MontoMov`, `Saldo`, `Ingresos_idIngresos`, `Egresos_idEgresos` )
			VALUES ('$fecha', 'EGRESO', '$hora', '$Concepto', '$MontoMov', '$Saldo' , 'NO', '$NumEgreso' );";
				 mysql_query($sql,$con) or die("No se ingresaron los datos en la caja");	
			 
		}
		
		echo"Egreso Registrado";
	}else{
	 exit("Debe completar todos los campos");
	}

}


/////////////////////////////////////////////////////////
///////////////Registramos el pago a un banco///////////
////////////////////////////////////////////////////////
if($accion=="PagarBancos"){

	if( isset($_POST["TxtNumObligacion"]) and !empty($_POST["TxtNumObligacion"]) and
		isset($_POST["TxtIntereses"]) and !empty($_POST["TxtIntereses"]) and
		isset($_POST["TxtAbonoCapital"]) and !empty($_POST["TxtAbonoCapital"]) and
		isset($_POST["TxtConcepto"]) and !empty($_POST["TxtConcepto"]) and
		isset($_POST["TxtTotal"]) and is_numeric($_POST["TxtTotal"]) 
		
		
		){
		
		if($_POST["CmbCuentaOrigen"]=="NO" or $_POST["CmbProveedor"]=="NO")
			exit("Debe seleccionar una cuenta Origen, un proveedor y una Cuenta Destino");
		
		
					
		$CuentaOrigen=$_POST["CmbCuentaOrigen"];
		$CuentaDestino="210510".$_POST["CmbProveedor"];
		$idProveedor=$_POST["CmbProveedor"];
		$Concepto=$_POST["TxtConcepto"];
		//$Concepto=$Concepto." Prestamos Pago registrado por $_SESSION[nombre] $_SESSION[apellido] el $fechaActual";
		$Intereses=$_POST["TxtIntereses"];
		$AbonoCapital=$_POST["TxtAbonoCapital"];
		$Total=$_POST["TxtTotal"];
		$NumFact=$_POST["TxtNumObligacion"];
		
		
		if(isset($_POST["TxtOtros"]) and is_numeric($_POST["TxtOtros"]) and ($_POST["TxtOtros"])<>0) {
			$OtrosPagos=$_POST["TxtOtros"];
			$TotalComp=$OtrosPagos+$Intereses+$AbonoCapital;
			if($TotalComp<>$Total)
				exit("la sumatoria de todos los conceptos no es igual al Total digitado, por favor verifique y vuelvalo a intentar");
		
		}else{	
			$OtrosPagos=0;
			$TotalComp=$Intereses+$AbonoCapital;
			if($TotalComp<>$Total)
				exit("la sumatoria de los intereses y capital no es igual al Total digitado, por favor verifique y vuelvalo a intentar");
			}
		
		
		//////registramos en egresos
		
		$NumRegistros=16;
		$tabla->NombresColumnas("proveedores");
		$DatosProveedor=$tabla->DevuelveValores($idProveedor);
		$RazonSocial=$DatosProveedor["RazonSocial"];
		$NIT=$DatosProveedor["Num_Identificacion"];
		
		
		
		$Columnas[0]="Fecha";				$Valores[0]=$fecha;
		$Columnas[1]="Beneficiario";		$Valores[1]=$RazonSocial;
		$Columnas[2]="NIT";					$Valores[2]=$NIT;
		$Columnas[3]="Concepto";			$Valores[3]=$Concepto;
		$Columnas[4]="Valor";				$Valores[4]=$Total;
		$Columnas[5]="Usuario_idUsuario";	$Valores[5]=$idUsuario;
		$Columnas[6]="PagoProg";			$Valores[6]="Contado";
		$Columnas[7]="FechaPagoPro";		$Valores[7]=$fecha;
		$Columnas[8]="TipoEgreso";			$Valores[8]="Pago Bancos";
		$Columnas[9]="Direccion";			$Valores[9]=$DatosProveedor["Direccion"];
		$Columnas[10]="Ciudad";				$Valores[10]=$DatosProveedor["Ciudad"];
		$Columnas[11]="Subtotal";			$Valores[11]=$Total;
		$Columnas[12]="IVA";				$Valores[12]=0;
		$Columnas[13]="NumFactura";			$Valores[13]=$NumFact;
		$Columnas[14]="idProveedor";		$Valores[14]=$idProveedor;
		$Columnas[15]="Cuenta";				$Valores[15]=$CuentaOrigen;
							
		$tabla->InsertarRegistro("egresos",$NumRegistros,$Columnas,$Valores);
		
		/////////////////////////////////////////////////////////////////
		//////registramos en libro diario
		
		$tab="librodiario";
		$tabla->NombresColumnas("egresos");
		$NumEgreso=$tabla->VerUltimoID();
		$NumRegistros=24;
		$CuentaPUC=$CuentaDestino;  			 /////Servicios
		
		$NombreCuenta="Obligacion financiera $NumFact $RazonSocial";
		
		
		
		$Columnas[0]="Fecha";					$Valores[0]=$fecha;
		$Columnas[1]="Tipo_Documento_Intero";	$Valores[1]="CompEgreso";
		$Columnas[2]="Num_Documento_Interno";	$Valores[2]=$NumEgreso;
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
		$Columnas[17]="Detalle";				$Valores[17]="egresos";
		
		$Columnas[18]="Debito";					$Valores[18]=$AbonoCapital;
		$Columnas[19]="Credito";				$Valores[19]="0";
		$Columnas[20]="Neto";					$Valores[20]=$AbonoCapital;
		$Columnas[21]="Mayor";					$Valores[21]="NO";
		$Columnas[22]="Esp";					$Valores[22]="NO";
		$Columnas[23]="Concepto";				$Valores[23]=$Concepto;
							
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		
		
		/////////////////////////////////////////////////////////////////
		//////contra partida 2 por intereses
		
		$CuentaPUC=530520; //gasto por pago de intereses
		$tabla->NombresColumnas("subcuentas");
		$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
		$NombreCuenta=$DatosCuenta["Nombre"];
		
		$Valores[15]=$CuentaPUC;
		$Valores[16]=$NombreCuenta;
		$Valores[18]=$Intereses;    //// debito
		$Valores[19]=0; 						
		$Valores[20]=$Intereses;  											
		
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		
		/////////////////////////////////////////////////////////////////
		//////Si hay pagos adicionales por otros conceptos
		if($OtrosPagos<>0){
		
			$CuentaPUC=530595; //cuenta de donde sacaremos el valor del egreso
			$tabla->NombresColumnas("subcuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=$OtrosPagos;   ////debito
			$Valores[19]=0; 						
			$Valores[20]=$OtrosPagos;  											//Credito se escribe el total de la venta menos los impuestos
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		}
		
		
		/////////////////////////////////////////////////////////////////
		//////contra partida
		
		$CuentaPUC=$CuentaOrigen; //cuenta de donde sacaremos el valor del egreso
		$tabla->NombresColumnas("cuentasfrecuentes");
		$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
		$NombreCuenta=$DatosCuenta["Nombre"];
		
		$Valores[15]=$CuentaPUC;
		$Valores[16]=$NombreCuenta;
		$Valores[18]="0";
		$Valores[19]=$Total; 						//Credito se escribe el total de la venta menos los impuestos
		$Valores[20]=$Total*(-1);  											//Credito se escribe el total de la venta menos los impuestos
		
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		////////////////////////////////////////////////////////////////////
		/////////////////////ingresa a la caja/////////////////////////////
		////////////////////////////////////////////////////////////////////	

		
			
			$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
			mysql_select_db($db,$con) or die("la base de datos no abre");
		
			$Sal = mysql_query("SELECT MAX(idCaja) as MaxItem FROM caja",$con) or die("Problemas en la consulta a la caja ".mysql_error());	
			$Sal = mysql_fetch_array($Sal);
			$idCaja=$Sal["MaxItem"];
			 
			 $Sal = mysql_query("SELECT Saldo FROM caja WHERE idCaja = '$idCaja'",$con) or die("Problemas en la consulta a la caja ".mysql_error());	
			 $Sal = mysql_fetch_array($Sal);
			 $Saldo=$Sal["Saldo"];
			$MontoMov = $Total-$TotalRetenciones;
			 $Saldo=$Saldo - $MontoMov;
			 
			$sql="INSERT INTO `caja` ( `Fecha`, `Movimiento`, `Hora`, `Observaciones`, `MontoMov`, `Saldo`, `Ingresos_idIngresos`, `Egresos_idEgresos` )
			VALUES ('$fecha', 'EGRESO', '$hora', '$Concepto', '$MontoMov', '$Saldo' , 'NO', '$NumEgreso' );";
				 mysql_query($sql,$con) or die("No se ingresaron los datos en la caja");	
			 
		
		
		echo"Pago al Proveedor $RazonSocial Registrado";
	}else{
	 exit("Debe completar todos los campos");
	}

}




/////////////////////////////////////////////////////////
///////////////Registramos el pago de un contratista///////////
////////////////////////////////////////////////////////
if($accion=="PagaContratistas"){
	

		
	if( isset($_POST["TxtNumFactura"]) and !empty($_POST["TxtNumFactura"]) and
		isset($_POST["TxtSubtotal"]) and !empty($_POST["TxtSubtotal"]) and
		isset($_POST["TxtConcepto"]) and !empty($_POST["TxtConcepto"]) and
		isset($_POST["TxtValor"]) and is_numeric($_POST["TxtValor"]) 
		
		
		){
		
		
		$FormaPago=$_POST["CmbFormaPago"];
		
		if($FormaPago=="Contado" and $_POST["CmbCuentaOrigen"]=="NO")
			exit("Usted selecciono un pago de contado pero no una cuenta origen, Debe seleccionar una cuenta Origen");
		
		if($_POST["CmbCuentaDestino"]=="NO" or $_POST["CmbProveedores"]=="NO")
			exit("Debe seleccionar una cuenta Origen, un proveedor y una Cuenta Destino");
		
		
		
	
	
		$NumFact=$_POST["TxtNumFactura"];
		
			
		//$data = explode(";", $_POST["CmbProveedores"]);
		//$idProveedor=$data[1];
				
		$CuentaOrigen=$_POST["CmbCuentaOrigen"];
		$CuentaDestino=$_POST["CmbCuentaDestino"];
		$idProveedor=$_POST["CmbProveedores"];
		$Concepto=$_POST["TxtConcepto"];
		//$Concepto=$Concepto." Pago de contratista registrado por $_SESSION[nombre] $_SESSION[apellido] el $fechaActual";
		$Subtotal=$_POST["TxtSubtotal"];
		$Valor=$_POST["TxtValor"];
		
		
		if(isset($_POST["TxtIVA"]) and is_numeric($_POST["TxtIVA"]) and ($_POST["TxtIVA"])<>0) {
			$IVA=$_POST["TxtIVA"];
			$TotalComp=$Subtotal+$IVA;
			if($TotalComp<>$Valor)
				exit("El Subtotal e IVA ingresados no son iguales al Total, por favor verifique y vuelvalo a intentar");
		
		}else{	
			$IVA=0;
			if($Subtotal<>$Valor)
				exit("No se digitó el IVA o fue digitado con una letra, en este caso el Total debe ser igual al Subtotal, por favor verifique y vuelvalo a intentar");
			}
		
		/////Calculamos el total de las retenciones
		
		$TotalRetenciones=0;
		if(isset($_POST["CkRetenciones"])){
			
			$RetencionesAplicadas=$_POST["CkRetenciones"];
			foreach($RetencionesAplicadas as $R){
			
				$data = explode(";", $R);
				if($data[4]=="Subtotal"){
					$Retencion=round($data[1]*$_POST["TxtSubtotal"]);
					$TotalRetenciones=round($data[1]*$_POST["TxtSubtotal"]+$TotalRetenciones);
					
				}if($data[4]=="IVA"){
					$Retencion=round($data[1]*$_POST["TxtIVA"]);
					$TotalRetenciones=round($data[1]*$_POST["TxtIVA"]+$TotalRetenciones);
				}
				echo("Se retuvo por $data[2]: $Retencion en total: $TotalRetenciones<br>");
			
			}
		}
		
				
		//////registramos en egresos
		
		$NumRegistros=16;
		$tabla->NombresColumnas("proveedores");
		$DatosProveedor=$tabla->DevuelveValores($idProveedor);
		$RazonSocial=$DatosProveedor["RazonSocial"];
		$NIT=$DatosProveedor["Num_Identificacion"];
		
		
		
		$Columnas[0]="Fecha";				$Valores[0]=$fecha;
		$Columnas[1]="Beneficiario";		$Valores[1]=$RazonSocial;
		$Columnas[2]="NIT";					$Valores[2]=$NIT;
		$Columnas[3]="Concepto";			$Valores[3]=$Concepto;
		$Columnas[4]="Valor";				$Valores[4]=$Valor-$TotalRetenciones;
		$Columnas[5]="Usuario_idUsuario";	$Valores[5]=$idUsuario;
		$Columnas[6]="PagoProg";			$Valores[6]=$_POST["CmbFormaPago"];
		$Columnas[7]="FechaPagoPro";		$Valores[7]=$_POST["TxtFechaProgram"];
		$Columnas[8]="TipoEgreso";			$Valores[8]=$accion;
		$Columnas[9]="Direccion";			$Valores[9]=$DatosProveedor["Direccion"];
		$Columnas[10]="Ciudad";				$Valores[10]=$DatosProveedor["Ciudad"];
		$Columnas[11]="Subtotal";			$Valores[11]=$Subtotal-$TotalRetenciones;
		$Columnas[12]="IVA";				$Valores[12]=$IVA;  //Pendiente encontrar la forma de calcular cuanto fue la retencion de IVA para restarlo
		$Columnas[13]="NumFactura";			$Valores[13]=$NumFact;
		$Columnas[14]="idProveedor";		$Valores[14]=$idProveedor;
		$Columnas[15]="Cuenta";				$Valores[15]=$CuentaOrigen;
							
		$tabla->InsertarRegistro("egresos",$NumRegistros,$Columnas,$Valores);
		
		
		/////////////////////////////////////////////////////////////////
		//////registramos en libro diario
		
		$tab="librodiario";
		$tabla->NombresColumnas("egresos");
		$NumEgreso=$tabla->VerUltimoID();
		$NumRegistros=24;
		
		$CuentaPUC=$CuentaDestino;  			 /////Cuenta seleccionada en el Selector
		$tabla->NombresColumnas("subcuentas");
		$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
		$NombreCuenta=$DatosCuenta["Nombre"];
		
		
		
		$Columnas[0]="Fecha";					$Valores[0]=$fecha;
		$Columnas[1]="Tipo_Documento_Intero";	$Valores[1]="CompEgreso";
		$Columnas[2]="Num_Documento_Interno";	$Valores[2]=$NumEgreso;
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
		$Columnas[17]="Detalle";				$Valores[17]="egresos";
		
		$Columnas[18]="Debito";					$Valores[18]=$Subtotal;
		$Columnas[19]="Credito";				$Valores[19]="0";
		$Columnas[20]="Neto";					$Valores[20]=$Subtotal;
		$Columnas[21]="Mayor";					$Valores[21]="NO";
		$Columnas[22]="Esp";					$Valores[22]="NO";
		$Columnas[23]="Concepto";				$Valores[23]=$Concepto;
							
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		/////////////////////////////////////////////////////////////////
		//////Si hay IVA
		if($IVA<>0){
		
			$CuentaPUC=2408; //Iva descontable
			$tabla->NombresColumnas("cuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=$IVA;
			$Valores[19]=0; 						
			$Valores[20]=$IVA;  											//Credito se escribe el total de la venta menos los impuestos
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		}
		
		/////////////////////////////////////////////////////////////////
		//////contra partida
		if($FormaPago=="Contado"){
			$CuentaPUC=$CuentaOrigen; //cuenta de donde sacaremos el valor del egreso
			$tabla->NombresColumnas("cuentasfrecuentes");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
		}else{
			$CuentaPUC="2205".$idProveedor;
			$NombreCuenta="Cartera del Cliente $RazonSocial con NIT $NIT";
		}	
		
		
		$Valores[15]=$CuentaPUC;
		$Valores[16]=$NombreCuenta;
		$Valores[18]="0";
		$Valores[19]=$Valor-$TotalRetenciones;   //lo que realmente se pagó el total menos las retenciones 						
		$Valores[20]=$Valores[19]*(-1);  											//Credito se escribe el total de la venta menos los impuestos
		
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		
		/////////////////////////////////////////////////////////////////
		//////Registro retenciones si las hay
		
		if(isset($_POST["CkRetenciones"])){
			//$TotalRetenciones=0;
			$RetencionesAplicadas=$_POST["CkRetenciones"];
			foreach($RetencionesAplicadas as $R){
			
				$data = explode(";", $R);
				if($data[4]=="Subtotal"){
					$Retencion=round($data[1]*$_POST["TxtSubtotal"]);
					//$TotalRetenciones=round($data[1]*$_POST["TxtSubtotal"]+$TotalRetenciones);
					
				}if($data[4]=="IVA"){
					$Retencion=round($data[1]*$_POST["TxtIVA"]);
					//$TotalRetenciones=round($data[1]*$_POST["TxtIVA"]+$TotalRetenciones);
				}
				echo("Se retuvo por $data[2]: $Retencion en total: $TotalRetenciones<br>");
				
				
				$CuentaPUC=$data[3]; //Iva descontable
				$tabla->NombresColumnas("cuentas");
				$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
				$NombreCuenta=$DatosCuenta["Nombre"];
				
				
				
				$Valores[15]=$CuentaPUC;
				$Valores[16]=$NombreCuenta;
				$Valores[18]="0";
				$Valores[19]=$Retencion; 						//Credito se escribe el total de la venta menos los impuestos
				$Valores[20]=$Retencion*(-1);  											//Credito se escribe el total de la venta menos los impuestos
				
				$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
			}
		}
		
		////////////////////////////////////////////////////////////////////
/////////////////////ingresa a la caja/////////////////////////////
////////////////////////////////////////////////////////////////////	

if($FormaPago=="Contado"){
			
			
			$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
			mysql_select_db($db,$con) or die("la base de datos no abre");
		
			$Sal = mysql_query("SELECT MAX(idCaja) as MaxItem FROM caja",$con) or die("Problemas en la consulta a la caja ".mysql_error());	
			$Sal = mysql_fetch_array($Sal);
			$idCaja=$Sal["MaxItem"];
			 
			 $Sal = mysql_query("SELECT Saldo FROM caja WHERE idCaja = '$idCaja'",$con) or die("Problemas en la consulta a la caja ".mysql_error());	
			 $Sal = mysql_fetch_array($Sal);
			 $Saldo=$Sal["Saldo"];
			$MontoMov = $_POST["TxtValor"]-$TotalRetenciones;
			 $Saldo=$Saldo - $MontoMov;
			 
			$sql="INSERT INTO `caja` ( `Fecha`, `Movimiento`, `Hora`, `Observaciones`, `MontoMov`, `Saldo`, `Ingresos_idIngresos`, `Egresos_idEgresos` )
			VALUES ('$fecha', 'EGRESO', '$hora', '$Concepto', '$MontoMov', '$Saldo' , 'NO', '$NumEgreso' );";
				 mysql_query($sql,$con) or die("No se ingresaron los datos en la caja");	
			 
		}
		
		echo"pago Registrado";
		
	}else{
	 exit("Debe completar todos los campos");
	}
	
}


print('<form name="formPrintComp" method="post" action="tcpdf/examples/imprimircomp.php" enctype="multipart/form-data" target="_blank" id="Form3">
		<input type="hidden" name="idProveedor" value="$idProveedor">
		<input type="hidden"  name="ImgPrintComp"  value="'.$NumEgreso.'"  >
		<input type="image"  name="ImgPrint" src="images/crear_pdf.png" value="'.$NumEgreso.'" style=width:55px;height:50px;z-index:103; >

</form>');




?>