<?php mvc\view\viewClass::includePartial('insumo/menu')?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->

<?php $empleado = empleadoTableClass::NOMBRE ?>
<?php $apellido = empleadoTableClass::APELLIDO ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1>EDITAR EMPLEADO </h1>
        <h2><?php echo $objEmpleado[0]->$empleado . ' ' . $objEmpleado[0]->$apellido ?></h2>
    </div>
    
</div>
<!--fintitulo-->



<?php view::includePartial('empleado/formEmpleado', array('objEmpleado' => $objEmpleado, 'nombre' => $empleado,'objUsuario' => $objUsuario, 'objTipoId' => $objTipoId)) ?>


