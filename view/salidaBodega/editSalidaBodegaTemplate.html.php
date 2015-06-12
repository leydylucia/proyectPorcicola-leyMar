<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>

<!--@var $descInsumo para definir que campo voy a modificar-->
<?php $empleado = salidaBodegaTableClass::EMPLEADO_ID ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('Edit_Hold_Out')?></h1>  
        <h2> <?php echo $objSalidaBodega[0]->$empleado ?></h2>
    </div>
<!--fintitulo-->
<?php view::includePartial('salidaBodega/formSalidaBodega', array('objSalidaBodega' => $objSalidaBodega, 'empleado' => $empleado,'objEmpleado' => $objEmpleado)) ?>


</div>