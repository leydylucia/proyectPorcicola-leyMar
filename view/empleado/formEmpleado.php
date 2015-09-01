
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
<?php $documento = empleadoTableClass::DOCUMENTO ?>
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
        <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true)) ? request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true)) : ((isset($objEmpleado) == true) ? $objEmpleado[0]->$nombre : '') ?>" type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>">
<?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
<?php endif ?>
      </div>
    </div>
    
    
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('lastname') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true)) ? request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true)) : ((isset($objEmpleado) == true) ? $objEmpleado[0]->$apellido : '') ?>" type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>">
<?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
<?php endif ?>
      </div>
    </div>


    <div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('direction') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true)) ? request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true)) : ((isset($objEmpleado) == true) ? $objEmpleado[0]->$direccion : '') ?>" type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true) ?>">
<?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
<?php endif ?>
      </div>
    </div>


    <div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('email') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) ? request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) : ((isset($objEmpleado) == true) ? $objEmpleado[0]->$correo : '') ?>" type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) ?>">
<?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
<?php endif ?>
      </div>
    </div>


    <div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('telephone') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true)) ? request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true)) : ((isset($objEmpleado) == true) ? $objEmpleado[0]->$telefono : '') ?>" type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true) ?>">
    <?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
<?php endif ?>
      </div>
    </div>


<?php if (session::getInstance()->hasError('inputEmpleado')): ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputEmpleado') ?><!--esta linea para actualizar demas formularios-->
      </div>
<?php endif ?><!--se agrega antes de cada input-->

    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('name_user') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php empleadoTableClass::getNameField(empleadoTableClass::USUARIO_ID, TRUE) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::USUARIO_ID, TRUE); ?>">
          <option value="<?php echo (session::getInstance()->hasFlash('inputEmpleado') or request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::USUARIO_ID, true))) ? request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::USUARIO_ID, true)) : ((isset($objEmpleado[0])) ? $objEmpleado[0]->$usuario_id_p : '') ?>"  type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::USUARIO_ID, true) ?>" placeholder="<?php echo i18n::__('user') ?>">Seleccione Usuario</option>
<?php foreach ($objUsuario as $usuario): ?>
            <option <?php echo (request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::USUARIO_ID, true)) === true and request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::USUARIO_ID, true)) == $usuario->$usuario_id) ? 'selected' : (isset($objEmpleado[0]->$usuario_id_p) === true and $objEmpleado[0]->$usuario_id_p == $usuario->$usuario_id) ? 'selected' : '' ?> value="<?php echo $usuario->$usuario_id ?>"><?php echo $usuario->$user ?></option> <!--sostenimiento de dato en foranea ?>-->  
            <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="" class="control-label col-xs-3"><?php echo i18n::__('type_id') ?>:</label>

      <div class="col-xs-9">
        <select class="form-control" id="<?php empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID_ID, TRUE) ?>" name="<?php echo empleadoTableClass::getNameField(EmpleadoTableClass::TIPO_ID_ID, TRUE); ?>">
          <option>Seleccione Tipo Identificacion</option>
<?php foreach ($objTipoId as $tipoId): ?>
            <option <?php echo (request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID_ID, true)) === true and request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID_ID, true)) == $tipoId->$tipo_id_id) ? 'selected' : (isset($objEmpleado[0]->$tipo_id_id_e) === true and $objEmpleado[0]->$tipo_id_id_e == $tipoId->$tipo_id_id) ? 'selected' : '' ?> value="<?php echo $tipoId->$tipo_id_id ?>"><?php echo $tipoId->$desc_tipo_id ?></option> <!--sostenimiento de dato en foranea ?>-->  
<?php endforeach; ?>
        </select>
      </div>
    </div>


  <?php if(session::getInstance()->hasError('inputDocumento')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDocumento') ?><!--esta linea para actualizar demas formularios-->
    </div>
    <?php endif ?><!--se agrega antes de cada input-->  
   
    <div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('document') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true)) ? request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true)) : ((isset($objEmpleado) == true) ? $objEmpleado[0]->$documento : '') ?>" type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true) ?>">
<?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
<?php endif ?>
      </div>
    </div>


    <!--    <div class="form-group"> 
          <label for="ciudad" class="control-label col-xs-3"></?php echo i18n::__('city_id') ?>:</label>
          <div class="col-xs-9"><input id="ciudad" class="form-control" value="</?php echo ((isset($objProveedor) == true) ? $objProveedor[0]->$ciudad_id : '') ?>" type="text" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::USUARIO_ID, true) ?>"> </div>
        </div>
    </div>-->

    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objEmpleado)) ? 'update' : 'register')) ?>">

    <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('empleado', 'index') ?>"><?php echo i18n::__('return') ?> </a>

</form>
</div>

