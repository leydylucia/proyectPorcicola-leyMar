<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>

<?php $idUsuario = usuarioTableClass::ID ?>
<?php $password = usuarioTableClass::PASSWORD ?>
<div class="container container-fluid" id="cuerpo">
  <article id='derecha'>
<form   class="form-horizontal" role="form" class="form-horizontal" role="form"  method="post" action="<?php echo routing::getInstance()->getUrlWeb('default', ((isset($objUsuario)) ? 'update' : 'create')) ?>">
  <?php if(isset($objUsuario)==true): ?>
  <input  name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID,true) ?>" value="<?php echo $objUsuario[0]->$idUsuario ?>" type="hidden">
  <?php endif ?>
  
  <?php if(session::getInstance()->hasError('inputUsuario')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputUsuario') ?><!--esta linea para actualizar demas formularios-->
    </div>
    <?php endif ?><!--se agrega antes de cada input-->
  
  
  <div class="form-group">
      <label for="<?php echo usuariotableClass::getNameField(usuarioTableClass::USER, true) ?>" class="col-sm-2"> <?php echo i18n::__('user') ?>:</label>     
      <div class="col-sm-10">
        <input class="form-control"  value="<?php echo (session::getInstance()->hasFlash('inputUsuario') or request::getInstance()->hasPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true))) ? request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true)) : ((isset($objUsuario[0])) ? $objUsuario[0]->$usuario : '') ?>"  type="text" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>" placeholder="<?php echo i18n::__('user') ?>" required>
     </div><!--el value para actualizar-->
  </div>  
  
  <?php if(session::getInstance()->hasError('inputPass1')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputPass1') ?>
    </div>
    <?php endif ?>
  
  <div class="form-group">
      <label for="<?php echo usuariotableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_1' ?>" class="col-sm-2"> <?php echo i18n::__('pass') ?>:</label>     
      <div class="col-sm-10"> 
        <input class="form-control" id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_1' ?>" value="<?php echo (session::getInstance()->hasFlash('inputPass1')or '') ? '' : ((isset($objUsuario[0])) ? '' : '') ?>"  type="password" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true). '_1' ?>" placeholder="<?php echo i18n::__('pass') ?>" required>
      </div>
  </div>   
  
  
   <?php if(session::getInstance()->hasError('inputPass2')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputPass2') ?>
    </div>
    <?php endif ?>
  
  <div class="form-group">
      <label for="<?php echo usuariotableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_2' ?>" class="col-sm-2"> <?php echo i18n::__('pass') ?>:</label>     
      <div class="col-sm-10"> 
        <input class="form-control" id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_2' ?>" value="<?php echo (session::getInstance()->hasFlash('inputPass2') or '') ? '' : ((isset($objUsuario[0])) ? '' : '') ?>" type="password" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true). '_2' ?>" placeholder="<?php echo i18n::__('pass') ?>" required>
      </div>
  </div> 
    
  <input class="btn btn-lg btn-success btn-xs" type="submit" value="<?php echo i18n::__(((isset($objUsuario)) ? 'update' : 'register')) ?>">
   <a class="btn btn-lg btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('default', 'index') ?>" ><?php echo i18n::__('return') ?></a>

  </form>
  </article>
  </div>





<!--<div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) === true) ? 'has-error has-feedback' : '' ?>">
            <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) . '_1' ?>" class="col-lg-2 control-label"><?php echo i18n::__('mail') ?>:</label>
            <div class="col-lg-10">
                <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) . '_1' ?>" type="text" class="form-control" value="<?php echo ((isset($objEmpleado) == true) ? $objEmpleado[0]->$correo : '') ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) . '_1' ?>" placeholder="<?php echo i18n::__('Enter your Mail') ?>">
                <?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) === true): ?>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <?php endif ?>
            </div>
        </div>
        <div class="form-group <?php echo (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) === true) ? 'has-error has-feedback' : '' ?>">
            <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) . '_2' ?>" class="col-lg-2 control-label"><?php echo i18n::__('Verify Mail') ?>:</label>
            <div class="col-lg-10">
                <input id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) . '_2' ?>" type="text" class="form-control" value="<?php echo ((isset($objEmpleado) == true) ? $objEmpleado[0]->$correo : '') ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) . '_2' ?>" placeholder="<?php echo i18n::__('Verify Mail') ?>">
                <?php if (session::getInstance()->hasFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true)) === true): ?>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <?php endif ?>
            </div>
        </div>-->