<script src="shortcuts.js" type="text/javascript">
</script>
<script language="JavaScript"> 

function init()
{

shortcut("Ctrl+S",function()
{
document.getElementById("Vender").click();
});
shortcut("Ctrl+Q",function()
{
document.getElementById("paga").focus();
});
shortcut("Ctrl+E",function()
{
document.getElementById("idTxtCodigoBarras").focus();
});

shortcut("Ctrl+F",function()
{
document.getElementById("volver").click();
});

}

function cargarDesdeCB(){ 


document.FormAgregaTeclado.submit();

} 


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
		
	var confirma = confirm('¿Estas seguro que deseas agregar este producto?');
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

function asigna(){ 
   
   document.getElementById("idTxtCodigoBarras").focus();
} 


function IrAPagar(e){ 
   if (e.keyCode == 13){
	document.getElementById("paga").focus();
   }
} 

function PosicionarImpr(){ 
   
	document.getElementById("BtnPrintPOS").focus();
   
} 

</script> 
<?php



 session_start();
   if(!isset($_SESSION["username"])){
   header("Location: index.php");
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
$tab = "productosventa";
$itemBuscar = $_POST["TxtBuscar"];
$operacion=$_POST["Operacion"];
$VentasActivas=$_POST["CbVentasActivas"];
$data = explode(";", $_POST["CbVentasActivas"]);
$idVentaActiva=$data[1];
$idUsuario=$data[3];
$accion="";

if(isset($_POST["agregarItemPreventa"])){
	
	$idProducto = $_POST["agregarItemPreventa"];
	$Cantidad=$_POST[$idProducto];
	
	$accion="AgregarItemPreventa";
}

if(isset($_POST["TxtCantidadTeclado"])){
	
	$idProducto = $_POST["TxtIdProducto"];
	$Cantidad=$_POST["TxtCantidadTeclado"];
	
	$accion="AgregarItemPreventaTeclado";
}

if(isset($_POST["BorrarItem"])){
	
	$idPreventaDel = $_POST["BorrarItem"];
	//$Cantidad=$_POST[$idProducto];
	$accion="BorrarItemPreventa";
}

if(isset($_POST["EditarCantidad"])){
	
	$idPreventaEdit = $_POST["EditarCantidad"];
	$Cantidad=$_POST[$idPreventaEdit];
	$ValorAcordado=$_POST["ValUni$idPreventaEdit"];
	$accion="EditarItemPreventa";
}
//echo " evalua";
if(isset($_POST["Vender"])){
	//echo "entra a post";
	$idPreventa = $_POST["Vender"];
	$Paga=$_POST["paga"];
	$TipoVenta = $_POST["CmbTipoVenta"];
	$Comisionista=$_POST["CmbColaboradores"];
	$ComisionPost=$_POST["CmbComisiones"];
	$CuentaDestino=$_POST["CmbCuentaDestino"];
	$accion="VentaRealizada";
	//echo "sale a post";
	
}

if(isset($_POST["BtnAsignarCliente"])){
	
	$idVentaActiva = $_POST["TxtVentasActivas"];
	$idUsuario=$_POST['TxtIdUsuario'];
	$VentaActiva=$_POST['CbVentasActivas'];
	
	////////////////////////////////////////////////////////////////////////////////////77
	/////////Buscar Cliente para Asignar a una Pre Venta//////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////777
	

		
		print("<center><H4>BUSQUE UN CLIENTE PARA ASIGNAR A LA PREVENTA No. $idVentaActiva <form action='VerInventariosVender.php' method='POST' target='_self'>
		<input type='hidden' name='TxtVentasActivas' value='$idVentaActiva'>
		<input type='hidden' name='TxtIdUsuario' value='$idUsuario'>
		<input type='hidden' name='CbVentasActivas' value='$VentaActiva'>
		<input type='text' name='TxtBuscarCliente' placeholder='Escriba un dato del cliente'>
		<input type='submit' name='BtnBuscarCliente' value='Buscar'>
		</form></center>
		");
	
	
	exit();
	////////////////////////////////////////////////////////////////////////////////////77
	//////////////////////7777777//////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////777
}	


if(isset($_POST["BtnBuscarCliente"])){
	
	$idVentaActiva = $_POST["TxtVentasActivas"];
	$VentaActiva = $_POST["CbVentasActivas"];
	$idUsuario=$_POST['TxtIdUsuario'];
	$key_words    = $_POST['TxtBuscarCliente'];
 
	////////////////////////////////////////////////////////////////////////////////////77
	/////////Buscar Cliente para Asignar a una Pre Venta//////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////777
	

		
		print("<center><H4>BUSQUE UN CLIENTE PARA ASIGNAR A LA PREVENTA No. $idVentaActiva <form action='VerInventariosVender.php' method='POST' target='_self'>
		<input type='hidden' name='TxtVentasActivas' value='$idVentaActiva'>
		<input type='hidden' name='TxtIdUsuario' value='$idUsuario'>
		
		<input type='text' name='TxtBuscarCliente' placeholder='Escriba un dato del cliente'>
		<input type='submit' name='BtnBuscarCliente' value='Buscar'>
		</form>
		");
	
	
	
	 
if(strlen($key_words)>2){//No realizamos búsqueda si la palabra es de un solo caracter
            if($key_words){
           				
                        //Contamos el numero de palabras que incluye la búsqueda.
                        $frac    = explode(' ',$key_words);
                        $no                  = count($frac);
						
                       	 $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
		 				 mysql_select_db($db,$con) or die("la base de datos no abre");
						 
                        //Si la búsqueda tiene una palabra utilizamos LIKE sino MATCH AGAINST.
                        if($no == 1){
                                   $sql = " SELECT * FROM clientes WHERE RazonSocial LIKE '%$key_words%' OR Num_Identificacion LIKE '%$key_words%'
								   			OR Telefono LIKE '%$key_words%' OR Ciudad LIKE '%$key_words%'
											 ";
                        }else{
                                   exit ("Por favor digite una sola palabra sin espacios");
                        }
                       
					   echo "<table width='600' border='1'>
	<tr><th ALIGN= 'center' colspan='10'>DATOS DEL CLIENTE</th></tr>
		  <tr><th>ID</th><th>Nombre</th><th>Cedula</th><th>Direccion</th>
		  <th> Asociar Venta </th>
";

                        //Ejecutamos el codigo Mysql
                        $r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
                       
                        if(mysql_num_rows($r)){//Si existen resultados
                                   while($DatosCliente= mysql_fetch_array($r)){
                                               print("<tr><td>$DatosCliente[idClientes]</td> <td>$DatosCliente[RazonSocial]</td> <td>$DatosCliente[Num_Identificacion]</td> <td>$DatosCliente[Direccion]</td> <td align=center>
											   <form name=formCargarCoti method='POST' action='VerInventariosVender.php' target='_self'>
											   <input type=hidden name='TxtVentasActivas' value='$idVentaActiva'>
											   <input type=hidden name='TxtBuscar' value=''>
											   
											   <input type=hidden name='CbVentasActivas' value='$VentaActiva'>
											   <input type=hidden name='TxtIdCliente' value='$DatosCliente[idClientes]'>
											   <input type=hidden name='BtnClienteAsignado' value='$DatosCliente[idClientes]'>
												<input type='image' src='iconos/Add.png' name='BtnAsignar' value=$DatosCliente[idClientes]
												style='width:50px;height:50px;'></form></td></tr>

");

                                   }
								   echo "</table></center>";
                        }else{//Si no existen resultados
                                   print("No se encontraron resultados.");
                        }
            }else{//Si no existen palabra clave
                        print("No existen palabras clave.");
            }
}else{//Si la palabra clave solo tiene un carácter

print("Palabra clave demasiado corta. Digite una palabra con mas de 3 letras");

}

	
	
	
	exit();
	////////////////////////////////////////////////////////////////////////////////////77
	//////////////////////7777777//////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////777
}	


if(isset($_POST["BtnClienteAsignado"])){
	
	$idClientes = $_POST["TxtIdCliente"];
	$idVentaActiva = $_POST["TxtVentasActivas"];
	//$idVentaActiva = $_POST["TxtVentasActivas"];
	$accion="AsignarClientePreVenta";
}
	
if(isset($_POST["TxtCodigoBarras"])){
	
	$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
    mysql_select_db($db,$con) or die("la base de datos no abre");
	
	$CodigoBarras = $_POST["TxtCodigoBarras"];
	$Cantidad=1;
	$sql="SELECT * FROM prod_codbarras WHERE CodigoBarras = '$CodigoBarras'";
	$r = mysql_query($sql,$con) or die("La consulta a codigo de barras es erronea .".mysql_error());
	if(mysql_num_rows($r)){
		$r= mysql_fetch_array($r);
		$idProducto=$r["ProductosVenta_idProductosVenta"];
		$accion="AgregarItemPreventaTeclado";
	}else{
		print('<script language="JavaScript">alert("Este producto no esta en la base de datos por favor no lo entregue")</script>');
		$accion="";
		$operacion="VerPreVenta";
	}	
}

$tabla=  new Mytable("localhost","softcontech_v4","root","pirlo1985",$tab);
$tabla->conectar();
$tabla->NombresColumnas($tab);

if(	$itemBuscar==""){
	if($operacion=="VerVenta"){
		$tabla->TableDrawVender($VentasActivas);
		//echo "Por favor digitar el nombre del articulo para buscar";
	}
		
		
	if($operacion=="VerPreVenta" && $accion<>"AgregarItemPreventaTeclado"){
		$tabla->TableDrawPreVenta($VentasActivas,$idVentaActiva,$idUsuario,$operacion);
}
			
	if($accion=="AgregarItemPreventa"){
		$tabla->AgregaPreventa($fecha,$Cantidad,$idVentaActiva,$idProducto,0,$idUsuario);
		echo "El usuario $idUsuario, ha agregado el Producto con id: $idProducto, en la Preventa $idVentaActiva";
		$tabla->TableDrawVender($VentasActivas);
	}
	
	if($accion=="AgregarItemPreventaTeclado"){
		$tabla->AgregaPreventa($fecha,$Cantidad,$idVentaActiva,$idProducto,0,$idUsuario);
		
		$tabla->TableDrawPreVenta($VentasActivas,$idVentaActiva,$idUsuario,$operacion);
	}
	
	if($accion=="BorrarItemPreventa"){
		$tabla->NombresColumnasEsp("preventa");
		$tabla->DelItem("preventa",$idPreventaDel);
		echo "El usuario $idUsuario, ha eliminado el Producto con id: $idPreventaDel, en la Preventa $idVentaActiva";
		$tabla->TableDrawPreVenta($VentasActivas,$idVentaActiva,$idUsuario,$operacion);
	}
	
	if($accion=="EditarItemPreventa"){
	
			
		
		$tabla->NombresColumnas("preventa");
		$campos=$tabla->DevuelveValores($idPreventaEdit);
		$idProducto=$campos["ProductosVenta_idProductosVenta"];
		$tabla->NombresColumnas("productosventa");
		$campos=$tabla->DevuelveValores($idProducto);
		$impuestos=$campos["IVA"];
		$PrecioVenta=$campos["PrecioVenta"];
		
		$tabla->NombresColumnas("preventa");
		$campos=$tabla->DevuelveValores($idPreventaEdit);
		$subtotal=round($ValorAcordado*$Cantidad);
		$impuestos=round($subtotal*$impuestos);
		//$subtotal=$subtotal-$impuestos;
		$total=$subtotal+$impuestos;
		//print_r($campos);
		$NumCols=6;
		
		$columnas[0]='ValorAcordado';  							$campos[0]=$ValorAcordado;
		$columnas[1]='Cantidad';								$campos[1]=$Cantidad;
		$columnas[2]='Subtotal';								$campos[2]=$subtotal;
		$columnas[3]='Descuento';								$campos[3]=($PrecioVenta*$Cantidad)-$subtotal;
		$columnas[4]='Impuestos';								$campos[4]=$impuestos;
		$columnas[5]='TotalVenta';								$campos[5]=$total;
			
		//print("<br><br><br><br>");
		//print_r($campos);
		print("<br><br><br><br>");
	    $tabla->EditarResgistroTabla($NumCols,$columnas,$campos, $idPreventaEdit);
		echo "El usuario $idUsuario, ha editado el Producto con id: $idPreventaEdit, en la Preventa $idVentaActiva";
		$tabla->NombresColumnas("productosventa");
		$tabla->TableDrawPreVenta($VentasActivas,$idVentaActiva,$idUsuario,$operacion);
		
	}
	
	
	if($accion=="AsignarClientePreVenta"){
		
		$sql="UPDATE `vestasactivas` SET `Clientes_idClientes` = '$idClientes' WHERE `idVestasActivas` = $idVentaActiva;";
	
	
		
		mysql_query($sql, $tabla->con) or die('no se pudo actualizar la Preventa: ' . mysql_error());	
		print("Se ha asignado el cliente $idClientes a la PreVenta No. $idVentaActiva");
		$tabla->TableDrawPreVenta($VentasActivas,$idVentaActiva,$idUsuario,$operacion);
	}
	
	
	if($accion=="VentaRealizada"){
		
		
		//////// Averiguamos el numero de la factura que se creara/////////////////////////////////////////////////////////////////////////////////

$tabla->NombresColumnas("facturas");
$maxID=$tabla->VerUltimoID();
$idFact=$maxID+1;
		
		//echo "entra a venta realizada";
		// en caso de que sea por porcentaje el pago de la comision
		$tabla->NombresColumnas("preventa");
		$Descuentos=$tabla->SumeColumnaEsp(10, 3,$idPreventa);
		$Impuestos=$tabla->SumeColumnaEsp(11, 3,$idPreventa);
		$TotalVenta=$tabla->SumeColumnaEsp(12, 3,$idPreventa);
		$TotalVentaNeta=$TotalVenta-$Impuestos-$Descuentos;
		$ValorComision=$TotalVentaNeta*$ComisionPost;
		$Devuelta=$Paga-$TotalVenta;
		//print(" esta venta: $TotalVentaNeta $Descuentos $Impuestos $TotalVenta");
		
		$NumVenta=$tabla->RegistreVenta($idPreventa,$TipoVenta,$CuentaDestino,$ValorComision,$Comisionista);
		
		if($TipoVenta==0)
				$TipoVenta1="Contado";
			else	
				$TipoVenta1="Credito";
			/*
		if($Comisionista<>"NO"){
			
			$tabla->RegistreComision($fecha,$ValorComision, $TipoVenta1,$Comisionista,$NumVenta,"NO");
		
		}
		*/
		
		$tabla->EliminarRegistros("preventa","VestasActivas_idVestasActivas",$idPreventa);
		//$tabla->EliminarRegistros("vestasactivas","idVestasActivas",$idPreventa);
		
		//echo" verifica cotizacion ";
		
		//////// Averiguamos el ultimo numero de cotizacion/////////////////////////////////////////////////////////////////////////////////

$tabla->NombresColumnas("cotizaciones");
$maxID=$tabla->VerUltimoID();
$idCoti=$maxID+1;
$campos=$tabla->DevuelveValores($maxID);
$NumCot=$campos["NumCotizacion"];

		//echo" ingresa factura ";
		///////////////////////////Ingresar a Facturas 
					
					$tabla->NombresColumnas("vestasactivas");
					$DatosVentasActivas=$tabla->DevuelveValores($idPreventa);
					$idCliente=$DatosVentasActivas["Clientes_idClientes"];
										
					$tabla->NombresColumnas("clientes");
					$DatosCliente=$tabla->DevuelveValores($idCliente);
					$NIT=$DatosCliente["Num_Identificacion"];
					$RazonSocialC=$DatosCliente["RazonSocial"];
					$TelefonoC=$DatosCliente["Telefono"];
					$ContactoC=$DatosCliente["Contacto"];
					$TelContacto=$DatosCliente["TelContacto"];
					
					$tab="facturas";
					$NumRegistros=12;  
										
					
					$Columnas[0]="Fecha";						$Valores[0]=$fecha;
					$Columnas[1]="FormaPago";					$Valores[1]="Contado";
					$Columnas[2]="Subtotal";					$Valores[2]=$TotalVenta-$Impuestos;
					$Columnas[3]="IVA";							$Valores[3]=$Impuestos;
					$Columnas[4]="Descuentos";					$Valores[4]=$Descuentos;
					$Columnas[5]="Total";						$Valores[5]=$TotalVenta;
					$Columnas[6]="SaldoFact";					$Valores[6]=$TotalVenta;
					$Columnas[7]="Cotizaciones_idCotizaciones";	$Valores[7]=$NumCot;
					$Columnas[8]="EmpresaPro_idEmpresaPro";		$Valores[8]="1";
					$Columnas[9]="Usuarios_idUsuarios";			$Valores[9]=$idUsuario;
					$Columnas[10]="Clientes_idClientes";		$Valores[10]=$idCliente;
					$Columnas[11]="OSalida";					$Valores[11]=$NumVenta;
					
					$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
					
					
					
//echo" ingresa cartera ";

///////////////////////////Ingresar a Cartera en caso de ser un credito 
					
			if($TipoVenta1=="Credito"){
				
					
				
					$tab="cartera";
					$NumRegistros=9;  
										
					
					$Columnas[0]="FechaVencimiento";			$Valores[0]=$fecha;
					$Columnas[1]="Cliente";						$Valores[1]=$RazonSocialC;
					$Columnas[2]="Telefono";					$Valores[2]=$TelefonoC;
					$Columnas[3]="Contacto";					$Valores[3]=$ContactoC;
					
					$Columnas[4]="TelContacto";					$Valores[4]=$TelContacto;
					$Columnas[5]="Saldo";						$Valores[5]=$TotalVenta;
					$Columnas[6]="DiasCartera";					$Valores[6]="0";
					$Columnas[7]="Observaciones";				$Valores[7]="Entra desde ventas locales por el usuario: $idUsuario";
					$Columnas[8]="Facturas_idFacturas";			$Valores[8]=$idFact;
					
					
					$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
					
				}
		
		$sql="UPDATE `vestasactivas` SET `Clientes_idClientes` = '0' WHERE `idVestasActivas` = $idVentaActiva;";

		mysql_query($sql, $tabla->con) or die('no se pudo actualizar la Preventa: ' . mysql_error());						
		
		echo 'Se ha pagado: $'.number_format($Paga).' del total: $'.number_format($TotalVenta).', por favor devolver: $'.number_format($Devuelta);
		/////////////Espacio para colocar la opcion de imprimir
		print("<br>Pulse para imprimir esta factura");
		print('<br><iframe name="FrameMensajes" id="InlineFrame1" style="width:300px;height:50px;" src="http://" frameborder="0"></iframe>
		<center><form name="FormPrintPost" id="FormPrintPost" method="POST" action="printer/imprimir.php" target="FrameMensajes">
		
		<input type="hidden" src="iconos/print.png" name="print" id="print" value='.$NumVenta.' style=width:150px;height:150px;><br>
		<input type="submit" name="BtnPrint" id="BtnPrintPOS" value="Imprimir en POS" style=width:150px;height:150px;><br>
		</form> 
		
		<form name="FormPrintNormal" method="POST" action="tcpdf/examples/imprimirfact.php" target="_blank">
		
		<input type="hidden" src="iconos/print.png" name="ImgPrintFact" value='.$idFact.' style=width:150px;height:150px;><br>
		<input type="submit" name="BtnPrint" id="BtnPrintPDF" value="Imprimir en PDF" style=width:150px;height:150px;><br>
		</form>
		
		</center>
		<center><form name="FormVolver" id="FormVolver" method="POST" action="VerInventariosVender.php" target="_self">
		<input type="hidden" name="CbVentasActivas" value="'.$VentasActivas.'">
		<input type="hidden" name="Operacion" value="VerPreVenta">
		<input type="hidden" name="TxtBuscar" value="">
		<input type="image" src="iconos/volver.png" name="volver" id="volver" value="">
		</form> </center>
		');
		
		
		print("<br>En este momento iniciará una nueva Preventa en la posicion $idPreventa, por favor seleccione agregar Item para iniciar el proceso");
		
		print('<script language="JavaScript"> 
PosicionarImpr();
</script> ');
		//echo " sale a venta realizada";
	}
	
	
	
}else{
	
	if($operacion=="VerVenta")
		
		$tabla->BuscarInventario($VentasActivas,$itemBuscar);
		
	if($operacion=="VerPreVenta")
		$tabla->TableDrawPreVenta($VentasActivas,$idVentaActiva,$idUsuario,$operacion);
}


?>
<script language="JavaScript"> 
asigna();
init();
</script> 