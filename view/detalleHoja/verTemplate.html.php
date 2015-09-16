

<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $peso = detalleHojaTableClass::PESO_CERDO ?>
<?php $unidad = detalleHojaTableClass::UNIDAD_MEDIDA_ID ?>
<?php $dosis = detalleHojaTableClass::DOSIS ?>
<?php $insumo = detalleHojaTableClass::INSUMO_ID ?>
<?php $tipoInsumo = detalleHojaTableClass::TIPO_INSUMO_ID ?>

<?php $created_at = detalleHojaTableClass::CREATED_AT ?>

<div class="container container-fluid">





  <div class="container">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-condensed">
        <thead>
          <tr class="info">

            <th>datos detalle hoja de vida</th>



          </tr>        
        </thead>
        <tbody>
<?php foreach ($objDetalleHoja as $detalle): ?> 
            <tr class="active">
              <th><?php echo i18n::__('quantity') ?></th>

              <td><?php echo $detalle->$peso ?></td>

            <tr class="active">
              <th><?php echo i18n::__('quantity') ?></th>

              <td><?php echo $detalle->$unidad ?></td>



            <tr >
              <th><?php echo i18n::__('describe_product') ?></th>

              <td><?php echo insumoTableClass::getNameInsumo($detalle->$insumo) ?></td>
            <tr class="info">

            <tr class="info">
              <th><?php echo i18n::__('Hold_Out') ?></th>

              <td><?php echo $detalle->$tipoInsumo ?></td>   

            <tr class="active">
              <th><?php echo i18n::__('date_creation') ?></th>

              <td><?php echo $detalle->$created_at ?></td>

<?php endforeach ?>
        </tbody>



      </table>    
    </div>
  </div>

