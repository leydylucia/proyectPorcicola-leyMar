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



<?php $id = detalleEntradaTableClass::ID ?>
<?php $cantidad = detalleEntradaTableClass::CANTIDAD ?>
<?php $valor = detalleEntradaTableClass::VALOR ?>


<?php $entrada_bodega_s = detalleEntradaTableClass::ENTRADA_BODEGA_ID ?>
<?php $entrada_bodega = entradaTableClass::ID ?>
<?php $id_entrada_bodega = detalleEntradaTableClass::ENTRADA_BODEGA_ID ?>
<?php $insumoId_p = detalleEntradaTableClass::INSUMO_ID ?>
<?php $insumoId = insumoTableClass::ID ?><!--manejo de foranea para traer datos-->
<?php $descripcion = insumoTableClass::DESC_INSUMO ?>

<?php view::includeHandlerMessage() ?>

<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('detalle', ((isset($objDetalle)) ? 'update' : 'create')) ?>">


    <?php if (isset($objDetalle) == true): ?>
        <input name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID, true) ?>" value="<?php echo $objDetalle[0]->$id ?>" type="hidden">
        <input type="hidden" value="<?php echo $objDetalle[0]->$id_entrada_bodega ?>" name="<?php echo  detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, TRUE) ?>"><!--tipo oculto para foranea-->
    <?php else: ?>
        <?php $id_entrada = request::getInstance()->getGet(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true)) ?>
                <input type="hidden" value="<?php echo$id_entrada ?>" name="<?php echo  detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, TRUE) ?>"><!--tipo oculto para foranea-->
        <?php endif; ?>
        
        
                            
         
    

    <div class="form-group <?php echo (session::getInstance()->hasFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true)) === true) ? 'has-error has-feedback' : '' ?>">
        <label for="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('quantity') ?>:</label>
        <div class="col-xs-9">
            <input id="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true)) ? request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true)) : ((isset($objDetalle) == true) ? $objDetalle[0]->$cantidad : '') ?>" type="text" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true) ?>">
            <?php if (session::getInstance()->hasFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true)) === true): ?>
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            <?php endif ?>
        </div>
    </div>
                
    <div class="form-group <?php echo (session::getInstance()->hasFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true)) === true) ? 'has-error has-feedback' : '' ?>">
        <label for="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('value') ?>:</label>
        <div class="col-xs-9">
            <input id="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true)) ? request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true)) : ((isset($objDetalle) == true) ? $objDetalle[0]->$valor : '') ?>" type="text" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true) ?>">
            <?php if (session::getInstance()->hasFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true)) === true): ?>
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            <?php endif ?>
        </div>
    </div>            
    <div class="form-group">
       


   <div class="form-group">
        <label for="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('product') ?>:</label>

        <div class="col-xs-9">
            <select class="form-control" id="<?php detalleEntradaTableClass::getNameField(detalleEntradaTableClass::INSUMO_ID, TRUE) ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::INSUMO_ID, TRUE); ?>">
                <option>Seleccione insumo</option>
                <?php foreach ($objInsumo as $insumo): ?><!--validacion para traer dato  de foranea en editar-->
                    <option <?php echo (isset($objDetalle[0]->$insumoId_p) === true and $objDetalle[0]->$insumoId_p == $insumo->$insumoId) ? 'selected' : '' ?> value="<?php echo $insumo->$insumoId ?>"><!--validacion para traer dato  de foranea en editar poner tambien un null enel option value=""-->
                        <?php echo $insumo->$descripcion ?><!--validacion para traer dato  de foranea en editar-->
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>




    <!--linea para poner seguridad-->
   <!-- </?php if (session::getInstance()->hasCredential('admin')): //and session::getInstance()->hasCredential('emple')):  ?>-->
        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objDetalle)) ? 'update' : 'register')) ?>">
    </?php endif ?>
<?php // if(isset($objDetalleSalida)): ?>
        <!--<button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalle', 'index',array(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true) => request::getInstance()->getGet('id')) ) ?>"><?php echo i18n::__('return') ?> </a></button>-->
    <?php // else: ?>
    <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalle', 'index',array(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true) => request::getInstance()->getGet(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true))) ) ?>"><?php echo i18n::__('return') ?> </a></button>
<?php // endif; ?>



</form>

