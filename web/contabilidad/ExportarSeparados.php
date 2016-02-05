<?php

session_start();
   if(!isset($_SESSION["username"])){
   header("Location: index.html");
}

include("conexion.php");

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
 mysql_select_db($db,$con) or die("la base de datos no abre");
 
 $sql = "SELECT cli.RazonSocial as RazonSocial, cli.Num_Identificacion as NIT, c.Descripcion as Descripcion, c.Referencia as Referencia, 
 c.Cantidad as Cantidad, c.Subtotal as Subtotal, c.IVA as IVA, c.Total as Total, 
 c.SubtotalCosto as SubtotalCosto, fac.Fecha as Fecha, fac.SaldoFact as Saldo, fac.idFacturas as Factura, cli.Telefono as Telefono
 FROM ventas_separados vs INNER JOIN Facturas fac ON vs.Facturas_idFacturas =fac.idFacturas 
 INNER JOIN Cotizaciones c ON fac.Cotizaciones_idCotizaciones=c.NumCotizacion 
 INNER JOIN clientes cli ON cli.idClientes =fac.Clientes_idClientes 
 WHERE vs.Retirado='NO' ORDER BY fac.idFacturas DESC";          
 $resultado = mysql_query ($sql, $con) or die (mysql_error());
 $registros = mysql_num_rows ($resultado);
 
 
   
   
   if ($registros > 0) {
   require_once 'Classes/PHPExcel.php';
   $objPHPExcel = new PHPExcel();
    
   //Informacion del excel
   $objPHPExcel->
    getProperties()
        ->setCreator("www.technosoluciones.com")
        ->setLastModifiedBy("www.technosoluciones.com")
        ->setTitle("Exportar tabla separados desde base de datos")
        ->setSubject("ventas_separados")
        ->setDescription("Documento generado con PHPExcel")
        ->setKeywords("techno soluciones")
        ->setCategory("ventas_separados");    
 
 $i = 1;
 
 $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i,'Producto');              
	  $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$i, 'Referencia'  );	
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C'.$i, 'Cantidad');	
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('D'.$i, 'Subtotal' );	
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E'.$i, 'IVA');	
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F'.$i, 'Total' );
			
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('G'.$i, 'Costo');	
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('H'.$i, 'Fecha');	

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('I'.$i, 'Factura');	

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('J'.$i, 'Saldo');	

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('K'.$i, 'Cliente');	

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('L'.$i, 'NIT');

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('M'.$i, 'TELEFONO');			
 
   $i = 2;    
   while ($registro = mysql_fetch_object ($resultado)) {
        		
      $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $registro->Descripcion);
	  $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$i, $registro->Referencia);	
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C'.$i, $registro->Cantidad);	
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('D'.$i, $registro->Subtotal);	
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E'.$i, $registro->IVA);	
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F'.$i, $registro->Total);
			
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('G'.$i, $registro->SubtotalCosto);	
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('H'.$i, $registro->Fecha);	
			
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('I'.$i, $registro->Factura);	
			
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('J'.$i, $registro->Saldo);	
			
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('K'.$i, $registro->RazonSocial);	
			
			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('L'.$i, $registro->NIT);	

			$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('M'.$i, $registro->Telefono);	

			
      $i++;
       
   }
}
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Separados.xls"');
header('Cache-Control: max-age=0');
 
$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('php://output');
exit;
mysql_close ();
   
   
?>