<?php

session_start();
//include("conexion.php");
include("classes_servi/CreaTablasMysql.php");

if(!isset($_SESSION["username"]))
   header("Location: index.php");
  
////////////////////////////////////////////
/////////////Obtengo el id de la factura
////////////////////////////////////////////
 if(    isset($_POST["TxtFactAnular"]) && !empty($_POST["TxtFactAnular"]) &&
	   isset($_POST["TxtObservacionesFact"]) && !empty($_POST["TxtObservacionesFact"])   
	   )
	   {
		    
  
$IDFactura = $_POST["TxtFactAnular"];
$Observaciones = $_POST["TxtObservacionesFact"];

$idUser = $_SESSION['idUser'];
$Login = $_SESSION["username"];
$Nombre = $_SESSION["nombre"];
$Apellido = $_SESSION["apellido"];
$fecha=$_POST["TxtFechaAnul"];	




////////////////////////////////////////////
/////////////Obtengo los datos de la factura
////////////////////////////////////////////

$con=mysql_connect($host,$user, $pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");  
$fac=mysql_query("SELECT * FROM facturas WHERE idFacturas='$IDFactura'");

if(mysql_num_rows($fac)==0){
	exit("No hay facturas asociadas a ese numero");
}
$DatosFactura=mysql_fetch_array($fac);
if($DatosFactura["FormaPago"]=="ANULADA"){
	exit("Esta Factura ya ha sido anulada");
}
$IDCotizacion=$DatosFactura["Cotizaciones_idCotizaciones"];
$IDCliente=$DatosFactura["Clientes_idClientes"];

$Clientes=mysql_query("SELECT * FROM clientes WHERE idClientes='$IDCliente'");
$DatosCliente=mysql_fetch_array($Clientes);



mysql_query("DELETE FROM `cartera` WHERE Facturas_idFacturas= '$IDFactura'",$con) or die("Problemas al eliminar los datos en cartera ".mysql_error());
	
$sel1=mysql_query("SELECT * FROM `impret` WHERE Nombre= 'CREE' ",$con) or die("Problemas al consultar los datos en clientes");
$CREE=mysql_fetch_array($sel1);	



error_reporting(0);

$frac = explode(';',$IDCotizacion);
$no = count($frac)-1;


////////////////////////////////////////////
/////////////ACTUALIZO FACTURAS
////////////////////////////////////////////


	 mysql_query("UPDATE `facturas` SET FormaPago = 'ANULADA' WHERE idFacturas='$IDFactura'") or die("Problemas al actualizar los datos en la factura ".mysql_error());
	 
	
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
$sel1 = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea. ".mysql_error());			

if(mysql_num_rows($sel1)){
	
	while($DatosCotizacion = mysql_fetch_array($sel1)){	
	
	if($DatosCotizacion["Descripcion"]<>""){
	
///////////////////////////////////////////////////////////
/////////////Se realizan asientos contables ///////////////
///////////////////////////////////////////////////////////

		$tab="librodiario";
		$tabla=  new Mytable($servi,$baseDatos,$usuario,$passsword,$tab);
		$tabla->conectar();
		if($DatosCotizacion["TipoItem"]=="MO" or $DatosCotizacion["TipoItem"]==""){
			$Detalle="Anulacion de Venta de Servicios";
		}
		else if($DatosCotizacion["TipoItem"]=="PR"){
		
			$Detalle="Anulacion de Venta de Productos";
			}
		else{
			$Detalle="Anulacion de Venta de Servicios";	
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
		$NombreCuenta="Clientes Nacionales $DatosCliente[RazonSocial] NIT $DatosCliente[Num_Identificacion]";
		
		
		
		$Columnas[0]="Fecha";					$Valores[0]=$fecha;
		$Columnas[1]="Tipo_Documento_Intero";	$Valores[1]="FACTURA";
		$Columnas[2]="Num_Documento_Interno";	$Valores[2]=$IDFactura;
		$Columnas[3]="Tercero_Tipo_Documento";	$Valores[3]=$DatosCliente['Tipo_Documento'];
		$Columnas[4]="Tercero_Identificacion";	$Valores[4]=$DatosCliente['Num_Identificacion'];
		$Columnas[5]="Tercero_DV";				$Valores[5]=$DatosCliente['DV'];
		$Columnas[6]="Tercero_Primer_Apellido";	$Valores[6]=$DatosCliente['Primer_Apellido'];
		$Columnas[7]="Tercero_Segundo_Apellido";$Valores[7]=$DatosCliente['Segundo_Apellido'];
		$Columnas[8]="Tercero_Primer_Nombre";	$Valores[8]=$DatosCliente['Primer_Nombre'];
		$Columnas[9]="Tercero_Otros_Nombres";	$Valores[9]=$DatosCliente['Otros_Nombres'];
		$Columnas[10]="Tercero_Razon_Social";	$Valores[10]=$DatosCliente['RazonSocial'];
		$Columnas[11]="Tercero_Direccion";		$Valores[11]=$DatosCliente['Direccion'];
		$Columnas[12]="Tercero_Cod_Dpto";		$Valores[12]=$DatosCliente['Cod_Dpto'];
		$Columnas[13]="Tercero_Cod_Mcipio";		$Valores[13]=$DatosCliente['Cod_Mcipio'];
		$Columnas[14]="Tercero_Pais_Domicilio";  $Valores[14]=$DatosCliente['Pais_Domicilio'];
		
		$Columnas[15]="CuentaPUC";				$Valores[15]=$CuentaPUC;
		$Columnas[16]="NombreCuenta";			$Valores[16]=$NombreCuenta;
		$Columnas[17]="Detalle";				$Valores[17]=$Detalle;
		$Columnas[18]="Debito";					$Valores[18]="0";
		$Columnas[19]="Credito";				$Valores[19]=round($DatosCotizacion["Total"]);
		$Columnas[20]="Neto";					$Valores[20]=(round($DatosCotizacion["Total"]))*(-1);
		$Columnas[21]="Mayor";					$Valores[21]="NO";
		$Columnas[22]="Esp";					$Valores[22]="NO";
		$Columnas[23]="Concepto";				$Valores[23]=$DatosCotizacion["Descripcion"];
							
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		///////////////////////////////////////////////////////////////
		////////////Registramos Autoretencion
		
		$CuentaPUC=135595; //  Autorretenciones CREE
			$tabla->NombresColumnas("subcuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=0;     //Valor del CREE
			$Valores[19]=$ValorCREE; 			
			$Valores[20]=$ValorCREE*(-1);  	//para la sumatoria contemplar el balance
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		///////////////////////////////////////////////////////////////
		////////////contra partida de la Autoretencion
		
			$CuentaPUC=23657502; //  Cuentas por pagar Autorretenciones CREE
			$tabla->NombresColumnas("subcuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=$ValorCREE;     //Valor del CREE
			$Valores[19]=0; 			
			$Valores[20]=$ValorCREE;  	//para la sumatoria contemplar el balance
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		/////////////////////////////////////////////////////////////////
		//////contra partida
		
		///////////////////////Registramos devoluciones en ventas
		
		
		$CuentaPUC=4175; //4175   devoluciones en ventas
		$tabla->NombresColumnas("cuentas");
		$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
		$NombreCuenta=$DatosCuenta["Nombre"];
		
		$Valores[15]=$CuentaPUC;
		$Valores[16]=$NombreCuenta;
		$Valores[18]=round($DatosCotizacion["Subtotal"]); 			//Subtotal
		$Valores[19]=0;
		$Valores[20]=$Valores[18];  											
		
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		///////////////////////Registramos IVA Generado si aplica
		
		if($DatosCotizacion["IVA"]>0){
		
			$CuentaPUC=2408; //2408   IVA Generado
			$tabla->NombresColumnas("cuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=round($DatosCotizacion["IVA"]); //Debito porque ya no se pagará
			$Valores[19]=0; 			
			$Valores[20]=$Valores[18];  	//para la sumatoria contemplar el balance
			
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
					
			$Movimiento="SALIDA";
			$Detalle="DEVOLUCION";
			$idDocumento=$idFacturas;
			$Cantidad=$DatosCotizacion["Cantidad"]*(-1);
			$ValorUnitario=$tabla->CalculeValorUnitario("kardexmercancias","ProductosVenta_idProductosVenta",$idProducto);
			$ValorTotalSalidas=($Cantidad*$ValorUnitario)*(-1);
			
			$tabla->RegistrarKardex("kardexmercancias","ProductosVenta_idProductosVenta",$fecha, $Movimiento, $Detalle, $idDocumento, $Cantidad, $ValorUnitario, $ValorTotalSalidas, $idProducto);
			
			///////////////////////////Registro el movimiento de SALDOS DESPUES DE LA VENTA de los productos al Kardex
			
			$Movimiento="SALDOS";
			$CantidadSaldo=$tabla->DevuelveSaldoProducto("kardexmercancias","idKardexMercancias","ProductosVenta_idProductosVenta",$idProducto);
			$NuevoSaldo=$CantidadSaldo-($Cantidad*(-1));
			$ValorTotal=$NuevoSaldo*$ValorUnitario;
			$tabla->RegistrarKardex("kardexmercancias","ProductosVenta_idProductosVenta",$fecha, $Movimiento, $Detalle, $idDocumento, $NuevoSaldo, $ValorUnitario, $ValorTotal, $idProducto);
			
							
			///////////////////////Registramos costo de mercancia
					
			$CuentaPUC=6135; //6135   costo de mercancia vendida
			$tabla->NombresColumnas("cuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=0;//Debito se escribe el costo de la mercancia vendida
			$Valores[19]=$ValorTotalSalidas*(-1); 			
			$Valores[20]=$Valores[19]*(-1);  	//para la sumatoria contemplar el balance
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
			
			///////////////////////Ajustamos el inventario
			
			$CuentaPUC=1435; //1435   Mercancias no fabricadas por la empresa
			$tabla->NombresColumnas("cuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=$ValorTotalSalidas*(-1); //El costo de la mercancia que entra como devolucion * -1 porque ya se ha multiplicado arriba
			$Valores[19]=0;		
			$Valores[20]=$Valores[18];  	//para la sumatoria contemplar el balance
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
							
			///////////////////////////Actualiza tabla de productos venta
			
			$tab="productosventa";
			$NumRegistros=3;
			$Columnas[0]="Existencias";
			$Columnas[1]="CostoUnitario";
			$Columnas[2]="CostoTotal";
			$Valores[0]=$NuevoSaldo;
			$Valores[1]=$ValorUnitario;
			$Valores[2]=$ValorTotal;
			$Filtro="idProductosVenta";
			
			$tabla->EditeValoresTabla($tab,$NumRegistros,$Columnas,$Valores,$Filtro,$idProducto);
			
			///////////////////////Ingresamos autoretenciones
			
			//$tab="facturas_autoretenciones";
			$NumRegistros=7;
			$Columnas[0]="Fecha";
			$Columnas[1]="NombreAutoRetencion";
			$Columnas[2]="Porcentaje";
			$Columnas[3]="Monto";
			$Columnas[4]="Paga";
			$Columnas[5]="Facturas_idFacturas";
			$Columnas[6]="idImpRet";
			
			
			$Valores[0]=$fecha;
			$Valores[1]=$CREE["Nombre"];
			$Valores[2]=$CREE["Valor"];
			$Valores[3]=$ValorCREE*(-1);					//Valor de la autorentecion del CREE		
			$Valores[4]="NO";  	
			$Valores[5]=$idFacturas;						
			$Valores[6]=$CREE["idImpRet"];  	
			
			$tabla->InsertarRegistro('facturas_autoretenciones',$NumRegistros,$Columnas,$Valores);
			
			
			
		}else{
			print("<br><br><br><br><br>No se encontró en el inventario un producto con la referencia $DatosCotizacion[Referencia]<br>");
		}
			
		}
			
		
		}
	}
}

}else{
	exit("Por favor digite todos los campos");	
}
			
echo" Anulacion Registrada";	
?>