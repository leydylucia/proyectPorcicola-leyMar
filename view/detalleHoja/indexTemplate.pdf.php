<?php

use mvc\routing\routingClass as routing;

$id = detalleHojaTableClass::ID;
$peso_cerdo = detalleHojaTableClass::PESO_CERDO;
$dosis = detalleHojaTableClass::DOSIS;
$insumo = detalleHojaTableClass::INSUMO_ID;
$tipo_insumo = detalleHojaTableClass::TIPO_INSUMO_ID;
$unidad_medida = detalleHojaTableClass::UNIDAD_MEDIDA_ID;

$nombre_cerdo=  hojaVidaTableClass::NOMBRE_CERDO;
$raza =  hojaVidaTableClass::RAZA_ID;
$lote=  hojaVidaTableClass::LOTE_ID;



$pdf = new FPDF('l', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100);
$pdf->Cell(10, 80, utf8_decode(''), 100, 10, 'C');
$pdf->Image(routing::getInstance()->getUrlImg('imagen_reporte.jpg'), 0, 0,280);/*200 ancho*/

$pdf->Ln(05);

$pdf->Cell(255,10,  utf8_decode("DETALLE HOJA"), 1, 0, 'C');
$pdf->Ln(10);

//$pdf->Cell(20, 5, utf8_decode("ID"), 1);
$pdf->Cell(51, 5, utf8_decode("PESO_CERDO"), 1);
$pdf->Cell(51, 5, utf8_decode("UNIDAD_MEDIDA"), 1);
$pdf->Cell(51, 5, utf8_decode("DOSIS"), 1);
$pdf->Cell(51, 5, utf8_decode("INSUMO"), 1);
$pdf->Cell(51, 5, utf8_decode("TIPO INSUMO"), 1);



$pdf->Ln();

foreach ($objDetalleHoja as $detalle) {
   
    $pdf->Cell(51, 10, utf8_decode($detalle->$peso_cerdo), 1);
    $pdf->Cell(51, 10, utf8_decode(unidadMedidaTableClass::getNameUnidadMedida($detalle->$unidad_medida)), 1);
    $pdf->Cell(51, 10, utf8_decode($detalle->$dosis), 1);
    $pdf->Cell(51, 10, utf8_decode(insumoTableClass::getNameInsumo($detalle->$insumo)), 1);
    $pdf->Cell(51, 10, utf8_decode(tipoInsumoTableClass::getNameTipoin($detalle->$tipo_insumo)), 1);

    $pdf->Ln();
}

//$pdf->Ln(05);
//$pdf->Cell(51, 5, utf8_decode("NOMBRE"), 1);
//$pdf->Cell(51, 5, utf8_decode("RAZA"), 1);
//$pdf->Cell(51, 5, utf8_decode("LOTE"), 1);
//
//
//
//
//$pdf->Ln();
//
//foreach ($objHojaVida as $hoja) {
//   
//    $pdf->Cell(51, 10, utf8_decode($hoja->$nombre_cerdo), 1);
//    $pdf->Cell(51, 10, utf8_decode($hoja->$raza), 1);
//    $pdf->Cell(51, 10, utf8_decode($hoja->$lote), 1);
// 

//    $pdf->Ln();
//}
$pdf->Output();
?>

