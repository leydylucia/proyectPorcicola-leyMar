
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

<?php $id = empleadoTableClass::ID ?>
<?php $nombre = empleadoTableClass::NOMBRE ?>
<?php $apellido = empleadoTableClass::APELLIDO ?>
<?php $direccion = empleadoTableClass::DIRECCION ?>
<?php $correo = empleadoTableClass::CORREO ?>
<?php $telefono = empleadoTableClass::TELEFONO ?>
<?php $usuario_id_p = empleadoTableClass::USUARIO_ID ?>
<?php $usuario_id = usuarioTableClass::ID ?>
<?php $user = usuarioTableClass::USER ?>
<?php $tipo_id_id_e = empleadoTableClass::TIPO_ID_ID ?>
<?php $tipo_id_id = tipoIdTableClass::ID ?>
<?php $desc_tipo_id = tipoIdTableClass::DESC_TIPO_ID ?><!--manejo de foranea para traer datos-->



<!--esto es boostrap no te el olvides de cerrar el div-->
<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('empleado', ((isset($objEmpleado)) ? 'update' : 'create')) ?>">
  <?php if (isset($objEmpleado) == true): ?>
    <input name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>" value="<?php echo $objEmpleado[0]->$id ?>" type="hidden">
  <?php endif ?>
  <div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->


    <?php view::includeHandlerMessage() ?>
    <div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('name') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" class="form-control" value="<?php echo ((isset($objEmpleado) == true) ? $objEmpleado[0]->$nombre : '') ?><?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true)) === true) ? request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true)) : '' ?>" type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>">
        <?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('lastname') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" class="form-control" value="<?php echo ((isset($objEmpleado) == true) ? $objEmpleado[0]->$apellido : '') ?><?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true)) === true) ? request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true)) : '' ?>" type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>">
        <?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>


    <div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('direction') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true) ?>" class="form-control" value="<?php echo ((isset($objEmpleado) == true) ? $objEmpleado[0]->$direccion : '') ?><?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true)) === true) ? request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true)) : '' ?>" type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true) ?>">
        <?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>


    <div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('email') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) ?>" class="form-control" value="<?php echo ((isset($objEmpleado) == true) ? $objEmpleado[0]->$correo : '') ?><?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) === true) ? request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) : '' ?>" type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) ?>">
        <?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>


    <div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('telephone') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true) ?>" class="form-control" value="<?php echo ((isset($objEmpleado) == true) ? $objEmpleado[0]->$telefono : '') ?><?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true)) === true) ? request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true)) : '' ?>" type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true) ?>">
        <?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>


    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('name_user') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php empleadoTableClass::getNameField(empleadoTableClass::USUARIO_ID, TRUE) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::USUARIO_ID, TRUE); ?>">
          <option>Seleccione Usuario</option>
          <?php foreach ($objUsuario as $usuario): ?>
            <option <?php echo (isset($objEmpleado[0]->$usuario_id_p) === true and $objEmpleado[0]->$usuario_id_p == $usuario->$usuario_id) ? 'selected' : '' ?> value="<?php echo $usuario->$usuario_id ?>">
              <?php echo $usuario->$user ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  
    <div class="form-group">
      <label for="<//?php echo proveedorTableClass::getNameField(proveedorTableClass::ID,true)?>" class="control-label col-xs-3"><?php echo i18n::__('type_id') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID_ID, TRUE) ?>" name="<?php echo empleadoTableClass::getNameField(EmpleadoTableClass::TIPO_ID_ID, TRUE); ?>">
          <option>Seleccione Usuario</option>
          <?php foreach ($objTipoId as $tipoId): ?>
            <option <?php echo (isset($objTipoId[0]->$tipo_id_id_e) === true and $objTipoId[0]->$tipo_id_id_e == $tipoId->$tipo_id_id) ? 'selected' : '' ?> value="<?php echo $tipoId->$tipo_id_id ?>">
              <?php echo $tipoId->$desc_tipo_id ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>


    <!--    <div class="form-group"> 
          <label for="ciudad" class="control-label col-xs-3"></?php echo i18n::__('city_id') ?>:</label>
          <div class="col-xs-9"><input id="ciudad" class="form-control" value="</?php echo ((isset($objProveedor) == true) ? $objProveedor[0]->$ciudad_id : '') ?>" type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::USUARIO_ID, true) ?>"> </div>
        </div>
    </div>-->

    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objEmpleado)) ? 'update' : 'register')) ?>">

    <a href="<?php echo routing::getInstance()->getUrlWeb('empleado', 'index') ?>"><?php echo i18n::__('return') ?> </a>
</form>
</div>

