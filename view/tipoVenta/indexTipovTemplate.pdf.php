<?php

use mvc\routing\routingClass as routing;

 $desc_tipoV = tipovTableClass::DESC_TIPOV;
 $id = tipovTableClass::ID;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80);
$pdf->Cell(10, 50, utf8_decode(' TIPO VENTA'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/

$pdf->Ln(50);

$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(40, 5, utf8_decode("DESC_TIPOV"), 1);

$pdf->Ln();
foreach ($objTipoV as $tipoV) {
    $pdf->Cell(20, 10, utf8_decode($tipoV->$id), 1);
    $pdf->Cell(40, 10, utf8_decode($tipoV->$desc_tipoV), 1);
    
    $pdf->Ln();
}


$pdf->Output();
?>

