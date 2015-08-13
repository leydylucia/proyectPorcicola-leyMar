
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\view\viewClass as view ?>

<?php $id = credencialTableClass::ID ?>
<?php $nombre = credencialTableClass::NOMBRE ?>


<!--esto es boostrap no te el olvides de cerrar el div-->
<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('credencial', ((isset($objCredencial)) ? 'update' : 'create')) ?>">
  <?php if (isset($objCredencial) == true): ?>
    <input name="<?php echo credencialTableClass::getNameField(credencialTableClass::ID, true) ?>" value="<?php echo $objCredencial[0]->$id ?>" type="hidden">
  <?php endif ?>
  <div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->


    <?php view::includeHandlerMessage() ?>
    <div class="form-group <?php echo (session::getInstance()->hasFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true)) === true) ? 'has-error has-feedback' : '' ?>">
      <label for="<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('name') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, true) ?>" class="form-control" value="<?php echo ((isset($objCredencial) == true) ? $objCredencial[0]->$nombre : '') ?><?php echo (session::getInstance()->hasFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true)) === true) ? request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true)) : '' ?>" type="text" name="<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, true) ?>">
        <?php if (session::getInstance()->hasFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

    
    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objCredencial)) ? 'update' : 'register')) ?>">

    <a class="btn btn-info" href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>"><?php echo i18n::__('return') ?> </a>
</form>
</div>

