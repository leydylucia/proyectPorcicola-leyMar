
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\view\viewClass as view ?>

<?php $id = hojaVidaTableClass::ID ?>
<?php $genero = hojaVidaTableClass::GENERO ?>
<?php $fecha_nacimiento = hojaVidaTableClass::FECHA_NACIMIENTO ?>
<?php $id_madre = hojaVidaTableClass::ID_MADRE ?>
<?php $estado_id_p = hojaVidaTableClass::ESTADO_ID ?>
<?php $estado_id = estadoTableClass::ID ?>
<?php $desc_estado = estadoTableClass::DESC_ESTADO ?>
<?php $lote_id_e = hojaVidaTableClass::LOTE_ID ?>
<?php $lote_id = loteTableClass::ID ?>
<?php $desc_lote = loteTableClass::DESC_LOTE ?>
<?php $raza_id_a = hojaVidaTableClass::RAZA_ID ?>
<?php $raza_id = razaTableClass::ID ?>
<?php $desc_raza = razaTableClass::DESC_RAZA ?><!--manejo de foranea para traer datos-->



<!--esto es boostrap no te el olvides de cerrar el div-->
<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', ((isset($objEmpleado)) ? 'update' : 'create')) ?>">
  <?php if (isset($objHojaVida) == true): ?>
    <input name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ID, true) ?>" value="<?php echo $objHojaVida[0]->$id ?>" type="hidden">
  <?php endif ?>
  <div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->


    <?php view::includeHandlerMessage() ?>
    <div class="form-group <?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('genre') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true) ?>" class="form-control" value="<?php echo ((isset($objHojaVida) == true) ? $objHojaVida[0]->$genero : '') ?><?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true)) === true) ? request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true)) : '' ?>" type="text" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true) ?>">
        <?php if (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('date_birth') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true) ?>" class="form-control" value="<?php echo ((isset($objHojaVida) == true) ? $objHojaVida[0]->$fecha_nacimiento : '') ?><?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true)) === true) ? request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true)) : '' ?>" type="text" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true) ?>">
        <?php if (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::FECHA_NACIMIENTO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>


    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('state') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php hojaVidaTableClass::getNameField(hojaVidaTableClass::ESTADO_ID, TRUE) ?>" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ESTADO_ID, TRUE); ?>">
          <option>Seleccione Estado</option>
          <?php foreach ($objEstado as $estado): ?>
            <option <?php echo (isset($objEstado[0]->$estado_id_p) === true and $objHojaVida[0]->$estado_id_p == $estado->$estado_id) ? 'selected' : '' ?> value="<?php echo $estado->$estado_id ?>">
              <?php echo $estado->$desc_estado ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('batch') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php hojaVidaTableClass::getNameField(hojaVidaTableClass::LOTE_ID, TRUE) ?>" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::LOTE_ID, TRUE); ?>">
          <option>Seleccione Lote</option>
          <?php foreach ($objLote as $lote): ?>
            <option <?php echo (isset($objLote[0]->$lote_id_e) === true and $objLote[0]->$lote_id_e == $lote->$lote_id) ? 'selected' : '' ?> value="<?php echo $lote->$lote_id ?>">
              <?php echo $lote->$desc_lote ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>


    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('race') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php hojaVidaTableClass::getNameField(hojaVidaTableClass::RAZA_ID, TRUE) ?>" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::RAZA_ID, TRUE); ?>">
          <option>Seleccione Raza</option>
          <?php foreach ($objRaza as $raza): ?>
            <option <?php echo (isset($objRaza[0]->$raza_id_a) === true and $objRaza[0]->$raza_id_a == $raza->$raza_id) ? 'selected' : '' ?> value="<?php echo $raza->$raza_id ?>">
              <?php echo $raza->$desc_raza ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>


    <div class="form-group <?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('mother') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true) ?>" class="form-control" value="<?php echo ((isset($objHojaVida) == true) ? $objHojaVida[0]->$id_madre : '') ?><?php echo (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true)) === true) ? request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true)) : '' ?>" type="text" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true) ?>">
        <?php if (session::getInstance()->hasFlash(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID_MADRE, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>   


    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objHojaVida)) ? 'update' : 'register')) ?>">

    <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'index') ?>"><?php echo i18n::__('return') ?> </a>
</form>
</div>
