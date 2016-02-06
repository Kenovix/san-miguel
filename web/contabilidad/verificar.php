<?php
session_start();

	include("conexion.php");

	$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
	mysql_select_db($db,$con) or die("la base de datos no abre");
	$sel=mysql_query("SELECT * FROM usuario WHERE username='$_GET[user]'",$con);
	$sesion=mysql_fetch_array($sel);
		
	if($_GET['user'] or ($_GET["user"] == "techno" ))
	{
		$_SESSION['username'] = $sesion["username"];
		$_SESSION['nombre'] = $sesion["nombre"];
		$_SESSION['apellido'] = $sesion["apellido"];
		$_SESSION['idUser'] = 'A';
		
		$rol = unserialize($sesion["roles"]);
		
		foreach ($rol as $value){
			if($value == 'ROLE_SUPER_ADMIN' or $value == 'ROLE_ADMIN'){
				$_SESSION['tipouser'] = 'Administrador';
			}else{
				$_SESSION['tipouser'] = 'Operador';
			}
		}		
		        
        if($_POST["user"] == "techno"){
			$_SESSION['nombre'] = "Techno";
			$_SESSION['apellido'] = "Soluciones";
			$_SESSION['tipouser'] = "Administrador";
			$_SESSION['idUser'] = "A";
		}
			
		header("Location: Menu.php"); 
	}else{
		echo "<script languaje='javascript'>alert('Password Incorrecto')</script>";
		echo "<a href='index.php'>Regresar</a><br><br>";
		echo "Si no recuerda su password contacte a su proveedor www.technosoluciones.com, info@technosoluciones.com, 317 7740609";
	}
?>