<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->

<?php $control = controlTableClass::PESO_CERDO ?>
<div class="container container-fluid">
  <div class="page-header titulo">
    <h1>EDITAR CONTROL PESO</h1>  
      <h2><?php echo $objControl[0]->$control ?></h2>    
  </div>
</div>

<?php view::includePartial('control/formControl', array('objUnidad' => $objUnidad, 'objControl' => $objControl, 'peso_cerdo' => $control, 'objEmpleado' => $objEmpleado, 'objHojaVida' => $objHojaVida)) ?>