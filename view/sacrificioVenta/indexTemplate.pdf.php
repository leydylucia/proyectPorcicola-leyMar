<?php

use mvc\routing\routingClass as routing;

$id = sacrificiovTableClass::ID;
$valor = sacrificiovTableClass::VALOR;
$tipoVenta = sacrificiovTableClass::TIPO_VENTA_ID;
$idCerdo = sacrificiovTableClass::ID_CERDO;
$cantidad = sacrificiovTableClass::CANTIDAD;
$unidad_medida = sacrificiovTableClass::UNIDAD_MEDIDA;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100);
$pdf->Cell(10, 50, utf8_decode('SACRIFICIO'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8, 200); /* 200 ancho */

$pdf->Ln(10);

$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(40, 5, utf8_decode("CERDO"), 1);
$pdf->Cell(40, 5, utf8_decode("TIPO-VENTA"), 1);
$pdf->Cell(40, 5, utf8_decode("CANTIDAD"), 1);
$pdf->Cell(40, 5, utf8_decode("UNIDAD_MEDIDA"), 1);
$pdf->Cell(40, 5, utf8_decode("VALOR"), 1);



$pdf->Ln();

foreach ($objSacrificioV as $sacrificio) {
    $pdf->Cell(20, 10, utf8_decode($sacrificio->$id), 1);
    $pdf->Cell(40, 10, utf8_decode($sacrificio->$idCerdo), 1);
    $pdf->Cell(40, 10, utf8_decode(tipovTableClass::getNameTipov($sacrificio->$tipoVenta)), 1);
    $pdf->Cell(40, 10, utf8_decode($sacrificio->$cantidad), 1);
    $pdf->Cell(40, 10, utf8_decode($sacrificio->$unidad_medida), 1);
    $pdf->Cell(40, 10, utf8_decode($sacrificio->$valor), 1);




    $pdf->Ln();
}


$pdf->Output();
?>

