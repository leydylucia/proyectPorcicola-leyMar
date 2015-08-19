<?php mvc\view\viewClass::includePartial('insumo/menu')?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->

<?php $proveedor = proveedorTableClass::NOMBRE ?>
<?php $apellido = proveedorTableClass::APELLIDO ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1>EDITAR PROVEEDOR </h1>
        <h2><?php echo $objProveedor[0]->$proveedor . ' ' . $objProveedor[0]->$apellido ?></h2>
    </div>
    
</div>
<!--fintitulo-->



<?php view::includePartial('proveedor/formProveedor', array('objProveedor' => $objProveedor, 'nombre' => $proveedor,'objCiudad' => $objCiudad)) ?>


