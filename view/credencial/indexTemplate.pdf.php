<?php use mvc\routing\routingClass as routing;



$id = credencialTableClass::ID;
$nombre = credencialTableClass::NOMBRE;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50);
$pdf->Cell(10, 50, utf8_decode('CREDENCIAL'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/

$pdf->Ln(05);

$pdf->Cell(20,5,  utf8_decode("ID"),1);
  $pdf->Cell(40,5,  utf8_decode("NOMBRE"),1);
 
    $pdf->Ln();
  
  foreach ($objCredencial as $credencial){
  $pdf->Cell(20,10,  utf8_decode($credencial->$id),1);
  $pdf->Cell(40,10,  utf8_decode($credencial->$nombre),1);
  
$pdf->Ln();
  }


$pdf->Output();


?>

