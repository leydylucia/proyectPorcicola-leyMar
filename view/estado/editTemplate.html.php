<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->
<?php $estado = estadoTableClass::DESC_ESTADO ?>
<h1>EDITAR ESTADO <?php echo $objEstado[0]->$estado ?></h1>
<?php view::includePartial('estado/formEstado', array('objEstado' => $objEstado, 'desc_estado' => $estado))?>
