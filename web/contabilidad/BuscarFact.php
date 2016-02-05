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
                                   $sql = " SELECT * FROM facturas fact INNER JOIN clientes c ON fact.Clientes_idClientes=c.idClientes WHERE fact.idFacturas = '$key_words' OR fact.Fecha LIKE '%$key_words%' OR fact.FormaPago LIKE '%$key_words%' OR fact.OSalida LIKE '%$key_words%' OR fact.OCompra LIKE '%$key_words%' OR c.RazonSocial LIKE '%$key_words%' OR c.Num_Identificacion LIKE '%$key_words%' OR fact.Cotizaciones_idCotizaciones = '$key_words' 
								   ";
                        }else{
                                   exit ("Por favor digite una sola palabra sin espacios");
                        }
                       
					   
                        //Ejecutamos el codigo Mysql
                        $r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
						
						
                        
                        if(mysql_num_rows($r)){//Si existen resultados
							
                                   while($registros=mysql_fetch_array($r)){
									   echo "<table width='600' border='1'>";
									   echo "<tr><td>Cliente</td><td>NIT</td><td>Ciudad</td><td>Contacto</td> <td>Numero de Factura</td> <td>Fecha</td><td>Forma de Pago</td> <td>Orden de Salida</td> <td>Orden de Compra</td> <td>Total</td> <td>Imprimir</td>";
									   echo "<tr>";
									   
									   print("<td>$registros[RazonSocial]</td>");
									   print("<td>$registros[Num_Identificacion]</td>");
									   print("<td>$registros[Ciudad]</td>");
									   print("<td>$registros[Contacto]</td>");
									   print("<td>$registros[idFacturas]</td>");
									   print("<td>$registros[Fecha]</td>");
									   print("<td>$registros[FormaPago]</td>");
									   print("<td>$registros[OSalida]</td>");
									   print("<td>$registros[OCompra]</td>");
									   print("<td>$registros[Total]</td>");
									  
										
										
										$tbl = <<<EOD
<td><form name="formPrintCoti" method="post" action="tcpdf/examples/imprimirfact.php" enctype="multipart/form-data" target="_blank" id="Form3">

<input type="image" id="Button5" name="ImgPrintFact" src="images/crear_pdf.png" value=$registros[0] style="width:55px;height:75px;z-index:103;">

</form></td></table>  <br>
EOD;

echo $tbl;
								   

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
