<?php use mvc\routing\routingClass as routing;

$id = controlTableClass::ID;
$peso_cerdo = controlTableClass::PESO_CERDO;
$empleado_id = controlTableClass::EMPLEADO_ID;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(80);
$pdf->Cell(10, 50, utf8_decode('CONTROL PESO'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8, 200); /* 200 ancho */

$pdf->Ln(50);

$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(40, 5, utf8_decode("PESO_CERDO"), 1);
$pdf->Cell(40, 5, utf8_decode("EMPLEADO"), 1);
$pdf->Ln();

foreach ($objControl as $control) {
  $pdf->Cell(20, 10, utf8_decode($controlr->$id), 1);
  $pdf->Cell(40, 10, utf8_decode($control->$peso_cerdo), 1);
  $pdf->Cell(40, 10, utf8_decode($control->$empleado_id), 1);
  $pdf->Ln();
}

$pdf->Output();
?>

