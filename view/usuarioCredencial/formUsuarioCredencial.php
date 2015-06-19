<!--@var $objInsumo
@var $descInsumo,$precio,$tipoInsumo,$fechaFabricacion,$fechaVencimiento,$proveedorId-->

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



<?php $id = usuarioCredencialTableClass::ID ?>
<?php $usuario_u = usuarioCredencialTableClass::USUARIO_ID?>
<?php $usuario = usuarioTableClass::ID?>
<?php $nomUsuario = usuarioTableClass::USER?>
<?php $credencial_c = usuarioCredencialTableClass::CREDENCIAL_ID ?>
<?php $credencial = credencialTableClass::ID ?>
<?php $nombre = credencialTableClass::NOMBRE ?>



    <?php view::includeHandlerMessage() ?>

<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', ((isset($objUsuarioCredencial)) ? 'updateUsuarioCredencial' : 'createUsuarioCredencial')) ?>">


<?php if (isset($objUsuarioCredencial) == true): ?>
        <input name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true) ?>" value="<?php echo $objUsuarioCredencial[0]->$id ?>" type="hidden">
            <?php endif ?>



<div class="form-group">
        <label for="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('user') ?>:</label>

        <div class="col-xs-9">
            <select class="form-control" id="<?php usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, TRUE) ?>" name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, TRUE); ?>">
               <option>Seleccione usuario</option>
<?php foreach ($objUsuario as $user): ?><!--validacion para traer dato  de foranea en editar-->
                    <option <?php echo (isset($objUsuarioCredencial[0]->$usuario_u) === true and $objUsuarioCredencial[0]->$usuario_u == $user->$usuario) ? 'selected' : '' ?> value="<?php echo $user->$usuario ?>"><!--validacion para traer dato  de foranea en editar-->
    <?php echo $user->$nomUsuario ?><!--validacion para traer dato  de foranea en editar-->
                    </option>
<?php endforeach; ?>
            </select>
        </div>      
    </div>

<div class="form-group">
        <label for="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('credential') ?>:</label>

<div class="col-xs-9">
            <select class="form-control" id="<?php usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, TRUE) ?>" name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, TRUE); ?>">
               <option>Seleccione credencial</option>
<?php foreach ($objCredencial as $cred): ?><!--validacion para traer dato  de foranea en editar-->
                    <option <?php echo (isset($objUsuarioCredencial[0]->$credencial_c) === true and $objUsuarioCredencial[0]->$credencial_c == $cred->$credencial) ? 'selected' : '' ?> value="<?php echo $cred->$credencial ?>"><!--validacion para traer dato  de foranea en editar-->
    <?php echo $cred->$nombre ?><!--validacion para traer dato  de foranea en editar-->
                    </option>
<?php endforeach; ?>
            </select>
        </div>     
</div>





   
   






    



    <!--linea para poner seguridad-->
<?php if (session::getInstance()->hasCredential('admin')): //and session::getInstance()->hasCredential('emple')):  ?>
        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objUsuarioCredencial)) ? 'update' : 'register')) ?>">
<?php endif ?>

        <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'indexUsuarioCredencial') ?>"><?php echo i18n::__('return') ?> </a></button>




</form>

