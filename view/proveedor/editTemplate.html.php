<?php mvc\view\viewClass::includePartial('insumo/menu')?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->

<?php $proveedor = proveedorTableClass::NOMBRE ?>
<h1>EDITAR PROVEEDOR   <?php echo $objProveedor[0]->$proveedor ?></h1>

<?php view::includePartial('proveedor/formProveedor', array('objProveedor' => $objProveedor, 'nombre' => $proveedor)) ?>