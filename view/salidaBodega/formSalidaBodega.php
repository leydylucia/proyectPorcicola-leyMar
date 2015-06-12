<!--@var $objInsumo
@var $descInsumo,$precio,$tipoInsumo,$fechaFabricacion,$fechaVencimiento,$proveedorId-->

<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\view\viewClass as view ?>



<?php $id = salidaBodegaTableClass::ID ?>
<?php $empleado_e = salidaBodegaTableClass::EMPLEADO_ID?>
<?php $empleado = empleadoTableClass::ID?>
<?php $nombre = empleadoTableClass::NOMBRE?>


    <?php view::includeHandlerMessage() ?>

<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('salidaBodega', ((isset($objSalidaBodega)) ? 'updateSalidaBodega' : 'createSalidaBodega')) ?>">


<?php if (isset($objSalidaBodega) == true): ?>
        <input name="<?php echo salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID, true) ?>" value="<?php echo $objSalidaBodega[0]->$id ?>" type="hidden">
            <?php endif ?>



<div class="form-group">
        <label for="<?php echo salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('empleyeed') ?>:</label>

        <div class="col-xs-9">
            <select class="form-control" id="<?php salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO_ID, TRUE) ?>" name="<?php echo salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO_ID, TRUE); ?>">
               <option>Seleccione empleado</option>
<?php foreach ($objEmpleado as $trabajador): ?><!--validacion para traer dato  de foranea en editar-->
                    <option <?php echo (isset($objSalidaBodega[0]->$empleado_e) === true and $objSalidaBodega[0]->$empleado_e == $trabajador->$empleado) ? 'selected' : '' ?> value="<?php echo $trabajador->$empleado ?>"><!--validacion para traer dato  de foranea en editar-->
    <?php echo $trabajador->$nombre ?><!--validacion para traer dato  de foranea en editar-->
                    </option>
<?php endforeach; ?>
            </select>
        </div>      
    </div>



    <!--linea para poner seguridad-->
<?php if (session::getInstance()->hasCredential('admin')): //and session::getInstance()->hasCredential('emple')):  ?>
        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objSalidaBodega)) ? 'update' : 'register')) ?>">
<?php endif ?>

        <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('salidaBodega', 'indexSalidaBodega') ?>"><?php echo i18n::__('return') ?> </a></button>




</form>

