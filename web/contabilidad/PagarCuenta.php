<?php
include("conexion.php");
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.html");
if(isset($_POST["CmbCuentaOrigen"]))
	$CuentaOrigen=$_POST["CmbCuentaOrigen"]; 
else
	$CuentaOrigen=110510; 
						
                       	 $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
		 				 mysql_select_db($db,$con) or die("la base de datos no abre");
						 
                        //Si la búsqueda tiene una palabra utilizamos LIKE sino MATCH AGAINST.
                       
                                   $sql = " SELECT * FROM egresos WHERE PagoProg = 'Programado'";
                       
					   
                        //Ejecutamos el codigo Mysql
                        $r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
						
						
                        
                        if(mysql_num_rows($r)){//Si existen resultados
							
						echo "<table width='600' border='1'>";
									   echo "<tr><td>ID</td><td>Fecha de Ingreso</td><td>Fecha de Programacion de pago</td><td>Concepto</td> <td>Tipo de Egreso</td> <td>Servicio a pagar</td><td>Beneficiario</td><td>NIT</td> <td>Direccion</td> <td>Ciudad</td>  <td>Valor</td> <td>Factura</td> <td>Seleccione para pagar</td>";
							 
                                   while($registros=mysql_fetch_array($r)){
									   
									   echo "<tr>";
									   
									   
									   for ($i=0;$i <= 1; $i++) {
										   
                                        print("<td>$registros[$i]</td>");
										
									   } 
									   for ($i=3;$i < 12; $i++) {
										if (  $i <> 4)
                                        print("<td>$registros[$i]</td>");
										
									   } 
									   
									   print("<td>$registros[Valor]</td><td>$registros[NumFactura]</td>");
										 $tbl = <<<EOD
<td><form name="formIngFact" method="post" action="ingresopago.php" enctype="multipart/form-data target=InlineFrame1 id="Form3">

<input type="hidden" name="idEgresos" value="$registros[0]">  
<input type="hidden" name="TxtValor" value="$registros[Valor]">  
<input type="hidden" name="TxtObservaciones" value="$registros[5]">  
<input type="hidden" name="CmbCuentaOrigen" value="$CuentaOrigen">  
<input type=image id=Button5 name=ImgIngPago src=images/ingresar_pago.png value=$registros[0] style=width:85px;height:75px;z-index:103;>


</form></td>
 
EOD;

echo $tbl;


								   

                                   }
								   
                        echo "</table>  ";



}
?>