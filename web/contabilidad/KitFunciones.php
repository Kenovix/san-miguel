<?php
include("conexion.php");
class ProductosGestion {

//echo "$tabla";
public function __construct($host,$db,$user,$pw,$tabla)
		{
			$this->host=$host;
			$this->database=$db;
			$this->user=$user;
			$this->pass=$pw;
			$this->tabla=$tabla;
			
		}
		
		
public function conectar()
  {
	//echo('entrando');
	 //echo "dibujando $tabla<br>";
	$conexion1 = new conexion($this->host,$this->database,$this->user,$this->pass);
	$this->con=$conexion1->conectar();
	//echo('conectado');
}  


public function AlimentaKardex($FechaKardex,$Movimiento, $Detalle, $Cantidad, $ValorUnitario, $ValorTotal, $idProducto){
	
	
	$sql = "INSERT INTO kardexmercancias (Fecha, Movimiento, Detalle, idDocumento, Cantidad, ValorUnitario, ValorTotal,  ProductosVenta_idProductosVenta)
	VALUES ('$FechaKardex','$Movimiento', '$Detalle','NO','$Cantidad','$ValorUnitario','$ValorTotal','$idProducto') ";
 
	mysql_query($sql,$this->con) or die("No se pudo agregar el registro del kardex del producto $idProducto .".mysql_error());
	
	
}


function ActualizaProducto($Ref ,$Existencias, $CostU, $CostTo ){
	
	 
	$sql = "UPDATE productosventa SET Existencias='$Existencias', CostoUnitario='$CostU', CostoTotal='$CostTo' WHERE Referencia='$Ref'";
 
		mysql_query($sql,$this->con) or die("Error al actualizar los datos del producto $Ref.".mysql_error());
	
	
}


}
?>