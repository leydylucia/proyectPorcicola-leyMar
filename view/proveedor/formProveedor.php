
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\view\viewClass as view ?>

<?php $id = proveedorTableClass::ID ?>
<?php $nombre = proveedorTableClass::NOMBRE ?>
<?php $apellido = proveedorTableClass::APELLIDO ?>
<?php $direccion = proveedorTableClass::DIRECCION ?>
<?php $correo = proveedorTableClass::CORREO ?>
<?php $telefono = proveedorTableClass::TELEFONO ?>
<?php $ciudad_id_p = proveedorTableClass::CIUDAD_ID ?>
<?php $ciudad_id = ciudadTableClass::ID ?>
<?php $nom_ciudad = ciudadTableClass::NOM_CIUDAD ?><!--manejo de foranea para traer datos-->



<!--esto es boostrap no te el olvides de cerrar el div-->
<form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('proveedor', ((isset($objProveedor)) ? 'updateProv' : 'createProv')) ?>">
  <?php if (isset($objProveedor) == true): ?>
    <input name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID, true) ?>" value="<?php echo $objProveedor[0]->$id ?>" type="hidden">
  <?php endif ?>
  <div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->


    <?php view::includeHandlerMessage() ?>
    <div class="form-group <?php echo (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('name') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true) ?>" class="form-control" value="<?php echo ((isset($objProveedor) == true) ? $objProveedor[0]->$nombre : '') ?><?php echo (session::getInstance()->hasFlash(proveedorTableClass::getNameField(ProveedorTableClass::NOMBRE, true)) === true) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true)) : '' ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true) ?>">
        <?php if (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('lastname') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true)) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true)) : ((isset($objProveedor) == true) ? $objProveedor[0]->$apellido : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true) ?>">
        <?php if (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('direction') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true)) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true)) : ((isset($objProveedor) == true) ? $objProveedor[0]->$direccion : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true) ?>">
        <?php if (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>
    
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::CORREO, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo proveedorTableClass::getNameField(proveedorTableClass::CORREO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('email') ?>:</label>
      <div class="col-xs-9">
      <input id="<?php echo proveedorTableClass::getNameField(proveedorTableClass::CORREO, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::CORREO, true)) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::CORREO, true)) : ((isset($objProveedor) == true) ? $objProveedor[0]->$correo : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::CORREO, true) ?>">
        <?php if (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::CORREO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>
   
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('telephone') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true)) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true)) : ((isset($objProveedor) == true) ? $objProveedor[0]->$telefono : '') ?>" type="text" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true) ?>">
        <?php if (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    
    <div class="form-group">
      <label for="<//?php echo proveedorTableClass::getNameField(proveedorTableClass::ID,true)?>" class="control-label col-xs-3"><?php echo i18n::__('city_id') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php proveedorTableClass::getNameField(proveedorTableClass::CIUDAD_ID, TRUE) ?>" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::CIUDAD_ID, TRUE); ?>">
          <option>Seleccione ciudad</option>
          <?php foreach ($objCiudad as $ciudad): ?>
          <option <?php echo (isset($objProveedor[0]->$ciudad_id_p) === true and $objProveedor[0]->$ciudad_id_p == $ciudad->$ciudad_id) ? 'selected' : '' ?> value="<?php echo $ciudad->$ciudad_id ?>">
          <?php  echo $ciudad->$nom_ciudad ?>
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

    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objProveedor)) ? 'update' : 'register')) ?>">

    <a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'indexProv') ?>"><?php echo i18n::__('return') ?> </a>
</form>
</div>

