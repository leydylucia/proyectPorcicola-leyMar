
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\view\viewClass as view ?>

<?php $id = entradaTableClass::ID ?>
<?php $empleado_id_e = entradaTableClass::EMPLEADO_ID ?>
<?php $empleado_id = empleadoTableClass::ID ?>
<?php $nombre_em = empleadoTableClass::NOMBRE ?>
<?php $proveedor_id_em = entradaTableClass::PROVEEDOR_ID ?>
<?php $proveedor_id = proveedorTableClass::ID ?>
<?php $nombre = proveedorTableClass::NOMBRE ?><!--manejo de foranea para traer datos-->



<!--esto es boostrap no te el olvides de cerrar el div-->
<form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('entrada', ((isset($objEntrada)) ? 'updateEn' : 'createEn')) ?>">
  <?php if (isset($objEntrada) == true): ?>
    <input name="<?php echo entradaTableClass::getNameField(entradaTableClass::ID, true) ?>" value="<?php echo $objEntrada[0]->$id ?>" type="hidden">
  <?php endif ?>
  <div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->


    <?php view::includeHandlerMessage() ?>

    
    <div class="form-group">
      <label for="#" class="control-label col-xs-3"><?php echo i18n::__('employee') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php entradaTableClass::getNameField(entradaTableClass::EMPLEADO_ID, TRUE) ?>" name="<?php echo entradaTableClass::getNameField(entradaTableClass::EMPLEADO_ID, TRUE); ?>">
          <option>Seleccione Empleado</option>
          <?php foreach ($objEmpleado as $empleado): ?>
          <option <?php echo (isset($objEntrada[0]->$empleado_id_e) === true and $objEntrada[0]->$empleado_id_e == $empleado->$empleado_id) ? 'selected' : '' ?> value="<?php echo $empleado->$empleado_id ?>">
          <?php  echo $empleado->$nombre_em ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    
    
    <div class="form-group">
      <label for="#" class="control-label col-xs-3"><?php echo i18n::__('supplier') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php entradaTableClass::getNameField(entradaTableClass::PROVEEDOR_ID, TRUE) ?>" name="<?php echo entradaTableClass::getNameField(entradaTableClass::PROVEEDOR_ID, TRUE); ?>">
          <option>Seleccione Proveedor</option>
          <?php foreach ($objProveedor as $proveedor): ?>
          <option <?php echo (isset($objEntrada[0]->$proveedor_id_em) === true and $objEntrada[0]->$proveedor_id_em == $proveedor->$proveedor_id) ? 'selected' : '' ?> value="<?php echo $proveedor->$proveedor_id ?>">
          <?php  echo $proveedor->$nombre ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>


    <!--    <div class="form-group"> 
          <label for="ciudad" class="control-label col-xs-3"></?php echo i18n::__('city_id') ?>:</label>
          <div class="col-xs-9"><input id="ciudad" class="form-control" value="</?php echo ((isset($objProveedor) == true) ? $objProveedor[0]->$ciudad_id : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::CIUDAD_ID, true) ?>"> </div>
        </div>
    </div>-->

    <br>
    <br>

    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objEntrada)) ? 'update' : 'register')) ?>">

    <a href="<?php echo routing::getInstance()->getUrlWeb('entrada', 'indexEn') ?>"><?php echo i18n::__('return') ?> </a>
</form>
</div>

