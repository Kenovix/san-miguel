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



if($_POST["TxtOtrosIngresos"]==1)
	$accion="OtrosIngresos";


/////////////////////////////////////////////////////////
///////////////Registramos  Otros Ingresos///////////
////////////////////////////////////////////////////////
if($accion="OtrosIngresos"){
	//print("Entra 2");
	
	if( isset($_POST["TxtConcepto"]) and !empty($_POST["TxtConcepto"]) and
		isset($_POST["TxtNumFactura"]) and !empty($_POST["TxtNumFactura"]) and
		isset($_POST["TxtTotal"]) and !empty($_POST["TxtTotal"]) 
		
		){
		//print("Entra 2");
		if($_POST["CmbCuentaOrigen"]=="NO" or $_POST["CmbProveedor"]=="NO")
			exit("Debe seleccionar una cuenta Origen, un proveedor y una Cuenta Destino");
		
		
					
		$CuentaOrigen=$_POST["CmbCuentaOrigen"];
		$CuentaDestino=$_POST["CmbCuentaDestino"];
		$idProveedor=$_POST["CmbProveedor"];
		$Concepto=$_POST["TxtConcepto"];
		//$Concepto=$Concepto." Prestamos Pago registrado por $_SESSION[nombre] $_SESSION[apellido] el $fechaActual";
			
		$Total=$_POST["TxtTotal"];
		$NumFact=$_POST["TxtNumFactura"];
				
		////////////////////////////////////////////////////////////////////
/////////////////////se registra en ingresos/////////////////////////////
////////////////////////////////////////////////////////////////////

	
		  $fecha=$_POST["TxtFecha"];
		  $hora=date("H:i:s");
		  
			  $Observaciones="Otros Ingresos: $_POST[TxtConcepto] registrado por: $_SESSION[nombre] $_SESSION[apellido] el $fecha siendo las $hora ";
		 
			  
		 
		  
		  
		  $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
		  mysql_select_db($db,$con) or die("la base de datos no abre");
		  
		  $sql="INSERT INTO `ingresos` ( `Observaciones`, `Total`, `Fecha` ) VALUES ('$Observaciones', '$Total',  '$fecha')";
		  
		 mysql_query($sql,$con) or die("Problemas al ingresar el pago a la base de datos");
		 
		 $sel1=mysql_query("SELECT * FROM `impret` WHERE Nombre= 'CREE' ",$con) or die("Problemas al consultar los datos en clientes");
		$CREE=mysql_fetch_array($sel1);	

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
 
 $Saldo=$Saldo + $Total;
 
$sql="INSERT INTO `caja` ( `Fecha`, `Movimiento`, `Hora`, `Observaciones`, `MontoMov`, `Saldo`, `Ingresos_idIngresos`, `Egresos_idEgresos` )
 VALUES ('$fecha', 'INGRESO', '$hora', '$Observaciones', '$Total', '$Saldo' , '$idIngresos' , 'NO');";
	 mysql_query($sql,$con) or die("No se ingresaron los datos en la caja");	 

		
		/////////////////////////////////////////////////////////////////
		//////calculamos autorretencion
		
		$ValorCREE=round($Total*$CREE['Valor']);
		
		/////////////////////////////////////////////////////////////////
		//////registramos en libro diario
		
		$tabla->NombresColumnas("proveedores");
		$DatosProveedor=$tabla->DevuelveValores($idProveedor);
		$RazonSocial=$DatosProveedor["RazonSocial"];
		$NIT=$DatosProveedor["Num_Identificacion"];
		
		
		$tab="librodiario";
		$tabla->NombresColumnas("ingresos");
		$NumIngreso=$tabla->VerUltimoID();
		$NumRegistros=24;
		
		
		$CuentaPUC=$CuentaOrigen;  			 
		$tabla->NombresColumnas("cuentasfrecuentes");
		$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
		$NombreCuenta=$DatosCuenta["Nombre"];
		
		
		
		$Columnas[0]="Fecha";					$Valores[0]=$fecha;
		$Columnas[1]="Tipo_Documento_Intero";	$Valores[1]="CompIngreso";
		$Columnas[2]="Num_Documento_Interno";	$Valores[2]=$NumIngreso;
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
		$Columnas[17]="Detalle";				$Valores[17]="Otros Ingresos";
		
		$Columnas[18]="Debito";					$Valores[18]=$Total;
		$Columnas[19]="Credito";				$Valores[19]="0";
		$Columnas[20]="Neto";					$Valores[20]=$Total;
		$Columnas[21]="Mayor";					$Valores[21]="NO";
		$Columnas[22]="Esp";					$Valores[22]="NO";
		$Columnas[23]="Concepto";				$Valores[23]=$Concepto;
							
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		
		///////////////////////////////////////////////////////////////
		////////////Registramos Autoretencion
		
		$CuentaPUC=135595; //  Autorretenciones CREE
			$tabla->NombresColumnas("subcuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=$ValorCREE;     //Valor del CREE
			$Valores[19]=0; 			
			$Valores[20]=$ValorCREE;  	//para la sumatoria contemplar el balance
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		///////////////////////////////////////////////////////////////
		////////////contra partida de la Autoretencion
		
			$CuentaPUC=23657502; //  Cuentas por pagar Autorretenciones CREE
			$tabla->NombresColumnas("subcuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=0;     //Valor del CREE
			$Valores[19]=$ValorCREE; 			
			$Valores[20]=$ValorCREE*(-1);  	//para la sumatoria contemplar el balance
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
				
		/////////////////////////////////////////////////////////////////
		//////contra partida
		
		$CuentaPUC=$CuentaDestino; 
		
		
			$tabla->NombresColumnas("cuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
		
		$Valores[15]=$CuentaPUC;
		$Valores[16]=$NombreCuenta;
		$Valores[18]="0";
		$Valores[19]=$Total; 						//Credito se escribe el total de la venta menos los impuestos
		$Valores[20]=$Total*(-1);  					//Credito se escribe el total de la venta menos los impuestos
		
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		
		echo"Ingreso Registrado";
	}else{
	 exit("Debe completar todos los campos");
	}

}


?>