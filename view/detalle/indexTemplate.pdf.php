<?php

use mvc\routing\routingClass as routing;

$id = detalleEntradaTableClass::ID;
$cantidad = detalleEntradaTableClass::CANTIDAD;
$valor = detalleEntradaTableClass::VALOR;
$entrada_bodega_id = detalleEntradaTableClass::ENTRADA_BODEGA_ID;
$insumo_id = detalleEntradaTableClass::INSUMO_ID;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50);
$pdf->Cell(10, 50, utf8_decode('Detalle Bodega'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8, 200); /* 200 ancho */

$pdf->Ln(05);

$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(40, 5, utf8_decode("CANTIDAD"), 1);
$pdf->Cell(40, 5, utf8_decode("VALOR"), 1);
$pdf->Cell(40, 5, utf8_decode("ENTRADA BODEGA"), 1);
$pdf->Cell(40, 5, utf8_decode("INSUMO"), 1);
$pdf->Ln();

foreach ($objDetalle as $detalle) {
  $pdf->Cell(20, 10, utf8_decode($detalle->$id), 1);
  $pdf->Cell(40, 10, utf8_decode($detalle->$cantidad), 1);
  $pdf->Cell(40, 10, utf8_decode($detalle->$valor), 1);
  $pdf->Cell(40, 10, utf8_decode($detalle->$entrada_bodega_id), 1);
  $pdf->Cell(40, 10, utf8_decode($detalle->$insumo_id), 1);
  $pdf->Ln();
}


$pdf->Output();
?>