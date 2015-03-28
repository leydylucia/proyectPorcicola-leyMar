<?php use mvc\routing\routingClass as routing;



$id = deptoTableClass::ID;
$nom_depto = deptoTableClass::NOM_DEPTO;
$created_at = deptoTableClass::CREATED_AT;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(80);
$pdf->Cell(10, 50, utf8_decode(' DEPARTAMENTO'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/

$pdf->Ln(50);

$pdf->Cell(20,5,  utf8_decode("ID"),1);
  $pdf->Cell(40,5,  utf8_decode("NOMBRE"),1);
  $pdf->Cell(60,5,  utf8_decode("FECHA CREACION"),1);
  $pdf->Ln();
  
  foreach ($objDepto as $depto){
  $pdf->Cell(20,10,  utf8_decode($depto->$id),1);
  $pdf->Cell(40,10,  utf8_decode($depto->$nom_depto),1);
  $pdf->Cell(60,10,  utf8_decode($depto->$created_at),1);
 $pdf->Ln();
  }

$pdf->Output();


?>

