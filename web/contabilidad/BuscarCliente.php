<?php
include("conexion.php");
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.html");
$key_words    = $_POST['TxtBusqueda'];
 
if(strlen($key_words)>2){//No realizamos búsqueda si la palabra es de un solo caracter
            if($key_words){
           				
                        //Contamos el numero de palabras que incluye la búsqueda.
                        $frac    = explode(' ',$key_words);
                        $no                  = count($frac);
						
                       	 $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
		 				 mysql_select_db($db,$con) or die("la base de datos no abre");
						 
                        //Si la búsqueda tiene una palabra utilizamos LIKE sino MATCH AGAINST.
                        if($no == 1){
                                   $sql = " SELECT * FROM clientes WHERE RazonSocial LIKE '%$key_words%' OR Num_Identificacion LIKE '%$key_words%'
								   			OR Direccion LIKE '%$key_words%' OR Telefono LIKE '%$key_words%' 
											OR Email LIKE '%$key_words%' OR Contacto LIKE '%$key_words%'
								   ";
                        }else{
                                   exit ("Por favor digite una sola palabra sin espacios");
                        }
                       
					   echo "<table width='600' border='1'>
	<tr><th ALIGN= 'center' colspan='10'>DATOS DEL CLIENTE</th></tr>
		  <tr><th>ID</th><th>Razon Social</th><th>NIT</th><th>Direccion</th><th>Telefono</th><th>Ciudad</th><th>Contacto</th>
		  <th>Telefono Contacto</th><th>Email</th><th> Cotizar </th>
";

                        //Ejecutamos el codigo Mysql
                        $r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
                       
                        if(mysql_num_rows($r)){//Si existen resultados
                                   while($DatosCoti= mysql_fetch_array($r)){
                                               print("<tr><td>$DatosCoti[idClientes]</td> <td>$DatosCoti[RazonSocial]</td> <td>$DatosCoti[Num_Identificacion]</td> 
											   <td>$DatosCoti[Direccion]</td> <td>$DatosCoti[Telefono]</td> <td>$DatosCoti[Ciudad]</td> <td>$DatosCoti[Contacto]</td>
											   <td>$DatosCoti[TelContacto]</td> <td>$DatosCoti[Email] </td><td><form name=formCargarCoti id=$DatosCoti[idClientes] method='POST' action='cargarcoti.php' target='InlineFrame1'>
		  <input type='submit'  name='btnCargaCoti' value='Cotizar al cliente $DatosCoti[idClientes]'
			style='width:200px;height:25px; color:blue;'></form></td></tr>

");

                                   }
								   echo "</table>";
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
