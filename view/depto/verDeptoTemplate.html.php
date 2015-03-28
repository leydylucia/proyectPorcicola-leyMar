

<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $nom_depto = deptoTableClass::NOM_DEPTO ?>
<?php $created_at = deptoTableClass::CREATED_AT ?>

<div class="container container-fluid">


  <a href="http://localhost/proyecto/web/index.php/depto"><?php echo i18n::__('return') ?> </a>
  <br>
  <br>

</div>



<div class="container">
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
      <thead>
        <tr>

      <center> <th>Datos de Departamento</th>     
        </tr>        

        </thead>

        <tbody>
          <?php foreach ($objDepto as $depto): ?>

          <th><?php echo i18n::__('name_dept') ?></th>
          <tr>
            <td><?php echo $depto->$nom_depto ?></td>

          <tr>
            <th><?php echo i18n::__('date_creation') ?></th>
          <tr>
            <td><?php echo $depto->$created_at ?></td>

          <?php endforeach ?>
          </tbody>



          </table>    
          </div>
          </div>

