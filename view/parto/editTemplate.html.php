<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->
<?php $parto = partoTableClass::FECHA_NACIMIENTO ?>
<h1>EDITAR PARTO <?php echo $objParto[0]->$parto ?></h1>
<?php view::includePartial('parto/formParto', array('objParto' => $objParto, 'fecha_nacimiento' => $parto)) ?>