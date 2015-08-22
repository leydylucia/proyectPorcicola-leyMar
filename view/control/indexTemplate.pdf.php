<?php use mvc\routing\routingClass as routing;

$id = controlTableClass::ID;
$peso_cerdo = controlTableClass::PESO_CERDO;
$empleado_id = controlTableClass::EMPLEADO_ID;
$apellido = empleadoTableClass::APELLIDO;
$unidad = controlTableClass::UNIDAD_MEDIDA_ID;

$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(10);
$pdf->Cell(10, 10, utf8_decode(''), 50, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8, 200); /* 200 ancho */

$pdf->Ln(50);

$pdf->Cell(260 ,10,  utf8_decode("CONTROL PESO"), 1, 0, 'C');
$pdf->Ln(10);

$pdf->Cell(65, 5, utf8_decode("NOMBRE CERDO"), 1, 0, 'C');
$pdf->Cell(65, 5, utf8_decode("PESO_CERDO"), 1, 0, 'C');
$pdf->Cell(65, 5, utf8_decode("UNIDAD MEDIDA"), 1, 0, 'C');
$pdf->Cell(65, 5, utf8_decode("EMPLEADO"), 1, 0, 'C');
$pdf->Ln();

foreach ($objControl as $control) {
  $pdf->Cell(65, 10, utf8_decode(hojaVidaTableClass::getNameHojaVida($control->$id)), 1);
  $pdf->Cell(65, 10, utf8_decode($control->$peso_cerdo), 1);
  $pdf->Cell(65, 10, utf8_decode(unidadMedidaTableClass::getNameUnidadMedida($control->$unidad)), 1);
  $pdf->Cell(65, 10, utf8_decode(empleadoTableClass::getNameEmpleado($control->$empleado_id) . ' ' . empleadoTableClass::getNameApellido($control->$empleado_id )), 1);
  $pdf->Ln();
}

$pdf->Output();
?>
