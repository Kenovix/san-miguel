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
	
if(isset($_POST["ImgEdit"])){
$Observaciones=	$_POST["TxtObservaciones"];
$idCartera=$_POST["ImgEdit"];

$sql = " UPDATE cartera SET
		  		Observaciones = '$Observaciones' 
		WHERE idCartera='$idCartera' ";
$r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());

}


if(isset($_POST["BtnEditAbono"])){

$idFactura=$_POST["idFactura"];
$Monto=$_POST["TxtAbono"];
$Saldo=$_POST["TxtSaldo"];
$idCartera=$_POST["idCartera"];

$sql = "SELECT SaldoFact FROM facturas WHERE idFacturas='$idFactura'";

$r = mysql_query($sql,$con) or die("Error al leer la tabla facturas.".mysql_error());
$SaldoFact=mysql_fetch_array($r);
$SaldoFact=$SaldoFact["SaldoFact"];

if($SaldoFact>=$Monto){


$sql = " INSERT INTO facturas_abonos (Fecha, Monto, Usuarios_idUsuarios, Facturas_idFacturas,CuentaIngreso, NombreCuenta) 
VALUES ('$fecha', '$Monto', '$_SESSION[idUser]', '$idFactura','$CuentaDestino', '$NombreCuentaDestino' )";

$r = mysql_query($sql,$con) or die("No se pudo insertar el abono.".mysql_error());

}else{
	
	exit("<script language=JavaScript> alert('Valor incorrecto, el saldo de esta factura es menor al abono') </script>");
	
}

if($SaldoFact==$Monto){

 $sql = " UPDATE ventas_separados SET Retirado='SI', FechaRetiro='$fecha', UsuariosEntrega='$_SESSION[idUser]' 
WHERE Facturas_idFacturas='$idFactura'";

$r = mysql_query($sql,$con) or die("No se pudo actualizar el separado .".mysql_error());

}
echo "<br>Se ha realizado un abono por: $Monto a la factura $idFactura";

echo "<td align=center><form name=FormPrintComp method=post action=tcpdf/examples/AbonosPrint.php enctype=multipart/form-data target=FrameCartera>
<input type=hidden name=TxtAbono value=$Monto><br>
<input type=hidden name=TxtSaldo value=$Saldo>
<input type=hidden name=CmbCuentaOrigen value=$CuentaDestino>

<input type=hidden name=idFactura value=$idFactura >

<input type=submit name=BtnPrintAbono value='Imprimir Comprobante' style=color:blue;>
 </form> </td> "; 	

 


}
	
                       	
						 
                        
                         $sql = " SELECT * FROM cartera WHERE Saldo<>0";
                      
                        //Ejecutamos el codigo Mysql
                        $r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
						
						echo "<table width='600' border='1'>";
									   echo "<tr><td>Cliente</td><td>Telefono</td><td>Contacto</td><td>Telefono Contacto</td> <td>Saldo</td> <td>Fecha de vencimiento</td><td>Dias de vencimiento</td> 
									   <td>Abonar</td><td>Observaciones</td> <td>Numero de Factura Vencida</td> ";
									   echo "<tr>";
                        
                        if(mysql_num_rows($r)){//Si existen resultados
							
                                   while($registros=mysql_fetch_array($r)){
									   
									    echo "<tr>";
									   
									   for ($i=1;$i <= 9; $i++) {
										   
										   
										 
										if ($i==8){
											
											echo "<td align=center><form name=formAbonos method=post action=EditarCartera.php enctype=multipart/form-data target=FrameCartera>
<input type=number name=TxtAbono value=$registros[Saldo] min=1 max=$registros[Saldo]><br>
<input type=hidden name=TxtSaldo value=$registros[Saldo]>
<input type=hidden name=CmbCuentaOrigen value=$CuentaDestino>

<input type=hidden id=Abo$registros[0] name=idFactura value=$registros[Facturas_idFacturas] >
<input type=hidden name=idCartera value=$registros[0] >
<input type=submit id=BtnAbo$registros[0] name=BtnEditAbono value=Abonar style=color:Red; onClick='envia();return false'>
 </form> </td> "; 	
 
 
										echo "<td align=center><form name=formPrintCoti method=post action=EditarCartera.php enctype=multipart/form-data target=FrameCartera id=Form$registros[0]>
<textarea name=TxtObservaciones id=TextArea1 style=width:200px;height:63px;z-index:15; rows=2 cols=109> $registros[$i] </textarea><br>
<input type=hidden id=Img$registros[0] name=ImgEdit value=$registros[0] >
<input type=submit id=Button$registros[0] name=BtnEdit value=Editar style=color:green;>
 </form> </td> "; 	
											}    
                                        else {
										
										print("<td>$registros[$i]</td>");
										}
									   } 
									   
										 
										$tbl = <<<EOD

EOD;

echo $tbl;
echo "</tr>";								   
                                   }
								   
 echo "</table>  <br>";
                      

}
?>