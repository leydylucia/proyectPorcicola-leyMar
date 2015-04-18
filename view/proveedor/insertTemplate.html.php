<?php mvc\view\viewClass::includePartial('insumo/menu')?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<h1><?php echo i18n::__('new_supplier') ?></h1>
<?php view::includePartial('proveedor/formProveedor',array( 'objCiudad' => $objCiudad)) ?>


