<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\view\viewClass as view ?>


<?php $id = controlTableClass::ID ?>
<?php $peso_cerdo = controlTableClass::PESO_CERDO ?>
<?php $control_id_c = controlTableClass::EMPLEADO_ID ?>
<?php $control_id = empleadoTableClass::ID ?>
<?php $nombre = empleadoTableClass::NOMBRE ?>
<?php $apellido = empleadoTableClass::APELLIDO ?>
<?php $hoja_vida_id_h = controlTableClass::HOJA_VIDA ?>
<?php $hoja_vida_id = hojaVidaTableClass::ID ?>
<?php $cerdo = hojaVidaTableClass::NOMBRE_CERDO ?>
<?php $unidad_medida_id_p = controlTableClass::UNIDAD_MEDIDA_ID ?>
<?php $unidad_medida_id = unidadMedidaTableClass::ID ?>
<?php $descripcion = unidadMedidaTableClass::DESCRIPCION ?><!--manejo de foranea para traer datos-->



<!--esto es boostrap no te el olvides de cerrar el div-->
<form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('control', ((isset($objControl)) ? 'update' : 'create')) ?>">
  <?php if (isset($objControl) == true): ?>
    <input name="<?php echo controlTableClass::getNameField(controlTableClass::ID, true) ?>" value="<?php echo $objControl[0]->$id ?>" type="hidden">
  <?php endif ?>
  <div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->

    <?php view::includeHandlerMessage() ?>
    
    
    <?php if(session::getInstance()->hasError('inputCerdo')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputCerdo') ?><!--esta linea para actualizar demas formularios-->
    </div>
    <?php endif ?><!--se agrega antes de cada input-->
    
    <div class="form-group">
      <label for="#" class="control-label col-xs-3"><?php echo i18n::__('pig') ?>:</label>
      <div class="col-xs-9">
        <select class="form-control" id="<?php controlTableClass::getNameField(controlTableClass::ID, TRUE) ?>" name="<?php echo controlTableClass::getNameField(controlTableClass::HOJA_VIDA, TRUE); ?>">
          <option value="<?php echo (session::getInstance()->hasFlash('inputCerdo') or request::getInstance()->hasPost(controlTableClass::getNameField(controlTableClass::HOJA_VIDA, true))) ? request::getInstance()->getPost(controlTableClass::getNameField(controlTableClass::HOJA_VIDA, true)) : ((isset($objControl[0])) ? $objControl[0]->$hoja_vida_id_h : '') ?>"  type="text" name="<?php echo controlTableClass::getNameField(controlTableClass::HOJA_VIDA, true) ?>" placeholder="<?php echo i18n::__('pig') ?>" >Seleccione Id Cerdo</option>
          <?php foreach ($objHojaVida as $control): ?>
            <option <?php echo (isset($objControl[0]->$hoja_vida_id_h) and $objControl[0]->$hoja_vida_id_h == $control->$hoja_vida_id) ? 'selected' : '' ?> value="<?php echo $control->$hoja_vida_id ?>">
              <?php echo $control->$cerdo ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>


    <div class="form-group <?php echo (session::getInstance()->hasFlash(controlTableClass::getNameField(controlTableClass::PESO_CERDO, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo controlTableClass::getNameField(controlTableClass::PESO_CERDO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('pig weight') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo controlTableClass::getNameField(controlTableClass::PESO_CERDO, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(controlTableClass::getNameField(controlTableClass::PESO_CERDO, true)) ? request::getInstance()->getPost(controlTableClass::getNameField(controlTableClass::PESO_CERDO, true)) : ((isset($objControl) == true) ? $objControl[0]->$peso_cerdo : '') ?>" type="text" name="<?php echo controlTableClass::getNameField(controlTableClass::PESO_CERDO, true) ?>">
        <?php if (session::getInstance()->hasFlash(controlTableClass::getNameField(controlTableClass::PESO_CERDO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>
    
    <div class="form-group">
      <label for="#" class="control-label col-xs-3"><?php echo i18n::__('unit_measure') ?>:</label>
      <div class="col-xs-9">
        <select class="form-control" id="<?php controlTableClass::getNameField(controlTableClass::ID, TRUE) ?>" name="<?php echo controlTableClass::getNameField(controlTableClass::UNIDAD_MEDIDA_ID, TRUE); ?>">
          <option value="<?php echo (session::getInstance()->hasFlash('inputCerdo') or request::getInstance()->hasPost(controlTableClass::getNameField(controlTableClass::UNIDAD_MEDIDA_ID, true))) ? request::getInstance()->getPost(controlTableClass::getNameField(controlTableClass::UNIDAD_MEDIDA_ID, true)) : ((isset($objControl[0])) ? $objControl[0]->$unidad_medida_id_p : '') ?>"  type="text" name="<?php echo controlTableClass::getNameField(controlTableClass::UNIDAD_MEDIDA_ID, true) ?>" placeholder="<?php echo i18n::__('unit_measure') ?>" >Seleccione Unidad Medida</option>
          <?php foreach ($objUnidad as $control): ?>
            <option <?php echo (isset($objControl[0]->$unidad_medida_id_p) and $objControl[0]->$unidad_medida_id_p == $control->$unidad_medida_id) ? 'selected' : '' ?> value="<?php echo $control->$unidad_medida_id ?>">
              <?php echo $control->$descripcion ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    
    <?php if(session::getInstance()->hasError('inputEmpleado')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputEmpleado') ?><!--esta linea para actualizar demas formularios-->
    </div>
    <?php endif ?><!--se agrega antes de cada input-->

    <div class="form-group">
      <label for="#" class="control-label col-xs-3"><?php echo i18n::__('employee') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php controlTableClass::getNameField(controlTableClass::ID, TRUE) ?>" name="<?php echo controlTableClass::getNameField(controlTableClass::EMPLEADO_ID, TRUE); ?>">
          <option value="<?php echo (session::getInstance()->hasFlash('inputEmpleado') or request::getInstance()->hasPost(controlTableClass::getNameField(controlTableClass::EMPLEADO_ID, true))) ? request::getInstance()->getPost(controlTableClass::getNameField(controlTableClass::EMPLEADO_ID, true)) : ((isset($objControl[0])) ? $objControl[0]->$control_id_c : '') ?>"  type="text" name="<?php echo controlTableClass::getNameField(controlTableClass::EMPLEADO_ID, true) ?>" placeholder="<?php echo i18n::__('employee') ?>">Seleccione Empleado</option>
          <?php foreach ($objEmpleado as $control): ?>
            <option <?php echo (isset($objControl[0]->$control_id_c) === true and $objControl[0]->$control_id_c == $control->$control_id) ? 'selected' : '' ?> value="<?php echo $control->$control_id ?>"><?php echo $control->$nombre . ' ' . $control->$apellido ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>



    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objControl)) ? 'update' : 'register')) ?>">

   <a class="btn btn-info" href="<?php echo routing::getInstance()->getUrlWeb('control', 'index') ?>"><?php echo i18n::__('return') ?> </a>
    
  </div>
</form>
