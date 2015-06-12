<!--@var $objInsumo
@var $descInsumo,$precio,$tipoInsumo,$fechaFabricacion,$fechaVencimiento,$proveedorId-->

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\view\viewClass as view ?>



<?php $id = sacrificiovTableClass::ID ?>
<?php $valor = sacrificiovTableClass::VALOR ?>
<?php $tipoVenta_v = sacrificiovTableClass::TIPO_VENTA_ID ?>
<?php $tipoVenta = tipovTableClass::ID ?>
<?php $desc_tipoV = tipovTableClass::DESC_TIPOV ?><!--manejo de foranea para traer datos-->

<?php $idCerdo_c = sacrificiovTableClass::ID_CERDO ?>
<?php $idCerdo = hojaVidaTableClass::ID ?>

<?php view::includeHandlerMessage() ?>

<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', ((isset($objSacrificioV)) ? 'updateSacrificioVenta' : 'createSacrificioVenta')) ?>">
    <?php if (isset($objSacrificioV) == true): ?>
        <input name="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID, true) ?>" value="<?php echo $objSacrificioV[0]->$id ?>" type="hidden">
    <?php endif ?>

         <?php if(session::getInstance()->hasError('inputValor')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputValor') ?><!--esta linea para actualizar demas formularios-->
    </div>
    <?php endif ?><!--se agrega antes de cada input-->
  

    <div class="form-group <?php echo (session::getInstance()->hasFlash(sacrificiovTableClass::getNameField(sacrificiovTableClass::VALOR, true)) === true) ? 'has-error has-feedback' : '' ?>">
        <label for="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::VALOR, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('sale') ?>:</label>
        <div class="col-xs-9">
            <input id="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::VALOR, true) ?>" class="form-control" value="<?php echo ((isset($objSacrificioV) == true) ? $objSacrificioV[0]->$valor : '') ?><?php echo (session::getInstance()->hasFlash(sacrificiovTableClass::getNameField(sacrificiovTableClass::VALOR, true)) === true) ? request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::VALOR, true)) : '' ?>" type="text" name="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::VALOR, true) ?>">
            <?php if (session::getInstance()->hasFlash(sacrificiovTableClass::getNameField(sacrificiovTableClass::VALOR, true)) === true): ?>
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            <?php endif ?>
        </div>
    </div>


    <!--    <div class="form-group">
            <label for="</?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID, true) ?>" class="control-label col-xs-3"></?php echo i18n::__('type sale') ?>:</label>
    
            <div class="col-xs-9">
                <select class="form-control" id="</?php sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, TRUE) ?>" name="</?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, TRUE); ?>">
                    <option>Seleccione tipo venta</option>
    </?php foreach ($objTipoV as $tipoV): ?>validacion para traer dato  de foranea en editar
                        <option </?php echo (isset($objSacrificioV[0]->$tipoVenta_v) === true and $objSacrificioV[0]->$tipoVenta_v == $tipoV->$tipoVenta) ? 'selected' : '' ?> value="</?php echo $tipoV->$tipoVenta ?>">validacion para traer dato  de foranea en editar
        </?php echo $tipoV->$desc_tipoV ?>validacion para traer dato  de foranea en editar
                        </option>
    </?php endforeach; ?>
                </select>
            </div>
        </div>-->



    <div class="form-group">
        <label for="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('type_sale') ?>:</label>

        <div class="col-xs-9">
            <select class="form-control" id="<?php sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, TRUE) ?>" name="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, TRUE); ?>">
                <option>Seleccione tipo venta</option>
<?php foreach ($objTipoV as $tipoV): ?><!--validacion para traer dato  de foranea en editar-->
                    <option <?php echo (isset($objSacrificioV[0]->$tipoVenta_v) === true and $objSacrificioV[0]->$tipoVenta_v == $tipoV->$tipoVenta) ? 'selected' : '' ?> value="<?php echo $tipoV->$tipoVenta ?>"><!--validacion para traer dato  de foranea en editar-->
    <?php echo $tipoV->$desc_tipoV ?><!--validacion para traer dato  de foranea en editar-->
                    </option>
<?php endforeach; ?>
            </select>
        </div>
    </div>
    
<div class="form-group">
        <label for="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('pig') ?>:</label>

        <div class="col-xs-9">
            <select class="form-control" id="<?php sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, TRUE) ?>" name="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, TRUE); ?>">
                <option>Seleccione Cerdo</option>
<?php foreach ($objHojaVida as $hojaVida): ?><!--validacion para traer dato  de foranea en editar-->
                    <option <?php echo (isset($objSacrificioV[0]->$idCerdo_c) === true and $objSacrificioV[0]->$idCerdo_c == $hojaVida->$idCerdo) ? 'selected' : '' ?> value="<?php echo $hojaVida->$idCerdo ?>"><!--validacion para traer dato  de foranea en editar-->
    <?php echo $hojaVida->$idCerdo ?><!--validacion para traer dato  de foranea en editar-->
                    </option>
<?php endforeach; ?>
            </select>
        </div>
    </div>    




<!--
    <div class="form-group </?php echo (session::getInstance()->hasFlash(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) === true) ? 'has-error has-feedback' : '' ?>">
        <label for="</?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true) ?>" class="control-label col-xs-3"></?php echo i18n::__('pig') ?>:</label>
        <div class="col-xs-9">
            <input id="</?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true) ?>" class="form-control" value="</?php echo ((isset($objSacrificioV) == true) ? $objSacrificioV[0]->$idCerdo : '') ?></?php echo (session::getInstance()->hasFlash(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) === true) ? request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) : '' ?>" type="text" name="</?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true) ?>">
            </?php if (session::getInstance()->hasFlash(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) === true): ?>
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            </?php endif ?>
        </div>
    </div>-->





    <!--linea para poner seguridad-->
    <!--</?php if (session::getInstance()->hasCredential('admin')): //and session::getInstance()->hasCredential('emple')):  ?>-->
    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objSacrificioV)) ? 'update' : 'register')) ?>">
    <!--</?php endif ?>-->

    <a href="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'indexSacrificioVenta') ?>"><?php echo i18n::__('return') ?> </a>




</form>

