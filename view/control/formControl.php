<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\view\viewClass as view ?>

<?php $id = controlTableClass::ID ?>
<?php $peso_cerdo = controlTableClass::PESO_CERDO ?>
<?php $empleado_id_c = controlTableClass::EMPLEADO_ID ?>
<?php $empleado_id = empleadoTableClass::ID ?>
<?php $nombre = empleadoTableClass::NOMBRE ?><!--manejo de foranea para traer datos-->



<!--esto es boostrap no te el olvides de cerrar el div-->
<form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('control', ((isset($objControl)) ? 'update' : 'create')) ?>">
  <?php if (isset($objControl) == true): ?>
    <input name="<?php echo controlTableClass::getNameField(controlTableClass::ID, true) ?>" value="<?php echo $objControl[0]->$id ?>" type="hidden">
  <?php endif ?>
  <div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->


    <?php view::includeHandlerMessage() ?>
    <div class="form-group <?php echo (session::getInstance()->hasFlash(controlTableClass::getNameField(controlTableClass::PESO_CERDO, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo controlTableClass::getNameField(controlTableClass::PESO_CERDO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('pig weight') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo controlTableClass::getNameField(controlTableClass::PESO_CERDO, true) ?>" class="form-control" value="<?php echo ((isset($objControl) == true) ? $objControl[0]->$peso_cerdo : '') ?><?php echo (session::getInstance()->hasFlash(controlTableClass::getNameField(controlTableClass::PESO_CERDO, true)) === true) ? request::getInstance()->getPost(controlTableClass::getNameField(controlTableClass::PESO_CERDO, true)) : '' ?>" type="text" name="<?php echo controlTableClass::getNameField(controlTableClass::PESO_CERDO, true) ?>">
        <?php if (session::getInstance()->hasFlash(controlTableClass::getNameField(controlTableClass::PESO_CERDO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    
<div class="form-group">
      <label for="#" class="control-label col-xs-3"><?php echo i18n::__('employee') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php controlTableClass::getNameField(controlTableClass::EMPLEADO_ID, TRUE) ?>" name="<?php echo controlTableClass::getNameField(controlTableClass::EMPLEADO_ID, TRUE); ?>">
          <option>Seleccione Empleado</option>
          <?php foreach ($objEmpleado as $empleado): ?>
          <option <?php echo (isset($objEmpleado[0]->$empleado_id_c) === true and $objControl[0]->$$empleado_id_c == $empleado->$empleado_id) ? 'selected' : '' ?> value="<?php echo $empleado->$empleado_id ?>">
          <?php  echo $empleado->$nombre ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>



    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objControl)) ? 'update' : 'register')) ?>">

    <a href="<?php echo routing::getInstance()->getUrlWeb('control', 'index') ?>"><?php echo i18n::__('return') ?> </a>
</div>
</form>
