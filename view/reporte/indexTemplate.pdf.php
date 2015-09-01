<?php

use mvc\routing\routingClass as routing;


$descripcion = sacrificiovTableClass::TIPO_VENTA_ID;
$cantidad = sacrificiovTableClass::CANTIDAD;
$unidad = sacrificiovTableClass::UNIDAD_MEDIDA_ID;
$cerdo = sacrificiovTableClass::ID_CERDO;
$fecha = sacrificiovTableClass::CREATED_AT;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100);
$pdf->Cell(10, 60, utf8_decode(''), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('imagen_reporte.jpg'), 0, 0,260);/*200 ancho*/

$pdf->Ln(05);

$pdf->Cell(240,10,  utf8_decode("SACRIFICIO DE CERDO"), 1, 0, 'C');
$pdf->Ln(10);

//$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(60, 5, utf8_decode("CANTIDAD"), 1);
$pdf->Cell(60, 5, utf8_decode("UNIDAD MEDIDA"), 1);
$pdf->Cell(60, 5, utf8_decode("DESCRIPCION"), 1);
$pdf->Cell(60, 5, utf8_decode("CERDO"), 1);

$pdf->Ln();

foreach ($objSacrificioV as $reporte) {

$pdf->Cell(60, 10, utf8_decode($reporte->$cantidad), 1);
$pdf->Cell(60, 10, utf8_decode(unidadMedidaTableClass::getNameUnidadMedida($reporte->$unidad)), 1);
$pdf->Cell(60, 10, utf8_decode(tipovTableClass::getNameTipov($reporte->$descripcion)), 1);
$pdf->Cell(60, 10, utf8_decode(hojaVidaTableClass::getNameHojaVida($reporte->$cerdo)), 1);

$pdf->Ln();
}


$pdf->Output();
?>

