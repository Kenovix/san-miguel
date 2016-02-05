<script language="JavaScript"> 
function envia(){ 

if (confirm('¿Estas seguro que deseas registrar este abono?')){ 
      document.this.form.submit();
      
    } 
	
}

</script> 

<?php


include("conexion.php");
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.php");

if(isset($_POST["TxtBusqueda"]))
	$Item=$_POST["TxtBusqueda"];
else
	$Item="";
	
$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

$fecha=date("Y-m-d");
	
if(isset($_POST["CmbCuentaOrigen"])){
	
	$CuentaDestino=$_POST["CmbCuentaOrigen"];
	$sql = " SELECT * FROM cuentasfrecuentes WHERE CuentaPUC=$CuentaDestino";
	$r = mysql_query($sql,$con) or die("La consulta a cuentas frecuentes es erronea .".mysql_error());
	$Datos=mysql_fetch_array($r);
	$NombreCuentaDestino=$Datos["Nombre"];
	
}else{
	$CuentaDestino=110510;
	$NombreCuentaDestino="CAJA MENOR";
}	
	

if(isset($_POST["BtnSeparados"])){

$idFactura=$_POST["idFactura"];
$Monto=$_POST["TxtAbono"];
$Saldo=$_POST["TxtSaldo"];


$sql = "SELECT SaldoFact FROM facturas WHERE idFacturas='$idFactura'";

$r = mysql_query($sql,$con) or die("Error al leer la tabla facturas.".mysql_error());
$SaldoFact=mysql_fetch_array($r);
$SaldoFact=$SaldoFact["SaldoFact"];

if($SaldoFact>=$Monto){

//////////////////Cuando se inserta un abono a esta tabla se activa un trigger que alimenta el libro diario

$sql = " INSERT INTO facturas_abonos (Fecha, Monto, Usuarios_idUsuarios, Facturas_idFacturas,CuentaIngreso, NombreCuenta) 
VALUES ('$fecha', '$Monto', '$_SESSION[idUser]', '$idFactura','$CuentaDestino', '$NombreCuentaDestino' )";

$r = mysql_query($sql,$con) or die("No se pudo insertar el abono.".mysql_error());

}else{
	
	exit("<script language=JavaScript> alert('Valor incorrecto, el saldo de esta factura es menor al abono') </script>");
	
}
$sql = " UPDATE ventas_separados SET Retirado='SI', FechaRetiro='$fecha', UsuariosEntrega='$_SESSION[idUser]' 
WHERE Facturas_idFacturas='$idFactura'";

$r = mysql_query($sql,$con) or die("No se pudo actualizar el separado .".mysql_error());




echo "<br>Se ha realizado un abono por: $Monto a la factura $idFactura y se eliminaron los items de la bodega separados";

echo "<td align=center><form name=FormPrintComp method=post action=tcpdf/examples/AbonosPrint.php enctype=multipart/form-data target=FrameSeparados>
<input type=hidden name=TxtAbono value=$Monto><br>
<input type=hidden name=TxtSaldo value=$Saldo>
<input type=hidden name=CmbCuentaOrigen value=$CuentaDestino>

<input type=hidden name=idFactura value=$idFactura >

<input type=submit name=BtnPrintAbono value='Imprimir Comprobante' style=color:blue;>
 </form> </td> "; 	


}
	
                       	
			if($Item==""){
                        
			 $sql = "SELECT * FROM ventas_separados vs INNER JOIN facturas fv ON vs.Facturas_idFacturas = fv.idFacturas 
			 INNER JOIN cotizaciones c ON fv.Cotizaciones_idCotizaciones=c.NumCotizacion
			 INNER JOIN clientes cl ON cl.idClientes=fv.Clientes_idClientes						 
			 WHERE vs.Retirado='NO'";
						 
			}else{
				
			 $sql = "SELECT * FROM ventas_separados vs INNER JOIN facturas fv ON vs.Facturas_idFacturas = fv.idFacturas 
			 INNER JOIN cotizaciones c ON fv.Cotizaciones_idCotizaciones=c.NumCotizacion
			 INNER JOIN clientes cl ON cl.idClientes=fv.Clientes_idClientes						 
			 WHERE vs.Retirado='NO' AND cl.RazonSocial LIKE '%$Item%'";

				
			}			 
                      //print($sql);
                        //Ejecutamos el codigo Mysql
                        $r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
						
						
                        
                        if(mysql_num_rows($r)){//Si existen resultados
									$i=0;
									$FacOld[0]=0;
									$FacOld[1]=0;
									 echo "<center><table width='600' border='1'>";
									 
                                   while($registros=mysql_fetch_array($r)){
									   
									   $FacOld[$i]=$registros["Facturas_idFacturas"];
									   
									   if($FacOld[1]<>$FacOld[0]){
										if($i==1)   
											$i=0;
										else
											$i=1;
									   echo "
									   <tr><td colspan=4 style=background-color:blue></tr>
									   <tr><td colspan=2>Cliente: $registros[RazonSocial]</td><td>Identificacion: $registros[Num_Identificacion]</td><td>Verificacion: $registros[Facturas_idFacturas]</td>
									         </tr>
											 <tr>
											 <td align=center colspan=4><form name=formSeparados method=post action=Separados.php target=FrameSeparados>
Saldo:<br><input type=number name=TxtAbono value=$registros[SaldoFact] readonly><br>
<input type=hidden name=TxtSaldo value=$registros[SaldoFact]>
<input type=hidden name=CmbCuentaOrigen value=$CuentaDestino>

<input type=hidden id=Abo$registros[0] name=idFactura value=$registros[Facturas_idFacturas] >

<input type=submit name=BtnSeparados value='Recibir saldo de esta factura y entregar productos' style=color:Red; onClick='envia();return false'>
 </form> </td></tr><tr> <td colspan=2>Producto</td> <td>Referencia</td> <td>Cantidad</td> </tr>
									   
									   ";
									    
										 }
										 
									    echo "<tr>";
									   
									    echo "												
												<td colspan=2>$registros[Descripcion]</td>
												<td>$registros[Referencia]</td>
												<td>$registros[Cantidad]</td>
												</tr>
										";
									   
									   
									   }
                                   
								   
								   
								   
								   
 echo "</table>  <br></center>";
                      

}else{
	
	echo "Sin resultados";
}
?>