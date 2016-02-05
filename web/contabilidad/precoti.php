<?php
include("conexion.php");

session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.html");


$fecha=date("Y-m-d");
$observaciones = $_POST["TxtObservaciones"];

$total=0;
	   
   $con=mysql_connect($host,$user, $pw) or die("problemas con el servidor");
		  mysql_select_db($db,$con) or die("la base de datos no abre");  
		  
$IDCliente = $_POST["TxtIDCliente"];
$sel=mysql_query("SELECT * FROM clientes WHERE idClientes = '$IDCliente'",$con) or die("problemas con la consulta ".mysql_error());
		  	$registros=mysql_fetch_array($sel);
			

// echo "<form method='POST' action='borrarItem.php' target='FramePrecoti2'>";
		  
		  echo "<table width='600' border='1'>";
		  echo "<tr><th ALIGN= 'center' colspan='7'>DATOS DEL CLIENTE</th></tr>
		  <tr><td>Nit</td><td colspan='2'>$registros[Num_Identificacion]</td><td align='right' >Fecha</td><td colspan='3'>$fecha</td>
		  <tr><td>Nombre</td><td colspan='3'>$registros[RazonSocial]</td><td>Direccion</td><td colspan='2'>$registros[Direccion]</td>
		  <tr><td>Ciudad</td><td>$registros[Ciudad]</td><td>Telefono</td><td>$registros[Telefono]</td></td><td>Email</td><td colspan='2'>$registros[Email]</td>";
		  echo "<tr><th ALIGN= 'center' colspan='7'>COTIZACION</th></tr>";
		  echo "<tr><td>ID</td>
		  		<td>Referencia</td>
                <td>Descripcion</td>
				<td>_______Precio______</td>
				<td>_____Cantidad_____</td>
				<td>Sub Total</td>
				
				</tr>";
				
		  
		if(isset($_POST["BtnEliminar"])){
			
			mysql_query("DELETE FROM precotizacion WHERE ID='$_POST[idItem]'",$con);
			
		}	

		if(isset($_POST["BtnEditar"])){
			$idPrecoti=$_POST["idItem"];
			$cantidad=$_POST["txtcantidad"];
			$Referencia=$_POST["TxtReferencia"];
			$ValorUnitario=$_POST["TxtValorUnitario"];
						
			$TablaEdit=$_POST["TxtTabla"];
			$sel=mysql_query("SELECT * FROM $TablaEdit WHERE Referencia = '$Referencia'",$con) or die("problemas con la consulta a productos en editar".mysql_error());
		  	$registros=mysql_fetch_array($sel);
			$IVA=$registros["IVA"];
			
			$Subtotal=$ValorUnitario*$cantidad;
			$impuestos=$Subtotal*$IVA;
			$Total=$Subtotal+$impuestos;
			
			mysql_query("UPDATE precotizacion SET Cantidad='$cantidad', ValorUnitario='$ValorUnitario', SubTotal='$Subtotal', IVA='$impuestos', Total='$Total' WHERE ID='$idPrecoti'",$con);
			
		}			

		if(isset($_POST["BtnAgregar"])){
			$tablaCot= $_POST["TablaCot"];
			
			$idProducto = $_POST["IDProducto"];
			$cantidad=$_POST["txtcantidad"];
			$descuentos = $_POST["txtDescuentos"];
			$impuestos = $_POST["txtImpuestos"];
			$descuentos1=$descuentos;
			$sel=mysql_query("SELECT * FROM $tablaCot WHERE Referencia = '$idProducto'",$con) or die("problemas con la consulta ".mysql_error());
		  	$registros=mysql_fetch_array($sel);
			$CuentaPUC=$registros["CuentaPUC"];
			$ValorUnitario=$registros["PrecioVenta"];
			$subtotal=$ValorUnitario*$cantidad;
			$descuentos=($subtotal/100*$descuentos);
			$ValorUnitario=round($ValorUnitario);
			
				
			$subtotalcosto=$registros["CostoUnitario"]*$cantidad;
			$impuestos=($subtotal-$descuentos)*($registros["IVA"]);
			$total=$subtotal+$impuestos;
			$impuestos=round($impuestos);
			$total=round($total);
			$subtotal=round($subtotal);
			$TipoItem="PR";
			if($tablaCot=="servicios"){
				
				$TipoItem="SE";
			}
				
			mysql_query("INSERT INTO precotizacion (Referencia, Cantidad, ValorUnitario, PrecioCosto, SubtotalCosto, Descripcion, SubTotal, ValorDescuento, Total, IVA, Descuento, TipoItem, idUsuario
			,CuentaPUC,Tabla) 
			VALUES 	('$registros[Referencia]','$cantidad','$ValorUnitario','$registros[CostoUnitario]','$subtotalcosto', '$registros[Nombre]', 
			'$subtotal', '$descuentos', '$total','$impuestos','$descuentos1', '$TipoItem','$_SESSION[idUser]','$CuentaPUC','$tablaCot' ) ",$con) or die("Problemas al agregar los datos a precotizacion");
			
    		
		  }
		  
		  
		 
		 
		
	
			$sel1=mysql_query("SELECT * FROM precotizacion WHERE idUsuario='$_SESSION[idUser]'",$con) or die("problemas con la consulta ".mysql_error());
			if(mysql_num_rows($sel1)){
		  	while($registros2=mysql_fetch_array($sel1)){
			
		    echo "<tr>";
		  	echo "<td>".$registros2["ID"]."</td>
		  		<td>".$registros2["Referencia"]."</td>
                <td>".$registros2["Descripcion"]."</td>
                <td colspan=2><form name=FormEditItem action='precoti.php' method='post' target='_self'>
				<input type=number name=TxtValorUnitario value='$registros2[ValorUnitario]' min='$registros2[PrecioCosto]' style='width: 150px;'>
				
				<input type=number name=txtcantidad value='$registros2[Cantidad]' min='1' style='width: 60px;' >
				<input type=submit name=BtnEditar value='Editar' style='width: 70px;' >
				<input type=submit name=BtnEliminar value='Eliminar' style='width: 70px; color:red '>
				<input type='hidden' name='TxtIDCliente' value='$IDCliente'>
				<input type='hidden' name='TxtObservaciones' value='$observaciones'>
				<input type='hidden' name='idItem' value='$registros2[ID]'>
				<input type='hidden' name='TxtReferencia' value='$registros2[Referencia]'>
				<input type='hidden' name='TxtTabla' value='$registros2[Tabla]'>
				</form></td>
				
				<td>".$registros2["SubTotal"]."</td>
				
				</tr>";
			}
			
}
	
		
		
		$res=mysql_query("select sum(SubTotal) as SubTotal, sum(ValorDescuento) as ValorDescuento, sum(Total) as Total,  sum(IVA) as IVA from precotizacion 
		WHERE idUsuario='$_SESSION[idUser]'") or die("problemas con la consulta ".mysql_error());
		$Totales=mysql_fetch_array($res);
		
		$descuentos=$Totales["ValorDescuento"];
		$impuestos=$Totales["IVA"];
		$total=$Totales["Total"]-$descuentos;
		
		$subtotal=number_format($Totales["SubTotal"]);
		$descuentos=number_format($descuentos);
		$impuestos=number_format($impuestos);
		$total=number_format($total);
		
		
			
			
		 echo "<tr>";
		  	echo "<th ALIGN= 'right' colspan='6'>Subtotal:</th><td>$$subtotal</td></tr>
				<tr>
                <th ALIGN= 'right' colspan='6'>Descuentos</th><td>$$descuentos</td></tr>
				<tr><th ALIGN= 'right' colspan='6'>Impuestos</th><td>$$impuestos</td></tr>
				<tr><th ALIGN= 'right' colspan='6'>Total</th><td>$$total</td>
				</tr>
				<tr><th ALIGN= 'center' colspan='7'>Observaciones</th>
				</tr>
				<tr><td ALIGN= 'left' colspan='7'>$observaciones</td>
				</tr>";
		echo "</table><br><br>";
			
		
			
		echo "<form method='POST' name=FormVaciar action='vaciar_tabla.php' target='FramePrecoti2'>";	
		echo "<input type='submit' name='btnVaciar' value='Limpiar Cotizacion' 
			style='width:200px;height:25px; color:red; position:relative; left: 100px;'>";
		echo "</form>";
		
		echo "<form method='POST' name=FormGuardar action='guardarcoti.php' target='FramePrecoti2'>";	
		echo "<input type='submit' name='btnGuardar' value='Guardar Cotizacion' 
			style='width:200px;height:25px; color:green; position:relative; left: 100px;'>
			<input type='hidden' name='TxtIDCliente' value='$IDCliente'/>
			<input type='hidden' name='TxtObservaciones' value='$observaciones'/>
			<input type='hidden' name='TxtFecha' value='$fecha'/>";
		echo "</form>";
		

		
?>