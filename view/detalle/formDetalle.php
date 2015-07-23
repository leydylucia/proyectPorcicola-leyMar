
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\view\viewClass as view ?>

<?php $id = detalleEntradaTableClass::ID ?>
<?php $cantidad = detalleEntradaTableClass::CANTIDAD ?>
<?php $valor = detalleEntradaTableClass::VALOR ?>
<?php $entrada_bodega_id_e = detalleEntradaTableClass::ENTRADA_BODEGA_ID ?>
<?php $entrada_bodega_id = entradaTableClass::ID ?>
<?php $insumo_id_e = detalleEntradaTableClass::INSUMO_ID ?>
<?php $insumo_id = insumoTableClass::ID ?>
<?php $desc_insumo = insumoTableClass::DESC_INSUMO ?><!--manejo de foranea para traer datos-->



<!--esto es boostrap no te el olvides de cerrar el div-->
<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('detalle', ((isset($objDetalle)) ? 'update' : 'create')) ?>">
  <?php if (isset($objDetalle) == true): ?>
    <input name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID, true) ?>" value="<?php echo $objDetalle[0]->$id ?>" type="hidden">
  <?php endif ?>
  <div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->


    <?php view::includeHandlerMessage() ?>
    <div class="form-group <?php echo (session::getInstance()->hasFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('cant') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true) ?>" class="form-control" value="<?php echo ((isset($objDetalle) == true) ? $objDetalle[0]->$cantidad : '') ?><?php echo (session::getInstance()->hasFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true)) === true) ? request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true)) : '' ?>" type="text" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true) ?>">
        <?php if (session::getInstance()->hasFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>


    <div class="form-group <?php echo (session::getInstance()->hasFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('value') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true) ?>" class="form-control" value="<?php echo ((isset($objDetalle) == true) ? $objDetalle[0]->$valor : '') ?><?php echo (session::getInstance()->hasFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true)) === true) ? request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true)) : '' ?>" type="text" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true) ?>">
        <?php if (session::getInstance()->hasFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>
    
    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('cellar entry') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, TRUE) ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, TRUE); ?>">
          <option>Seleccione Entrada</option>
          <?php foreach ($objEntrada as $entrada): ?>
          <option <?php echo (isset($objDetalle[0]->$entrada_bodega_id_e) === true and $objDetalle[0]->$entrada_bodega_id_e == $entrada->$entrada_bodega_id) ? 'selected' : '' ?> value="<?php echo $entrada->$entrada_bodega_id ?>">
          <?php  echo $entrada->$entrada_bodega_id ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    
    
    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('product') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php detalleEntradaTableClass::getNameField(detalleEntradaTableClass::INSUMO_ID, TRUE) ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::INSUMO_ID, TRUE); ?>">
          <option>Seleccione Insumo</option>
          <?php foreach ($objInsumo as $insumo): ?>
          <option <?php echo (isset($objDetalle[0]->$insumo_id_e) === true and $objDetalle[0]->$insumo_id_e == $insumo->$insumo_id) ? 'selected' : '' ?> value="<?php echo $insumo->$insumo_id ?>">
          <?php  echo $insumo->$desc_insumo ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objDetalle)) ? 'update' : 'register')) ?>">

    <a href="<?php echo routing::getInstance()->getUrlWeb('detalle', 'index') ?>"><?php echo i18n::__('return') ?> </a>
</form>
</div>
