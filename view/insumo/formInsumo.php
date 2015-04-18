<!--@var $objInsumo
@var $descInsumo,$precio,$tipoInsumo,$fechaFabricacion,$fechaVencimiento,$proveedorId-->

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>



<?php $id = insumoTableClass::ID ?>
<?php $descInsumo = insumoTableClass::DESC_INSUMO ?>
<?php $precio = insumoTableClass::PRECIO ?>

<?php $tipoInsumo_i = insumoTableClass::TIPO_INSUMO_ID ?>
<?php $tipoInsumo = tipoInsumoTableClass::ID ?>
<?php $desc_tipoIn = tipoinsumoTableClass::DESC_TIPOIN ?><!--manejo de foranea para traer datos-->

<?php $fechaFabricacion = insumoTableClass::FECHA_FABRICACION ?>
<?php $fechaVencimiento = insumoTableClass::FECHA_VENCIMIENTO ?>

<?php $proveedorId_p = insumoTableClass::PROVEEDOR_ID ?>
<?php $proveedorId = proveedorTableClass::ID ?><!--manejo de foranea para traer datos-->
<?php $nombre = proveedorTableClass::NOMBRE ?>



<div class="container">
    <form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('insumo', ((isset($objInsumo)) ? 'updateInsumo' : 'createInsumo')) ?>">
        <?php if (isset($objInsumo) == true): ?>
            <input name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>" value="<?php echo $objInsumo[0]->$id ?>" type="hidden">
        <?php endif ?>

  
        <div class="form-group <?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true)) === true) ? 'has-error has-feedback' : '' ?>">
            <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('describe_product') ?>:</label>
            <div class="col-xs-9">
                <input id="<?php echo insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true) ?>" class="form-control" value="<?php echo ((isset($objInsumo) == true) ? $objInsumo[0]->$descInsumo : '') ?><?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true)) === true) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true)) : '' ?>" type="text" name="<?php echo insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true) ?>">
                <?php if (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true)) === true): ?>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <?php endif ?>
            </div>
        </div>

        <div class="form-group <?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::PRECIO, true)) === true) ? 'has-error has-feedback' : '' ?>">
            <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::PRECIO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('prise') ?>:</label>
            <div class="col-xs-9">
                <input id="<?php echo insumoTableClass::getNameField(insumoTableClass::PRECIO, true) ?>" class="form-control" value="<?php echo ((isset($objInsumo) == true) ? $objInsumo[0]->$precio : '') ?><?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::PRECIO, true)) === true) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PRECIO, true)) : '' ?>" type="text" name="<?php echo insumoTableClass::getNameField(insumoTableClass::PRECIO, true) ?>">
                <?php if (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::PRECIO, true)) === true): ?>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <?php endif ?>
            </div>
        </div>


        <div class="form-group">
            <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('type_product') ?>:</label>

            <div class="col-xs-9">
                <select class="form-control" id="<?php insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, TRUE) ?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, TRUE); ?>">
                    <option>Seleccione tipoinsumo</option>
                    <?php foreach ($objTipoin as $tipoin): ?><!--validacion para traer dato  de foranea en editar-->
                        <option <?php echo (isset($objInsumo[0]->$tipoInsumo_i) === true and $objInsumo[0]->$tipoInsumo_i == $tipoin->$tipoInsumo) ? 'selected' : '' ?> value="<?php echo $tipoin->$tipoInsumo ?>"><!--validacion para traer dato  de foranea en editar-->
                            <?php echo $tipoin->$desc_tipoIn ?><!--validacion para traer dato  de foranea en editar-->
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

       


        

            <div class="form-group <?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true)) === true) ? 'has-error has-feedback' : '' ?>">
                <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('date_manufacture') ?>:</label>
                <div class="col-xs-9">
                    <input id="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true) ?>" class="form-control" value="<?php echo ((isset($objInsumo) == true) ? $objInsumo[0]->$fechaFabricacion : '') ?><?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true)) === true) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true)) : '' ?>" type="date" name="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true) ?>">
                    <?php if (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true)) === true): ?>
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                    <?php endif ?>
                </div>
            </div>

             <div class="form-group <?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true)) === true) ? 'has-error has-feedback' : '' ?>">
                <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('date_conquering') ?>:</label>
                <div class="col-xs-9">
                    <input id="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true) ?>" class="form-control" value="<?php echo ((isset($objInsumo) == true) ? $objInsumo[0]->$fechaVencimiento : '') ?><?php echo (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true)) === true) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true)) : '' ?>" type="date" name="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true) ?>">
                    <?php if (session::getInstance()->hasFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true)) === true): ?>
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                    <?php endif ?>
                </div>
            </div>



           


            <div class="form-group">
                <label for="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('provisioner') ?>:</label>

                <div class="col-xs-9">
                    <select class="form-control" id="<?php insumoTableClass::getNameField(insumoTableClass::PROVEEDOR_ID, TRUE) ?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::PROVEEDOR_ID, TRUE); ?>">
                        <option>Seleccione proveedor</option>
                        <?php foreach ($objProv as $proveedor): ?><!--validacion para traer dato  de foranea en editar-->
                            <option <?php echo (isset($objInsumo[0]->$proveedorId_p) === true and $objInsumo[0]->$proveedorId_p == $proveedor->$proveedorId) ? 'selected' : '' ?> value="<?php echo $proveedor->$proveedorId ?>"><!--validacion para traer dato  de foranea en editar-->
                                <?php echo $proveedor->$nombre ?><!--validacion para traer dato  de foranea en editar-->
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>




<!--linea para poner seguridad-->
            <?php if(session::getInstance()->hasCredential('admin')): //and session::getInstance()->hasCredential('emple')): ?>
            <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objInsumo)) ? 'update' : 'register')) ?>">
            <?php endif ?>
            <a href="http://www.porcicolatapasco.com/index.php/insumo/index"><?php echo i18n::__('return') ?> </a>



    </form>
</div>

