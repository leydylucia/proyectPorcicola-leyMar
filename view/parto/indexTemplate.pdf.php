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
$pdf->Cell(10, 50, utf8_decode(''), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('imagen_reporte.jpg'), 0, 0,280);/*200 ancho*/

$pdf->Ln(05);

$pdf->Cell(255,10,  utf8_decode("PARTO"), 1, 0, 'C');
$pdf->Ln(10);

//$pdf->Cell(20,5,  utf8_decode("ID"),1);
  $pdf->Cell(40,5,  utf8_decode("FECHA NAC."),1);
  $pdf->Cell(25,5,  utf8_decode("NACIDOS"),1);
  $pdf->Cell(20,5,  utf8_decode("VIVOS"),1);
  $pdf->Cell(25,5,  utf8_decode("MUERTOS"),1);
  $pdf->Cell(25,5,  utf8_decode("HEMBRAS"),1);
  $pdf->Cell(25,5,  utf8_decode("MACHOS"),1);
  $pdf->Cell(40,5,  utf8_decode("FECHA MONTADA"),1);
  $pdf->Cell(25,5,  utf8_decode("PADRE"),1);
  $pdf->Cell(30,5,  utf8_decode("CERDO"),1);
    $pdf->Ln();
  
  foreach ($objParto as $parto){
  //$pdf->Cell(20,10,  utf8_decode($parto->$id),1);
  $pdf->Cell(40,10,  utf8_decode($parto->$fecha_nacimiento),1);
  $pdf->Cell(25,10,  utf8_decode($parto->$num_nacidos),1);
  $pdf->Cell(20,10,  utf8_decode($parto->$num_vivos),1);
  $pdf->Cell(25,10,  utf8_decode($parto->$num_muertos),1);
  $pdf->Cell(25,10,  utf8_decode($parto->$num_hembras),1);
  $pdf->Cell(25,10,  utf8_decode($parto->$num_machos),1);
  $pdf->Cell(40,10,  utf8_decode($parto->$fecha_montada),1);
  $pdf->Cell(25,10,  utf8_decode($parto->$id_padre),1);
  $pdf->Cell(30,10,  utf8_decode(hojaVidaTableClass::getNameHojaVida($parto->$hoja_vida_id)),1);
  
$pdf->Ln();
  }


$pdf->Output();


?>
