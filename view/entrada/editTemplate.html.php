<?php mvc\view\viewClass::includePartial('insumo/menu')?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->

<?php $entrada = entradaTableClass::EMPLEADO_ID ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1>EDITAR ENTRADA BODEGA </h1>
        <h2><?php echo $objEntrada[0]->$entrada ?></h2>
    </div>
    
</div>
<!--fintitulo-->



<?php view::includePartial('entrada/formEntrada', array('objEntrada' => $objEntrada, 'nombre' => $entrada,'objEmpleado' => $objEmpleado, 'objProveedor' => $objProveedor)) ?>


