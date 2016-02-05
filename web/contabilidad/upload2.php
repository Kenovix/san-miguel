<?php

include "conexion.php"; //Connect to Database
////////////////////////////////////////////
/////////////Verifico que haya una sesion activa
////////////////////////////////////////////
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.php");

$tipo = $_SESSION['tipouser'];

   if($tipo<>"administrador")
   header("Location: Menu.php");  



 

//Upload File

if (isset($_POST['submit'])) {

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

$fecha=date("Y-m-d");

	print("Borrando Tablas Anteriores<br>");
	
	$deleterecords1 = "TRUNCATE TABLE productosventa"; //empty the table of its current records
	$deleterecords2 = "TRUNCATE TABLE kardexmercancias"; //empty the table of its current records
	$deleterecords3 = "TRUNCATE TABLE relacioncompras"; //empty the table of its current records
	$deleterecords3 = "TRUNCATE TABLE prod_codbarras"; //empty the table of its current records

	mysql_query($deleterecords1) or die("No se pudo eliminar la lista de precios");
	mysql_query($deleterecords2) or die("No se pudo eliminar el Kardex");
	mysql_query($deleterecords3) or die("No se pudo eliminar la relacion de compras");
	print("Cargando el archivo<br>");
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {

        echo "Archivo ".$_FILES['filename']['name']." cargado satisfactoriamente <br>";

        //echo "<h2>Displaying contents:</h2>";

        //readfile($_FILES['filename']['tmp_name']);

    }

 

    //Import uploaded file to Database

    $handle = fopen($_FILES['filename']['tmp_name'], "r");

	
	$i=0;
	print("Iniciando importacion a la Base de Datos, finalizará una vez todos los elementos hayan sido cargados<br>");
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		print("Producto $i registrado<br>");
		$i++;
		//inserto la lista de precios
		
        $import="INSERT into productosventa(idProductosVenta, CodigoBarras, Referencia, Departamento, Nombre, Existencias, PrecioVenta, Especial, CostoUnitario, 
		CostoTotal, IVA, Bodega_idBodega, ImagenesProductos_idImagenesProductos, PrecioMayorista, Sub1, Sub2, Sub3, Sub4,Sub5, Sub6) values
		('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]'
		,'$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]')";
        mysql_query($import) or die("No se pudo insertar el producto $data[0]".mysql_error());
		
    }

 

    fclose($handle);

 

    print "Importacion a la lista de precios fue exitosa";

 

    //view upload form

}else {


    print "<form enctype='multipart/form-data' action='upload2.php' method='post'>";

 
    print "<input size='50' type='file' name='filename'><br />\n";

 

    print "<input type='submit' name='submit' value='Subir'></form>";

 

}

 

?>