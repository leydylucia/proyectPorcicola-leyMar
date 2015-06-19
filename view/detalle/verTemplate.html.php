<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $cantidad = detalleEntradaTableClass::CANTIDAD ?>
<?php $valor = detalleEntradaTableClass::VALOR ?>
<?php $entrada_bodega_id = detalleEntradaTableClass::ENTRADA_BODEGA_ID ?>
<?php $insumo_id = detalleEntradaTableClass::INSUMO_ID ?>
<?php $created_at = detalleEntradaTableClass::CREATED_AT ?>

<div class="container container-fluid">


  <a href="<?php echo routing::getInstance()->getUrlWeb('detalle', 'index') ?>"><?php echo i18n::__('return') ?> </a>

</div>



<div class="container">
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
      <thead>
        <tr>

          <th>Datos de Detalle Bodega</th>



        </tr>        
      </thead>
      <tbody>
        <tr><?php foreach ($objDetalle as $detalle): ?> </tr>
          <tr>
            <th><?php echo i18n::__('cant') ?></th>
            <td><?php echo $detalle->$cantidad ?></td>
          <tr>
            <th><?php echo i18n::__('value') ?></th>
            <td><?php echo $detalle->$valor ?></td>
            <tr>
            <th><?php echo i18n::__('cellar entry') ?></th>
            <td><?php echo entradaTableClass::getNameEntrada($detalle->$entrada_bodega_id) ?></td>
          <tr>
            <th><?php echo i18n::__('product') ?></th>
            <td><?php echo insumoTableClass::getNameInsumo($detalle->$insumo_id) ?></td>
          <tr>
            <th><?php echo i18n::__('date_creation') ?></th>
            <td><?php echo $detalle->$created_at ?></td>

<?php endforeach ?>
      </tbody>

    </table>    
  </div>
</div>  