<?php

use mvc\routing\routingClass as routing;

$id = usuarioTableClass::ID;
$usu = usuarioTableClass::USER;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80);
$pdf->Cell(10, 50, utf8_decode('USUARIO'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/

$pdf->Ln(50);

$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(40, 5, utf8_decode("USER"), 1);

$pdf->Ln();
foreach ($objUsuario as $usuario) {
    $pdf->Cell(20, 10, utf8_decode($usuario->$id), 1);
    $pdf->Cell(40, 10, utf8_decode($usuario->$usu), 1);
    
    $pdf->Ln();
}


$pdf->Output();
?>

