
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

        <?php $id = tipoInsumoTableClass::ID ?>
        <?php $desc_tipoIn = tipoInsumoTableClass::DESC_TIPOIN ?>


        <?php view::includeHandlerMessage() ?>
<div class="container">
    <form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('insumo', ((isset($objTipoin)) ? 'updateTipoin' : 'createTipoin')) ?>">
<?php if (isset($objTipoin) == true): ?>
            <input name="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID, true) ?>" value="<?php echo $objTipoin[0]->$id ?>" type="hidden">
                <?php endif ?>

                <?php view::includeHandlerMessage() ?>
        <div class="form-group <?php echo (session::getInstance()->hasFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true)) === true) ? 'has-error has-feedback' : '' ?>">
            <label for="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('describe_typeProduct') ?>:</label>
            <div class="col-xs-9">
                <input id="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true) ?>" class="form-control" value="<?php echo ((isset($objTipoin) == true) ? $objTipoin[0]->$desc_tipoIn : '') ?><?php echo (session::getInstance()->hasFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true)) === true) ? request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true)) : '' ?>" type="text" name="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true) ?>">
<?php if (session::getInstance()->hasFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true)) === true): ?>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
<?php endif ?>
            </div>
        </div>


        <!--        <div class="form-group">
                    <label for="desc_tipoIn" class="control-label col-xs-3"></?php echo i18n::__('describe_typeProduct') ?>:</label>
        
                    <div class="col-xs-9"><input id="desc_tipoIn" class="form-control" value="</?php echo ((isset($objTipoin) == true) ? $objTipoin[0]->$desc_tipoIn : '') ?>" type="text" name="</?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true) ?>">
                </div>-->


        <br>

        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objTipoin)) ? 'update' : 'register')) ?>">

        <a href="http://www.porcicolatapasco.com/index.php/tipoInsumo/index"><?php echo i18n::__('return') ?> </a>




    </form>
</div>

