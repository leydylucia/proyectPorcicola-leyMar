<?php use mvc\routing\routingClass as routing;

$id = loteTableClass::ID;
$desc_lote = loteTableClass::DESC_LOTE;
$ubicacion = loteTableClass::UBICACION;



$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50);
$pdf->Cell(10, 50, utf8_decode('LOTE'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/

$pdf->Ln(05);

$pdf->Cell(20,5,  utf8_decode("ID"),1);
  $pdf->Cell(40,5,  utf8_decode("DESC_LOTE"),1);
  $pdf->Cell(40,5,  utf8_decode("UBICACION"),1);
    $pdf->Ln();
  
  foreach ($objLote as $lote){
  $pdf->Cell(20,10,  utf8_decode($lote->$id),1);
  $pdf->Cell(40,10,  utf8_decode($lote->$desc_lote),1);
  $pdf->Cell(40,10,  utf8_decode($lote->$ubicacion),1);
$pdf->Ln();
  }


$pdf->Output();


?>
