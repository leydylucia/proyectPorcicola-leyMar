
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


        <?php if (session::getInstance()->hasError('inputDescTipoIn')): ?><!--inicio de validaciones-->
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDescTipoIn') ?><!--esta linea para actualizar demas formularios-->
            </div>
        <?php endif ?><!--fin de validaciones-->


        <div class="form-group <?php echo (session::getInstance()->hasFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true)) === true) ? 'has-error has-feedback' : '' ?>">
            <label for="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('describe_typeProduct') ?>:</label>
            <div class="col-xs-9">
                <input id="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true) ?>" class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputDescTipoIn') or request::getInstance()->hasPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true))) ? request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true)) : ((isset($objTipoin[0])) ? $objTipoin[0]->$desc_tipoIn : '') ?>" type="text" name="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true) ?>">
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

         <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexTipoin') ?>"><?php echo i18n::__('return') ?> </a></button>




    </form>
</div>

