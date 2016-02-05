<?php
include("conexion.php");
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.html");
   
$IDCliente = $_POST["TxtIDCliente"];
$fecha = $_POST["TxtFecha"];	
$observaciones = $_POST["TxtObservaciones"];
		  $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
		  mysql_select_db($db,$con) or die("la base de datos no abre");
		  
		  $reg=mysql_query("SELECT * FROM clientes WHERE idClientes='$IDCliente'",$con)
		  or die("Problemas al seleccionar los datos");
		  $re=mysql_fetch_array($reg);
		  
		  $nombre = $re["RazonSocial"];
			$direccion = $re["Direccion"];
			$telefono = $re["Telefono"];
			$email = $re["Email"];
			$ciudad = $re["Ciudad"];
			$nit = $re["Num_Identificacion"];
		  
		  $reg=mysql_query("SELECT ID FROM precotizacion WHERE ID='$_POST[eliminar]'",$con)
		  or die("Problemas al seleccionar los datos");
		  
		  if($re=mysql_fetch_array($reg))
			{
				mysql_query("DELETE FROM precotizacion WHERE ID='$_POST[eliminar]'",$con);
				echo "Item $_POST[eliminar] Eliminado Correctamente";
			}else{
				echo "Item $_POST[eliminar] no fue eliminado";
			}
			
			
			echo "<form method='POST' action='borrarItem.php' target='FramePrecoti2'>";
		  
		  echo "<table width='600' border='1'>";
		  echo "<tr><th ALIGN= 'center' colspan='7'>DATOS DEL CLIENTE</th></tr>
		  <tr><td>Nit</td><td colspan='2'>$nit</td><td align='right' >Fecha</td><td colspan='3'>$fecha</td>
		  <tr><td>Nombre</td><td colspan='3'>$nombre</td><td>Direccion</td><td colspan='2'>$direccion</td>
		  <tr><td>Ciudad</td><td>$ciudad</td><td>Telefono</td><td>$telefono</td></td><td>Email</td><td colspan='2'>$email</td>";
		  echo "<tr><th ALIGN= 'center' colspan='7'>COTIZACION</th></tr>";
		  echo "<tr><td>ID</td>
		  		<td>Referencia</td>
                <td>Descripcion</td>
				<td>Precio</td>
				<td>Cantidad</td>
				<td>Sub Total</td>
				<td>Quitar Item</td>
				</tr>";
			
		 $consulta="select max(ID) as maxnp from precotizacion";
		  $NumMayor=mysql_query("select max(ID) as maxnp from precotizacion");
		  $item=mysql_fetch_array($NumMayor);
		  
		  
		  	  	
for ($i = 1; $i <= $item["maxnp"]; $i++) {
	
			$sel1=mysql_query("SELECT * FROM precotizacion WHERE ID=$i",$con) or die("problemas con la consulta");
		  	$registros2=mysql_fetch_array($sel1);
			if($registros2["Referencia"]<> ""){
		    echo "<tr>";
		  	echo "<td>".$registros2["ID"]."</td>
		  		<td>".$registros2["Referencia"]."</td>
                <td>".$registros2["Descripcion"]."</td>
                <td>".$registros2["ValorUnitario"]."</td>
				<td>".$registros2["Cantidad"]."</td>
				<td>".$registros2["SubTotal"]."</td>
				<td><input type='radio'  name='eliminar' value='".$i."' 
				style='width:80px;height:20px;'>
				</tr>";
			}
}
	
		
		
		$res=mysql_query("select sum(SubTotal) from precotizacion");
		$subtotal=mysql_fetch_array($res);
		$res=mysql_query("select sum(ValorDescuento) from precotizacion");
		$totaldescuentos=mysql_fetch_array($res);
		$res=mysql_query("select sum(Total) from precotizacion");
		$total1=mysql_fetch_array($res);
		$res=mysql_query("select sum(IVA) from precotizacion");
		$IVA=mysql_fetch_array($res);
		$descuentos=$totaldescuentos[0];
		$impuestos=$IVA[0];
		$total=$total1[0];
		
		$subtotal[0]=number_format($subtotal[0]);
		$descuentos=number_format($descuentos);
		$impuestos=number_format($impuestos);
		$total=number_format($total);
		
		
			
			
		 echo "<tr>";
		  	echo "<th ALIGN= 'right' colspan='6'>Subtotal:</th><td>$$subtotal[0]</td></tr>
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
			
		echo "<input type='submit'  name='btnEliminarItem' value='Eliminar item seleccionado'
			style='width:200px;height:25px; color:blue; position:relative; left: 100px;'>
			<input type='hidden' name='TxtIDCliente' value='$IDCliente'/>
			<input type='hidden' name='TxtFecha' value='$fecha'/>
			<input type='hidden' name='TxtObservaciones' value='$observaciones'/>";
		echo "</form>";	
			
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