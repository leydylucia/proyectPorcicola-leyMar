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



<?php $id = insumoTableClass::ID ?>
<?php $descInsumo = insumoTableClass::DESC_INSUMO ?>
<?php $precio = insumoTableClass::PRECIO ?>

<?php $tipoInsumo_i = insumoTableClass::TIPO_INSUMO_ID ?>
<?php $tipoInsumo = tipoInsumoTableClass::ID ?>
<?php $desc_tipoIn = tipoinsumoTableClass::DESC_TIPOIN ?><!--manejo de foranea para traer datos-->

<?php $fechaFabricacion = insumoTableClass::FECHA_FABRICACION ?>
<?php $fechaVencimiento = insumoTableClass::FECHA_VENCIMIENTO ?>

<?php $insumoId_p = insumoTableClass::PROVEEDOR_ID ?>
<?php $insumoId = proveedorTableClass::ID ?><!--manejo de foranea para traer datos-->
<?php $nombre = proveedorTableClass::NOMBRE ?>

<?php view::includeHandlerMessage() ?>

<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('insumo', ((isset($objInsumo)) ? 'updateInsumo' : 'createInsumo')) ?>">


    <?php if (isset($objInsumo) == true): ?>
        <input name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>" value="<?php echo $objInsumo[0]->$id ?>" type="hidden">
    <?php endif ?>

    <?php if (session::getInstance()->hasError('inputDescInsumo')): ?><!--inicio de validaciones-->
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDescInsumo') ?><!--esta linea para actualizar demas formularios-->
        </div>
    <?php endif ?><!--fin de validaciones-->

    <div class="form-group <?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true)) === true) ? 'has-error has-feedback' : '' ?>">
        <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('describe_product') ?>:</label>
        <div class="col-xs-9">
            <input id="<?php echo insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true)) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true)) : ((isset($objInsumo) == true) ? $objInsumo[0]->$descInsumo : '') ?>" type="text" name="<?php echo insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true) ?>">
            <?php if (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true)) === true): ?>
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            <?php endif ?>
        </div>
    </div>

    <?php if (session::getInstance()->hasError('inputPrecio')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputPrecio') ?><!--esta linea para actualizar demas formularios-->
        </div>
    <?php endif ?>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::PRECIO, true)) === true) ? 'has-error has-feedback' : '' ?>">
        <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::PRECIO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('prise') ?>:</label>
        <div class="col-xs-9">
            <input id="<?php echo insumoTableClass::getNameField(insumoTableClass::PRECIO, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::PRECIO, true)) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PRECIO, true)) : ((isset($objInsumo) == true) ? $objInsumo[0]->$precio : '') ?>" type="text" name="<?php echo insumoTableClass::getNameField(insumoTableClass::PRECIO, true) ?>">
            <?php if (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::PRECIO, true)) === true): ?>
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            <?php endif ?>
        </div>
    </div>

<?php if(session::getInstance()->hasError('inputProveedor')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputProveedor') ?><!--esta linea para actualizar demas formularios-->
    </div>
    <?php endif ?>
    
    
    <div class="form-group">
        <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('type_product') ?>:</label>

        <div class="col-xs-9">
            <select class="form-control" id="<?php insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, TRUE) ?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, TRUE); ?>">
                <option value="<?php echo (session::getInstance()->hasFlash('inputTipoIn') or request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true))) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true)) : ((isset($objInsumo[0])) ? $objInsumo[0]->$insumoId_p : '') ?>">Seleccione tipoinsumo</option>
                <?php foreach ($objTipoin as $tipoin): ?><!--validacion para traer dato  de foranea en editar-->
                    <option <?php echo (isset($objInsumo[0]->$tipoInsumo_i) === true and $objInsumo[0]->$tipoInsumo_i == $tipoin->$tipoInsumo) ? 'selected' : '' ?> value="<?php echo $tipoin->$tipoInsumo ?>"><!--validacion para traer dato  de foranea en editar-->
                        <?php echo $tipoin->$desc_tipoIn ?><!--validacion para traer dato  de foranea en editar-->
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>




<?php if (session::getInstance()->hasError('inputFechaFabricacion')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputFechaFabricacion') ?><!--esta linea para actualizar demas formularios-->
        </div>
    <?php endif ?>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true)) === true) ? 'has-error has-feedback' : '' ?>">
        <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('date_manufacture') ?>:</label>
        <div class="col-xs-9">
            <input id="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true)) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true)) : ((isset($objInsumo) == true) ? $objInsumo[0]->$fechaFabricacion : '') ?>" type="date" name="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true) ?>">
            <?php if (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true)) === true): ?>
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            <?php endif ?>
        </div>
    </div>

  <?php if (session::getInstance()->hasError('inputFechaVencimiento')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputFechaVencimiento') ?><!--esta linea para actualizar demas formularios-->
        </div>
    <?php endif ?>      
        
    <div class="form-group <?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true)) === true) ? 'has-error has-feedback' : '' ?>">
        <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('date_conquering') ?>:</label>
        <div class="col-xs-9">
            <input id="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true)) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true)) : ((isset($objInsumo) == true) ? $objInsumo[0]->$fechaVencimiento : '') ?>" type="date" name="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true) ?>">
            <?php if (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true)) === true): ?>
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            <?php endif ?>
        </div>
    </div>



<?php if(session::getInstance()->hasError('inputProveedor')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputProveedor') ?><!--esta linea para actualizar demas formularios-->
    </div>
    <?php endif ?>
    


    <div class="form-group">
        <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('provisioner') ?>:</label>

        <div class="col-xs-9">
            <select class="form-control" id="<?php insumoTableClass::getNameField(insumoTableClass::PROVEEDOR_ID, TRUE) ?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::PROVEEDOR_ID, TRUE); ?>">
                <option value="<?php echo (session::getInstance()->hasFlash('inputTipoIn') or request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true))) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true)) : ((isset($objInsumo[0])) ? $objInsumo[0]->$tipoInsumo_i : '') ?>">Seleccione proveedor</option>
                <?php foreach ($objProv as $insumo): ?><!--validacion para traer dato  de foranea en editar-->
                    <option <?php echo (isset($objInsumo[0]->$insumoId_p) === true and $objInsumo[0]->$insumoId_p == $insumo->$insumoId) ? 'selected' : '' ?> value="<?php echo $insumo->$insumoId ?>"><!--validacion para traer dato  de foranea en editar-->
                        <?php echo $insumo->$nombre ?><!--validacion para traer dato  de foranea en editar-->
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>




    <!--linea para poner seguridad-->
    <?php if (session::getInstance()->hasCredential('admin')): //and session::getInstance()->hasCredential('emple')):  ?>
        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objInsumo)) ? 'update' : 'register')) ?>">
    <?php endif ?>

    <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>"><?php echo i18n::__('return') ?> </a></button>




</form>

