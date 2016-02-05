<?php
//session_start();
include ("conexion.php");

 $con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
 mysql_select_db($db,$con) or die("la base de datos no abre");
 if(isset($_POST['txtPassword'])){
 $password= $_POST['txtPassword'];

 $seleccione= $_POST['seleccione'];
 
    $sql = "SELECT idColaboradores FROM colaboradores WHERE Clave='$password' ";
	
 $resultado = mysql_query ($sql, $con) or die (mysql_error ());
 $registros = mysql_fetch_array($resultado);
 $fecha = date("Y-m-d");
 $hora = date("H:i:s");
 

$IdColaborador = $registros["idColaboradores"];
$EntradaSalida = $_POST['seleccione'];

if ($registros>0){

$con="INSERT into col_registrohoras ( IdColaborador, RegistroFecha, RegistroHora, EntradaSalida)  
values  ('$IdColaborador', '$fecha', '$hora', '$seleccione')";mysql_query($con) or die("Problemas al agregar los datos a col_registroHoras".
mysql_error());

print("<h2>El registro $seleccione del colaborador $IdColaborador ha sido registrado el dia $fecha a las $hora </h2><br/>");

} else{
	print( '<script> alert("Clave incorrecta") </script><br>');
}
   
 }
    
?>

<style type="text/css">
{
	font-size: 14px;
}
form.login {
    background: none repeat scroll 0 0 #F1F1F1;
    border: 1px solid #DDDDDD;
    font-family: sans-serif;
    margin: 0 auto;
    padding: 20px;
    width: 278px;
}
form.login div {
    margin-bottom: 15px;
    overflow: hidden;
}
form.login div label {
    display: block;
    float: left;
    line-height: 25px;
}
form.login div input[type="text"], form.login div input[type="password"] {
    border: 1px solid #DCDCDC;
    float: right;
    padding: 4px;
}
form.login div input[type="submit"] {
    background: none repeat scroll 0 0 #DEDEDE;
    border: 1px solid #C6C6C6;
    float: right;
    font-weight: bold;
    padding: 4px 20px;
}
.error{
    color: red;
    font-weight: bold;
    margin: 10px;
    text-align: center;
}
</style>



<form action="HoraEntradaSalida.php" method="post" class="login">
	
	<div><label>Password</label><input name="txtPassword" type="password"></div>
	<div><input name="login" type="submit" value="login"></div>
	Seleccione:
Entrar <input type="radio" name="seleccione" value="entra" required>
Salir <input type="radio" name="seleccione" value="sale" required>
	
	 <!--<a href="#contenido-oculto-1" rel="modalBox">Click para verlo</a>
<div id='contenido-oculto-1' style="display:none">Hola! Soy el contenido oculto</div>--> 
</form>
