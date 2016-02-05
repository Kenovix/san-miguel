<script>
function show_hide() {
if(document.getElementById('FormaPago').value == "Contado") {
document.getElementById('CmbCuentaOrigen').style.display = "block";
} else {
document.getElementById('CmbCuentaOrigen').style.display = "none";
}
}
</script>

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
	
    background: rgba(76,76,76,1);
background: -moz-linear-gradient(left, rgba(76,76,76,1) 0%, rgba(89,89,89,1) 12%, rgba(102,102,102,1) 25%, rgba(71,71,71,1) 39%, rgba(44,44,44,1) 50%, rgba(0,0,0,1) 51%, rgba(17,17,17,1) 60%, rgba(43,43,43,1) 76%, rgba(28,28,28,1) 91%, rgba(19,19,19,1) 100%);
background: -webkit-gradient(left top, right top, color-stop(0%, rgba(76,76,76,1)), color-stop(12%, rgba(89,89,89,1)), color-stop(25%, rgba(102,102,102,1)), color-stop(39%, rgba(71,71,71,1)), color-stop(50%, rgba(44,44,44,1)), color-stop(51%, rgba(0,0,0,1)), color-stop(60%, rgba(17,17,17,1)), color-stop(76%, rgba(43,43,43,1)), color-stop(91%, rgba(28,28,28,1)), color-stop(100%, rgba(19,19,19,1)));
background: -webkit-linear-gradient(left, rgba(76,76,76,1) 0%, rgba(89,89,89,1) 12%, rgba(102,102,102,1) 25%, rgba(71,71,71,1) 39%, rgba(44,44,44,1) 50%, rgba(0,0,0,1) 51%, rgba(17,17,17,1) 60%, rgba(43,43,43,1) 76%, rgba(28,28,28,1) 91%, rgba(19,19,19,1) 100%);
background: -o-linear-gradient(left, rgba(76,76,76,1) 0%, rgba(89,89,89,1) 12%, rgba(102,102,102,1) 25%, rgba(71,71,71,1) 39%, rgba(44,44,44,1) 50%, rgba(0,0,0,1) 51%, rgba(17,17,17,1) 60%, rgba(43,43,43,1) 76%, rgba(28,28,28,1) 91%, rgba(19,19,19,1) 100%);
background: -ms-linear-gradient(left, rgba(76,76,76,1) 0%, rgba(89,89,89,1) 12%, rgba(102,102,102,1) 25%, rgba(71,71,71,1) 39%, rgba(44,44,44,1) 50%, rgba(0,0,0,1) 51%, rgba(17,17,17,1) 60%, rgba(43,43,43,1) 76%, rgba(28,28,28,1) 91%, rgba(19,19,19,1) 100%);
background: linear-gradient(to right, rgba(76,76,76,1) 0%, rgba(89,89,89,1) 12%, rgba(102,102,102,1) 25%, rgba(71,71,71,1) 39%, rgba(44,44,44,1) 50%, rgba(0,0,0,1) 51%, rgba(17,17,17,1) 60%, rgba(43,43,43,1) 76%, rgba(28,28,28,1) 91%, rgba(19,19,19,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4c4c4c', endColorstr='#131313', GradientType=1 );
    
	color: #ffffff;
}

#Tblproductos tr.alt td {
    color: #000000;
    background-color: #EAF2D3;
}





</style>

<?php
include("conexion.php");
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.php");

 $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
 mysql_select_db($db,$con) or die("la base de datos no abre");


///////////////////////////////////////////////////////////////////////////////////////////
///////////////////SI SE BORRA UN PRODUCTO A UN KIT
///////////////////////////////////////////////////////////////////////////////////////
 
if(isset($_POST['BtnEliminarItem'])){
 
 $idItemKit=$_POST["BtnEliminarItem"];
  
 $sql = "DELETE FROM prod_kits WHERE idKits='$idItemKit'";
 
 mysql_query($sql,$con) or die("No se pudo eliminar el item del kit .".mysql_error());
 
 print("Item $idItemKit eliminado");
 
} 
 
 
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////SI SE AGREGA UN PRODUCTO A UN KIT
///////////////////////////////////////////////////////////////////////////////////////
 
if(isset($_POST['BtnAgregarPro'])){
 
 $DatosProducto=$_POST["ListProductos"];
 $DatosProducto=explode(';',$DatosProducto);
 
 if(count($DatosProducto)<2){
	 
	 exit("No se seleccionó un producto valido");
 }
 
 $ReferenciaProducto=$DatosProducto[1];
 $RefKit=$_POST["RefKit"];
 $Cantidad=$_POST["TxtCantidad"];
 
 
 
 $sql = "INSERT INTO prod_kits (ReferenciaKit, ReferenciaProducto, Cantidad) VALUES ('$RefKit','$ReferenciaProducto','$Cantidad') ";
 
 mysql_query($sql,$con) or die("No se pudo agregar el producto al kit .".mysql_error());
 
 print("Producto $ReferenciaProducto agregado");
 
}
 

///////////////////////////////////////////////////////////////////////////////////////////
///////////////////CUANDO SE SELECCIONA UN KIT
///////////////////////////////////////////////////////////////////////////////////////
 
 
 
if(isset($_POST['RefKit'])){
	
	$RefKit=$_POST['RefKit'];
	$NombreKit=$_POST['Nombre'];
	
	print(' <center><h3>Busque un producto para agregar al KIT '.$RefKit.':</h3><br>
	<form name="formList" method="post" action="kitContructor.php"  target="_self" >
	
	<input list="Productos" name="ListProductos" value="" required style="width:580px;height:30px" >
<datalist id="Productos">');

$reg = mysql_query("SELECT pr.idProductosVenta as ID, pr.Nombre as Nombre, dep.Nombre as Departamento, pr.Referencia as Referencia FROM productosventa pr INNER JOIN prod_departamentos dep ON pr.Departamento=dep.idDepartamentos 
WHERE dep.Nombre NOT LIKE 'KIT' ",$con) or die("La consulta a productosventa en lista es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados

   while($datos=mysql_fetch_array($reg)){
      print('<option value="'.$datos["ID"].' '.$datos["Departamento"].' '.$datos["Nombre"].' ;'.$datos["Referencia"].'">');
   }

}



echo '</datalist>';

print("<input type=number name='TxtCantidad' value='1' step=any min='0' style='width:50px;height:30px'>
<input type='hidden' name='RefKit' value='$RefKit'>
<input type='hidden' name='Nombre' value='$NombreKit'>
<input type=submit name='BtnAgregarPro' value='Agregar' style='width:80px;height:30px'></form>");	
	

print('<hr><h3 style="color:blue">Productos Agregados al KIT '.$RefKit.':</h3><br>

<div id="Layer1" style="text-align:left;background-color: WHITE;">

');


						$sql = " SELECT kit.idKits as ID, pr.Referencia as Referencia, pr.Nombre as Nombre, kit.Cantidad as Cantidad FROM prod_kits kit 
						INNER JOIN productosventa pr ON kit.ReferenciaProducto=pr.Referencia
						 WHERE kit.ReferenciaKit = '$RefKit' ORDER BY kit.idKits DESC";
                        
                       
					   
                        //Ejecutamos el codigo Mysql
                        $r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
						
						
                        if(mysql_num_rows($r)){//Si existen resultados
														
							echo "<table width='600' border='1' id='Tblproductos'>";
							 echo "<tr>
							 
							 <th>Referencia</th>
							 <th colspan=2 align=center >Nombre</th>
							 <th>Cantidad</th> 
							 <th>Eliminar</th>
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
                                        print("
										
										<td>$DatosProducto[Referencia]</td>
										<td colspan=2>$DatosProducto[Nombre]</td>
										<td>$DatosProducto[Cantidad]</td>
										
										<td><form name='formAgregar' method='post' action='kitContructor.php' enctype='multipart/form-data' target='_self' >
										
										<input type='hidden' name='RefKit' value='$RefKit'>
										<input type='hidden' name='Nombre' value='$NombreKit'>
										<input type='hidden' name='BtnEliminarItem' value='$DatosProducto[ID]'>
										<input type='image' id='Button5' name='Img' src='iconos/delete.png' >

										</form></td></tr>
										");
										
									   } 

print("</div></center>");									   
									   
						}


	exit();
}


$key_words = $_POST['TxtBusqueda'];
$fecha=date("Y-m-d");
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
							<th>Seleccionar</th>
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
										<td><form name='formSelect' method='post' action='kitContructor.php' enctype='multipart/form-data' target='_self' >
										<input type='hidden' name='idKit' value='$DatosProducto[ID]'>
										<input type='hidden' name='RefKit' value='$DatosProducto[Referencia]'>
										<input type='hidden' name='Nombre' value='$DatosProducto[Nombre]'>
										<input type='image' id='Button5' name='Img' src='iconos/select.png' >

										</form></td></tr>
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
