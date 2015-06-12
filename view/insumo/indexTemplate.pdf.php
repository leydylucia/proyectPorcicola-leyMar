<?php

use mvc\routing\routingClass as routing;

$id = insumoTableClass::ID;
$descInsumo = insumoTableClass::DESC_INSUMO;
$precio = insumoTableClass::PRECIO;
$tipoInsumo = insumoTableClass::TIPO_INSUMO_ID;
$fechaFabricacion = insumoTableClass::FECHA_FABRICACION;
$fechaVencimiento = insumoTableClass::FECHA_VENCIMIENTO;
$proveedorId = insumoTableClass::PROVEEDOR_ID;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100);
$pdf->Cell(10, 80, utf8_decode('INSUMO'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/

$pdf->Ln(10);

$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(40, 5, utf8_decode("DESC_INSUMO"), 1);
$pdf->Cell(40, 5, utf8_decode("PRECIO"), 1);
$pdf->Cell(40, 5, utf8_decode("TIPO_INSUMO"), 1);
$pdf->Cell(40, 5, utf8_decode("FABRICACION"), 1);
$pdf->Cell(40, 5, utf8_decode("VENCIMIENTO"), 1);
$pdf->Cell(40, 5, utf8_decode("PROVEEDOR"), 1);
$pdf->Ln();

foreach ($objInsumo as $insumo) {
    $pdf->Cell(20, 10, utf8_decode($insumo->$id), 1);
    $pdf->Cell(40, 10, utf8_decode($insumo->$descInsumo), 1);
    $pdf->Cell(40, 10, utf8_decode($insumo->$precio), 1);
    $pdf->Cell(40, 10, utf8_decode(tipoInsumoTableClass::getNameTipoin($insumo->$tipoInsumo)), 1);
    $pdf->Cell(40, 10, utf8_decode($insumo->$fechaFabricacion), 1);
    $pdf->Cell(40, 10, utf8_decode($insumo->$fechaVencimiento), 1);
    $pdf->Cell(40, 10, utf8_decode(proveedorTableClass::getNameProveedor($insumo->$proveedorId)), 1);

    $pdf->Ln();
}


$pdf->Output();
?>

