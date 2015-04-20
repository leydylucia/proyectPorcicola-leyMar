<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>


        <?php $idUsuario = usuarioTableClass::ID ?>
        <?php $password = usuarioTableClass::PASSWORD ?>


<div class="container">
    <form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('default', ((isset($objUsuario)) ? 'update' : 'create')) ?>">
<?php if (isset($objUsuario) == true): ?>                            
            <input name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>" value="<?php echo $objUsuario[0]->$idUsuario ?>" type="hidden">
<?php endif ?>


        <div class="form-group <?php echo (session::getInstance()->hasFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, true)) === true) ? 'has-error has-feedback' : '' ?>">
            <label for="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('user') ?>:</label>

            <div class="col-xs-9"><input id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>" class="form-control" value="<?php echo ((isset($objUsuario) == true) ? $objUsuario[0]->$usuario : '');
echo (session::getInstance()->hasFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, true)) === true) ? request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true)) : '' ?>" type="text" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>">    </div>
<?php if (session::getInstance()->hasFlash(usuarioTableClass::getNameField(usuarioTableClass::USER, true)) === true): ?>

            <spam class="glyphicon glyphicon-remove form-control-feedback"></spam><!--para que aparesca el color rojo en el input-->
<?php endif ?><!--fijarse en el value hay una condicion que escoje el flash del controller-->
        </div>
            
            

        <div class="form-group <?php echo (session::getInstance()->hasFlash(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true)) === true) ? 'has-error has-feedback' : '' ?>">
            <label for="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_1' ?>" class="control-label col-xs-3"><?php echo i18n::__('pass') ?>:</label>

            <div class="col-xs-9"><input id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_1' ?>" class="form-control" value="<?php echo ((isset($objUsuario) == true) ? $objUsuario[0]->$password : '') ?>" type="password" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_1' ?>">    </div>
<?php if (session::getInstance()->hasFlash(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true)) === true): ?>

            <spam class="glyphicon glyphicon-remove form-control-feedback"></spam><!--para que aparesca el color rojo en el input-->
<?php endif ?>
        </div>

            
            
            
        <div class="form-group <?php echo (session::getInstance()->hasFlash(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true)) === true) ? 'has-error has-feedback' : '' ?>">
            <label for="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_2' ?>" class="control-label col-xs-3"><?php echo i18n::__('pass2') ?>:</label>

            <div class="col-xs-9"><input id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_2' ?>" class="form-control" value="<?php echo ((isset($objUsuario) == true) ? $objUsuario[0]->$password : '') ?>" type="password" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) . '_2' ?>">    </div>
<?php if (session::getInstance()->hasFlash(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true)) === true): ?>

            <spam class="glyphicon glyphicon-remove form-control-feedback"></spam><!--para que aparesca el color rojo en el input-->
<?php endif ?>
        </div>





        <br>
        <br>



        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objUsuario)) ? 'update' : 'register')) ?>">

        <a href="http://localhost/proyectPorcicola-leyMar/web/index.php/usuarios"><?php echo i18n::__('return') ?> </a>



    </form>
</div>




<!--<div class="container">
<form role="form" class="form-horizontal" method="post" action="</?php echo routing::getInstance()->getUrlWeb('default', ((isset($objUsuario)) ? 'update' : 'create' )) ?>">
  </?php if(isset($objUsuario) == true): ?>
    <input name="</?php echo usuarioTableClass::getNameField(usuarioTableClass::ID,true) ?>" value="</?php echo $objUsuario[0]->$idUsuario ?>" type="hidden">
  </?php endif ?>
    
    
      <div class="form-group">
            <label for="user" class="control-label col-xs-3"> </?php echo i18n::__('user') ?>:</label>

            <div class="col-xs-9">  <input value="</?php echo ((isset($objUsuario) == true) ? $objUsuario[0]->$usuario : '') ?>" type="text" name="</?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>"> </div>
        </div>

         <div class="form-group">
            <label for="user" class="control-label col-xs-3">  </?php echo i18n::__('pass') ?>:</label>

            <div class="col-xs-9">  <input value="</?php echo ((isset($objUsuario) == true) ? $objUsuario[0]->$password : '') ?>" type="password" name="</?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) ?>"> </div>
        </div>

        <br>
    
    
    

  <br>
 
  <br>
  <input type="submit" value="</?php echo i18n::__(((isset($objUsuario)) ? 'update' : 'register')) ?>">
</form>
</div>-->