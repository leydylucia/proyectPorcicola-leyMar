<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>


<?php $genero_id = hojaVidaTableClass::GENERO_ID ?>
<?php $nombre_cerdo = hojaVidaTableClass::NOMBRE_CERDO ?>
<?php $fecha_nacimiento = hojaVidaTableClass::FECHA_NACIMIENTO ?>
<?php $estado_id = hojaVidaTableClass::ESTADO_ID ?>
<?php $lote_id = hojaVidaTableClass::LOTE_ID ?>
<?php $raza_id = hojaVidaTableClass::RAZA_ID ?>
</?php $id_madre = hojaVidaTableClass::ID_MADRE ?>
<?php $created_at = hojaVidaTableClass::CREATED_AT ?>


<div class="container container-fluid">

  <button type="button" class="btn btn-info" > <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'index') ?>"><?php echo i18n::__('return') ?> </a> </button>
  <br>
  <br>

</div>



<div class="container">
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
      <thead>
        <tr>

          <th>Datos Hoja de Vida</th>



        </tr>        
      </thead>
      <tbody>
        <tr><?php foreach ($objHojaVida as $hojaVida): ?> </tr>
          <tr>
            <th><?php echo i18n::__('genre') ?></th>

            <td><?php echo generoTableClass::getNameGenero($hojaVida->$genero_id) ?></td>
          <tr>
            <th><?php echo i18n::__('date_birth') ?></th>

            <td><?php echo $hojaVida->$fecha_nacimiento ?></td>
            <tr>
            <th><?php echo i18n::__('name_pig') ?></th>

            <td><?php echo $hojaVida->$nombre_cerdo ?></td>
          <tr>
            <th><?php echo i18n::__('state') ?></th>

            <td><?php echo estadoTableClass::getNameEstado($hojaVida->$estado_id) ?></td>
          <tr>
            <th><?php echo i18n::__('batch') ?></th>

            <td><?php echo loteTableClass::getNameLote($hojaVida->$lote_id) ?></td>
          <tr>
            <th><?php echo i18n::__('race') ?></th>

            <td><?php echo razaTableClass::getNameRaza($hojaVida->$raza_id) ?></td>
          <tr>
            <th></?php echo i18n::__('mother') ?></th>

             <!-- <td></?php echo $hojaVida->$id_madre ?></td> -->
          <tr>
            <th><?php echo i18n::__('date_creation') ?></th>
            <td><?php echo $hojaVida->$created_at ?></td>

          <?php endforeach ?>
      </tbody>



    </table>    
  </div>
</div>

