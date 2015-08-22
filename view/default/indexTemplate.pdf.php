<?php

use mvc\routing\routingClass as routing;


$usu = usuarioTableClass::USER;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80);
$pdf->Cell(10, 50, utf8_decode(''), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('fondopasto.jpg'), 0, 0,280);/*200 ancho*/

$pdf->Ln(05);

$pdf->Cell(150,10,  utf8_decode("USUARIO"),1, 0, 'C');
$pdf->Ln(10);


foreach ($objUsuario as $usuario) {
   
    $pdf->Cell(150, 10, utf8_decode($usuario->$usu), 1, 0, 'C');
    
    $pdf->Ln();
}


$pdf->Output();
?>

