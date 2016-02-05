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



if($_POST["TxtPagaConciliaciones"]==1)
	$accion="PagaConciliacion";


/////////////////////////////////////////////////////////
///////////////Registramos el pago del IVA///////////
////////////////////////////////////////////////////////
if($accion="PagaConciliacion"){
	//print("Entra 2");
	
	if( isset($_POST["TxtConcepto"]) and !empty($_POST["TxtConcepto"]) and
		isset($_POST["TxtNumFactura"]) and !empty($_POST["TxtNumFactura"]) and
		isset($_POST["TxtTotal"]) and !empty($_POST["TxtTotal"]) 
		
		){
		//print("Entra 2");
		if($_POST["CmbCuentaOrigen"]=="NO" or $_POST["CmbProveedor"]=="NO")
			exit("Debe seleccionar una cuenta Origen, un proveedor y una Cuenta Destino");
		
		
					
		$CuentaOrigen=$_POST["CmbCuentaOrigen"];
		
		$idProveedor=$_POST["CmbProveedor"];
		$Concepto=$_POST["TxtConcepto"];
		//$Concepto=$Concepto." Prestamos Pago registrado por $_SESSION[nombre] $_SESSION[apellido] el $fechaActual";
			
		$Total=$_POST["TxtTotal"];
		$NumFact=$_POST["TxtNumFactura"];
				
		//////registramos en egresos
		
		$NumRegistros=16;
		$tabla->NombresColumnas("proveedores");
		$DatosProveedor=$tabla->DevuelveValores($idProveedor);
		$RazonSocial=$DatosProveedor["RazonSocial"];
		$NIT=$DatosProveedor["Num_Identificacion"];
		$CuentaDestino=$_POST["CmbCuentaDestino"];    /// IVA
		
		if($CuentaDestino==2408){
			
			$Columnas[0]="Fecha";				$Valores[0]=$fecha;
		$Columnas[1]="Beneficiario";		$Valores[1]=$RazonSocial;
		$Columnas[2]="NIT";					$Valores[2]=$NIT;
		$Columnas[3]="Concepto";			$Valores[3]=$Concepto;
		$Columnas[4]="Valor";				$Valores[4]=$Total;
		$Columnas[5]="Usuario_idUsuario";	$Valores[5]=$idUsuario;
		$Columnas[6]="PagoProg";			$Valores[6]="Contado";
		$Columnas[7]="FechaPagoPro";		$Valores[7]=$fecha;
		$Columnas[8]="TipoEgreso";			$Valores[8]=$accion;
		$Columnas[9]="Direccion";			$Valores[9]=$DatosProveedor["Direccion"];
		$Columnas[10]="Ciudad";				$Valores[10]=$DatosProveedor["Ciudad"];
		$Columnas[11]="Subtotal";			$Valores[11]=0;
		$Columnas[12]="IVA";				$Valores[12]=$Total;
		$Columnas[13]="NumFactura";			$Valores[13]=$NumFact;
		$Columnas[14]="idProveedor";		$Valores[14]=$idProveedor;
		$Columnas[15]="Cuenta";				$Valores[15]=$CuentaOrigen;
			
			
		}else{
			
			$Columnas[0]="Fecha";				$Valores[0]=$fecha;
		$Columnas[1]="Beneficiario";		$Valores[1]=$RazonSocial;
		$Columnas[2]="NIT";					$Valores[2]=$NIT;
		$Columnas[3]="Concepto";			$Valores[3]=$Concepto;
		$Columnas[4]="Valor";				$Valores[4]=$Total;
		$Columnas[5]="Usuario_idUsuario";	$Valores[5]=$idUsuario;
		$Columnas[6]="PagoProg";			$Valores[6]="Contado";
		$Columnas[7]="FechaPagoPro";		$Valores[7]=$fecha;
		$Columnas[8]="TipoEgreso";			$Valores[8]=$accion;
		$Columnas[9]="Direccion";			$Valores[9]=$DatosProveedor["Direccion"];
		$Columnas[10]="Ciudad";				$Valores[10]=$DatosProveedor["Ciudad"];
		$Columnas[11]="Subtotal";			$Valores[11]=$Total;
		$Columnas[12]="IVA";				$Valores[12]=0;
		$Columnas[13]="NumFactura";			$Valores[13]=$NumFact;
		$Columnas[14]="idProveedor";		$Valores[14]=$idProveedor;
		$Columnas[15]="Cuenta";				$Valores[15]=$CuentaOrigen;
			
			
		}
		$tabla->InsertarRegistro("egresos",$NumRegistros,$Columnas,$Valores);
		
		/////////////////////////////////////////////////////////////////
		//////registramos en libro diario
		
		$tab="librodiario";
		$tabla->NombresColumnas("egresos");
		$NumEgreso=$tabla->VerUltimoID();
		$NumRegistros=24;
		if($CuentaDestino==2408){
			$CuentaPUC=$CuentaDestino;  			 /////Servicios
			$tabla->NombresColumnas("cuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
		}else{	
			$CuentaPUC=$CuentaDestino;  			 /////Servicios
			$tabla->NombresColumnas("subcuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
		
		}
		
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
		
		$Columnas[18]="Debito";					$Valores[18]=$Total;
		$Columnas[19]="Credito";				$Valores[19]="0";
		$Columnas[20]="Neto";					$Valores[20]=$Total;
		$Columnas[21]="Mayor";					$Valores[21]="NO";
		$Columnas[22]="Esp";					$Valores[22]="NO";
		$Columnas[23]="Concepto";				$Valores[23]=$Concepto;
							
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
		$Valores[19]=$Total; 						//Credito se escribe el total de la venta menos los impuestos
		$Valores[20]=$Total*(-1);  					//Credito se escribe el total de la venta menos los impuestos
		
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
			$MontoMov = $Total;
			 $Saldo=$Saldo - $MontoMov;
			 
			$sql="INSERT INTO `caja` ( `Fecha`, `Movimiento`, `Hora`, `Observaciones`, `MontoMov`, `Saldo`, `Ingresos_idIngresos`, `Egresos_idEgresos` )
			VALUES ('$fecha', 'EGRESO', '$hora', '$Concepto', '$MontoMov', '$Saldo' , 'NO', '$NumEgreso' );";
				 mysql_query($sql,$con) or die("No se ingresaron los datos en la caja");	
			 
		
		
		echo"Pago al Proveedor $RazonSocial Registrado";
	}else{
	 exit("Debe completar todos los campos");
	}

}

print('<form name="formPrintComp" method="post" action="tcpdf/examples/imprimircomp.php" enctype="multipart/form-data" target="_blank" id="Form3">
		<input type="hidden" name="idProveedor" value="$idProveedor">
		<input type="hidden"  name="ImgPrintComp" value="'.$NumEgreso.'"  >
		<input type="image"  name="ImgPrint" src="images/crear_pdf.png" value="'.$NumEgreso.'" style=width:55px;height:50px;z-index:103; >

</form>');




?>