

<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>


<?php $desc_lote = loteTableClass::DESC_LOTE ?>
<?php $ubicacion = loteTableClass::UBICACION ?>
<?php $created_at = loteTableClass::CREATED_AT ?>


<div class="container container-fluid">


  <a href="<?php echo routing::getInstance()->getUrlWeb('lote', 'index') ?>"><?php echo i18n::__('return') ?> </a>

</div>



<div class="container">
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
      <thead>
        <tr>

          <th>Datos Lote</th>



        </tr>        
      </thead>
      <tbody>
        <tr><?php foreach ($objLote as $lote): ?> </tr>
          <tr>
            <th><?php echo i18n::__('desc_lot') ?></th>

            <td><?php echo $lote->$desc_lote ?></td>

          <tr>
            <th><?php echo i18n::__('location') ?></th>

            <td><?php echo $lote->$ubicacion ?></td>
          <tr>
            <th><?php echo i18n::__('date_creation') ?></th>
            <td><?php echo $lote->$created_at ?></td>

          <?php endforeach ?>
      </tbody>



    </table>    
  </div>
</div>

