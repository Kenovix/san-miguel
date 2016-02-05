<?php


include "../conexion.php"; //Connect to Database
////////////////////////////////////////////
/////////////Verifico que haya una sesion activa
////////////////////////////////////////////
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.php");
   
   
if(($handle = @fopen($COMPrinter, "w")) === FALSE){
        die('ERROR:\nNo se puedo Imprimir, Verifique la conexion de la IMPRESORA');
    }

$NumDev=$_POST["TxtIdDev"];   

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


fwrite($handle,chr(27). chr(64));//REINICIO
//fwrite($handle, chr(27). chr(112). chr(48));//ABRIR EL CAJON
fwrite($handle, chr(27). chr(100). chr(0));// SALTO DE CARRO VACIO
fwrite($handle, chr(27). chr(33). chr(8));// NEGRITA
fwrite($handle, chr(27). chr(97). chr(1));// CENTRADO
fwrite($handle,"=================================");
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
fwrite($handle,"=================================");
fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
fwrite($handle, chr(27). chr(97). chr(0));// IZQUIERDA

$DatosVenta=mysql_query("SELECT * FROM ventas_devoluciones WHERE idDevoluciones='$NumDev'", $con) or die('no se pudo conectar a devoluciones: ' . mysql_error());

$DatosVenta=mysql_fetch_array($DatosVenta);	
$impuesto=$DatosVenta["IVA"];

$Total=$DatosVenta["Total"];
$Subtotal=$DatosVenta["Subtotal"];
$Cantidad=$DatosVenta["Cantidad"];

$Descripcion=$DatosVenta["Descripcion"];
$Referencia=$DatosVenta["Referencia"];
$Fecha=$DatosVenta["FechaDevolucion"];
$idUsuarios=$DatosVenta["Usuarios_idUsuarios"];

				
		fwrite($handle,"Cantidad: ".$Cantidad."..");
		fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
		fwrite($handle,"Producto: $Referencia $Descripcion");
		fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
		fwrite($handle,"SubTotal: ".number_format($Subtotal));
		fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
		fwrite($handle,"Impuestos: ".number_format($impuesto));
		fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA
		fwrite($handle,"Total: ".number_format($Total));
		fwrite($handle, chr(27). chr(100). chr(1));// SALTO DE LINEA



fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

$DatosUsuario=mysql_query("SELECT * FROM usuarios WHERE idUsuarios='$idUsuarios'", $con) or die('no se pudo conectar a usuarios: ' . mysql_error());
$DatosUsuario=mysql_fetch_array($DatosUsuario);	

fwrite($handle,$Fecha);
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"*..COMPROBANTE DE DEVOLUCION No....$NumDev");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"*..VERIFICACION No....$DatosVenta[Facturas_idFacturas]");
fwrite($handle, chr(27). chr(100). chr(1));//salto de linea
fwrite($handle,"***Usuario:.$DatosUsuario[Nombre] $DatosUsuario[Apellido]");

fwrite($handle, chr(27). chr(100). chr(1));//salto de linea

//fwrite($handle, chr(27). chr(32). chr(0));//ESTACIO ENTRE LETRAS
//fwrite($handle, chr(27). chr(100). chr(0));
//fwrite($handle, chr(29). chr(107). chr(4)); //CODIGO BARRAS
fwrite($handle, chr(27). chr(100). chr(1));
fwrite($handle, chr(27). chr(100). chr(1));
fwrite($handle,"***Comprobante impreso por SoftConTech***");
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
$salida = shell_exec("lpr $COMPrinter");
echo "El documento se ha impreso";


?>