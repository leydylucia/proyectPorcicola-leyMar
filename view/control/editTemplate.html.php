<?php mvc\view\viewClass::includePartial('insumo/menu')?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->

<?php $control = controlTableClass::PESO_CERDO ?>
<h1>EDITAR CONTROL PESO      <small><?php echo $objControl[0]->$control ?></small>    </h1>

<?php view::includePartial('control/formControl', array('objControl' => $objControl, 'peso_cerdo' => $control,'objEmpleado' => $objEmpleado)) ?>