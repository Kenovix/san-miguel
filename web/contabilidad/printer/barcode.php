<?php


include "../conexion.php"; //Connect to Database
////////////////////////////////////////////
/////////////Verifico que haya una sesion activa
////////////////////////////////////////////
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.php");
   
   
if(($handle = @fopen("$COMBarcode", "w")) === FALSE){
        die('ERROR:\nNo se puedo Imprimir, Verifique la conexion de la IMPRESORA');
   }


$Codigo=$_POST["TxtBusqueda"];   
$Numpages=$_POST["TxtNumPages"];
$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

$fecha=date("y-m");

$sql="SELECT * FROM empresapro WHERE idEmpresaPro='1'";
$DatosEmpresa=mysql_query($sql,$con) or die('no se pudo obtener los datos de la empresa: ' . mysql_error());

$DatosEmpresa=mysql_fetch_array($DatosEmpresa);
$RazonSocial=substr($DatosEmpresa["RazonSocial"],0,24);
//$RazonSocial="Punto Moda";
$sql="SELECT pr.Nombre as Nombre, pr.PrecioVenta as PrecioVenta, pr.CostoUnitario as Costo, pr.Referencia as Referencia FROM productosventa pr 
INNER JOIN prod_codbarras cb ON pr.idProductosVenta=cb.ProductosVenta_idProductosVenta 
WHERE cb.CodigoBarras='$Codigo' LIMIT 1";
$DatosProducto=mysql_query($sql,$con) or die('no se pudo obtener los datos del producto con el codigo de barras $Codigo: ' . mysql_error());



if(mysql_num_rows($DatosProducto)){
	

	
$DatosProducto=mysql_fetch_array($DatosProducto);
$Descripcion=substr($DatosProducto["Nombre"],0,22);
$PrecioVenta= number_format($DatosProducto["PrecioVenta"]);
$Referencia= $DatosProducto["Referencia"];
$Costo2= substr($DatosProducto["Costo"], 1, -1);
$Costo1= substr($DatosProducto["Costo"], 0, 1);
$Costo=$Costo1."/".$Costo2;
$enter="\r\n";

fwrite($handle,"SIZE 4,1.1".$enter);
fwrite($handle,"GAP 4 mm,0".$enter);
fwrite($handle,"DIRECTION 1".$enter);
fwrite($handle,"CLS".$enter);
fwrite($handle,'TEXT 10,20,"1",0,1,1,"'.$RazonSocial.'"'.$enter);
fwrite($handle,'TEXT 10,40,"1",0,1,1,"'.$Referencia.' '.$fecha.' '.$Costo.'"'.$enter);
fwrite($handle,'TEXT 10,60,"1",0,1,1,"'.$Descripcion.'"'.$enter);
fwrite($handle,'BARCODE 10,80,"128",50,1,0,2,2,"'.$Codigo.'"'.$enter);
fwrite($handle,'TEXT 10,160,"3",0,1,1,"$ '.$PrecioVenta.'"'.$enter);

fwrite($handle,'TEXT 285,20,"1",0,1,1,"'.$RazonSocial.'"'.$enter);
fwrite($handle,'TEXT 285,40,"1",0,1,1,"'.$Referencia.' '.$fecha.' '.$Costo.'"'.$enter);
fwrite($handle,'TEXT 285,60,"1",0,1,1,"'.$Descripcion.'"'.$enter);
fwrite($handle,'BARCODE 285,80,"128",50,1,0,2,2,"'.$Codigo.'"'.$enter);
fwrite($handle,'TEXT 285,160,"3",0,1,1,"$ '.$PrecioVenta.'"'.$enter);

fwrite($handle,'TEXT 555,20,"1",0,1,1,"'.$RazonSocial.'"'.$enter);
fwrite($handle,'TEXT 555,40,"1",0,1,1,"'.$Referencia.' '.$fecha.' '.$Costo.'"'.$enter);
fwrite($handle,'TEXT 555,60,"1",0,1,1,"'.$Descripcion.'"'.$enter);
fwrite($handle,'BARCODE 555,80,"128",50,1,0,2,2,"'.$Codigo.'"'.$enter);
fwrite($handle,'TEXT 555,160,"3",0,1,1,"$ '.$PrecioVenta.'"'.$enter);
fwrite($handle,"PRINT $Numpages".$enter);



$salida = shell_exec('lpr $COMBarcode');
echo "El documento se ha impreso";
}else{
	
	echo "No hay productos con este codigo";
}

?>