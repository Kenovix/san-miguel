<script language="JavaScript"> 
function cargaDesdeId(){ 


var DatosProducto=document.getElementById('idListProductos').value;
var arrPartes=DatosProducto.split(';');
var idProducto=arrPartes[0];

document.getElementById('Editbox1').value=idProducto;
document.getElementById('Editbox2').value=arrPartes[1] ;
document.getElementById('Editbox3').value=arrPartes[3] ;
document.getElementById("Editbox4").focus();
} 

function cargaDesdeNombre(){ 


var DatosProducto=document.getElementById('idListProductosNombre').value;
var arrPartes=DatosProducto.split(';');
var idProducto=arrPartes[1];

document.getElementById('Editbox1').value=idProducto;
document.getElementById('Editbox2').value=arrPartes[0] ;
document.getElementById('Editbox3').value=arrPartes[3] ;
document.getElementById("Editbox4").focus();
} 

function preguntaConfirm(e){
if (e.keyCode == 13){
	if(document.getElementById('Editbox3').value=="undefined" || document.getElementById('Editbox3').value=="0" || document.getElementById('Editbox3').value=="")
	{
		document.getElementById('Editbox3').style.backgroundColor = '#2EFEF7';
		document.getElementById("idListProductos").focus();
		alert("Este producto no tiene valor unitario, por favor editelo de lo contrario no podrá agregarlo");
		return;
	}
		
	var confirma = confirm('¿Estas seguro que deseas devolver este producto?');
    if (confirma){ 
		
	   if(document.getElementById('Editbox1').value != "undefined" && document.getElementById('Editbox2').value != "undefined" &&
	   document.getElementById('Editbox1').value != "" && document.getElementById('Editbox2').value != ""
	   
	   ){	
			if(document.getElementById('Editbox4').value != ""){
				document.FormAgregaTeclado.submit();
			}else{
				document.getElementById('Editbox4').style.backgroundColor = '#FFF555';
				document.getElementById("Editbox4").focus();
				alert("Por favor digita una cantidad valida");
			}			
			
		} 
      else{
		document.getElementById('Editbox1').style.backgroundColor = '#FF5555';
		document.getElementById('Editbox2').style.backgroundColor = '#FF5555';
		document.getElementById("idListProductos").focus();
		alert("Datos incompletos, intentalo de nuevo");
		}
    } 
} 
}

function devuelve(){ 

if (confirm('¿Estas seguro que deseas realizar esta devolución?')){ 
     thisform.submit();
     
    } 
}	
function asigna(){ 
   
   document.getElementById("idListProductos").focus();
} 

function IrAPagar(e){ 
   if (e.keyCode == 13){
	document.getElementById("paga").focus();
   }
} 

function PosicionarImpr(){ 
   
	document.getElementById("print").focus();
   
} 

</script> 
<?php



 session_start();
   if(!isset($_SESSION["username"])){
   header("Location: index.html");
}

$fecha=date("Y-m-d");

error_reporting(0);

//include("conexion.php");
include("classes_servi/CreaTablasMysqlVender.php");
/*
while ($post = each($_POST))
{
echo $post[0] . " = " . $post[1];
}
echo "entra a ver inventarios";
*/
//print("Entra");
		$tab = "ventas";
		$idFactura = $_POST["TxtBuscarFactura"];


		$tabla=  new Mytable($host,$db,$user,$pw,$tab);
		$tabla->conectar();
		$tabla->NombresColumnas($tab);
		
		$tabla->NombresColumnas("facturas");
		$DatosFactura=$tabla->DevuelveValores($idFactura);
		$idCotizaciones=$DatosFactura["Cotizaciones_idCotizaciones"];
		$FormaPago=$DatosFactura["FormaPago"];
		
		
if(isset($_POST["BtnAsignarCambio"])){
	
		$idVentaActiva=$_POST["CbVentasActivas"];
		$SaldoFavor=$_POST["TxtSaldoFavor"];
		
		$sql="SELECT SaldoFavor from `vestasactivas` WHERE `idVestasActivas` = '$idVentaActiva'";
	
	
		$reg=mysql_query($sql, $tabla->con) or die('no se pudo obtener el valor del saldo a favor la Preventa: ' . mysql_error());	
		
		$reg=mysql_fetch_array($reg);
		$SaldoActual=$reg["SaldoFavor"];
		
		$SaldoFavor=$SaldoFavor+$SaldoActual;
		
		$sql="UPDATE `vestasactivas` SET `SaldoFavor` = '$SaldoFavor' WHERE `idVestasActivas` = '$idVentaActiva'";
	
	
		mysql_query($sql, $tabla->con) or die('no se pudo actualizar la Preventa: ' . mysql_error());	
		print("Se ha asignado el valor $SaldoFavor a la PreVenta No. $idVentaActiva");
}

if(isset($_POST["BtnDevolver"])){
	
	$idItemDev=$_POST["ItemVenta"];
	
	
	$CantidadDev=$_POST["TxtCantidadDev"];
	////////////////////////////////////////////
/////////////Obtengo los datos de la factura
////////////////////////////////////////////

$con=mysql_connect($host,$user, $pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");  
$fac=mysql_query("SELECT * FROM cotizaciones WHERE idCotizaciones='$idItemDev'");


$DatosCotizacion=mysql_fetch_array($fac);

$IDCliente=$DatosCotizacion["Clientes_idClientes"];

$Clientes=mysql_query("SELECT * FROM clientes WHERE idClientes='$IDCliente'");
$DatosCliente=mysql_fetch_array($Clientes);

$TotalDev=$CantidadDev*$DatosCotizacion["ValorUnitario"];
$IVAUni=ROUND($DatosCotizacion["IVA"]/$DatosCotizacion["Cantidad"]);
$IVADev=$IVAUni*$CantidadDev;
$TotalDev=$TotalDev+$IVADev;
$SubTotalDev=$TotalDev-$IVADev;
$CostoDev=ROUND($CantidadDev*$DatosCotizacion["PrecioCosto"]);

	
$sel1=mysql_query("SELECT * FROM `impret` WHERE Nombre= 'CREE' ",$con) or die("Problemas al consultar los datos en clientes");
$CREE=mysql_fetch_array($sel1);	


echo "Se ha devuelto el item $idItemDev de la venta No. $DatosFactura[OSalida]";
//error_reporting(0);


	
	
	
///////////////////////////////////////////////////////////
/////////////Se realizan asientos contables ///////////////
///////////////////////////////////////////////////////////
		
		$tab="librodiario";
		$tabla->NombresColumnas($tab);
		$Detalle="Anulacion de Venta de Productos";
		
		
		/////////////////////////////////////////////////////////////////
		//////calculamos autorretencion
		$Subtotal=$DatosCotizacion["Subtotal"];
		$ValorCREE=round($Subtotal*$CREE['Valor']);
		//$Entrada=round($DatosCotizacion["Total"]-$ValorCREE);
		/////////////////////////////////////////////////////////////////
		//////registramos en libro diario 
		
		$tab="librodiario";
		$NumRegistros=24;
		if($FormaPago=="Credito"){
			$CuentaPUC="130505$IDCliente";
			$NombreCuenta="Clientes Nacionales $DatosCliente[RazonSocial] $DatosCliente[Num_Identificacion]";
		}
		
		if($FormaPago<>"Credito"){
			$CuentaPUC="110510";
			$NombreCuenta="Caja Menor";
		}
		
		
		
		$Columnas[0]="Fecha";					$Valores[0]=$fecha;
		$Columnas[1]="Tipo_Documento_Intero";	$Valores[1]="FACTURA";
		$Columnas[2]="Num_Documento_Interno";	$Valores[2]=$idFactura;
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
		$Columnas[19]="Credito";				$Valores[19]=$TotalDev;
		$Columnas[20]="Neto";					$Valores[20]=$Valores[19]*(-1);
		$Columnas[21]="Mayor";					$Valores[21]="NO";
		$Columnas[22]="Esp";					$Valores[22]="NO";
		$Columnas[23]="Concepto";				$Valores[23]="Devolucion de $DatosCotizacion[Referencia] en factura No $idFactura";
				

		
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		
		/*
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
		*/
		///////////////////////Registramos devoluciones en ventas
		
		
		$CuentaPUC=4175; //4175   devoluciones en ventas
		$tabla->NombresColumnas("cuentas");
		$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
		$NombreCuenta=$DatosCuenta["Nombre"];
		
		$Valores[15]=$CuentaPUC;
		$Valores[16]=$NombreCuenta;
		$Valores[18]=$SubTotalDev; 			//Subtotal
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
			$Valores[18]=$IVADev; //Debito porque ya no se pagará
			$Valores[19]=0; 			
			$Valores[20]=$Valores[18];  	//para la sumatoria contemplar el balance
			
			
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
		}
			
		/////////////////////////
		//// Ajustamos inventarios en caso de ser venta de productos
		///////////////////////////////////////////////////////////
		
		
			
						
			$InfoProducto=mysql_query("SELECT * FROM `productosventa` WHERE Referencia= '$DatosCotizacion[Referencia]' ",$con) or die("Problemas al consultar los datos en productos venta".mysql_error());
			$InfoProducto=mysql_fetch_array($InfoProducto);	
			$idProducto=$InfoProducto['idProductosVenta'];
			$ValorUnitario=$InfoProducto['CostoUnitario'];
			$CantidadSaldo=$InfoProducto['Existencias'];
			if($idProducto > 0){
			///////////////////////////Registro el movimiento de SALIDA DE LA VENTA de los productos al Kardex
					
			$Movimiento="SALIDA";
			$Detalle="DEVOLUCION";
			$idDocumento=$idFactura;
			$Cantidad=$CantidadDev*(-1);
			//$ValorUnitario=round($tabla->CalculeValorUnitario("kardexmercancias","ProductosVenta_idProductosVenta",$idProducto));
			$ValorTotalSalidas=round(($Cantidad*$ValorUnitario)*(-1));
			
			$tabla->RegistrarKardex("kardexmercancias","ProductosVenta_idProductosVenta",$fecha, $Movimiento, $Detalle, $idDocumento, $Cantidad, $ValorUnitario, $ValorTotalSalidas, $idProducto);
			
			///////////////////////////Registro el movimiento de SALDOS DESPUES DE LA VENTA de los productos al Kardex
			
			$Movimiento="SALDOS";
			//$CantidadSaldo=$tabla->DevuelveSaldoProducto("kardexmercancias","idKardexMercancias","ProductosVenta_idProductosVenta",$idProducto);
			$NuevoSaldo=$CantidadSaldo+$CantidadDev;
			$ValorTotal=round($NuevoSaldo*$ValorUnitario);
			$tabla->RegistrarKardex("kardexmercancias","ProductosVenta_idProductosVenta",$fecha, $Movimiento, $Detalle, $idDocumento, $NuevoSaldo, $ValorUnitario, $ValorTotal, $idProducto);
			
			
							
			///////////////////////Registramos costo de mercancia
					
			$CuentaPUC=6135; //6135   costo de mercancia vendida
			$tabla->NombresColumnas("cuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=0;//Debito se escribe el costo de la mercancia vendida
			$Valores[19]=$ValorTotalSalidas; 			
			$Valores[20]=$Valores[19]*(-1);  	//para la sumatoria contemplar el balance
			
			$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
			
			///////////////////////Ajustamos el inventario
			
			$CuentaPUC=1435; //1435   Mercancias no fabricadas por la empresa
			$tabla->NombresColumnas("cuentas");
			$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
			$NombreCuenta=$DatosCuenta["Nombre"];
			
			$Valores[15]=$CuentaPUC;
			$Valores[16]=$NombreCuenta;
			$Valores[18]=$ValorTotalSalidas; //El costo de la mercancia que entra como devolucion * -1 porque ya se ha multiplicado arriba
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
			$Valores[1]=$InfoProducto["CostoUnitario"];
			$Valores[2]=$InfoProducto["CostoUnitario"]*$NuevoSaldo;
			$Filtro="idProductosVenta";
			
			$tabla->EditeValoresTabla($tab,$NumRegistros,$Columnas,$Valores,$Filtro,$idProducto);
			
			///////////////////////////Actualiza factura
			
			
			$tab="facturas";
			$NumRegistros=2;
			
			$Columnas[0]="SaldoFact";
			$Columnas[1]="TotalCostos";
			
			$Valores[0]=$DatosFactura["SaldoFact"]-$TotalDev;
			$Valores[1]=round($DatosFactura["TotalCostos"]-$ValorTotalSalidas);
			$Filtro="idFacturas";
			$SaldoFactura=$Valores[0];
			$tabla->EditeValoresTabla($tab,$NumRegistros,$Columnas,$Valores,$Filtro,$idFactura);
			
			
			///////////////////////////Actualiza Cartera si es credito, ojo esto siempre debe estar despues de actualizar facturas
			
			if($FormaPago=="Credito"){
				$tab="cartera";
				$NumRegistros=1;
				$Columnas[0]="Saldo";
				
				$Valores[0]=$SaldoFactura;
				
				$Filtro="Facturas_idFacturas";
				
				$tabla->EditeValoresTabla($tab,$NumRegistros,$Columnas,$Valores,$Filtro,$idFactura);
				
				if($SaldoFactura<=0){
					
					$tabla->EliminarRegistros($tab,$Filtro, $idFactura);
				}
			
			}
			
			
			
			//////registramos en devoluciones
		
		$tab="ventas_devoluciones";
		$NumRegistros=13;
		
		
		$Columnas[0]="Facturas_idFacturas";				$Valores[0]=$idFactura;
		$Columnas[1]="FechaDevolucion";					$Valores[1]=$fecha;
		$Columnas[2]="Descripcion";						$Valores[2]=$DatosCotizacion['Descripcion'];
		$Columnas[3]="Referencia";						$Valores[3]=$DatosCotizacion['Referencia'];
		$Columnas[4]="ValorUnitario";					$Valores[4]=$DatosCotizacion['ValorUnitario'];
		$Columnas[5]="Cantidad";						$Valores[5]=$CantidadDev;
		$Columnas[6]="Subtotal";						$Valores[6]=$SubTotalDev;
		$Columnas[7]="IVA";								$Valores[7]=$IVADev;
		$Columnas[8]="Total";							$Valores[8]=$TotalDev;
		$Columnas[9]="SubtotalCosto";					$Valores[9]=$ValorTotalSalidas;
		$Columnas[10]="Clientes_idClientes";			$Valores[10]=$DatosCotizacion['Clientes_idClientes'];
		$Columnas[11]="Usuarios_idUsuarios";			$Valores[11]=$_SESSION['idUser'];
		$Columnas[12]="Observaciones";					$Valores[12]=$_POST['TxtObservaciones'];
		
							
		$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
		
			
		
			///Borramos el Item de la cotizacion
			
			
			$SaldoDevolucionCot=$DatosCotizacion['Devuelto']+$CantidadDev;
			mysql_query("UPDATE `cotizaciones` SET Devuelto='$SaldoDevolucionCot'  WHERE idCotizaciones= '$idItemDev'",$con) or die("Problemas al actualizar el item de cotizaciones ".mysql_error());
			
			$sqlD=mysql_query("SELECT MAX(idDevoluciones) as idMax FROM ventas_devoluciones",$con) or die("Problemas al seleccionar el maximo de Devoluciones".mysql_error());
			$sqlD=mysql_fetch_array($sqlD);
			$idMaxD=$sqlD['idMax'];
			
			
			///////////////////////////////////////////777
			
			
			
			print( "<br><form name=formDev method='post' action='printer/Comprobante.php' target='_blank'>
						<input type=hidden name=TxtIdDev value=$idMaxD>
						<input type=submit name=BtnPrintDev value='Imprimir Comprobante'></form>
				");
				
				if($FormaPago=="Contado"){
				print( "<br>Seleccione la preventa  a la que desea asignar el saldo de: $$TotalDev");
				
			}else{
				print( "<br>Item borrado de la factura, se descontó del saldo de la factura $idFactura: $$TotalDev");
				
			}	
				
			$r = mysql_query("SELECT * FROM vestasactivas WHERE Usuario_idUsuario='$_SESSION[idUser]'",$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
echo "<form name=formAsign method='post' action='VerFacturas.php' target='_self'>
<select name=CbVentasActivas size=1 id=CbVentasActivas required>";
echo "<option value=';NO;NO;NO'>Seleccione la venta</option>";

if(mysql_num_rows($r)){//Si existen resultados

   while($ventas=mysql_fetch_array($r)){
      echo "<option value= '$ventas[idVestasActivas]'>$ventas[Nombre] No. $ventas[idVestasActivas]</option>";
   }

}


echo "</select>";
echo "<input type=hidden name=TxtBuscarFactura value=$idFactura>
		<input type=hidden name=TxtSaldoFavor value=$TotalDev>
		<input type=submit name='BtnAsignarCambio' value='Asignar este saldo a esta preventa'></form>";
exit();
			
		}else{
			print("<br><br><br><br><br>No se encontró en el inventario un producto con la referencia $DatosCotizacion[Referencia]<br>");
		}
			
		
			
		
		
		
		
	}


	
		$tab = "cotizaciones";
		
		$tabla->NombresColumnas($tab);
		
		$tabla->TableDrawFacturas($idCotizaciones,$idFactura);
		
		//echo "Por favor digitar el nombre del articulo para buscar";
	    //print('<script language="JavaScript"> PosicionarImpr();</script> ');
		//echo " sale a venta realizada";
	
	
?>
