<?php use mvc\routing\routingClass as routing;



$id = proveedorTableClass::ID;
$nombre = proveedorTableClass::NOMBRE;
$apellido = proveedorTableClass::APELLIDO;
$direccion = proveedorTableClass::DIRECCION;
$correo = proveedorTableClass::CORREO;
$telefono = proveedorTableClass::TELEFONO;
$ciudad_id = proveedorTableClass::CIUDAD_ID;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50);
$pdf->Cell(10, 50, utf8_decode('PROVEEDOR'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/

$pdf->Ln(05);

$pdf->Cell(20,5,  utf8_decode("ID"),1);
  $pdf->Cell(40,5,  utf8_decode("NOMBRE"),1);
  $pdf->Cell(40,5,  utf8_decode("DIRECCION"),1);
  $pdf->Cell(45,5,  utf8_decode("CORREO"),1);
  $pdf->Cell(40,5,  utf8_decode("TELEFONO"),1);
  $pdf->Cell(40,5,  utf8_decode("CIUDAD"),1);
  $pdf->Ln();
  
  foreach ($objProveedor as $proveedor){
  $pdf->Cell(20,10,  utf8_decode($proveedor->$id),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$nombre. ' ' . $proveedor->$apellido),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$direccion),1);
  $pdf->Cell(45,10,  utf8_decode($proveedor->$correo),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$telefono),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$ciudad_id),1);

$pdf->Ln();
  }


$pdf->Output();


?>

