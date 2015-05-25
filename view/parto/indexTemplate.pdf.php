<?php use mvc\routing\routingClass as routing;



$id = partoTableClass::ID;
$fecha_nacimiento = partoTableClass::FECHA_NACIMIENTO;
$num_nacidos = partoTableClass::NUM_NACIDOS;
$num_vivos = partoTableClass::NUM_VIVOS;
$num_muertos = partoTableClass::NUM_MUERTOS;
$num_hembras = partoTableClass::NUM_HEMBRAS;
$num_machos = partoTableClass::NUM_MACHOS;
$fecha_montada = partoTableClass::FECHA_MONTADA;
$id_padre = partoTableClass::ID_PADRE;
$hoja_vida_id = partoTableClass::HOJA_VIDA_ID;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50);
$pdf->Cell(10, 50, utf8_decode('PARTO'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/

$pdf->Ln(05);

$pdf->Cell(20,5,  utf8_decode("ID"),1);
$pdf->Cell(40,5,  utf8_decode("FECHA NACIMIENTO"),1);
  $pdf->Cell(40,5,  utf8_decode("NUM NACIDOS"),1);
  $pdf->Cell(40,5,  utf8_decode("NUM VIVOS"),1);
  $pdf->Cell(40,5,  utf8_decode("NUM MUERTOS"),1);
  $pdf->Cell(40,5,  utf8_decode("NUM HEMBRAS"),1);
  $pdf->Cell(40,5,  utf8_decode("NUM MACHOS"),1);
  $pdf->Cell(40,5,  utf8_decode("FECHA MONTADA"),1);
  $pdf->Cell(40,5,  utf8_decode("PADRE"),1);
  $pdf->Cell(40,5,  utf8_decode("CERDO"),1);
    $pdf->Ln();
  
  foreach ($objHojaVida as $parto){
  $pdf->Cell(20,10,  utf8_decode($parto->$id),1);
  $pdf->Cell(40,10,  utf8_decode($parto->$fecha_nacimiento),1);
  $pdf->Cell(40,10,  utf8_decode($parto->$num_nacidos),1);
  $pdf->Cell(40,10,  utf8_decode($parto->$num_vivos),1);
  $pdf->Cell(40,10,  utf8_decode($parto->$num_muertos),1);
  $pdf->Cell(40,10,  utf8_decode($parto->$num_hembras),1);
  $pdf->Cell(40,10,  utf8_decode($parto->$num_machos),1);
  $pdf->Cell(40,10,  utf8_decode($parto->$fecha_montada),1);
  $pdf->Cell(40,10,  utf8_decode($parto->$id_padre),1);
  $pdf->Cell(40,10,  utf8_decode($parto->$hoja_vida_id),1);
  
$pdf->Ln();
  }


$pdf->Output();


?>

