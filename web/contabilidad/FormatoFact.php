<script src="js/funciones.js"></script>

<?php 
$accion="";
session_start();

include_once("modelo/php_conexion.php");

if (!isset($_SESSION['username']))
{
  exit("No se ha iniciado una sesion <a href='index.php' >Iniciar Sesion </a>");
  
}

if(isset($_REQUEST["CbComprasActivas"]) and $_REQUEST["CbComprasActivas"]>0){
	
	$idCompra = $_REQUEST["CbComprasActivas"];	
	$ItemBus="";
	$obVenta=new ProcesoVenta(1);
	$DatosPrecompra=$obVenta->DevuelveValores("compras_activas","idComprasActivas", $idCompra);
	
}else{
	exit("Debes seleccionar una compra activa");
}

	if(!empty($_GET['del'])){
		$id=$_GET['del'];
		
		mysql_query("DELETE FROM compras_precompra WHERE idPreCompra='$id'") or die(mysql_error());
		//exit("precompra $id borrada");
		header("location:FormatoFact.php?CbComprasActivas=$idCompra");
	}
	
	
	
	if(!empty($_POST['TxtItemBuscar']))
		$ItemBus=$_POST['TxtItemBuscar'];
		
	if(isset($_POST["BtnAgregarItem"]))
		$accion = "agregarItem";

	if(isset($_POST["BtnGuardar"]))
		$accion = "guardarFact";

	
/////////////////////////////////////////
////////////Agregamos Item
//////////////////////////////////////////	
	
if($accion=="agregarItem"){
	
			$CostoUnitario=$_POST["TxtCostoUnitario"];
			$PrecioVenta=$_POST["TxtVentaUnitario"];
			$Cantidad=$_POST["TxtCantidad"];
			$IVA=$_POST["CmbIVA"];
			$Referencia=$_POST["TxtReferencia"];
			$idProducto=$_POST["TxtidProducto"];
			$Subtotal=$CostoUnitario*$Cantidad;
			$Impuestos=round($Subtotal*$IVA);
			$Total=round($Subtotal+$Impuestos);
			
			//////registramos en compras precompra
		
		
		$NumRegistros=10;
					
		$Columnas[0]="idProductosVenta";	$Valores[0]=$idProducto;
		$Columnas[1]="Referencia";      	$Valores[1]=$_POST["TxtReferencia"];
		$Columnas[2]="Descripcion";			$Valores[2]=$_POST["TxtDescripcion"];
		$Columnas[3]="Cantidad";			$Valores[3]=$Cantidad;
		$Columnas[4]="ValorUnitario";		$Valores[4]=$CostoUnitario;
		$Columnas[5]="Subtotal"; 			$Valores[5]=$Subtotal;
		$Columnas[6]="IVA";					$Valores[6]=$Impuestos;
		$Columnas[7]="Total";				$Valores[7]=$Total;
		$Columnas[8]="idComprasActivas";	$Valores[8]=$idCompra;
		$Columnas[9]="PrecioVentaPre";		$Valores[9]=$PrecioVenta;
		
		$obVenta->InsertarRegistro("compras_precompra",$NumRegistros,$Columnas,$Valores);
			
		//mysql_query("UPDATE productosventa SET PrecioVenta='$PrecioVenta' WHERE Referencia='$Referencia'");	
		
}
	
	
/////////////////////////////////
///////////////////guardamos
/////////////////////////////////

if($accion=="guardarFact"){
	
		$ComparaIn=$_POST["TxtTotalCompara"];
		$Fecha=$_POST["TxtFecha"];
		//////obtenemos datos de la compra
		$reg = mysql_query("SELECT *, SUM(Subtotal) as SubTotalFact, 
		SUM(IVA) as IVAFact, SUM(Total) as TotalFact
		  FROM `compras_precompra` WHERE `idComprasActivas`='$idCompra' ") 
		or die("La consulta a precompras es erronea.".mysql_error());

		$datosSumas=mysql_fetch_array($reg);

		
		$Subtotal=$datosSumas["SubTotalFact"];
		$IVA=$datosSumas["IVAFact"];
		$Valor=$datosSumas["TotalFact"];			
		
		$idProveedor=$DatosPrecompra["idProveedor"];
		$NumFact=$DatosPrecompra["Factura"];
		$CuentaOrigen=$DatosPrecompra["CuentaOrigen"];
		$FormaPago=$DatosPrecompra["FormaPago"];
		$FechaPagoPro=$DatosPrecompra["FechaProg"];
		$TipoCompra=$DatosPrecompra["Tipo"];
		$TotalCompra=$DatosPrecompra["TotalCompra"];
		
		///////////////////////////////////Alimentamos el inventario
		////////////////////////////////////////////////////////////
		
		$reg = mysql_query("SELECT * FROM `compras_precompra` WHERE `idComprasActivas`='$idCompra' ") 
or die("La consulta a precompras es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

	
   while($datosProducto=mysql_fetch_array($reg)){
	   
	   mysql_query("INSERT INTO relacioncompras ( Fecha, Documento, NumDocumento, Cantidad, ValorUnitarioAntesIVA, TotalAntesIva, ProductosVenta_idProductosVenta  )
		VALUES ('$Fecha','$TipoCompra','$NumFact','$datosProducto[Cantidad]','$datosProducto[ValorUnitario]','$datosProducto[Subtotal]','$datosProducto[idProductosVenta]') ") 
		or die("no se pudo alimentar el inventario ".mysql_error());

      mysql_query("UPDATE productosventa SET PrecioVenta='$datosProducto[PrecioVentaPre]' WHERE idProductosVenta='$datosProducto[idProductosVenta]'");	
	  
}


}
		
		$Diferencia=$TotalCompra-$ComparaIn;
		
		mysql_query("DELETE FROM compras_precompra WHERE idComprasActivas='$idCompra'")
		or die(mysql_error());
		mysql_query("DELETE FROM compras_activas WHERE idComprasActivas='$idCompra'")
		or die(mysql_error());
		
		
		
		if($Diferencia<>0)
		print("<script> alert('El total de la factura ingresada no es igual a la sumatoria de los productos comprados, existe una diferencia de: $Diferencia')</script>");
		
		exit('Compra Registrada e inventario alimentado, por favor actualice la pagina');
		
			

}

	
	
	
	
?>
 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Compras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Software de Techno Soluciones">
    <meta name="author" content="Techno Soluciones SAS">

    <!-- Le styles -->
    <link href="VAtencion/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="VAtencion/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="VAtencion/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="VAtencion/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="VAtencion/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="VAtencion/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="VAtencion/ico/favicon.png">
  
  
  

 <script language="JavaScript"> 
function envia(){ 
if (confirm('¿Estas seguro que deseas guardar?')){ 
      document.FrmGuardar.submit();
      
    } 

 
} 


</script> 
  
  
  </head>

  <body>

  
  
  
    <div class="navbar navbar-inverse navbar-fixed-top" >
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand">SoftConTech</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              
			  <li center><form name= "FormBuscar" action="FormatoFact.php" id="FormMesa" method="post" target="_self"> 
					<input type="text" name="TxtItemBuscar" placeholder="Busqueda" onchange="EnviaFormSC()" style="width:500px;height:42px;z-index:8;background-color:white">
					<input type="hidden" name="CbComprasActivas" value="<?php echo $idCompra; ?>"></input>
					<input type="submit" name="BtnBuscar" value="Buscar" class="btn btn-primary"></input>
				</form>
			  </li>
			  
			  
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      

      <!-- Example row of columns -->
	  
	  <div class="span4" >
           
               
            </div>
	  <br>
	  <br>
	  <br>
	  <div align="center">
      	
        <div class="row-fluid">
    		<div class="span8">
			<?php
			
			if($ItemBus<>""){
				$sql="SELECT * FROM productosventa pv INNER JOIN prod_codbarras pc ON pv.idProductosVenta=pc.ProductosVenta_idProductosVenta 
				WHERE pv.Referencia = '$ItemBus' OR pc.CodigoBarras='$ItemBus' OR pv.Nombre LIKE '%$ItemBus%' OR pv.idProductosVenta = '$ItemBus'";
				//print($sql);
                $pa=mysql_query($sql) or die(mysql_error());				
                while($row=mysql_fetch_array($pa)){
				//$ImageRuta=explode("/", $row['Imagen']);
				$PrecioFinal=$row['PrecioVenta'];
				$Costo=$row['CostoUnitario'];
				//$idProducto=$row['idProductosVenta'];
				
				
            ?>                       
        	<table class="table table-bordered">
            	<tr><td>
                	<div class="row-fluid">
                    	<div class="span4">
                            <center><strong><?php echo $row['Nombre']; ?></strong></center><br>
                            <!--<img src="imagepro/<?php //echo $ImageRuta[3]; ?>" class="img-polaroid"> -->
                        </div>
                        <div class="span4"><br>
                            
                            
                        </div>
                        <div class="span4" align="right"><br>
                        	<form name="form<?php $row['Referencia']; ?>" method="post" action="">
                            	<input type="hidden" name="TxtReferencia" value="<?php echo $row['Referencia']; ?>">
								<input type="hidden" name="TxtDescripcion" value="<?php echo $row['Nombre']; ?>">
								<input type="hidden" name="TxtidProducto" value="<?php echo $row['idProductosVenta']; ?>">
								<input type="hidden" name="CbComprasActivas" value="<?php print($idCompra); ?>">
								
								Cantidad:
								<input type="number" name="TxtCantidad" id="<?php echo $row['Referencia']; ?>" value="1" step="any" style="height:50px;font-size:20;width:100px"> 
								<br>Costo:
								<input type="number" value="<?php echo $Costo; ?>" name="TxtCostoUnitario" required placeholder="CostoUnitario" step="any" style="height:50px;font-size:20;width:100px">
								<br>Venta:
								<input type="number" value="<?php echo $PrecioFinal; ?>" name="TxtVentaUnitario" min="<?php echo $Costo; ?>" required placeholder="VentaUnitario" step="any" style="height:50px;font-size:20;width:100px">
								<br>IVA:
								<select name="CmbIVA" style="height:50px;font-size:20;width:100px">
									<option value=0>0</option>
									<option value="0.05">5%</option>
									<option value="0.08">8%</option>
									<option value="0.16" selected>16%</option>  
								</select>
								 <button type="submit" name="BtnAgregarItem" class="btn btn-primary">
                                    <i class="icon-shopping-cart"></i> <strong>Agregar</strong>
                                </button>
                            </form>
                        </div>
                    </div>
            	</td></tr>
        	</table>
        	<?php }} ?>
        	</div>
            
    	</div>
        
      </div>
	  
	  
	  
	  
	  
	  
	  <div id="sidebar" ><br>
               		<h2 align="center">Pre Compra No. <?php Print("$DatosPrecompra[idComprasActivas] Factura: $DatosPrecompra[Factura] Proveedor: $DatosPrecompra[NombrePro] por: $ $DatosPrecompra[TotalCompra]"); ?>
					</h2>
               		<table class="table table-bordered" >
                      <tr>
                        <td>
                        	<table class="table table-bordered table table-hover" >
							<tr style="font-size:14px">
                                <td>Descripción</td>
								<td>Precio de Venta</td>
                                <td>Cantidad</td>
                                <td>Costo Unitario</td>
								<td>Subtotal</td>
								<td>IVA</td>
								<td>Total</td>
                                <td>Borrar</td>
                              </tr>
                            <?php 
								$tsub=0;$tneto=0;$tiva=0;
								$pa=mysql_query("SELECT *, ap.IVA as IVA FROM compras_precompra ap INNER JOIN productosventa pv ON ap.Referencia=pv.Referencia WHERE ap.idComprasActivas='$idCompra'") 
								or die(mysql_error());	
								$in=0;
								while($row=mysql_fetch_array($pa)){
									$in=1;
									//$oProducto=new Consultar_Producto($row['Prod_Referencia']);
									$ValorUnitario=$row['ValorUnitario'];
									$SubtotalPre=$row['Subtotal'];
									$IVAPre=$row['IVA'];
									$TotalPre=$row['Total'];
									$tsub=$tsub+$SubtotalPre;
									$tiva=$tiva+$IVAPre;
									$tneto=$tneto+$TotalPre;
									
									
							?>
							
							  
                              <tr style="font-size:14px">
                                <td><?php echo $row['Descripcion']; ?></td>
								<td>$ <?php echo number_format($row['PrecioVentaPre']); ?></td>
                                <td><?php echo $row['Cantidad']; ?></td>
                                <td>$ <?php echo number_format($ValorUnitario); ?></td>
								<td>$ <?php echo number_format($SubtotalPre); ?></td>
								<td>$ <?php echo number_format($IVAPre); ?></td>
								<td>$ <?php echo number_format($TotalPre); ?></td>
                                <td>
                                	<a href="FormatoFact.php?del=<?php print("$row[idPreCompra]&CbComprasActivas=$idCompra"); ?>" title="Eliminar de la Lista">
                                		<i class="icon-remove"></i>
                                    </a>
                                </td>
                              </tr>
                            <?php }
							?>
								<tr><td align="right" colspan="4" style="font-size:20px;color:red">Subtotal</td>
								<td colspan="3" style="font-size:20px;color:red"><div align="right">$<?php echo number_format($tsub); ?></div></td> </tr>
								<tr><td align="right"colspan="4" style="font-size:20px;color:red">IVA</td>
								<td colspan="3" style="font-size:20px;color:red"><div align="right">$<?php echo number_format($tiva); ?></div></td> </tr>
                            	<tr><td align="right" colspan="4" style="font-size:20px;color:red">Total</td>
								<td colspan="3" style="font-size:20px;color:red"><div align="right">$<?php echo number_format($tneto); ?></div></td> </tr>
                            <?php 
								$pa=mysql_query("SELECT * FROM compras_precompra ap INNER JOIN productosventa pv ON ap.Referencia=pv.Referencia WHERE ap.idComprasActivas='$idCompra'");				
								if(!$row=mysql_fetch_array($pa)){
							?>
                              <tr><div class="alert alert-success" align="center"><strong>No hay Productos Agregados</strong></div></tr>
							  <?php } ?>
                            </table>
                        </td>
                      </tr>
                    </table>
					
                </div>
				
				<form name="FrmGuardar" method="post" action="FormatoFact.php" target="_self" id="FrmGuardar">
				<input type="hidden" name="CbComprasActivas" value="<?php print($idCompra); ?>">  
				<input type="hidden" name="TxtTotalCompara" value="<?php print($DatosPrecompra['TotalCompra']); ?>">  
				<input type="hidden" name="TxtFecha" value="<?php print($DatosPrecompra['Fecha']); ?>">
				<?php if($in==1){
					
					print('<form >
					<input type="submit" name="BtnGuardar" id="BtnGuardar" style="width:134px;height:136px;z-index:10;"   value="Guardar">');
					
				} ?>
	  
				</form>
      <div class="row">
      	
      </div>
      

      <hr>

      <footer>
        <p>&copy; Techno Soluciones SAS 2015</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="VAtencion/js/jquery.js"></script>
    <script src="VAtencion/js/bootstrap-transition.js"></script>
    <script src="VAtencion/js/bootstrap-alert.js"></script>
    <script src="VAtencion/js/bootstrap-modal.js"></script>
    <script src="VAtencion/js/bootstrap-dropdown.js"></script>
    <script src="VAtencion/js/bootstrap-scrollspy.js"></script>
    <script src="VAtencion/js/bootstrap-tab.js"></script>
    <script src="VAtencion/js/bootstrap-tooltip.js"></script>
    <script src="VAtencion/js/bootstrap-popover.js"></script>
    <script src="VAtencion/js/bootstrap-button.js"></script>
    <script src="VAtencion/js/bootstrap-collapse.js"></script>
    <script src="VAtencion/js/bootstrap-carousel.js"></script>
    <script src="VAtencion/js/bootstrap-typeahead.js"></script>
	
   
<a style="display:scroll; position:fixed; bottom:10px; right:10px;" href="#" title="Volver arriba"><img src="iconos/up1_amarillo.png" /></a>
  </body>
</html>
