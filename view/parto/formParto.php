
<?php use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\view\viewClass as view ?>

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
<?php $hoja_vida_id = hojaVidaTableClass::ID ?>
<?php $cerdo = hojaVidaTableClass::NOMBRE_CERDO ?><!--manejo de foranea para traer datos-->


<script>
  function fncTotal() {
    caja = document.forms["sumar"].elements;
    var <?php echo partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true) ?> = Number(caja["<?php echo partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true) ?>"].value);
    var <?php echo partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true) ?> = Number(caja["<?php echo partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true) ?>"].value);

<?php echo partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true) ?> = (<?php echo partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true) ?>) + (<?php echo partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true) ?>);
    if (!isNaN(<?php echo partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true) ?>)) {
      caja["<?php echo partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true) ?>"].value = (<?php echo partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true) ?>) + (<?php echo partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true) ?>);
    }
  }
</script>


<!--esto es boostrap no te el olvides de cerrar el div-->
<form name="sumar" role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('parto', ((isset($objParto)) ? 'update' : 'create')) ?>">
  <a href="formParto.php"></a>
  <?php if (isset($objParto) == true): ?>
    <input name="<?php echo partoTableClass::getNameField(partoTableClass::ID, true) ?>" value="<?php echo $objParto[0]->$id ?>" type="hidden">
  <?php endif ?>
  <div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->


    <?php view::includeHandlerMessage() ?>
    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('date_of_birth') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true)) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true)) : ((isset($objParto) == true) ? $objParto[0]->$fecha_nacimiento : '') ?>" type="date" name="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true) ?>">
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true) ?>" class="control-label col-xs-3 hidden"><?php echo i18n::__('number born') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true) ?>" class="form-control hidden" value="<?php echo request::getInstance()->hasPost(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true)) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true)) : ((isset($objParto) == true) ? $objParto[0]->$num_nacidos : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true) ?>" >
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('num_lives') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true)) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true)) : ((isset($objParto) == true) ? $objParto[0]->$num_vivos : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true) ?>" onkeyUp="fncTotal()" required>
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('num_deads') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true)) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true)) : ((isset($objParto) == true) ? $objParto[0]->$num_muertos : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true) ?>" onkeyUp="fncTotal()" required>
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('num_female') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true)) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true)) : ((isset($objParto) == true) ? $objParto[0]->$num_hembras : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true) ?>">
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('num_male') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true)) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true)) : ((isset($objParto) == true) ? $objParto[0]->$num_machos : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true) ?>">
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('date_pregnancy') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true)) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true)) : ((isset($objParto) == true) ? $objParto[0]->$fecha_montada : '') ?>" type="date" name="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true) ?>">
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::ID_PADRE, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo partoTableClass::getNameField(partoTableClass::ID_PADRE, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('father') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo partoTableClass::getNameField(partoTableClass::ID_PADRE, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(partoTableClass::getNameField(partoTableClass::ID_PADRE, true)) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::ID_PADRE, true)) : ((isset($objParto) == true) ? $objParto[0]->$id_padre : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::ID_PADRE, true) ?>">
        <?php if (session::getInstance()->hasFlash(partoTableClass::getNameField(partoTableClass::ID_PADRE, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>


    <?php if (session::getInstance()->hasError('inputCerdo')): ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputCerdo') ?><!--esta linea para actualizar demas formularios-->
      </div>
    <?php endif ?><!--se agrega antes de cada input-->

    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('pig') ?>:</label>
      <div class="col-xs-9">
        <select class="form-control" id="<?php partoTableClass::getNameField(partoTableClass::HOJA_VIDA_ID, TRUE) ?>" name="<?php echo partoTableClass::getNameField(partoTableClass::HOJA_VIDA_ID, TRUE); ?>">
          <option value="<?php echo (session::getInstance()->hasFlash('inputCerdo') or request::getInstance()->hasPost(partoTableClass::getNameField(partoTableClass::HOJA_VIDA_ID, true))) ? request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::HOJA_VIDA_ID, true)) : ((isset($objParto[0])) ? $objParto[0]->$hoja_vida_id_p : '') ?>"  type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::HOJA_VIDA_ID, true) ?>" placeholder="<?php echo i18n::__('pig') ?>">Seleccione Cerdo</option>
          <?php foreach ($objHojaVida as $hojaVida): ?>
            <option <?php echo (request::getInstance()->hasPost(partoTableClass::getNameField(partoTableClass::HOJA_VIDA_ID, true)) === true and request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::HOJA_VIDA_ID, true)) == $hojaVida->$hoja_vida_id) ? 'selected' : (isset($objParto[0]->$hoja_vida_id_p) === true and $objParto[0]->$hoja_vida_id_p == $hojaVida->$hoja_vida_id) ? 'selected' : '' ?> value="<?php echo $hojaVida->$hoja_vida_id ?>"><?php echo $hojaVida->$cerdo ?></option><!--sostenimiento de dato en foranea-->
            </option>
          <?php endforeach; ?>
        </select>
      </div>


    </div>


    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objParto)) ? 'update' : 'register')) ?>">

    <a class="btn btn-primary" href="<?php echo routing::getInstance()->getUrlWeb('parto', 'index') ?>"><?php echo i18n::__('return') ?> </a>
</form>
</div>