<script language="JavaScript"> 
function envia(){ 

if (confirm('¿Estas seguro que deseas dar de baja este producto?')){ 
      document.this.form.submit();
      
    } 
	
}

</script> 

<?php


include("classes_servi/CreaTablasMysqlVender.php");

//if(!isset($_SESSION["username"]))
  // header("Location: index.php");

error_reporting(0);	

session_start();

if(!isset($_SESSION["username"]))
  header("Location: index.php");


$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

$fecha=date("Y-m-d");
	
$Busqueda=$_POST["TxtBusqueda"];
	
if(isset($_POST["BtnBaja"])){
	
	
	$idProducto=$_POST["TxtidProducto"];
	$CostoUnitario=$_POST["TxtCosto"];
	$Cantidad=$_POST["TxtCantidadBaja"];
	$Observaciones=$_POST["TxtObservaciones"];
	
	$CostoTotal=round($Cantidad*$CostoUnitario);
	
	$tab="productosventa";
	
	$tabla=  new Mytable($host,$db,$user,$pw,$tab);
	$tabla->conectar();
	
	/////////////////////////////////////////
	////////////Edito el saldo del producto///
	///////////////////////////////////////
	
	$tabla->NombresColumnas($tab);
	$DatosProducto=$tabla->DevuelveValores($idProducto);
	$Saldo=$DatosProducto['Existencias']-$Cantidad;
	$CostoTotal=$Saldo*$DatosProducto['CostoUnitario'];
	
	$NumRegistros=2;
	$Filtro="idProductosVenta";
	$idItem=$idProducto;
	$Columnas[0]='Existencias';        $Valores[0]=$Saldo;
	$Columnas[1]='CostoTotal';        	$Valores[1]=$CostoTotal;
	
	$tabla-> EditeValoresTabla($tab,$NumRegistros,$Columnas,$Valores,$Filtro,$idItem);
	
	////////////////////////////////////////////////////////
	//////////Inserto la baja
	/////////////////////////////////////////////////////////
	
	
	
	
	$tab="prod_bajas";
	$NumRegistros=8;  
						
	
	$Columnas[0]="Fecha";						$Valores[0]=$fecha;
	$Columnas[1]="Departamento";				$Valores[1]=$DatosProducto['Departamento'];
	$Columnas[2]="Referencia";					$Valores[2]=$DatosProducto['Referencia'];
	$Columnas[3]="Nombre";						$Valores[3]=$DatosProducto['Nombre'];
	$Columnas[4]="Cantidad";					$Valores[4]=$Cantidad;
	$Columnas[5]="CostoTotal";					$Valores[5]=$CostoTotal;
	$Columnas[6]="Observaciones";				$Valores[6]=$Observaciones;
	$Columnas[7]="Usuarios_idUsuarios";			$Valores[7]=$_SESSION['idUser'];
		
	$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
	
	$tabla->NombresColumnas($tab);
	$idBaja=$tabla->VerUltimoID();
	
	////////////////////////////////////////////////////////
	//////////Inserto informacion en kardex
	/////////////////////////////////////////////////////////
	
	$tab="kardexmercancias";
	$NumRegistros=8;  
						
	
	$Columnas[0]="Fecha";								$Valores[0]=$fecha;
	$Columnas[1]="Movimiento";							$Valores[1]='BAJA';
	$Columnas[2]="Detalle";								$Valores[2]=$Observaciones;
	$Columnas[3]="idDocumento";							$Valores[3]=$idBaja;
	$Columnas[4]="Cantidad";							$Valores[4]=$Cantidad;
	$Columnas[5]="ValorUnitario";						$Valores[5]=$CostoUnitario;
	$Columnas[6]="ValorTotal";							$Valores[6]=$CostoTotal;
	$Columnas[7]="ProductosVenta_idProductosVenta";		$Valores[7]=$idProducto;
		
	$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
	
	
	$Columnas[0]="Fecha";								$Valores[0]=$fecha;
	$Columnas[1]="Movimiento";							$Valores[1]='SALDOS';
	$Columnas[2]="Detalle";								$Valores[2]=$Observaciones;
	$Columnas[3]="idDocumento";							$Valores[3]=$idBaja;
	$Columnas[4]="Cantidad";							$Valores[4]=$Saldo;
	$Columnas[5]="ValorUnitario";						$Valores[5]=$CostoUnitario;
	$Columnas[6]="ValorTotal";							$Valores[6]=$Saldo*$CostoUnitario;
	$Columnas[7]="ProductosVenta_idProductosVenta";		$Valores[7]=$idProducto;
		
	$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
	
	
	
	//////////////////////////////////////////////////////////////////////
		///////////////////////////Realizar asientos contables en la tabla de Libro Diario
					
					$tab="librodiario";
					$NumRegistros=24;
					$tabla->NombresColumnas("cuentas");
					$CuentaPUC="6135";
					$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
					$NombreCuenta=$DatosCuenta["Nombre"];
					
					
					
					$Columnas[0]="Fecha";					$Valores[0]=$fecha;
					$Columnas[1]="Tipo_Documento_Intero";	$Valores[1]="COMPROBANTE DE BAJA";
					$Columnas[2]="Num_Documento_Interno";	$Valores[2]=$idBaja;
					$Columnas[3]="Tercero_Tipo_Documento";	$Valores[3]="";
					$Columnas[4]="Tercero_Identificacion";	$Valores[4]="";
					$Columnas[5]="Tercero_DV";				$Valores[5]="";
					$Columnas[6]="Tercero_Primer_Apellido";	$Valores[6]="";
					$Columnas[7]="Tercero_Segundo_Apellido";$Valores[7]="";
					$Columnas[8]="Tercero_Primer_Nombre";	$Valores[8]="";
					$Columnas[9]="Tercero_Otros_Nombres";	$Valores[9]="";
					$Columnas[10]="Tercero_Razon_Social";	$Valores[10]="PROPIO";
					$Columnas[11]="Tercero_Direccion";		$Valores[11]="";
					$Columnas[12]="Tercero_Cod_Dpto";		$Valores[12]="";
					$Columnas[13]="Tercero_Cod_Mcipio";		$Valores[13]="";
					$Columnas[14]="Tercero_Pais_Domicilio";  $Valores[14]="";
					
					$Columnas[15]="CuentaPUC";				$Valores[15]=$CuentaPUC;
					$Columnas[16]="NombreCuenta";			$Valores[16]=$NombreCuenta;
					$Columnas[17]="Detalle";				$Valores[17]="BAJA DE ACTIVOS";
					$Columnas[18]="Debito";					$Valores[18]=round($CostoTotal);
					$Columnas[19]="Credito";				$Valores[19]="0";
					$Columnas[20]="Neto";					$Valores[20]=$Valores[18];
					$Columnas[21]="Mayor";					$Valores[21]="NO";
					$Columnas[22]="Esp";					$Valores[22]="NO";
					$Columnas[23]="Concepto";				$Valores[23]="BAJA DE ACTIVOS";
												
					$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
					
					///////////////////////Registramos ingresos
					
					$CuentaPUC=1435; //4135   comercio al por menor y mayor
					$tabla->NombresColumnas("cuentas");
					$DatosCuenta=$tabla->DevuelveValores($CuentaPUC);
					$NombreCuenta=$DatosCuenta["Nombre"];
					
					$Valores[15]=$CuentaPUC;
					$Valores[16]=$NombreCuenta;
					$Valores[18]="0";
					$Valores[19]=round($CostoTotal); 				//Credito se escribe el total de la venta menos los impuestos
					$Valores[20]=$Valores[19]*(-1);  											//Credito se escribe el total de la venta menos los impuestos
					
					$tabla->InsertarRegistro($tab,$NumRegistros,$Columnas,$Valores);
					
					
					
					echo "Se dió de baja $Cantidad existencias de $DatosProducto[Nombre] por valor de $CostoTotal";
	
	
}


                      	
						 
                        
		 $sql = "SELECT * FROM productosventa pr INNER JOIN prod_codbarras cod ON pr.idProductosVenta=cod.ProductosVenta_idProductosVenta WHERE cod.CodigoBarras ='$Busqueda' 
		 OR pr.Referencia='$Busqueda' OR pr.Nombre LIKE '%$Busqueda%' OR pr.Departamento='$Busqueda'";
	  
		//Ejecutamos el codigo Mysql
		$r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
		
		echo "<table width='600' border='1'>";
					   echo "<tr><td>ID</td><td>Referencia</td><td>Departamento</td><td>Nombre</td> <td>Cod. Barras</td> <td>Existencias</td><td>Costo</td> 
					   <td>Dar de Baja</td> ";
					   echo "<tr>";
		
		if(mysql_num_rows($r)){//Si existen resultados
			
				   while($registros=mysql_fetch_array($r)){
					   
						echo "<tr><td>$registros[idProductosVenta]</td>";
						 echo "<td>$registros[Referencia]</td>";
						  echo "<td>$registros[Departamento]</td>";
						   echo "<td>$registros[Nombre]</td>";
							echo "<td>$registros[CodigoBarras]</td>";
							 echo "<td>$registros[Existencias]</td>";
							 echo "<td>$registros[CostoUnitario]</td>";
							 echo "<td><form name=FormBaja action='BuscarProductoBaja.php' method=post target='_self'>
							 Cantidad:<br><input type='number' name='TxtCantidadBaja' value='1' step='any' min=0 max='$registros[Existencias]' style=width:65px onkeypress='return event.keyCode!=13'><br>
							 <input type='hidden' name='TxtBusqueda' value='$Busqueda'>
							 <input type='hidden' name='TxtidProducto' value='$registros[idProductosVenta]'>
							 <input type='hidden' name='TxtCosto' value='$registros[CostoUnitario]'>
							 ";
							 echo "Observaciones:<br><textarea name=TxtObservaciones style=width:200px;height:63px;z-index:15; rows=2 cols=109 placeholder='Escriba el motivo para darle de baja a este articulo' required></textarea>
							 <input type='submit' name='BtnBaja' value='Dar de baja' style='width:200px;height:30px;color:RED' onClick='envia();return false;'></form>
							 
							 </td>";
							
									   
									   
echo "</tr>";								   
                                   }
								   
 echo "</table>  <br>";
                      

}
?>