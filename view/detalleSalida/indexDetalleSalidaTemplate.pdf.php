<?php

use mvc\routing\routingClass as routing;

$id = detalleSalidaTableClass::ID;
$cantidad = detalleSalidaTableClass::CANTIDAD;
$unidad_medida = detalleSalidaTableClass::UNIDAD_MEDIDA_ID;
$insumo = detalleSalidaTableClass::INSUMO_ID;
$lote = detalleSalidaTableClass::LOTE_ID;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100);
$pdf->Cell(10, 65, utf8_decode(''), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('imagen_reporte.jpg'), 0, 0,265);/*200 ancho*/

$pdf->Ln(05);

$pdf->Cell(260,10,  utf8_decode("DETALLE SALIDA"), 1, 0, 'C');
$pdf->Ln(10);

//$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(65, 5, utf8_decode("CANTIDAD"), 1);
$pdf->Cell(65, 5, utf8_decode("UNIDAD MEDIDA"), 1);
$pdf->Cell(65, 5, utf8_decode("INSUMO"), 1);
$pdf->Cell(65, 5, utf8_decode("LOTE"), 1);

$pdf->Ln();

foreach ($objDetalleSalida as $detalleSalida) {
   
    $pdf->Cell(65, 10, utf8_decode($detalleSalida->$cantidad), 1);
    $pdf->Cell(65, 10, utf8_decode(unidadMedidaTableClass::getNameUnidadMedida($detalleSalida->$unidad_medida)), 1);
    $pdf->Cell(65, 10, utf8_decode(insumoTableClass::getNameInsumo($detalleSalida->$insumo)), 1);
    $pdf->Cell(65, 10, utf8_decode(loteTableClass::getNameLote($detalleSalida->$lote)), 1);

    $pdf->Ln();
}


$pdf->Output();
?>

