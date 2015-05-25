<?php

use mvc\routing\routingClass as routing;

$id = hojaVidaTableClass::ID;
$genero = hojaVidaTableClass::GENERO;
$fecha_nacimiento = hojaVidaTableClass::FECHA_NACIMIENTO;
$estado_id = hojaVidaTableClass::ESTADO_ID;
$lote_id = hojaVidaTableClass::LOTE_ID;
$raza_id = hojaVidaTableClass::RAZA_ID;
$id_madre = hojaVidaTableClass::ID_MADRE;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50);
$pdf->Cell(10, 50, utf8_decode('HOJA DE VIDA (ANIMAL)'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8, 200); /* 200 ancho */

$pdf->Ln(05);

$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(40, 5, utf8_decode("GENERO"), 1);
$pdf->Cell(40, 5, utf8_decode("FECHA_NAC"), 1);
$pdf->Cell(40, 5, utf8_decode("ESTADO"), 1);
$pdf->Cell(40, 5, utf8_decode("LOTE"), 1);
$pdf->Cell(40, 5, utf8_decode("RAZA"), 1);
$pdf->Cell(40, 5, utf8_decode("MADRE"), 1);
$pdf->Ln();

foreach ($objHojaVida as $hojaVida) {
  $pdf->Cell(20, 10, utf8_decode($hojaVida->$id), 1);
  $pdf->Cell(40, 10, utf8_decode($hojaVida->$genero), 1);
  $pdf->Cell(40, 10, utf8_decode($hojaVida->$fecha_nacimiento), 1);
  $pdf->Cell(40, 10, utf8_decode($hojaVida->$estado_id), 1);
  $pdf->Cell(40, 10, utf8_decode($hojaVida->$lote_id), 1);
  $pdf->Cell(40, 10, utf8_decode($hojaVida->$raza_id), 1);
  $pdf->Cell(40, 10, utf8_decode($hojaVida->$id_madre), 1);

  $pdf->Ln();
}


$pdf->Output();
?>

