<?php use mvc\routing\routingClass as routing;



$id = credencialTableClass::ID;
$nombre = credencialTableClass::NOMBRE;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50);
$pdf->Cell(10, 50, utf8_decode(''), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('imagen_reporte.jpg'), 0, 0,280);/*200 ancho*/

$pdf->Ln(05);

$pdf->Cell(250,10,  utf8_decode("CREDENCIAL"),1, 0, 'C');
$pdf->Ln(10);

  $pdf->Cell(250,5,  utf8_decode("NOMBRE"),1, 0, 'C');
 
    $pdf->Ln();
  
  foreach ($objCredencial as $credencial){
  
  $pdf->Cell(250,10,  utf8_decode($credencial->$nombre),1, 0, 'C');
  
$pdf->Ln();
  }


$pdf->Output();


?>
