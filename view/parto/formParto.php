
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\view\viewClass as view ?>

<?php $id = partoTableClass::ID ?>
<?php $fecha_nacimiento = partoTableClass::FECHA_NACIMIENTO ?>
<?php $num_nacidos = partoTableClass::NUM_NACIDOS ?>
<?php $num_vivos = partoTableClass::NUM_VIVOS ?>
<?php $num_muertos = partoTableClass::NUM_MUERTOS ?>
<?php $num_hembras = partoTableClass::NUM_HEMBRAS ?>
<?php $num_machos = partoTableClass::NUM_MACHOS ?>
<?php $fecha_montada = partoTableClass::FECHA_MONTADA ?>
<?php $id_padre = partoTableClass::ID_PADRE ?>
<?php $hoja_vida_id_p = partoTableClass::HOJA_VIDA_ID ?>
<?php $hoja_vida_id = hojaVidaTableClass::ID ?><!--manejo de foranea para traer datos-->



<!--esto es boostrap no te el olvides de cerrar el div-->
<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('parto', ((isset($objParto)) ? 'update' : 'create')) ?>">
  <?php if (isset($objParto) == true): ?>
    <input name="<?php echo partoTableClass::getNameField(partoTableClass::ID, true) ?>" value="<?php echo $objParto[0]->$id ?>" type="hidden">
  <?php endif ?>
  <div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->


    <?php view::includeHandlerMessage() ?>
    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('name') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true) ?>" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$fecha_nacimiento : '') ?><?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true)) === true) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true)) : '' ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true) ?>">
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('name') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true) ?>" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$num_nacidos : '') ?><?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true)) === true) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true)) : '' ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true) ?>">
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('num_lives') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true) ?>" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$num_vivos : '') ?><?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true)) === true) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true)) : '' ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true) ?>">
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('num_deads') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true) ?>" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$num_muertos : '') ?><?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true)) === true) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true)) : '' ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true) ?>">
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('num_female') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true) ?>" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$num_hembras : '') ?><?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true)) === true) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true)) : '' ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true) ?>">
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('num_male') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true) ?>" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$num_machos : '') ?><?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true)) === true) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true)) : '' ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true) ?>">
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('date_pregnancy') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true) ?>" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$fecha_montada : '') ?><?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true)) === true) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true)) : '' ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true) ?>">
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::ID_PADRE, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::ID_PADRE, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('id_father') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::ID_PADRE, true) ?>" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$id_padre : '') ?><?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::ID_PADRE, true)) === true) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::ID_PADRE, true)) : '' ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::ID_PADRE, true) ?>">
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::ID_PADRE, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    

    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('pig') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php partoTableClass::getNameField(partoTableClass::HOJA_VIDA_ID, TRUE) ?>" name="<?php echo partoTableClass::getNameField(partoTableClass::HOJA_VIDA_ID, TRUE); ?>">
          <option>Seleccione Cerdo</option>
          <?php foreach ($objHojaVida as $hojaVida): ?>
            <option <?php echo (isset($objHojaVida[0]->$hoja_vida_id_p) === true and $objHojaVida[0]->$hoja_vida_id_p == $hojaVida->$hoja_vida_id) ? 'selected' : '' ?> value="<?php echo $hojaVida->$hoja_vida_id ?>">
              <?php echo $hojaVida->$hoja_vida_id ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>


    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objParto)) ? 'update' : 'register')) ?>">

    <a href="<?php echo routing::getInstance()->getUrlWeb('parto', 'index') ?>"><?php echo i18n::__('return') ?> </a>
</form>
</div>