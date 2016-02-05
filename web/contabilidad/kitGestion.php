

<style>
#Tblproductos {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
}

#Tblproductos td, #customers th {
    font-size: 1em;
    border: 1px solid #98bf21;
    padding: 3px 7px 2px 7px;
}

#Tblproductos th {
    font-size: 1.1em;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
	
  background: rgba(1,5,0,1);
background: -moz-linear-gradient(left, rgba(1,5,0,1) 0%, rgba(0,0,0,1) 25%, rgba(83,200,25,1) 96%, rgba(104,167,22,1) 100%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(1,5,0,1)), color-stop(25%, rgba(0,0,0,1)), color-stop(96%, rgba(83,200,25,1)), color-stop(100%, rgba(104,167,22,1)));
background: -webkit-linear-gradient(left, rgba(1,5,0,1) 0%, rgba(0,0,0,1) 25%, rgba(83,200,25,1) 96%, rgba(104,167,22,1) 100%);
background: -o-linear-gradient(left, rgba(1,5,0,1) 0%, rgba(0,0,0,1) 25%, rgba(83,200,25,1) 96%, rgba(104,167,22,1) 100%);
background: -ms-linear-gradient(left, rgba(1,5,0,1) 0%, rgba(0,0,0,1) 25%, rgba(83,200,25,1) 96%, rgba(104,167,22,1) 100%);
background: linear-gradient(to right, rgba(1,5,0,1) 0%, rgba(0,0,0,1) 25%, rgba(83,200,25,1) 96%, rgba(104,167,22,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#010500', endColorstr='#68a716', GradientType=1 );
	color: #ffffff;
}

#Tblproductos tr.alt td {
    color: #000000;
    background-color: #EAF2D3;
}


</style>

<?php
include("KitFunciones.php");

session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.php");

 $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
 mysql_select_db($db,$con) or die("la base de datos no abre");

$fecha=date("Y-m-d");
$tabla="productosventa";
$GesPro=  new ProductosGestion($host,$db,$user,$pw,$tabla);
$GesPro->conectar();


///////////////////////////////////////////////////////////////////////////////////////////
///////////////////SI SE AGREGA UN KIT AL INVENTARIO
///////////////////////////////////////////////////////////////////////////////////////
 
if(isset($_POST['BtnAddKit'])){
 
 $RefKit=$_POST["RefKit"];
 $idKit=$_POST["BtnAddKit"]; 
 $Cantidad=$_POST["TxtCantidad"];  
  
 $sql = "SELECT Existencias FROM productosventa WHERE Referencia='$RefKit'";
 
 $DatosProducto=mysql_query($sql,$con) or die("No se pudo obtener los datos del kit $RefKit.".mysql_error());
 
 $DatosProducto=mysql_fetch_array($DatosProducto);
 $Existencias = $DatosProducto["Existencias"];
 
 $NuevoSaldo=$Existencias + $Cantidad;
 $CostoUnitarioKit=0;
 $sql = "SELECT ReferenciaProducto, Cantidad FROM  prod_kits WHERE ReferenciaKit='$RefKit'";
 
 $Referencias=mysql_query($sql,$con) or die("No se pudo obtener las referencias del kit $RefKit.".mysql_error());
 
 if(mysql_num_rows($Referencias)){
	 
	 while($Ref=mysql_fetch_array($Referencias)){
		 
		 $RefPro=$Ref["ReferenciaProducto"];
		 $CantPro=$Ref["Cantidad"];
		 
		 $sql = "SELECT idProductosVenta, Existencias, CostoUnitario FROM  productosventa WHERE Referencia='$RefPro' LIMIT 1";
 
		$DatosProducto=mysql_query($sql,$con) or die("No se pudo obtener los datos del producto $RefPro.".mysql_error());
		$DatosProducto=mysql_fetch_array($DatosProducto);
		$CostoUnitario=$DatosProducto["CostoUnitario"];
		$idProducto=$DatosProducto["idProductosVenta"];
		$ExisPro=$DatosProducto["Existencias"];
		$SubCosto=$CantPro*$CostoUnitario;
		$CostoUnitarioKit=$CostoUnitarioKit+$SubCosto;
		
		$CantTotalSol=$CantPro*$Cantidad;
		$SubTotalSol=$CantTotalSol*$CostoUnitario;
		
		$ExisPro=$ExisPro-$CantTotalSol;
		$CostoTotalProducto=$ExisPro*$CostoUnitario;
		
		$GesPro->AlimentaKardex($fecha,"SALIDA", "PARA ARMAR KIT $RefKit", $CantTotalSol, $CostoUnitario, $SubTotalSol, $idProducto);				//Alimentamos la Salida en kardex de los productos del kit agregado
		$GesPro->AlimentaKardex($fecha,"SALDOS", "PARA ARMAR KIT $RefKit", $ExisPro, $CostoUnitario, $CostoTotalProducto, $idProducto); 		//Alimentamos el saldo en kardex de los productos del kit agregado
		$GesPro->ActualizaProducto($RefPro ,$ExisPro, $CostoUnitario, $CostoTotalProducto);           //Actualizamos el inventario del producto del kit agregado
 
		//print("Costo de $RefPro = $CostoUnitario <br>");
		 
	 }
 }
 
 $CostoTotal=$CostoUnitarioKit*$NuevoSaldo;
 $SubCostoKit=$CostoUnitarioKit*$Cantidad;
 
 $GesPro->AlimentaKardex($fecha,"ENTRADA", "SE ARMA KIT", $Cantidad, $CostoUnitarioKit, $SubCostoKit, $idKit);						//Alimentamos la entrada en kardex del kit agregado
 $GesPro->AlimentaKardex($fecha,"SALDOS", "SE ARMA KIT", $NuevoSaldo, $CostoUnitarioKit, $CostoTotal, $idKit); 		//Alimentamos el saldo en kardex de los productos del kit agregado
 
 $GesPro->ActualizaProducto($RefKit ,$NuevoSaldo, $CostoUnitarioKit, $CostoTotal); 
 
 print("Se han Agregado $Cantidad unidades del Kit $RefKit al inventario");
 
} 
 
 
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////SI SE RETORNAN LOS ELEMENTOS DE UN KIT AL INVENTARIO
///////////////////////////////////////////////////////////////////////////////////////
 
if(isset($_POST['BtnDelKit'])){
 
 $RefKit=$_POST["RefKit"];
 $idKit=$_POST["BtnDelKit"]; 
 $Cantidad=$_POST["TxtCantidad"];  
  
 $sql = "SELECT Existencias FROM productosventa WHERE Referencia='$RefKit'";
 
 $DatosProducto=mysql_query($sql,$con) or die("No se pudo obtener los datos del kit $RefKit.".mysql_error());
 
 $DatosProducto=mysql_fetch_array($DatosProducto);
 $Existencias = $DatosProducto["Existencias"];
 
 $NuevoSaldo=$Existencias - $Cantidad;
 $CostoUnitarioKit=0;
 $sql = "SELECT ReferenciaProducto, Cantidad FROM  prod_kits WHERE ReferenciaKit='$RefKit'";
 
 $Referencias=mysql_query($sql,$con) or die("No se pudo obtener las referencias del kit $RefKit.".mysql_error());
 
 if(mysql_num_rows($Referencias)){
	 
	 while($Ref=mysql_fetch_array($Referencias)){
		 
		 $RefPro=$Ref["ReferenciaProducto"];
		 $CantPro=$Ref["Cantidad"];
		 
		 $sql = "SELECT idProductosVenta, Existencias, CostoUnitario FROM  productosventa WHERE Referencia='$RefPro' LIMIT 1";
 
		$DatosProducto=mysql_query($sql,$con) or die("No se pudo obtener los datos del producto $RefPro.".mysql_error());
		$DatosProducto=mysql_fetch_array($DatosProducto);
		$CostoUnitario=$DatosProducto["CostoUnitario"];
		$idProducto=$DatosProducto["idProductosVenta"];
		$ExisPro=$DatosProducto["Existencias"];
		$SubCosto=$CantPro*$CostoUnitario;
		$CostoUnitarioKit=$CostoUnitarioKit+$SubCosto;
		
		$CantTotalSol=$CantPro*$Cantidad;
		$SubTotalSol=$CantTotalSol*$CostoUnitario;
		
		$ExisPro=$ExisPro+$CantTotalSol;
		$CostoTotalProducto=$ExisPro*$CostoUnitario;
		
		$GesPro->AlimentaKardex($fecha,"ENTRADA", "POR DESARME DE KIT $RefKit", $CantTotalSol, $CostoUnitario, $SubTotalSol, $idProducto);				//Alimentamos la Salida en kardex de los productos del kit agregado
		$GesPro->AlimentaKardex($fecha,"SALDOS", "POR DESARME DE KIT $RefKit", $ExisPro, $CostoUnitario, $CostoTotalProducto, $idProducto); 		//Alimentamos el saldo en kardex de los productos del kit agregado
		$GesPro->ActualizaProducto($RefPro ,$ExisPro, $CostoUnitario, $CostoTotalProducto);           //Actualizamos el inventario del producto del kit agregado
 
		//print("Costo de $RefPro = $CostoUnitario <br>");
		 
	 }
 }
 
 $CostoTotal=$CostoUnitarioKit*$NuevoSaldo;
 $SubCostoKit=$CostoUnitarioKit*$Cantidad;
 
 $GesPro->AlimentaKardex($fecha,"SALIDA", "SE DESARMA KIT", $Cantidad, $CostoUnitarioKit, $SubCostoKit, $idKit);						//Alimentamos la entrada en kardex del kit agregado
 $GesPro->AlimentaKardex($fecha,"SALDOS", "SE DESARMA KIT", $NuevoSaldo, $CostoUnitarioKit, $CostoTotal, $idKit); 		//Alimentamos el saldo en kardex de los productos del kit agregado
 
 $GesPro->ActualizaProducto($RefKit ,$NuevoSaldo, $CostoUnitarioKit, $CostoTotal); 
 
 print("Se han Agregado $Cantidad unidades del Kit $RefKit al inventario");
 
} 
 
 
 //////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////Busqueda de los kit
 ///////////////////////////////////////////////////////////////////////////////////////////7

$key_words = $_POST['TxtBusqueda'];

if(strlen($key_words)>2  ){//No realizamos búsqueda si la palabra es de un solo caracter
            if($key_words){
           				
                        
						
                       	
						 
                        //Si la búsqueda tiene una palabra utilizamos LIKE sino MATCH AGAINST.
                        
                                   $sql = " SELECT pr.idProductosVenta as ID , pr.Referencia as Referencia, pr.Nombre as Nombre, pr.Existencias as Existencias
								   , pr.PrecioVenta as PrecioVenta FROM productosventa pr INNER JOIN prod_departamentos dep ON pr.Departamento=dep.idDepartamentos 
								   WHERE (pr.Referencia LIKE '%$key_words%' OR pr.Nombre LIKE '%$key_words%') AND dep.Nombre LIKE '%KIT%' 
								   ";
                        
                       
					   
                        //Ejecutamos el codigo Mysql
                        $r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
						
						
                        if(mysql_num_rows($r)){//Si existen resultados
														
							echo "<table width='600' border='1' id='Tblproductos'>";
							 echo "<tr>
							 <th>ID</th> 
							 <th>Referencia</th>
							 <th colspan=2 align=center >Nombre</th>
							 <th>Existencias</th> 
							<th> Precio Venta</th>
							<th>Agregar KIT al Inventario</th>
							<th>Retornar elementos del KIT al Inventario</th>
							</tr><tr>
							 ";
							
									  $i=0;
									while($DatosProducto=mysql_fetch_array($r)) {
										  
										 if($i==1){
											print("<tr class=alt >");
											$i=0;
										 }else{
											 print("<tr>");
											$i=1;
											 
										 }
                                        print("<td>$DatosProducto[ID]</td>
										
										<td>$DatosProducto[Referencia]</td>
										<td colspan=2>$DatosProducto[Nombre]</td>
										<td>$DatosProducto[Existencias]</td>
										<td>$DatosProducto[PrecioVenta]</td>
										<td><form name='formAddKit' method='post' action='kitGestion.php' enctype='multipart/form-data' target='_self' >
										<input type='hidden' name='BtnAddKit' value='$DatosProducto[ID]'>
										<input type='hidden' name='RefKit' value='$DatosProducto[Referencia]'>
										<input type='hidden' name='TxtBusqueda' value='$key_words'> 
										<input type='number' name='TxtCantidad' value='1' min=1 max=100> 
										<input type='image' id='Button5' name='Img' src='iconos/agregaVenta.png' style='width:50px;height:50px'>

										</form></td>
										
										<td><form name='formDelKit' method='post' action='kitGestion.php' enctype='multipart/form-data' target='_self' >
										<input type='hidden' name='BtnDelKit' value='$DatosProducto[ID]'>
										<input type='hidden' name='RefKit' value='$DatosProducto[Referencia]'>
										<input type='hidden' name='TxtBusqueda' value='$key_words'> 
										<input type='number' name='TxtCantidad' value='1' min=1 max=100> 
										<input type='image' id='Button5' name='Img' src='iconos/return2.png' style='width:50px;height:50px'>

										</form></td>
										</tr>
										");
										
									   }    
							
											
										

								   
                        }else{//Si no existen resultados
                                   print("No se encontraron resultados.");
                        }
            }else{//Si no existen palabra clave
                        print("No existen palabras clave.");
            }
			
}else{
	
	print("Digite mas de dos letras");

}

?>
