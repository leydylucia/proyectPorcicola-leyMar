<?php

use mvc\routing\routingClass as routing;

$id = vacunacionTableClass::ID;
$dosis = vacunacionTableClass::DOSIS;
//$hora = vacunacionTableClass::HORA;
$insumoId = vacunacionTableClass::INSUMO_ID;
$idCerdo = vacunacionTableClass::ID_CERDO;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100);
$pdf->Cell(10, 50, utf8_decode('VACUNACION'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/

$pdf->Ln(10);

$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(40, 5, utf8_decode("DOSIS"), 1);
//$pdf->Cell(40, 5, utf8_decode("HORA"), 1);
$pdf->Cell(40, 5, utf8_decode("INSUMO"), 1);
$pdf->Cell(40, 5, utf8_decode("CERDO"), 1);

$pdf->Ln();

foreach ($objVacunacion as $vacunacion) {
    $pdf->Cell(20, 10, utf8_decode($vacunacion->$id), 1);
    $pdf->Cell(40, 10, utf8_decode($vacunacion->$dosis), 1);
//    $pdf->Cell(40, 10, utf8_decode($vacunacion->$hora), 1);
    $pdf->Cell(40, 10, utf8_decode(insumoTableClass::getNameInsumo($vacunacion->$insumoId)), 1);
    $pdf->Cell(40, 10, utf8_decode($vacunacion->$idCerdo), 1);
   
    $pdf->Ln();
}


$pdf->Output();
?>

