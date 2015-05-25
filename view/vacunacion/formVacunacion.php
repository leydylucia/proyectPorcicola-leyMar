<!--@var $objVacunacion
@var $deosis,$precio,$tipoInsumo,$fechaFabricacion,$fechaVencimiento,$proveedorId-->

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



<?php $id = vacunacionTableClass::ID ?>
<?php $dosis = vacunacionTableClass::DOSIS ?>
<?php $hora = vacunacionTableClass::HORA?>

<?php $insumoId_i = vacunacionTableClass::INSUMO_ID?>
<?php $insumoId = insumoTableClass::ID ?>
<?php $desc_insumo = insumoTableClass::DESC_INSUMO ?><!--manejo de foranea para traer datos-->

<?php $idCerdo_c = vacunacionTableClass::ID_CERDO ?>
<?php $idCerdo = hojaVidaTableClass::ID ?>


    <?php view::includeHandlerMessage() ?>

<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', ((isset($objVacunacion)) ? 'updateVacunacion' : 'createVacunacion')) ?>">


<?php if (isset($objVacunacion) == true): ?>
        <input name="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::ID, true) ?>" value="<?php echo $objVacunacion[0]->$id ?>" type="hidden">
            <?php endif ?>


    <div class="form-group <?php echo (session::getInstance()->hasFlash(vacunacionTableClass::getNameField(vacunacionTableClass::DOSIS, true)) === true) ? 'has-error has-feedback' : '' ?>">
        <label for="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::DOSIS, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('Dose') ?>:</label>
        <div class="col-xs-9">
            <input id="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::DOSIS, true) ?>" class="form-control" value="<?php echo ((isset($objVacunacion) == true) ? $objVacunacion[0]->$dosis : '') ?><?php echo (session::getInstance()->hasFlash(vacunacionTableClass::getNameField(vacunacionTableClass::DOSIS, true)) === true) ? request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::DOSIS, true)) : '' ?>" type="text" name="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::DOSIS, true) ?>">
<?php if (session::getInstance()->hasFlash(vacunacionTableClass::getNameField(vacunacionTableClass::DOSIS, true)) === true): ?>
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
<?php endif ?>
        </div>
    </div>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(vacunacionTableClass::getNameField(vacunacionTableClass::HORA, true)) === true) ? 'has-error has-feedback' : '' ?>">
        <label for="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::HORA, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('Time') ?>:</label>
        <div class="col-xs-9">
            <input id="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::HORA, true) ?>" class="form-control" value="<?php echo ((isset($objVacunacion) == true) ? $objVacunacion[0]->$hora : '') ?><?php echo (session::getInstance()->hasFlash(vacunacionTableClass::getNameField(vacunacionTableClass::HORA, true)) === true) ? request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::HORA, true)) : '' ?>" type="time" name="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::HORA, true) ?>">
<?php if (session::getInstance()->hasFlash(vacunacionTableClass::getNameField(vacunacionTableClass::HORA, true)) === true): ?>
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
<?php endif ?>
        </div>
    </div>


    <div class="form-group">
        <label for="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('product') ?>:</label>

        <div class="col-xs-9">
            <select class="form-control" id="<?php vacunacionTableClass::getNameField(vacunacionTableClass::INSUMO_ID, TRUE) ?>" name="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::INSUMO_ID, TRUE); ?>">
                <option>Seleccione insumo</option>
<?php foreach ($objInsumo as $insumo): ?><!--validacion para traer dato  de foranea en editar-->
                    <option <?php echo (isset($objVacunacion[0]->$insumoId_i) === true and $objVacunacion[0]->$insumoId_i == $insumo->$insumoId) ? 'selected' : '' ?> value="<?php echo $insumo->$insumoId ?>"><!--validacion para traer dato  de foranea en editar-->
    <?php echo $insumo->$desc_insumo ?><!--validacion para traer dato  de foranea en editar-->
                    </option>
<?php endforeach; ?>
            </select>
        </div>
    </div>



<div class="form-group">
        <label for="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('pig') ?>:</label>

        <div class="col-xs-9">
            <select class="form-control" id="<?php vacunacionTableClass::getNameField(vacunacionTableClass::ID_CERDO, TRUE) ?>" name="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::ID_CERDO, TRUE); ?>">
                <option>Seleccione Cerdo</option>
<?php foreach ($objHojaVida as $hojaVida): ?><!--validacion para traer dato  de foranea en editar-->
                    <option <?php echo (isset($objHojaVida[0]->$idCerdo_c) === true and $objHojaVida[0]->$idCerdo_c == $hojaVida->$idCerdo) ? 'selected' : '' ?> value="<?php echo $hojaVida->$idCerdo ?>"><!--validacion para traer dato  de foranea en editar-->
    <?php echo $hojaVida->$idCerdo ?><!--validacion para traer dato  de foranea en editar-->
                    </option>
<?php endforeach; ?>
            </select>
        </div>
    </div>  
<!--
    <div class="form-group </?php echo (session::getInstance()->hasFlash(vacunacionTableClass::getNameField(vacunacionTableClass::ID_CERDO, true)) === true) ? 'has-error has-feedback' : '' ?>">
        <label for="</?php echo vacunacionTableClass::getNameField(vacunacionTableClass::ID_CERDO, true) ?>" class="control-label col-xs-3"></?php echo i18n::__('pig') ?>:</label>
        <div class="col-xs-9">
            <input id="</?php echo vacunacionTableClass::getNameField(vacunacionTableClass::ID_CERDO, true) ?>" class="form-control" value="</?php echo ((isset($objVacunacion) == true) ? $objVacunacion[0]->$idCerdo : '') ?></?php echo (session::getInstance()->hasFlash(vacunacionTableClass::getNameField(vacunacionTableClass::ID_CERDO, true)) === true) ? request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::ID_CERDO, true)) : '' ?>" type="text" name="</?php echo vacunacionTableClass::getNameField(vacunacionTableClass::ID_CERDO, true) ?>">
</?php if (session::getInstance()->hasFlash(vacunacionTableClass::getNameField(vacunacionTableClass::ID_CERDO, true)) === true): ?>
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
</?php endif ?>
        </div>
    </div>-->

    




  




    <!--linea para poner seguridad-->
<?php if (session::getInstance()->hasCredential('admin')): //and session::getInstance()->hasCredential('emple')):  ?>
        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objVacunacion)) ? 'update' : 'register')) ?>">
<?php endif ?>

        <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>"><?php echo i18n::__('return') ?> </a></button>




</form>

