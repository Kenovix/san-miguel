<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Usuarios</title>
</head>

<body>
  
<?php
session_start();
include("conexion.php");
$combo1 = $_POST["Combobox1"];
$descuentos = $_POST["Combobox2"];
$impuestos = $_POST["Combobox3"];
$nombre = $_POST["TxtNombre"];
$direccion = $_POST["TxtDireccion"];
$telefono = $_POST["TxtTelefono"];
$email = $_POST["TxtEmail"];
$ciudad = $_POST["TxtCiudad"];
$fecha = $_POST["TxtFecha"];
$nit = $_POST["TxtNit"];
$observaciones = $_POST["TxtObservaciones"];
$IDCliente = $_POST["TxtIDCliente"];


		  $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
		  mysql_select_db($db,$con) or die("la base de datos no abre");
		  
		  $sel=mysql_query("SELECT * FROM prod_departamentos WHERE idDepartamentos='$combo1'",$con) or die("problemas con la consulta a la lista productosventa ".mysql_error());
		  $registros=mysql_fetch_array($sel);
		  $tabla=$registros["Tabla"];
		  echo "";
			
		  echo "<table width='600' border='1'>";
		  echo "<tr><th ALIGN= 'center' colspan='6'>LISTA DE PRODUCTOS</th></tr>";
		  echo "<tr><td>ID</td>
		  		<td>Referencia</td>
                <td>Descripcion</td>
				
				<td>Precio</td>
				<td>_______________Cantidad_______________</td>
				</tr>";
				
		  
			$sel=mysql_query("SELECT * FROM $tabla WHERE Departamento='$combo1'",$con) or die("problemas con la consulta a la lista $tabla ".mysql_error());
			if(mysql_num_rows($sel)){
				
		  	while($registros=mysql_fetch_array($sel)){;
			echo "<tr>";
		  	echo "<td>".$registros[0]."</td>
		  		<td>".$registros["Referencia"]."</td>
                <td>".$registros["Nombre"]."</td>
				
                <td>".$registros["PrecioVenta"]."</td>
				<td>
				<form method='POST' action='precoti.php' target='FramePrecoti2'/>
	
		  		  <input type='hidden' name='TxtNombre' value='$nombre'/>
				  <input type='hidden' name='TxtIDCliente' value='$IDCliente'/>
				  <input type='hidden' name='TxtFecha' value='$fecha'  />
				  <input type='hidden' name='TxtDireccion' value='$direccion' />
				  
				  <input type='hidden' name='TxtCiudad' value='$ciudad' />
				  
				  <input type='hidden' name='TxtTelefono' value='$telefono'/>
				  
				 <input type='hidden' name='TxtEmail'  value='$email'/>
				  
				 <input type='hidden' name='TxtNit'  value='$nit' /><br>
				  
				  
		         <input type='hidden' name='txtproveedor'  value='$combo1' /> 
				 <input type='hidden' name='txtDescuentos'  value='$descuentos'/>
				 <input type='hidden' name='txtImpuestos'  value='$impuestos'/>
				  
				  <input type='hidden' name='TxtObservaciones'  value='$observaciones'/>
				<input type='hidden' name='IDProducto'  value='$registros[Referencia]'/>
				<input type='hidden' name='TablaCot'  value='$tabla'/>
				<input type='number' name='txtcantidad' step='any'  value='1' size='3'
				  style='background-color:transparent;' />
				<input type='submit' id='Button1' name='BtnAgregar' value='Agregar' 
				style='width:96px;height:25px;'>
				</form>
				</td>
				</tr>";
    		
		  }
		   }
		  echo "</table>";
		  echo "";
		  
		   	   					
?>
</body>
</html>
