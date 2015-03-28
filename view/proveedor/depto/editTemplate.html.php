<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->
<?php $depto = deptoTableClass::NOM_DEPTO ?>
<h1>EDITAR DEPARTAMENTO <?php echo $objDepto[0]->$depto ?></h1>
<?php view::includePartial('depto/formDepto', array('objDepto' => $objDepto, 'nom_depto' => $depto)) ?>