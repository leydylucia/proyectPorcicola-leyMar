<?php

use mvc\routing\routingClass as routing;

$id = usuarioCredencialTableClass::ID;
$usuario = usuarioCredencialTableClass::USUARIO_ID;
$credencial = usuarioCredencialTableClass::CREDENCIAL_ID;
$fecha = usuarioCredencialTableClass::CREATED_AT;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100);
$pdf->Cell(10, 50, utf8_decode('USUARIO CREDENCIAL'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/

$pdf->Ln(10);

$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(40, 5, utf8_decode("USUARIO"), 1);
$pdf->Cell(40, 5, utf8_decode("CREDENCIAL"), 1);

$pdf->Ln();

foreach ($objUsuarioCredencial as $usuarioCredencial) {

$pdf->Cell(40, 10, utf8_decode(usuarioTableClass::getNameUsuario($usuarioCredencial->$usuario)), 1);
$pdf->Cell(40, 10, utf8_decode(credencialTableClass::getNameCredencial($usuarioCredencial->$credencial)), 1);

$pdf->Ln();
}


$pdf->Output();
?>

