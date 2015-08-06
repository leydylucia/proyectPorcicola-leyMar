<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>


<?php $id = tipovTableClass::ID ?>
<?php $desc_tipoV = tipovTableClass::DESC_TIPOV ?>


<?php view::includeHandlerMessage() ?>
<div class="container">
    <form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', ((isset($objTipoV)) ? 'updateTipov' : 'createTipov')) ?>">
        <?php if (isset($objTipoV) == true): ?>
            <input name="<?php echo tipovTableClass::getNameField(tipovTableClass::ID, true) ?>" value="<?php echo $objTipoV[0]->$id ?>" type="hidden">
        <?php endif ?>

        <?php if (session::getInstance()->hasError('inputDescTipoV')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDescTipoV') ?><!--esta linea para actualizar demas formularios-->
            </div>
        <?php endif ?><!--se agrega antes de cada input-->


        <div class="form-group">
            <label for="desc_tipoIn" class="control-label col-xs-3"><?php echo i18n::__('describe') ?>:</label>

            <div class="col-xs-9">
                <input id="<?php echo tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true)) ? request::getInstance()->getPost(tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true)) : ((isset($objTipoV) == true) ? $objTipoV[0]->$desc_tipoV : '') ?>" type="text" name="<?php echo tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true) ?>">
            </div>


            <br>

            <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objTipoV)) ? 'update' : 'register')) ?>">

            <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'indexTipov') ?>"><?php echo i18n::__('return') ?> </a> </button>



    </form>
</div>

