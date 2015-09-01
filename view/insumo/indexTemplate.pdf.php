<?php

use mvc\routing\routingClass as routing;

$id = insumoTableClass::ID;
$descInsumo = insumoTableClass::DESC_INSUMO;
//$precio = insumoTableClass::PRECIO;
$tipoInsumo = insumoTableClass::TIPO_INSUMO_ID;
$fechaFabricacion = insumoTableClass::FECHA_FABRICACION;
$fechaVencimiento = insumoTableClass::FECHA_VENCIMIENTO;
$proveedorId = insumoTableClass::PROVEEDOR_ID;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50);
$pdf->Cell(10, 50, utf8_decode(''), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('imagen_reporte.jpg'), 0, 0,280);/*200 ancho*/

$pdf->Ln(10);

$pdf->Cell(250, 10, utf8_decode('INSUMOS') , 1, 0, 'C');

$pdf->Ln(10);

$pdf->Cell(50, 5, utf8_decode("DESCRIPCION"), 1, 0, 'C');
//$pdf->Cell(40, 5, utf8_decode("PRECIO"), 1);
$pdf->Cell(50, 5, utf8_decode("TIPO_INSUMO"), 1, 0, 'C');
$pdf->Cell(50, 5, utf8_decode("FABRICACION"), 1, 0, 'C');
$pdf->Cell(50, 5, utf8_decode("VENCIMIENTO"), 1, 0, 'C');
$pdf->Cell(50, 5, utf8_decode("PROVEEDOR"), 1, 0, 'C');
$pdf->Ln();

foreach ($objInsumo as $insumo) {
   
    $pdf->Cell(50, 10, utf8_decode($insumo->$descInsumo), 1);
//    $pdf->Cell(40, 10, utf8_decode($insumo->$precio), 1);
    $pdf->Cell(50, 10, utf8_decode(tipoInsumoTableClass::getNameTipoin($insumo->$tipoInsumo)), 1);
    $pdf->Cell(50, 10, utf8_decode($insumo->$fechaFabricacion), 1);
    $pdf->Cell(50, 10, utf8_decode($insumo->$fechaVencimiento), 1);
    $pdf->Cell(50, 10, utf8_decode(proveedorTableClass::getNameProveedor($insumo->$proveedorId)), 1);

    $pdf->Ln();
}


$pdf->Output();
?>

