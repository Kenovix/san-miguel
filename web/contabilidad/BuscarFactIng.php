<?php
include("conexion.php");
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.html");
$FechaActual=date("Y-m-d");

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

///////////////////////////////////////////////////////////
///////////////////Aplico retenciones/////////////////////
//////////////////////////////////////////////////////////
						 
if(isset($_POST['BtnApliRet'])){
	
	$idFactura=$_POST['idFactura'];
	$idRetencion=$_POST['CmbRetenciones'];
	$FechaPago=$_POST['TxtFecha'];
	$ret = mysql_query("SELECT * FROM impret WHERE idImpRet='$idRetencion'",$con);
	$DatosRetenciones=mysql_fetch_array($ret);
	$Aplica=$DatosRetenciones["Aplicable_A"];
	$Monto=round($DatosRetenciones["Valor"]*$_POST["Fact$Aplica"]);
	
	
	mysql_query("INSERT INTO `facturas_reten_aplicadas` ( `Fecha`, `NombreRetencion`, `Porcentaje`, `Monto`, `Cruzada`, `Facturas_idFacturas`, `idImpRet`) 
	VALUES ( '$FechaPago', '$DatosRetenciones[Nombre]', '$DatosRetenciones[Valor]', '$Monto', 'NO', '$idFactura', '$idRetencion'); ",$con) 
	or die("Problemas al agregar los datos a la tabla de retenciones aplicadas ".mysql_error());
	
}

///////////////////////////////////////////////////////////
///////////////////Edito retenciones/////////////////////
//////////////////////////////////////////////////////////

if(isset($_POST['BtnEditPorcRet'])){
	
	
	$idRetencion=$_POST['idRetencion'];
	$idRetencionApl=$_POST['idRetencionApl'];
	$Porcentaje=$_POST['TxtPorcentaje'];
	
	if($idRetencion==4){
		
		$Monto=round($Porcentaje * $_POST['FactIVA']);
	
	}else{
		
		$Monto=round($Porcentaje * $_POST['FactSubtotal']);
		
	}
	
	mysql_query("UPDATE `facturas_reten_aplicadas` SET Porcentaje='$Porcentaje', Monto='$Monto' 
	WHERE idFacturasRetAplicadas='$idRetencionApl'",$con) 
	or die("Problemas al editar los datos a la tabla de retenciones aplicadas ".mysql_error());
	
}

///////////////////////////////////////////////////////////
///////////////////Borro retenciones/////////////////////
//////////////////////////////////////////////////////////

if(isset($_POST['BtnDelPorcRet'])){
	
	
	
	$idRetencionApl=$_POST['idRetencionApl'];
	
	mysql_query("DELETE FROM `facturas_reten_aplicadas` WHERE idFacturasRetAplicadas='$idRetencionApl'",$con) 
	or die("Problemas al Borrar los datos a la tabla de retenciones aplicadas ".mysql_error());
	
}


$key_words = $_POST['TxtBusqueda'];


if(strlen($key_words)>0  ){//No realizamos búsqueda si la palabra es de un solo caracter
            if($key_words){
           				
                        //Contamos el numero de palabras que incluye la búsqueda.
                        $frac    = explode(' ',$key_words);
                        $no                  = count($frac);
						
                       	 
						 
                        //Si la búsqueda tiene una palabra utilizamos LIKE sino MATCH AGAINST.
                        if($no == 1){
                                   $sql = " SELECT * FROM facturas fact INNER JOIN clientes c ON fact.Clientes_idClientes=c.idClientes 
								   INNER JOIN cartera car ON car.Facturas_idFacturas=fact.idFacturas 
								   WHERE fact.idFacturas = '$key_words' OR c.RazonSocial LIKE '%$key_words%' 
								   
								   ";
                        }else{
                                   exit ("Por favor digite una sola palabra sin espacios");
                        }
                       
					   
                        //Ejecutamos el codigo Mysql
                        $r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
						
						
                        
                        if(mysql_num_rows($r)){//Si existen resultados
											
							 //$NombresRet=mysql_fetch_array($datosR);
							 
                                   while($registros=mysql_fetch_array($r)){
									   echo "<table width='600' border='1'>
									   <tr><td colspan=11 align=center><h3>DATOS DE LA FACTURA</h3></td></tr>";
									   echo "<tr><td>Cliente</td><td>NIT</td><td>Ciudad</td> <td>Numero de Factura</td> <td>Fecha</td>
									   <td>Orden de Compra</td>  <td>SubTotal</td> <td>IVA</td><td>Total</td> <td>Saldo</td><td>__________Aplicar_Retenciones___________</td>";
									   echo "<tr>";
									   
									   
									   print("<td>$registros[RazonSocial]</td>");
										print("<td>$registros[Num_Identificacion]</td>");
									    print("<td>$registros[Ciudad]</td>");
										
									    print("<td>$registros[idFacturas]</td>");
										
										print("<td>$registros[Fecha]</td>");
										
										print("<td>$registros[OCompra]</td>");
										print("<td>$".number_format($registros['Subtotal'])."</td>");
									   print("<td>$".number_format($registros['IVA'])."</td>");
									   print("<td>$".number_format($registros['Total'])."</td>");
									   print("<td>$".number_format($registros['SaldoFact'])."</td>");
										
										
									print('<td ><form name="FormAplRet" method="post" action="BuscarFactIng.php" target="_self">
												Fecha de Pago: <input type="date" name="TxtFecha" value="'.$FechaActual.'"><br><br>
												Retencion: <select name="CmbRetenciones">');
									$datosR = mysql_query("SELECT * FROM impret WHERE Tipo='Retencion'",$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
									if(mysql_num_rows($datosR)){
									
										while($DatosRetenciones=mysql_fetch_array($datosR)){
											print("<option value=$DatosRetenciones[idImpRet]>$DatosRetenciones[Nombre] $DatosRetenciones[Valor]</option>");
										}
									}	
									print("</select>
									<input type=hidden name='idFactura' value=$registros[idFacturas]>
									<input type=hidden name='FactSubtotal' value=$registros[Subtotal]>
									<input type=hidden name='FactIVA' value=$registros[IVA]>
									<input type=hidden name='FactTotal' value=$registros[Total]>
									<input type=hidden name='TxtBusqueda' value=$_POST[TxtBusqueda]>
									<input type='submit' name='BtnApliRet' value='Aplicar'></form>
									<tr><td colspan=11 align=center><h3>RETENCIONES REALIZADAS</h3></td></tr>
									<tr><td colspan=2>Fecha</td><td colspan=3>Nombre</td><td colspan=2>Porcentaje</td>
									<td colspan=2>Monto</td><td colspan=2>Borrar</td></tr>");

									$DatosRetFact = mysql_query("SELECT * FROM facturas_reten_aplicadas WHERE Facturas_idFacturas='$registros[idFacturas]'",$con) 
									or die("La consulta a nuestra base de datos es erronea ".mysql_error());
									if(mysql_num_rows($DatosRetFact)){
									
										while($InfoRetFact=mysql_fetch_array($DatosRetFact)){
											print("<tr><td colspan=2>$InfoRetFact[Fecha]</td>
												   <td colspan=3>$InfoRetFact[NombreRetencion]</td>
												   <td colspan=2><form name='FormEditRet' method='post' action='BuscarFactIng.php' target='_self'>
													<input type='number' name='TxtPorcentaje' value='$InfoRetFact[Porcentaje]' step='any'>
													<input type=hidden name='TxtBusqueda' value=$_POST[TxtBusqueda]>
													<input type='hidden' name='idRetencion' value='$InfoRetFact[idImpRet]'>
													<input type='hidden' name='idRetencionApl' value='$InfoRetFact[idFacturasRetAplicadas]'>
													<input type=hidden name='FactSubtotal' value=$registros[Subtotal]>
													<input type=hidden name='FactIVA' value=$registros[IVA]>
													<input type='submit' name='BtnEditPorcRet' value='Editar'>
												   </form></td>
												   <td colspan=2>$InfoRetFact[Monto]</td>
												   <td colspan=2><form name='FormDelRet' method='post' action='BuscarFactIng.php' target='_self'>
													
													<input type=hidden name='TxtBusqueda' value=$_POST[TxtBusqueda]>
													
													<input type='hidden' name='idRetencionApl' value='$InfoRetFact[idFacturasRetAplicadas]'>
													
													<input type='submit' name='BtnDelPorcRet' value='Borrar'>
												   </form>
												   </td>
												   
												   </tr>
											");
											
										}
									}	
									
									print('<tr><td colspan=11 align="center"><h3>REGISTRAR PAGO</h3></td></tr>
									<tr><td colspan=11 align="center">
										
									<form name="formIngFact" method="post" action="ingresofact.php" enctype="multipart/form-data target=_blank id="Form3">
									Fecha de Pago:<input type="date" name="TxtFechaPago" value="'.$FechaActual.'">
									 Valor del Pago: $'.number_format($registros["SaldoFact"]).'<br><br>
									
									Registre Observaciones del pago: <textarea id="text1" name="TxtObservacionesPago" ></textarea><br><br>
									  
									<input type="hidden" name="idFactura" value="'.$registros[0].'">  
									<input type="hidden" name="TxtPago" value="'.$registros["SaldoFact"].'">
									<input type="hidden" name="TxtSubTotal" value="'.$registros["Subtotal"].'">
									<input type="hidden" name="TxtTotal" value="'.$registros["Total"].'">
									<input type="hidden" name="IDCliente" value="'.$registros["Clientes_idClientes"].'">
									Cuenta Donde Ingresa el Dinero: <select name="CmbCuentaDestino">
									');
									
									$j = mysql_query("SELECT * FROM cuentasfrecuentes WHERE ClaseCuenta='ACTIVOS'",$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
									if(mysql_num_rows($j)){
									
										while($CuentasF=mysql_fetch_array($j)){
											print("<option value=$CuentasF[CuentaPUC]>$CuentasF[Nombre] $CuentasF[CuentaPUC]</option>");
										}
									}	
									
									print('</select><br>Oprima para Guardar e ingresar el pago <input type=image id=Button5 name=ImgIngFact src=images/guardar.png value='.$registros[0].' style=width:55px;height:75px;z-index:103;>


									</form></td></tr>
									</table>  
									 ');


//<tr>
//<td><form name="FormAplRet" method="post" action="BuscarFactIng.php" target=_self >

//</form></td>
//</tr>
								   

                                   }
								   
                        }else{//Si no existen resultados
                                   print("No se encontraron resultados.");
                        }
            }else{//Si no existen palabra clave
                        print("No existen palabras clave.");
            }
}else{//Si la palabra clave solo tiene un carácter

print("Palabra clave demasiado corta. Digite una palabra con mas de 3 letras");

}
?>