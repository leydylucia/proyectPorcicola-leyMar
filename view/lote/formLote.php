
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

<?php $id = loteTableClass::ID ?>
<?php $desc_lote = loteTableClass::DESC_LOTE ?>
<?php $ubicacion = loteTableClass::UBICACION ?>


<!--esto es boostrap no te el olvides de cerrar el div-->
<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('lote', ((isset($objLote)) ? 'update' : 'create')) ?>">
  <?php if (isset($objLote) == true): ?>
    <input name="<?php echo loteTableClass::getNameField(loteTableClass::ID, true) ?>" value="<?php echo $objLote[0]->$id ?>" type="hidden">
  <?php endif ?>
  <div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->


    <?php view::includeHandlerMessage() ?>
    <div class="form-group <?php echo (session::getInstance()->hasFlash(loteTableClass::getNameField(loteTableClass::DESC_LOTE, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo loteTableClass::getNameField(loteTableClass::DESC_LOTE, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('desc_lot') ?>:</label>
      <div class="col-xs-9">
       <input id="<?php echo loteTableClass::getNameField(loteTableClass::DESC_LOTE, true) ?>" class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputDesc') or request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::DESC_LOTE, true))) ? request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESC_LOTE, true)) : ((isset($objLote[0])) ? $objLote[0]->$desc_lote : '') ?>" type="text" name="<?php echo loteTableClass::getNameField(loteTableClass::DESC_LOTE, true) ?>"><!--linea de sostenimiento de datos-->
       <!--<input id="<?php // echo loteTableClass::getNameField(loteTableClass::DESC_LOTE, true) ?>" class="form-control" value="<?php // echo ((isset($objLote) == true) ? $objLote[0]->$desc_lote : '') ?><?php // echo (session::getInstance()->hasFlash(loteTableClass::getNameField(loteTableClass::DESC_LOTE, true)) === true) ? request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::DESC_LOTE, true)) : '' ?>" type="text" name="<?php // echo loteTableClass::getNameField(loteTableClass::DESC_LOTE, true) ?>">-->
        <?php if (session::getInstance()->hasFlash(loteTableClass::getNameField(loteTableClass::DESC_LOTE, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>


    <div class="form-group <?php echo (session::getInstance()->hasFlash(loteTableClass::getNameField(loteTableClass::UBICACION, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo loteTableClass::getNameField(loteTableClass::UBICACION, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('location') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo loteTableClass::getNameField(loteTableClass::DESC_LOTE, true) ?>" class="form-control" value="<?php echo (session::getInstance()->hasFlash('inputUbicacion') or request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::UBICACION, true))) ? request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true)) : ((isset($objLote[0])) ? $objLote[0]->$ubicacion : '') ?>" type="text" name="<?php echo loteTableClass::getNameField(loteTableClass::UBICACION, true) ?>"><!--linea de sostenimiento de datos-->
        <!--<input id="<?php // echo loteTableClass::getNameField(loteTableClass::UBICACION, true) ?>" class="form-control" value="<?php // echo ((isset($objLote) == true) ? $objLote[0]->$ubicacion : '') ?><?php // echo (session::getInstance()->hasFlash(loteTableClass::getNameField(loteTableClass::UBICACION, true)) === true) ? request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::UBICACION, true)) : '' ?>" type="text" name="<?php // echo loteTableClass::getNameField(loteTableClass::UBICACION, true) ?>">-->
        <?php if (session::getInstance()->hasFlash(loteTableClass::getNameField(loteTableClass::UBICACION, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objLote)) ? 'update' : 'register')) ?>">

    <a class="btn btn-primary" href="<?php echo routing::getInstance()->getUrlWeb('lote', 'index') ?>"><?php echo i18n::__('return') ?> </a>
</form>
</div>
