<!--@var $objInsumo
@var $descInsumo,$precio,$tipoInsumo,$fechaFabricacion,$fechaVencimiento,$insumoId-->

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



<?php $id = detalleSalidaTableClass::ID ?>
<?php $cantidad = detalleSalidaTableClass::CANTIDAD ?>


<?php $salida_bodega_s = detalleSalidaTableClass::SALIDA_BODEGA_ID ?>
<?php $salida_bodega = salidaBodegaTableClass::ID ?>

<?php $insumoId_p = detalleSalidaTableClass::INSUMO_ID ?>
<?php $insumoId = insumoTableClass::ID ?><!--manejo de foranea para traer datos-->
<?php $descripcion = insumoTableClass::DESC_INSUMO ?>

<?php view::includeHandlerMessage() ?>

<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('detalleSalida', ((isset($objDetalleSalida)) ? 'updateDetalleSalida' : 'createDetalleSalida')) ?>">


    <?php if (isset($objDetalleSalida) == true): ?>
        <input name="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID, true) ?>" value="<?php echo $objDetalleSalida[0]->$id ?>" type="hidden">
    <?php endif ?>

    

    <div class="form-group <?php echo (session::getInstance()->hasFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, true)) === true) ? 'has-error has-feedback' : '' ?>">
        <label for="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('quantity') ?>:</label>
        <div class="col-xs-9">
            <input id="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, true)) ? request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, true)) : ((isset($objDetalleSalida) == true) ? $objDetalleSalida[0]->$cantidad : '') ?>" type="text" name="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, true) ?>">
            <?php if (session::getInstance()->hasFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, true)) === true): ?>
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            <?php endif ?>
        </div>
    </div>

   

    


    <div class="form-group">
        <label for="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('Hold_Out') ?>:</label>

        <div class="col-xs-9">
            <select class="form-control" id="<?php detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, TRUE) ?>" name="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, TRUE); ?>">
                <option>Seleccione salidaBodega</option>
                <?php foreach ($objSalidaBodega as $salidaBodega): ?><!--validacion para traer dato  de foranea en editar-->
                    <option <?php echo (isset($objDetalleSalida[0]->$salida_bodega_s) === true and $objDetalleSalida[0]->$salida_bodega_s == $salidaBodega->$salida_bodega) ? 'selected' : '' ?> value="<?php echo $salidaBodega->$salida_bodega ?>"><!--validacion para traer dato  de foranea en editar-->
                        <?php echo $salidaBodega->$salida_bodega ?><!--validacion para traer dato  de foranea en editar-->
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>



   <div class="form-group">
        <label for="<?php echo detallesalidaTableClass::getNameField(detalleSalidaTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('provisioner') ?>:</label>

        <div class="col-xs-9">
            <select class="form-control" id="<?php detalleSalidaTableClass::getNameField(detalleSalidaTableClass::INSUMO_ID, TRUE) ?>" name="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::INSUMO_ID, TRUE); ?>">
                <option>Seleccione insumo</option>
                <?php foreach ($objInsumo as $insumo): ?><!--validacion para traer dato  de foranea en editar-->
                    <option <?php echo (isset($objDetalleSalida[0]->$insumoId_p) === true and $objDetalleSalida[0]->$insumoId_p == $insumo->$insumoId) ? 'selected' : '' ?> value="<?php echo $insumo->$insumoId ?>"><!--validacion para traer dato  de foranea en editar-->
                        <?php echo $insumo->$descripcion ?><!--validacion para traer dato  de foranea en editar-->
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>




    <!--linea para poner seguridad-->
   <!-- </?php if (session::getInstance()->hasCredential('admin')): //and session::getInstance()->hasCredential('emple')):  ?>-->
        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objDetalleSalida)) ? 'update' : 'register')) ?>">
    </?php endif ?>

    <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleSalida', 'indexDetalleSalida') ?>"><?php echo i18n::__('return') ?> </a></button>




</form>
