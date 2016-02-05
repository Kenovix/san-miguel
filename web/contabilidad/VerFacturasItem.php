
<?php
$fecha=date("Y-m-d");


$Item=$_POST["TxtBuscarFactura"];
include("conexion.php");


////////////////////////////////////////////

$con=mysql_connect($host,$user, $pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");  
$sql="SELECT * FROM cotizaciones c INNER JOIN facturas f ON c.NumCotizacion = f.Cotizaciones_idCotizaciones
		INNER JOIN productosventa pr ON pr.Referencia=c.Referencia
		INNER JOIN prod_codbarras cod ON cod.ProductosVenta_idProductosVenta=pr.idProductosVenta
  WHERE c.Descripcion like '%$Item%' OR c.Referencia like '%$Item%' OR c.Referencia like '%$Item%' OR pr.idProductosVenta = '$Item' OR cod.CodigoBarras = '$Item'
  ORDER BY f.idFacturas DESC";
$fac=mysql_query($sql,$con);

if(mysql_num_rows($fac)){
	
	print("<table border=1><tr><td>Descripcion</td><td>Referencia</td><td>Cantidad</td><td>Verificacion</td><td>Imprimir</td></tr>");
	while($DatosCotizacion=mysql_fetch_array($fac)){
		
		print("<tr><td>$DatosCotizacion[Descripcion]</td>");
		print("<td>$DatosCotizacion[Referencia]</td>");
		print("<td>$DatosCotizacion[Cantidad]</td>");
		print("<td>$DatosCotizacion[idFacturas]</td>");
		print('<td><form name="formPrintFact" method="post" action="tcpdf/examples/imprimirfact.php" enctype="multipart/form-data" target="_blank" id="Form3">
<input type="hidden" name="ImgPrintFact" value='.$DatosCotizacion["idFacturas"].'>
<input type="image" id="Button5" name="PrintFact" src="images/crear_pdf.png" value=$idFacturas style="width:110px;height:150px;">

</form></td></tr>');
		
	}
}else{
	
	echo "No hay resultados";
}

	
		
			
	
	
?>
