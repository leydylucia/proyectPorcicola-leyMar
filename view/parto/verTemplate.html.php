<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>

<?php $fecha_nacimiento = partoTableClass::FECHA_NACIMIENTO; ?>
<?php $num_nacidos = partoTableClass::NUM_NACIDOS; ?>
<?php $num_vivos = partoTableClass::NUM_VIVOS; ?>
<?php $num_muertos = partoTableClass::NUM_MUERTOS; ?>
<?php $num_hembras = partoTableClass::NUM_HEMBRAS; ?>
<?php $num_machos = partoTableClass::NUM_MACHOS; ?>
<?php $fecha_montada = partoTableClass::FECHA_MONTADA; ?>
<?php $id_padre = partoTableClass::ID_PADRE; ?>
<?php $hoja_vida_id = partoTableClass::HOJA_VIDA_ID; ?>
<?php $created_at = partoTableClass::CREATED_AT ?>


<div class="container container-fluid">


  <button type="button" class="btn btn-info" > <a href="<?php echo routing::getInstance()->getUrlWeb('parto', 'index') ?>"><?php echo i18n::__('return') ?> </a> </button>
  <br>
  <br>


</div>



<div class="container">
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
      <thead>
        <tr>

          <th>datos de parto</th>



        </tr>        
      </thead>
      <tbody>
        <tr><?php foreach ($objParto as $parto): ?> </tr>
          <tr>
            <th><?php echo i18n::__('date_birth') ?></th>

            <td><?php echo $parto->$fecha_nacimiento ?></td>

          <tr>
            <th><?php echo i18n::__('num_born') ?></th>

            <td><?php echo $parto->$num_nacidos ?></td>
          <tr>
            <th><?php echo i18n::__('num_lives') ?></th>

            <td><?php echo $parto->$num_vivos ?></td>
          <tr>
            <th><?php echo i18n::__('num_deads') ?></th>

            <td><?php echo $parto->$num_muertos ?></td>
          <tr>
            <th><?php echo i18n::__('num_female') ?></th>

            <td><?php echo $parto->$num_hembras ?></td>
          <tr>
            <th><?php echo i18n::__('num_male') ?></th>

            <td><?php echo $parto->$num_machos ?></td>
          <tr>
            <th><?php echo i18n::__('date_pregnancy') ?></th>

            <td><?php echo $parto->$fecha_montada ?></td>
          <tr>
            <th><?php echo i18n::__('id_father') ?></th>

            <td><?php echo $parto->$id_padre ?></td>
          <tr>
            <th><?php echo i18n::__('pig') ?></th>

            <td><?php echo hojaVidaTableClass::getNameHojaVida($parto->$hoja_vida_id) ?></td>
          <tr>
            <th><?php echo i18n::__('date_creation') ?></th>
            <td><?php echo $parto->$created_at ?></td>

<?php endforeach ?>
      </tbody>
    </table>    
  </div>
</div>

