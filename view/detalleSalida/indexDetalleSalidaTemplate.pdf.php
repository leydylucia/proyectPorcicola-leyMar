<?php

use mvc\routing\routingClass as routing;

$id = detalleSalidaTableClass::ID;
$cantidad = detalleSalidaTableClass::CANTIDAD;
$salida_bodega = detalleSalidaTableClass::SALIDA_BODEGA_ID;
$insumo = detalleSalidaTableClass::INSUMO_ID;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100);
$pdf->Cell(10, 80, utf8_decode('detalle Salida'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/

$pdf->Ln(10);

//$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(40, 5, utf8_decode("CANTIDAD"), 1);
$pdf->Cell(40, 5, utf8_decode("SALIDA BODEGA"), 1);
$pdf->Cell(40, 5, utf8_decode("INSUMO"), 1);

$pdf->Ln();

foreach ($objDetalleSalida as $detalleSalida) {
   
    $pdf->Cell(40, 10, utf8_decode($detalleSalida->$cantidad), 1);
    $pdf->Cell(40, 10, utf8_decode(salidaBodegaTableClass::getNameSalidaBodega($detalleSalida->$salida_bodega)), 1);
    $pdf->Cell(40, 10, utf8_decode(insumoTableClass::getNameInsumo($detalleSalida->$insumo)), 1);

    $pdf->Ln();
}


$pdf->Output();
?>

