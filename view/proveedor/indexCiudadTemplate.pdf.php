<?php use mvc\routing\routingClass as routing;



$id = ciudadTableClass::ID;
$nom_ciudad = ciudadTableClass::NOM_CIUDAD;
$depto_id = ciudadTableClass::DEPTO_ID;
$nom_depto = deptoTableClass::NOM_DEPTO;


$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 13);
$pdf->Cell(80);
$pdf->Cell(10, 50, utf8_decode('CIUDAD'), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('prueba.jpg'), 50, 8,200);/*200 ancho*/


$pdf->Ln(50);

$pdf->Cell(20,10,  utf8_decode("ID"),1);
  $pdf->Cell(40,10,  utf8_decode("NOMBRE CIUDAD"),1);
  $pdf->Ln();
  
  foreach ($objCiudad as $ciudad){
  $pdf->Cell(20,10,  utf8_decode($ciudad->$id),1);
  $pdf->Cell(40,10,  utf8_decode($ciudad->$nom_ciudad),1);
 $pdf->Ln();
  }

$pdf->Output();


?>

