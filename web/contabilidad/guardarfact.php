<?php

session_start();
//include("conexion.php");
include("classes_servi/CreaTablasMysql.php");
include_once("modelo/php_conexion.php");
if(!isset($_SESSION["username"]))
   header("Location: index.php");
  
////////////////////////////////////////////
/////////////Obtengo el ID del cliente y el del Usuario 
////////////////////////////////////////////
 if(    isset($_POST["TxtOCompra"]) && !empty($_POST["TxtOCompra"]) &&
	   isset($_POST["TxtOSalida"]) && !empty($_POST["TxtOSalida"])   
	   )
	   {
		    
  
$IDCotizacion = $_POST["Cotizaciones"];
$IDCliente = $_POST["idCliente"];
$FormaPago = $_POST["FormaPago"];
$Subtotal = $_POST["Subtotal"];
$IVA = round($_POST["IVA"]);
$Total = round($_POST["Total"]);
$Descuentos = $_POST["Descuentos"];
$SubtotalCosto = $_POST["SubtotalCosto"];
$OCompra = $_POST["TxtOCompra"];
$OSalida = $_POST["TxtOSalida"];
$idUser = $_SESSION['idUser'];
$Login = $_SESSION["username"];
$Nombre = $_SESSION["nombre"];
$Apellido = $_SESSION["apellido"];
$fecha=$_POST["TxtFecha"];	
$CuentaDestino=$_POST["CmbCuentaOrigen"];
$ObservacionesFactura=$_POST["TxtObservacionesFact"];	

$frac = explode(';',$IDCotizacion);
$no = count($frac)-1;

////////////////////////////////////////////
/////////////Obtengo el ultimo numero de la factura
////////////////////////////////////////////

$con=mysql_connect($host,$user, $pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");  


$sel1=mysql_query("SELECT MAX(NumVenta) as NumVenta, MAX(NumFactura) as NumFactura FROM vestasactivas WHERE `Usuario_idUsuario`= $idUser",$con) or die("problemas con la consulta a ventas".mysql_error());

$ID=mysql_fetch_array($sel1);
if($ID>0){
	
	$NumVentas=$ID["NumVenta"];
	$idFacturas=$ID["NumFactura"];
	
}else{
	$obVenta=new ProcesoVenta($idUser);
	
	$obVenta->CrearPreventa($idUser);// Crea otra preventa
	$sel1=mysql_query("SELECT MAX(NumVenta) as NumVenta, MAX(NumFactura) as NumFactura FROM vestasactivas WHERE `Usuario_idUsuario`= $idUser",$con) or die("problemas con la consulta a ventas".mysql_error());

	$NumVentas=$ID["NumVenta"];
	$idFacturas=$ID["NumFactura"];
}




//echo " NumVenta: $NumVentas,  Factura  $idFacturas)";


////////////////////////////////////////////
/////////////Calcula fecha de vencimiento
////////////////////////////////////////////
	
switch ($FormaPago){
	
	case "Contado": $SumaDias=0; break;
	case "Factoring": $SumaDias=15; break;
	case "15": $SumaDias=15; break;
	case "30": $SumaDias=30; break;
	case "60": $SumaDias=60; break;
	case "90": $SumaDias=90; break;	
		
}

//error_reporting(0);
$Observaciones="Entra desde facturación el $fecha";
//$fecha=date("Y-m-d");
$FechaTemp = date_create("$fecha");
date_add($FechaTemp, date_interval_create_from_date_string("$SumaDias days"));
$FechaVencimiento = date_format($FechaTemp, 'Y-m-d');
//error_reporting(E_ALL ^ E_NOTICE);
$DiasCartera=0;

$sel1=mysql_query("SELECT * FROM `clientes` WHERE idClientes= '$IDCliente' ",$con) or die("Problemas al consultar los datos en clientes");
$DatosCliente=mysql_fetch_array($sel1);	
$cliente=$DatosCliente["RazonSocial"];
$Telefono=$DatosCliente["Telefono"];
$Contacto=$DatosCliente["Contacto"];
$TelContacto=$DatosCliente["TelContacto"];
$NIT=$DatosCliente["Num_Identificacion"];

if($FormaPago<>"Contado"){
	mysql_query("INSERT INTO `cartera` ( `Cliente`, `Telefono`, `Contacto`, `TelContacto`, `Saldo`, `FechaVencimiento`, `DiasCartera`, `Observaciones`, `Facturas_idFacturas`) 
	VALUES ( '$cliente', '$Telefono', '$Contacto', '$TelContacto', '$Total', '$FechaVencimiento', '$DiasCartera', '$Observaciones', '$idFacturas'); ",$con) or die("Problemas al agregar los datos a cartera".mysql_error());
}	
$sel1=mysql_query("SELECT * FROM `impret` WHERE Nombre= 'CREE' ",$con) or die("Problemas al consultar los datos en clientes");
$CREE=mysql_fetch_array($sel1);	

$sel1=mysql_query("SELECT max(NumVenta) as NumVentaActiva FROM `vestasactivas` WHERE Usuario_idUsuario= '$idUser' ",$con) or die("Problemas al consultar los datos en clientes");
$VentaActiva=mysql_fetch_array($sel1);	
$VentaActiva=$VentaActiva["NumVentaActiva"];



error_reporting(0);


/////////////////////////////////////////////////////////////////////////////////
////////////Revision en el inventario de cada item //////////////////////////////
/////////////////////////////////////////////////////////////////////////////////


$sql = "SELECT * FROM cotizaciones WHERE ";
	for ($i=0;$i<=$no;$i++){
		
		if($i==$no){
			$sql = $sql." NumCotizacion = '$frac[$i]'";
		}else{
			$sql = $sql." NumCotizacion = '$frac[$i]' OR";
		}
		
	}
$sel1 = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());									
										
if(mysql_num_rows($sel1)){
	
	while($DatosCotizacion = mysql_fetch_array($sel1)){	
	if($DatosCotizacion["TipoItem"]=="PR"){
		$InfoProducto=mysql_query("SELECT * FROM `productosventa` WHERE Referencia= '$DatosCotizacion[Referencia]' ",$con) or die("Problemas al consultar los datos en clientes");
		$InfoProducto=mysql_fetch_array($InfoProducto);	
		$idProducto=$InfoProducto['idProductosVenta'];
			if($idProducto > 0){
				print("Producto $DatosCotizacion[Referencia] encontrado, ");
			}else{
				exit("Producto $DatosCotizacion[Referencia] no encontrado, deberá crear este producto antes de poder generar esta factura");
			}
				
}
}
}	


/////////////////////////////////////////////////////////////////////////////////
////////////Ingresar los items de la venta a la tabla ventas//////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

if($FormaPago<>"Contado")
	$FormaPago="Credito";




$sql = "SELECT * FROM cotizaciones WHERE ";
	for ($i=0;$i<=$no;$i++){
		
		if($i==$no){
			$sql = $sql." NumCotizacion = '$frac[$i]'";
		}else{
			$sql = $sql." NumCotizacion = '$frac[$i]' OR";
		}
		
	}
$sel1 = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());									
										
if(mysql_num_rows($sel1)){
	
	while($DatosCotizacion = mysql_fetch_array($sel1)){	
	
		$InfoProducto=mysql_query("SELECT * FROM `productosventa` WHERE Referencia= '$DatosCotizacion[Referencia]' ",$con) or die("Problemas al consultar los datos en productosventa");
		$InfoProducto=mysql_fetch_array($InfoProducto);	
		$idProducto=$InfoProducto['idProductosVenta'];
		
		mysql_query("INSERT INTO ventas (`NumVenta`,`Fecha`, `Productos_idProductos`, `Producto`, `Referencia`, `Cantidad`, `ValorCostoUnitario`, `ValorVentaUnitario`, `Impuestos`, `Descuentos`,
						`TotalCosto`, `TotalVenta`, `TipoVenta`, `Clientes_idClientes`, `Usuarios_idUsuarios`, `NoReclamacion`) VALUES
						('$NumVentas', '$fecha', '$idProducto', '$DatosCotizacion[Descripcion]', '$DatosCotizacion[Referencia]', '$DatosCotizacion[Cantidad]', '$DatosCotizacion[PrecioCosto]'
						, '$DatosCotizacion[ValorUnitario]', '$DatosCotizacion[IVA]', '$DatosCotizacion[ValorDescuento]', '$DatosCotizacion[SubtotalCosto]', '$DatosCotizacion[Total]'
						, '$FormaPago','$IDCliente' , '$idUser', '$idFacturas')",$con) 
						or die("Problemas al ingresar los datos en ventas ".mysql_error());	
				

}
}	

////////////////////////////////////////////
/////////////Obtener los items de cotizacion y guardar los datos en la tabla facturacion y cartera
////////////////////////////////////////////



	 mysql_query("INSERT INTO `facturas` (`idFacturas`, `Fecha`, `OCompra`, `OSalida`, `FormaPago`, `Subtotal`, `IVA`, `Total`, `SaldoFact`,
	 `EmpresaPro_idEmpresaPro`, `Usuarios_idUsuarios`, `Clientes_idClientes`, `Cotizaciones_idCotizaciones`, `Descuentos`, `ObservacionesFact`) 
	 VALUES ('$idFacturas', '$fecha', '$OCompra', '$NumVentas', '$FormaPago', '$Subtotal', '$IVA', '$Total', '$Total', '1', '$idUser', 
	 '$IDCliente', '$IDCotizacion', '$Descuentos','$ObservacionesFactura');") or die("Problemas al agregar los datos a facturas".mysql_error());
	 //mysql_query("INSERT INTO `facturas` ( `idFacturas`, `Fecha`, `FormaPago`, `OCompra`, `OSalida`,`Subtotal`, `IVA`,  `Total`, `EmpresaPro_idEmpresaPro`, `Usuarios_idUsuarios`, `Clientes_idClientes`, `Cotizaciones_idCotizaciones`,`Descuentos`) 
	 //VALUES ( '$idFacturas', '$fecha', '$FormaPago', '$OCompra','$OSalida',  '$Subtotal', '$IVA', '$Total', '1', '$idUser', '$IDCliente', '$IDCotizacion', '$Descuentos'); ",$con) or die("Problemas al agregar los datos a facturas");
	
	
///////////////////////////////////////////////////////////
//////////Se revisa cada item de la cotizacion para realizar los asientos contables
///////////////////////////////////////////////////////////		
		
$sql = "SELECT * FROM cotizaciones WHERE ";
	for ($i=0;$i<=$no;$i++){
		
		if($i==$no){
			$sql = $sql." NumCotizacion = '$frac[$i]'";
		}else{
			$sql = $sql." NumCotizacion = '$frac[$i]' OR";
		}
		
	}
$sel1 = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());			

if(mysql_num_rows($sel1)){
	
	while($DatosCotizacion = mysql_fetch_array($sel1)){	
	
	if($DatosCotizacion["Descripcion"]<>""){
	
///////////////////////////////////////////////////////////
/////////////Se realizan asientos contables ///////////////
///////////////////////////////////////////////////////////

		$tab="librodiario";
		$tabla=  new Mytable($servi,$baseDatos,$usuario,$passsword,$tab);
		$tabla->conectar();
		if($DatosCotizacion["TipoItem"]=="SE"){
			$Detalle="Venta de Servicios";
		}
		else if($DatosCotizacion["TipoItem"]=="PR"){
		
			$Detalle="Venta de Productos";
			}
		else{
			$Detalle="Sin especificar";	
		}
		
		/////////////////////////////////////////////////////////////////
		//////calculamos autorretencion
		
		$ValorCREE=round($DatosCotizacion["Subtotal"]*$CREE['Valor']);
		//$Entrada=round($DatosCotizacion["Total"]-$ValorCREE);
		/////////////////////////////////////////////////////////////////
		//////registramos en libro diario
		
		$tab="librodiario";
		$NumRegistros=24;
		$CuentaPUC="130505$IDCliente";
		$NombreCuenta="Clientes Nacionales $DatosCliente[RazonSocial] NIT $NIT";
		
		
		
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
		$Columnas[10]="Tercero_Razon_Social";	$Valores[10]=$cliente;
		$Columnas[11]="Tercero_Direccion";		$Valores[11]=$DatosCliente['Direccion'];
		$Columnas[12]="Tercero_Cod_Dpto";		$Valores[12]=$DatosCliente['Cod_Dpto'];
		$Columnas[13]="Tercero_Cod_Mcipio";		$Valores[13]=$DatosCliente['Cod_Mcipio'];
		$Columnas[14]="Tercero_Pais_Domicilio";  $Valores[14]=$DatosCliente['Pais_Domicilio'];
		
		$Columnas[15]="CuentaPUC";				$Valores[15]=$CuentaPUC;
		$Columnas[16]="NombreCuenta";			$Valores[16]=$NombreCuenta;
		$Columnas[17]="Detalle";				$Valores[17]=$Detalle;
		$Columnas[18]="Debito";					$Valores[18]=round($DatosCotizacion["Total"]);
		$Columnas[19]="Credito";				$Valores[19]="0";
		$Columnas[20]="Neto";					$Valores[20]=round($DatosCotizacion["Total"]);
		$Columnas[21]="Mayor";					$Valores[21]="NO";
		$Columnas[22]="Esp";					$Valores[22]="NO";
		$Columnas[23]="Concepto";				$Valores[23]=$DatosCotizacion["Descripcion"];
							
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		
		///////////////////////////////////////////////////////////////
		////////////Registramos Pago en caso de ser de contado
		
		
		if($FormaPago=="Contado"){
			
			
			$CuentaPUC=$CuentaDestino; 
			$tabla->NombresColumnas("cuentasfrecuentes");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=round($DatosCotizacion["Total"]);
			$Valores[19]=0; 			
			$Valores[20]=round($DatosCotizacion["Total"]);
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		///////////////////////////////////////////////////////////////
		////////////contra partida 
		
			$CuentaPUC="130505$IDCliente";
			$NombreCuenta="Clientes Nacionales $DatosCliente[RazonSocial] NIT $NIT";
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=0;     //Valor del CREE
			$Valores[19]=round($DatosCotizacion["Total"]);		
			$Valores[20]=$Valores[19]*(-1);
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
			
			
			
			
		}
		
		
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
		
		///////////////////////Registramos ingresos
		
		
		$CuentaPUC=$DatosCotizacion["CuentaPUC"]; 
		$tabla->NombresColumnas("subcuentas");
		$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
		$NombreCuenta=$DatosCuenta["Nombre"];
		
		$Valores[15]=$CuentaPUC;
		$Valores[16]=$NombreCuenta;
		$Valores[18]="0";
		$Valores[19]=round($DatosCotizacion["Total"]-$DatosCotizacion["IVA"]); 			//Credito se escribe el total de la venta menos los impuestos
		$Valores[20]=$Valores[19]*(-1);  											
		
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		///////////////////////Registramos IVA Generado si aplica
		
		if($DatosCotizacion["IVA"]>0){
		
			$CuentaPUC=2408; //2408   IVA Generado
			$tabla->NombresColumnas("cuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]="0";
			$Valores[19]=round($DatosCotizacion["IVA"]); 			//Credito se escribe el total de la venta
			$Valores[20]=$Valores[19]*(-1);  	//para la sumatoria contemplar el balance
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		}
			
		/////////////////////////
		//// Ajustamos inventarios en caso de ser venta de productos
		///////////////////////////////////////////////////////////
		
		if($DatosCotizacion["TipoItem"]=="PR"){
			
			
						
			$InfoProducto=mysql_query("SELECT * FROM `productosventa` WHERE Referencia= '$DatosCotizacion[Referencia]' ",$con) or die("Problemas al consultar los datos en clientes");
			$InfoProducto=mysql_fetch_array($InfoProducto);	
			$idProducto=$InfoProducto['idProductosVenta'];
			if($idProducto > 0){
			///////////////////////////Registro el movimiento de SALIDA DE LA VENTA de los productos al Kardex
					
			$ValorTotalSalidas=$InfoProducto["CostoUnitario"]*$DatosCotizacion["Cantidad"];				
			///////////////////////Registramos costo de mercancia
					
			$CuentaPUC=6135; //6135   costo de mercancia vendida
			$tabla->NombresColumnas("cuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=$ValorTotalSalidas;//Debito se escribe el costo de la mercancia vendida
			$Valores[19]="0"; 			
			$Valores[20]=$ValorTotalSalidas;  	//para la sumatoria contemplar el balance
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
			
			///////////////////////Ajustamos el inventario
			
			$CuentaPUC=1435; //1435   Mercancias no fabricadas por la empresa
			$tabla->NombresColumnas("cuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]="0";
			$Valores[19]=$ValorTotalSalidas;//Credito se escribe el costo de la mercancia vendida			
			$Valores[20]=$ValorTotalSalidas*(-1);  	//para la sumatoria contemplar el balance
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
							
				
			
		}else{
			print("<br><br><br><br><br>No se encontró en el inventario un producto con la referencia $DatosCotizacion[Referencia]<br>");
		}
			
		}
			
		//echo"Egreso Registrado";	
		}
	}
}


////////////////////////////////////////////
/////////////Mensaje posterior ///////////////
////////////////////////////////////////////
$tbl = <<<EOD

<br>


<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Factura guardada satisfactoriamente<br><br>Desea imprimir la factura?</em></strong></span>



<form name="formPrintFact" method="post" action="tcpdf/examples/imprimirfact.php" enctype="multipart/form-data" target="_blank" id="Form3">
<input type="hidden" name="ImgPrintFact" value=$idFacturas>
<input type="image" id="Button5" name="PrintFact" src="images/crear_pdf.png" value=$idFacturas style="position:absolute;left:20px;top:20px;width:110px;height:150px;z-index:103;">

</form>
<input  type="button" value="Terminar" onclick="document.location = 'Terminado.php';" >
		 
EOD;

echo $tbl;

}  else{
	exit("Por favor digite todos los campos");	
}
			

?>