<?php

use mvc\routing\routingClass as routing;

$id = detalleEntradaTableClass::ID;
$cantidad = detalleEntradaTableClass::CANTIDAD;
$unidad_medida = detalleEntradaTableClass::UNIDAD_MEDIDA_ID;
$valor = detalleEntradaTableClass::CANTIDAD;
$insumo = detalleEntradaTableClass::INSUMO_ID;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100);
$pdf->Cell(10, 80, utf8_decode(''), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 60, 8,200);/*200 ancho*/

$pdf->Ln(05);

$pdf->Cell(260,10,  utf8_decode("DETALLE ENTRADA"), 1, 0, 'C');
$pdf->Ln(10);

//$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(65, 5, utf8_decode("CANTIDAD"), 1);
$pdf->Cell(65, 5, utf8_decode("UNIDAD MEDIDA"), 1);
$pdf->Cell(65, 5, utf8_decode("VALOR"), 1);
$pdf->Cell(65, 5, utf8_decode("INSUMO"), 1);

$pdf->Ln();

foreach ($objDetalle as $detalle) {
   
    $pdf->Cell(65, 10, utf8_decode($detalle->$cantidad), 1);
    $pdf->Cell(65, 10, utf8_decode(unidadMedidaTableClass::getNameUnidadMedida($detalle->$unidad_medida)), 1);
    $pdf->Cell(65, 10, utf8_decode($detalle->$valor), 1);
    $pdf->Cell(65, 10, utf8_decode(insumoTableClass::getNameInsumo($detalle->$insumo)), 1);

    $pdf->Ln();
}


$pdf->Output();
?>

