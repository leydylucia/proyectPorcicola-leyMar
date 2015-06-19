<?php

use mvc\routing\routingClass as routing;

$id = entradaTableClass::ID;
$empleado_id = entradaTableClass::EMPLEADO_ID;
$proveedor_id = entradaTableClass::PROVEEDOR_ID;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50);
$pdf->Cell(10, 50, utf8_decode('ENTRADA BODEGA'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8, 200); /* 200 ancho */
$pdf->Ln(05);

$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(40, 5, utf8_decode("EMPLEADO"), 1);
$pdf->Cell(40, 5, utf8_decode("PROVEEDOR"), 1);
$pdf->Ln();

foreach ($objEntrada as $entrada) {
  $pdf->Cell(20, 10, utf8_decode($entrada->$id), 1);
  $pdf->Cell(40, 10, utf8_decode($entrada->$empleado_id), 1);
  $pdf->Cell(40, 10, utf8_decode($entrada->$proveedor_id), 1);
  $pdf->Ln();
}


$pdf->Output();
?>

