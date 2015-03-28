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
$pdf->Cell(80);
$pdf->Cell(20, 10, utf8_decode('PROVEEDOR'), 0, 1, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('pig.jpg'),50,8,30);

$pdf->Ln(50);

$pdf->Cell(20,5,  utf8_decode("ID"),1);
  $pdf->Cell(40,5,  utf8_decode("NOMBRE"),1);
  $pdf->Cell(40,5,  utf8_decode("APELLIDO"),1);
  $pdf->Cell(40,5,  utf8_decode("DIRECCION"),1);
  $pdf->Cell(40,5,  utf8_decode("CORREO"),1);
  $pdf->Cell(40,5,  utf8_decode("TELEFONO"),1);
  $pdf->Cell(40,5,  utf8_decode("CIUDAD"),1);
  $pdf->Ln();
  
  foreach ($objProveedor as $proveedor){
  $pdf->Cell(20,10,  utf8_decode($proveedor->$id),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$nombre),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$apellido),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$direccion),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$correo),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$telefono),1);
  $pdf->Cell(40,10,  utf8_decode($proveedor->$ciudad_id),1);

$pdf->Ln();
  }


$pdf->Output();


?>

