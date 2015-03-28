<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->
<?php $raza = razaTableClass::DESC_RAZA ?>
<h1>EDITAR RAZA <?php echo $objRaza[0]->$raza ?></h1>
<?php view::includePartial('raza/formRaza', array('objRaza' => $objRaza, 'desc_raza' => $raza)) ?>