<?php

use mvc\routing\routingClass as routing;

$id = tipoInsumoTableClass::ID;
$desc_tipoIn = tipoInsumoTableClass::DESC_TIPOIN;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80);
$pdf->Cell(10, 50, utf8_decode(' TIPO INSUMO'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/

$pdf->Ln(50);

$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(40, 5, utf8_decode("DESC_TIPOIN"), 1);

$pdf->Ln();
foreach ($objTipoIn as $tipoIn) {
    $pdf->Cell(20, 10, utf8_decode($tipoIn->$id), 1);
    $pdf->Cell(40, 10, utf8_decode($tipoIn->$desc_tipoIn), 1);
    
    $pdf->Ln();
}


$pdf->Output();
?>

