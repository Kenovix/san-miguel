<?php
include("conexion.php");
session_start();
if(!isset($_SESSION["username"]))
   header("Location: index.html");


$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

if(isset($_POST["ImgEdit"])){
$Observaciones=	$_POST["TxtObservaciones"];
$idCartera=$_POST["ImgEdit"];

$sql = " UPDATE cartera SET
		  		Observaciones = '$Observaciones' 
		WHERE idCartera='$idCartera' ";
$r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());

}
						
                       	 
						 if(isset($_POST["BtnCargarCart"])){
							
							if($_POST["ComboCartera"]=="V")
								$sql = " SELECT * FROM cartera WHERE DiasCartera > 0"; 
							else
								$sql = " SELECT * FROM cartera"; 
						 }else{
                        
                        	$sql = " SELECT * FROM cartera";
						 
						 
						 }
                        //Ejecutamos el codigo Mysql
                        $r = mysql_query($sql,$con) or die("La consulta a nuestra base de datos es erronea.".mysql_error());
						
						echo "<table width='600' border='1'>";
									   echo "<tr><td>Cliente</td><td>Telefono</td><td>Contacto</td><td>Telefono Contacto</td> <td>Saldo</td> <td>Fecha de vencimiento</td><td>Dias de vencimiento</td> <td ><_____________Observaciones______________></td> <td>Numero de Factura Vencida</td> ";
									   echo "<tr>";
                        
                        if(mysql_num_rows($r)){//Si existen resultados
							
                                   while($registros=mysql_fetch_array($r)){
									   
									    echo "<tr>";
									   
									   for ($i=1;$i <= 9; $i++) {
										 
										if ($i==8){
										echo "<td align=center><form name=formPrintCoti method=post action=ActCartera.php enctype=multipart/form-data target=FrameCartera id=Form$registros[0]>
<textarea name=TxtObservaciones id=TextArea1 style=width:200px;height:63px;z-index:15; rows=2 cols=109> $registros[$i] </textarea>
<input type=image id=Button$registros[0] name=ImgEdit src=images/editar2.png value=$registros[0] style=width:55px;height:75px;z-index:103;>
 </form> </td> "; 	
											}    
                                        else {
										
										print("<td>$registros[$i]</td>");
										}
									   } 
									   
										 
										$tbl = <<<EOD

EOD;

echo $tbl;
echo "</tr>";								   
                                   }
								   
 echo "</table>  <br>";
                      

}else{
	
	echo " No se encontró cartera vencida";	
									   
}
?>