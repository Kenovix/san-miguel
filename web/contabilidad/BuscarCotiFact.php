<script>
function show_hide() {
if(document.getElementById('FormaPago').value == "Contado") {
document.getElementById('CmbCuentaOrigen').style.display = "block";
} else {
document.getElementById('CmbCuentaOrigen').style.display = "none";
}
}
</script>

<?php
include("conexion.php");
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.php");
$key_words    = $_POST['TxtBusqueda'];
$fecha=date("Y-m-d");
if(strlen($key_words)>0  ){//No realizamos búsqueda si la palabra es de un solo caracter
            if($key_words){
           				
                        //Contamos el numero de palabras que incluye la búsqueda.
                        $frac = explode(';',$key_words);
                        $no = count($frac)-1;
						
                       	 $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
		 				 mysql_select_db($db,$con) or die("la base de datos no abre");
						 
                        //Si la búsqueda tiene una palabra utilizamos LIKE sino MATCH AGAINST.
                        
                                   $sql = " SELECT * FROM cotizaciones cot INNER JOIN clientes c ON cot.Clientes_idClientes=c.idClientes
								   
								    WHERE cot.NumCotizacion = '$frac[0]'
								   ";
                        
                       
					   
                        //Ejecutamos el codigo Mysql
                        $r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
						$registros=mysql_fetch_array($r);
						
						$RazonSocial=$registros["RazonSocial"];
						$NIT=$registros["Num_Identificacion"];
						$Direccion=$registros["Direccion"];
						$Ciudad=$registros["Ciudad"];
						$Contacto=$registros["Contacto"];
						$TelContacto=$registros["TelContacto"];
                        $idCliente=$registros["idClientes"];
						
                        if(mysql_num_rows($r)){//Si existen resultados
														
							echo "<table width='600' border='1'>";
							 echo "<tr><th>Razón Social</th> <th>NIT</th><th colspan=2>Direccion</th>
							 	<tr><td>$RazonSocial</td> <td> $NIT</td><td colspan=2>$Direccion</td>
								<tr><th>Ciudad</th> <th> Contacto</th><th colspan=2>Tel Contacto</th>
								<tr><td>$Ciudad</td> <td> $Contacto</td><td colspan=2>$TelContacto</td><tr>
							 ";
							
									   echo "<tr><th>Numero de Cotizacion</th> <th>Numero de Solicitud</th><th colspan=2>Fecha</th><tr>";
									   print("<td>$key_words</td>");
									for ($i=2;$i <= 3; $i++) {
										   
                                        print("<td>$registros[$i]</td>");
										
									   }    
							echo "</tr> <tr> <th>Descripcion</th><th>Valor Unitario</th><th>Cantidad</th><th>Subtotal</th></tr>";		   
                                   
									  $sql = "SELECT * FROM cotizaciones cot INNER JOIN clientes c ON cot.Clientes_idClientes=c.idClientes 
												WHERE ";
										for ($i=0;$i<=$no;$i++){
											if(is_numeric($frac[$i])){
											if($i==$no){
												$sql = $sql." cot.NumCotizacion = '$frac[$i]'";
											}else{
												$sql = $sql." cot.NumCotizacion = '$frac[$i]' OR";
											}
											}else{
												exit("Por favor digite solo numeros o ; para separar las cotizaciones y no termine con ;");
											}
										}
										//print($sql);
										$r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
										
										if(mysql_num_rows($r)){
											while($registros=mysql_fetch_array($r)){
                                        print("<tr><td>$registros[Descripcion]</td><td>$registros[ValorUnitario]</td><td>$registros[Cantidad]</td><td>$registros[Subtotal]</td></tr>");
										
											}
										}
									  
									  
									  $sql1 = "SELECT SUM(Subtotal) as Subtotalcoti, SUM(IVA) as IVACoti, SUM(Total) as TotalCoti, SUM(ValorDescuento) as Descuento, SUM(SubtotalCosto) as SubtotalCosto
									  FROM cotizaciones	WHERE ";
										for ($i=0;$i<=$no;$i++){
											if($i==$no){
												$sql1 = $sql1." NumCotizacion = '$frac[$i]'";
											}else{
												$sql1 = $sql1." NumCotizacion = '$frac[$i]' OR";
											}
										}
										
										$sel1 = mysql_query($sql1,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
										
									 
									  
		  $costos=mysql_fetch_array($sel1);	
		  $SubTotalOr=$costos["Subtotalcoti"];
		  $IVACotiOr=$costos["Descuento"];
		  $IVAOr=$costos["IVACoti"];
		  $SubtotalCosto=$costos["SubtotalCosto"];
		  $TotalOr=$costos["TotalCoti"]-$costos["Descuento"];
		  $SubTotal=number_format($SubTotalOr);
		  $IVACoti=number_format(round($IVACotiOr));
		  $Total=number_format(round($TotalOr));
		  $IVA=number_format(round($IVAOr));
			
		print("<tr><th colspan=3 align=right>Subtotal</th><td>$$SubTotal</td></tr>
		<tr><th colspan=3 align=right>Descuentos</td><td>$$IVACoti</td></tr>
		<tr><th colspan=3 align=right>IVA</td><td>$$IVA</td></tr>
		<tr><th colspan=3 align=right>TOTAL</td><td>$$Total</td></tr>");							   
						   

print(' <tr><th >	Imprimir Vista Previa</th> <th colspan=3>Guardar Factura	</th> 				
<tr><td  align="center"> <form name="formPrintCuenta" method="post" action="tcpdf/examples/imprimircuenta.php" enctype="multipart/form-data" target="_blank" id="Form3">

<input type="image" id="Button5" name="ImgPrintCoti" src="images/crear_pdf.png" value=$key_words style="width:60px;height:75px;z-index:103;">

</form></td>

<td colspan=3 align="left"> <form name="formGuardaFactura" method="post" action="guardarfact.php" enctype="multipart/form-data" target="FrameBuscarCoti" id="Form3">

Seleccione la forma de pago: <select name="FormaPago" id="FormaPago" onclick="show_hide()">
  <option value="Contado" selected>Contado</option> 
  <option value="15">15 días</option>
  <option value="30">30 días</option>
  <option value="60">60 días</option>
  <option value="90">90 días</option>
  <option value="Factoring">Factoring</option>
</select><br><br>


<select name="CmbCuentaOrigen" size=1 id="CmbCuentaOrigen">
	<option value=110510>Seleccione la Cuenta donde ingresará el dinero</option>');
	
	
$reg = mysql_query("SELECT * FROM `cuentasfrecuentes` WHERE `ClaseCuenta`='ACTIVOS' ",$con) or die("La consulta a cuentasfrecuentes es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      echo "<option value= $datos[CuentaPUC]>$datos[Nombre]</option>";
   }

}


echo '</select><br>';						   
						   
								   $tbl = <<<EOD



<input type="hidden" name="idCliente" value=$idCliente >
<input type="hidden" name="Subtotal" value=$SubTotalOr >    
<input type="hidden" name="IVA" value=$costos[IVACoti] >
<input type="hidden" name="Cotizaciones" value="$key_words" >
<input type="hidden" name="Descuentos" value=$costos[Descuento] >
<input type="hidden" name="Total" value=$TotalOr >
<input type="hidden" name="SubtotalCosto" value=$SubtotalCosto >
<input type="hidden" name="ImgGuardar" value="$key_words" >

<br><br>
Fecha de la Factura<br><input type="date" name="TxtFecha" value="$fecha" min="2000-01-01" max="2100-01-01""><br>
Digite la Orden de Compra:&nbsp;&nbsp;&nbsp;<input type="text" name="TxtOCompra" value="NO"><br>
Digite la Orden de Salida:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="TxtOSalida" value="NO"><br><br>
<textarea name="TxtObservacionesFact" placeholder="Observaciones para esta Factura" style="width: 330px; height: 80px;"></textarea>
<br><br>
Pulse para guardar <input type="image" id="Button5" name="Img" src="images/guardar.png" value=$key_words style="width:65px;height:75px;z-index:103;">

</form></td>

</tr></table>

EOD;

echo $tbl;


								   
                        }else{//Si no existen resultados
                                   print("No se encontraron resultados.");
                        }
            }else{//Si no existen palabra clave
                        print("No existen palabras clave.");
            }
}else{//Si la palabra clave solo tiene un carácter

print("Palabra clave demasiado corta. Digite una palabra con mas de 3 letras");

}
