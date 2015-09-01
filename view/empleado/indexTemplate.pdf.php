<?php

use mvc\routing\routingClass as routing;

$id = empleadoTableClass::ID;
$nombre = empleadoTableClass::NOMBRE;
$usuario_id = empleadoTableClass::USUARIO_ID;
$tipo_id_id = empleadoTableClass::TIPO_ID_ID;
$apellido = empleadoTableClass::APELLIDO;
$direccion = empleadoTableClass::DIRECCION;
$correo = empleadoTableClass::CORREO;
$telefono = empleadoTableClass::TELEFONO;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50);
$pdf->Cell(10, 50, utf8_decode(''), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8, 200); /* 200 ancho */

$pdf->Ln(05);

$pdf->Cell(250, 10, utf8_decode("EMPLEADO"), 1, 0, 'C');
$pdf->Ln(10);

//$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(50, 5, utf8_decode("NOMBRE"), 1, 0, 'C');
$pdf->Cell(40, 5, utf8_decode("USUARIO"), 1, 0, 'C');
$pdf->Cell(40, 5, utf8_decode("TIPO ID"), 1, 0, 'C');
$pdf->Cell(40, 5, utf8_decode("DIRECCION"), 1, 0, 'C');
$pdf->Cell(40, 5, utf8_decode("CORREO"), 1, 0, 'C');
$pdf->Cell(40, 5, utf8_decode("TELEFONO"), 1, 0, 'C');
$pdf->Ln();

foreach ($objEmpleado as $empleado) {
 // $pdf->Cell(20, 10, utf8_decode($empleado->$id), 1);
  $pdf->Cell(50, 10, utf8_decode($empleado->$nombre . ' ' . $empleado->$apellido), 1);
  $pdf->Cell(40, 10, utf8_decode(usuarioTableClass::getNameUsuario($empleado->$usuario_id)), 1);
  $pdf->Cell(40, 10, utf8_decode(tipoIdTableClass::getNameTipo($empleado->$tipo_id_id)), 1);
  $pdf->Cell(40, 10, utf8_decode($empleado->$direccion), 1);
  $pdf->Cell(40, 10, utf8_decode($empleado->$correo), 1);
  $pdf->Cell(40, 10, utf8_decode($empleado->$telefono), 1);

  $pdf->Ln();
}


$pdf->Output();
?>

