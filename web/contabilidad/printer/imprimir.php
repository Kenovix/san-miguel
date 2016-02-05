<?php


include "../conexion.php"; //Connect to Database
////////////////////////////////////////////
/////////////Verifico que haya una sesion activa
////////////////////////////////////////////
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.php");
   
   
if(($handle = @fopen("$COMPrinter", "w")) === FALSE){
        die('ERROR:\nNo se puedo Imprimir, Verifique la conexion de la IMPRESORA');
    }

$NumVenta=$_REQUEST["print"];   

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

$fecha=date("Y-m-d");

$sql="SELECT * FROM empresapro WHERE idEmpresaPro='1'";
$DatosEmpresa=mysql_query($sql,$con) or die('no se pudo obtener los datos de la empresa: ' . mysql_error());

$DatosEmpresa=mysql_fetch_array($DatosEmpresa);
$RazonSocial=$DatosEmpresa["RazonSocial"];
$NIT=$DatosEmpresa["NIT"];
$Direccion=$DatosEmpresa["Direccion"];
$Ciudad=$DatosEmpresa["Ciudad"];
$ResolucionDian=$DatosEmpresa["ResolucionDian"];
$Telefono=$DatosEmpresa["Telefono"];

$DatosVenta=mysql_query("SELECT * FROM facturas WHERE idFacturas='$NumVenta'", $con) or die('no se pudo conectar a facturas: ' . mysql_error());

$DatosVenta=mysql_fetch_array($DatosVenta);	
$impuesto=$DatosVenta["IVA"];
$Descuento=$DatosVenta["Descuentos"];
$TotalVenta=$DatosVenta["Total"];
$Subtotal=$DatosVenta["Subtotal"];
$TotalFinal=$DatosVenta["Total"];
$idCoti=$DatosVenta["Cotizaciones_idCotizaciones"];
$frac = explode(';',$idCoti);
$no = count($frac)-1;
$NumFact=$DatosVenta["OSalida"];
$Fecha=$DatosVenta["Fecha"];
$idUsuarios=$DatosVenta["Usuarios_idUsuarios"];


$DatosUsuario=mysql_query("SELECT * FROM usuarios WHERE idUsuarios='$idUsuarios'", $con) or die('no se pudo conectar a usuarios: ' . mysql_error());
$DatosUsuario=mysql_fetch_array($DatosUsuario);	

$DatosFormaPago=mysql_query("SELECT * FROM facturas_formapago WHERE Facturas_idFactuas='$NumVenta'", $con) or die('no se pudo conectar a facturas_formapago: ' . mysql_error());
$DatosFormaPago=mysql_fetch_array($DatosFormaPago);	


fwrite($handle,chr(27). chr(64));//REINICIO
fwrite($handle, chr(27). chr(112). chr(48));//ABRIR EL CAJON
fwrite($handle, chr(27). chr(100). chr(0));// SALTO DE CARRO VACIO
fwrite($handle, chr(27). chr(33). chr(8));// NEGRITA
fwrite($handle, chr(27). chr(97). chr(1));// CENTRADO
fwrite($handle,"*************************************");
fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
fwrite($handle,$RazonSocial); // ESCRIBO RAZON SOCIAL
fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
fwrite($handle,$NIT);
fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
fwrite($handle,$ResolucionDian);
fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
fwrite($handle,$Direccion);
fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
fwrite($handle,$Ciudad);
fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
fwrite($handle,$Telefono);
fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA

fwrite($handle,"Cajero:.$DatosUsuario[Nombre] $DatosUsuario[Apellido]");
fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
fwrite($handle,"*************************************");

/////////////////////////////FECHA Y NUM FACTURA

fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
fwrite($handle, chr(27). chr(97). chr(0));// IZQUIERDA
fwrite($handle,"FECHA: $Fecha");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"FACTURA DE VENTA No $NumFact");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"_____________________________________");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

/////////////////////////////ITEMS VENDIDOS

fwrite($handle, chr(27). chr(97). chr(0));// IZQUIERDA

$sql = "SELECT * FROM cotizaciones WHERE ";
	for ($i=0;$i<=$no;$i++){
		
		if($i==$no){
			$sql = $sql." NumCotizacion = '$frac[$i]'";
		}else{
			$sql = $sql." NumCotizacion = '$frac[$i]' OR";
		}
		
	}

$registros=mysql_query($sql,$con) or die('no se pudo obtener los datos de la cotizacion $idCoti: ' . mysql_error());

if(mysql_num_rows($registros)){
								
	while($DatosVenta=mysql_fetch_array($registros)){
		
		//$Descuentos=$DatosVenta["Descuentos"];
		//$Impuestos=$DatosVenta["Impuestos"];
		$SubTotalITem=$DatosVenta["Subtotal"];
		//$SubTotalITem=$TotalVenta-$Impuestos;
		
		
		fwrite($handle,str_pad($DatosVenta["Cantidad"],4," ",STR_PAD_RIGHT));
		
		fwrite($handle,str_pad(substr($DatosVenta["Descripcion"],0,20),20," ",STR_PAD_BOTH)."   ");
		
		fwrite($handle,str_pad("$".number_format($SubTotalITem),10," ",STR_PAD_LEFT));
		
		fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
}

}


/////////////////////////////TOTALES

fwrite($handle,"_____________________________________");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(97). chr(0));// IZQUIERDA
$reg=mysql_query("SELECT SUM(Total) as Excluidos FROM cotizaciones WHERE NumCotizacion='$idCoti' AND IVA=0;",$con) or die('no se pudo obtener los datos de la cotizacion $idCoti: ' . mysql_error());
$Excluidos=mysql_fetch_array($reg);
$Excluidos=$Excluidos["Excluidos"];

fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"BASE IVA         ".str_pad("$".number_format($Subtotal-$Excluidos),20," ",STR_PAD_LEFT));
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"IVA              ".str_pad("$".number_format($impuesto),20," ",STR_PAD_LEFT));

fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"SUBTOTAL         ".str_pad("$".number_format($TotalFinal-$Excluidos),20," ",STR_PAD_LEFT));


fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"EXCLUIDOS        ".str_pad("$".number_format($Excluidos),20," ",STR_PAD_LEFT));

fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"TOTAL A PAGAR    ".str_pad("$".number_format($TotalFinal),20," ",STR_PAD_LEFT));
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

fwrite($handle,"_____________________________________");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

/////////////////////////////Forma de PAGO

fwrite($handle,"_____________________________________");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(97). chr(0));// IZQUIERDA

fwrite($handle,"Formas de Pago");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"       $DatosFormaPago[FormaPago] ----> $".str_pad(number_format($DatosFormaPago["Paga"]),20," ",STR_PAD_LEFT));

fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"       CAMBIO                     ----> $".str_pad(number_format($DatosFormaPago["Devuelve"]),20," ",STR_PAD_LEFT));

fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

fwrite($handle,"_____________________________________");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea


fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"Codigo de Verificacion: $NumVenta");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(97). chr(1));// CENTRO
fwrite($handle,"***GRACIAS POR SU COMPRA***");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
//fwrite($handle, chr(27). chr(32). chr(0));//ESTACIO ENTRE LETRAS
//fwrite($handle, chr(27). chr(100). chr(0));
//fwrite($handle, chr(29). chr(107). chr(4)); //CODIGO BARRAS
fwrite($handle, chr(27). chr(100). chr(1));
fwrite($handle, chr(27). chr(100). chr(1));
fwrite($handle,"***Factura impresa por SoftConTech***");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"Software diseniado por Techno Soluciones, 3177740609, www.technosoluciones.com");
//fwrite($handle,"=================================");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(100). chr(1));
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(100). chr(1));
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle, chr(27). chr(100). chr(1));

fwrite($handle, chr(29). chr(86). chr(49));//CORTA PAPEL
fclose($handle); // cierra el fichero PRN
$salida = shell_exec('lpr $COMPrinter');
echo "El documento se ha impreso";

if(!empty($_REQUEST["ruta"])){
	
	header("location:$_REQUEST[ruta]");
}

?>