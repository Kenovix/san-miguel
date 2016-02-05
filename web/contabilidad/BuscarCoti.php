<?php
include("conexion.php");
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.html");
$key_words    = $_POST['TxtBusqueda'];

if(strlen($key_words)>0  ){//No realizamos búsqueda si la palabra es de un solo caracter
            if($key_words){
           				
                        //Contamos el numero de palabras que incluye la búsqueda.
                        $frac    = explode(' ',$key_words);
                        $no                  = count($frac);
						
                       	 $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
		 				 mysql_select_db($db,$con) or die("la base de datos no abre");
						 
                        //Si la búsqueda tiene una palabra utilizamos LIKE sino MATCH AGAINST.
                        if($no == 1){
                                   $sql = " SELECT * FROM cotizaciones cot INNER JOIN clientes c ON cot.Clientes_idClientes=c.idClientes
								   
								    WHERE c.RazonSocial LIKE '%$key_words%' OR c.Num_Identificacion LIKE '%$key_words%' OR cot.NumCotizacion = '$key_words' OR cot.NumSolicitud = '$key_words' OR c.Contacto LIKE '%$key_words%'
								   GROUP BY cot.NumCotizacion";
                        }else{
                                   exit ("Por favor digite una sola palabra sin espacios");
                        }
                       
					   
                        //Ejecutamos el codigo Mysql
                        $r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
						//$registros=mysql_fetch_array($r);
						//print_r($registros);
                        
                        if(mysql_num_rows($r)){//Si existen resultados
							
                                   while($registros=mysql_fetch_array($r)){
									   echo "<table width='600' border='1'>";
									   echo "<tr><td>Cliente</td><td>NIT</td><td>Ciudad</td><td>Contacto</td> <td>Numero de Cotizacion</td> <td>Numero de Solicitud</td> <td>Fecha</td> <td>Descripcion</td><td>Valor Unitario</td><td>Cantidad</td><td>Subtotal</td><td>Imprimir</td><td align=center>Realizar Remisión</td>";
									   echo "<tr>";
									   
									   
									   
										   
                                        print("<td>$registros[RazonSocial]</td>");
										print("<td>$registros[Num_Identificacion]</td>");
									    print("<td>$registros[Ciudad]</td>");
										print("<td>$registros[Contacto]</td>");
									    print("<td>$registros[NumCotizacion]</td>");
										print("<td>$registros[NumSolicitud]</td>");
										print("<td>$registros[Fecha]</td>");
										print("<td>$registros[Descripcion]</td>");
										print("<td>$registros[ValorUnitario]</td>");
										print("<td>$registros[Cantidad]</td>");
										print("<td>$registros[Subtotal]</td>");
										
									   
									   
										
										
										$tbl = <<<EOD
<td><form name="formPrintCoti" method="post" action="tcpdf/examples/imprimircoti.php" enctype="multipart/form-data" target="_blank" id="Form3">

<input type="hidden" name="ImgPrintCoti" value=$registros[NumCotizacion] >
<input type="image" id="Button5" name="ImgPri" src="images/crear_pdf.png" value=$registros[NumCotizacion] style="width:55px;height:75px;z-index:103;">

</form></td>

<td align="center"><form name="formPrintRemi" method="post" action="tcpdf/examples/imprimirremi.php" enctype="multipart/form-data" target="_blank" id="FormRemi">

Observaciones de la remisión<textarea id="TxtObservacionesRemi" name="TxtObservacionesRemi"></textarea>
<input type="hidden"  name="ImgPrintRemi" value=$registros[NumCotizacion] ">
<input type="image"  name="Img" src="images/crear_pdf.png" value=$registros[NumCotizacion] style="width:55px;height:75px;z-index:103;">

</form></td>
EOD;

echo $tbl;


									
								   

echo "<tr>";
print("<br></table> ");

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