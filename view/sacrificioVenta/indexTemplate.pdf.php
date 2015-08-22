<?php

use mvc\routing\routingClass as routing;

$id = sacrificiovTableClass::ID;
$valor = sacrificiovTableClass::VALOR;
$tipoVenta = sacrificiovTableClass::TIPO_VENTA_ID;
$idCerdo = sacrificiovTableClass::ID_CERDO;
$cantidad = sacrificiovTableClass::CANTIDAD;
$unidad_medida = sacrificiovTableClass::UNIDAD_MEDIDA_ID;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100);
$pdf->Cell(10, 50, utf8_decode(''), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8, 200); /* 200 ancho */

$pdf->Ln(10);

$pdf->Cell(250, 10, utf8_decode('SACRIFICIO DE LOS CERDOS') , 1, 0, 'C');

$pdf->Ln(10);

$pdf->Cell(50, 5, utf8_decode("CERDO"), 1);
$pdf->Cell(50, 5, utf8_decode("TIPO-VENTA"), 1);
$pdf->Cell(50, 5, utf8_decode("CANTIDAD"), 1);
$pdf->Cell(50, 5, utf8_decode("UNIDAD_MEDIDA"), 1);
$pdf->Cell(50, 5, utf8_decode("VALOR"), 1);



$pdf->Ln();

foreach ($objSacrificioV as $sacrificio) {
    
    $pdf->Cell(50, 10, utf8_decode(hojaVidaTableClass::getNameHojaVida($sacrificio->$idCerdo)), 1);
    $pdf->Cell(50, 10, utf8_decode(tipovTableClass::getNameTipov($sacrificio->$tipoVenta)), 1);
    $pdf->Cell(50, 10, utf8_decode($sacrificio->$cantidad), 1);
    $pdf->Cell(50, 10, utf8_decode(unidadMedidaTableClass::getNameUnidadMedida($sacrificio->$unidad_medida)), 1);
    $pdf->Cell(50, 10, utf8_decode($sacrificio->$valor), 1);




    $pdf->Ln();
}


$pdf->Output();
?>

