<?php

use mvc\routing\routingClass as routing;

$id = hojaVidaTableClass::ID;
$genero_id = hojaVidaTableClass::GENERO_ID;
$nombre_cerdo = hojaVidaTableClass::NOMBRE_CERDO;
$fecha_nacimiento = hojaVidaTableClass::FECHA_NACIMIENTO;
$estado = hojaVidaTableClass::ESTADO_ID;
$lote = hojaVidaTableClass::LOTE_ID;
$raza = hojaVidaTableClass::RAZA_ID;
//$id_madre = hojaVidaTableClass::ID_MADRE;
$fecha = hojaVidaTableClass::CREATED_AT;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50);
$pdf->Cell(10, 50, utf8_decode(''), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('imagen_reporte.jpg'), 0, 0, 280); /* 200 ancho */
$pdf->Ln(05);

$pdf->Cell(255, 10, utf8_decode("HOJA DE VIDA"), 1, 0, 'C');
$pdf->Ln(10);

$pdf->Cell(20, 5, utf8_decode("GENERO"), 1, 0, 'C');
$pdf->Cell(35, 5, utf8_decode("CERDO"), 1, 0, 'C');
$pdf->Cell(35, 5, utf8_decode("F_NAC."), 1, 0, 'C');
$pdf->Cell(35, 5, utf8_decode("ESTADO"), 1, 0, 'C');
$pdf->Cell(35, 5, utf8_decode("LOTE"), 1, 0, 'C');
$pdf->Cell(35, 5, utf8_decode("RAZA"), 1, 0, 'C');
$pdf->Cell(60, 5, utf8_decode("FECHA CREACION"), 1, 0, 'C');
$pdf->Ln();

foreach ($objHojaVida as $hojaVida) {
  $pdf->Cell(20, 10, utf8_decode(generoTableClass::getNameGenero($hojaVida->$genero_id)), 1);
  $pdf->Cell(35, 10, utf8_decode($hojaVida->$nombre_cerdo), 1);
  $pdf->Cell(35, 10, utf8_decode($hojaVida->$fecha_nacimiento), 1);
  $pdf->Cell(35, 10, utf8_decode(estadoTableClass::getNameEstado($hojaVida->$estado)), 1);
  $pdf->Cell(35, 10, utf8_decode(loteTableClass::getNameLote($hojaVida->$lote)), 1);
  $pdf->Cell(35, 10, utf8_decode(razaTableClass::getNameRaza($hojaVida->$raza)), 1);
  $pdf->Cell(60, 10, utf8_decode($hojaVida->$fecha), 1);
  $pdf->Ln();
}


$pdf->Output();
?>

