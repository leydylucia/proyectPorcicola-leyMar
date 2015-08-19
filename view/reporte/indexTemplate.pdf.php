<?php

use mvc\routing\routingClass as routing;

$id = reporteTableClass::ID;
$nombre = reporteTableClass::NOMBRE;
$descripcion = reporteTableClass::DESCRIPCION;
$fecha = reporteTableClass::CREATED_AT;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100);
$pdf->Cell(10, 50, utf8_decode('Reporte'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/

$pdf->Ln(10);

//$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(40, 5, utf8_decode("NOMBRE"), 1);
$pdf->Cell(40, 5, utf8_decode("DESCRIPCION"), 1);

$pdf->Ln();

foreach ($objReporte as $reporte) {

$pdf->Cell(40, 10, utf8_decode($reporte->$nombre), 1);
$pdf->Cell(40, 10, utf8_decode($reporte->$descripcion), 1);

$pdf->Ln();
}


$pdf->Output();
?>

