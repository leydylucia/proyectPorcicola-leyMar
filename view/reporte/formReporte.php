<!--@var $objInsumo
@var $descInsumo,$precio,$tipoInsumo,$fechaFabricacion,$fechaVencimiento,$reporteId-->

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



<?php $id = reporteTableClass::ID ?>
<?php $nombre = reporteTableClass::NOMBRE ?>





<?php view::includeHandlerMessage() ?>

<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('reporte', ((isset($objReporte)) ? 'update' : 'create')) ?>">

    <div class="container">
    <?php if (isset($objReporte) == true): ?>
        <input name="<?php echo reporteTableClass::getNameField(reporteTableClass::ID, true) ?>" value="<?php echo $objReporte[0]->$id ?>" type="hidden">
    <?php endif ?>

<?php if(session::getInstance()->hasError('inputUsuario')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputUsuario') ?><!--esta linea para actualizar demas formularios-->
    </div>
    <?php endif ?>

    <div class="form-group <?php echo (session::getInstance()->hasFlash(reporteTableClass::getNameField(reporteTableClass::NOMBRE, true)) === true) ? 'has-error has-feedback' : '' ?>">       
      <label for="<?php echo reporteTableClass::getNameField(reporteTableClass::NOMBRE, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('name') ?>:</label>
      <div class="col-xs-9">
        <input id="<?php echo reporteTableClass::getNameField(reporteTableClass::NOMBRE, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(reporteTableClass::getNameField(reporteTableClass::NOMBRE, true)) ? request::getInstance()->getPost(reporteTableClass::getNameField(reporteTableClass::NOMBRE, true)) : ((isset($objReporte) == true) ? $objReporte[0]->$nombre : '') ?>" type="text" name="<?php echo reporteTableClass::getNameField(reporteTableClass::NOMBRE, true) ?>">
        <?php if (session::getInstance()->hasFlash(reporteTableClass::getNameField(reporteTableClass::NOMBRE, true)) === true): ?>
          <span class="glyphicon glyphicon-remove form-control-feedback"></span>
        <?php endif ?>
      </div>
    </div>

        
    

    <!--linea para poner seguridad-->
    <?php // if (session::getInstance()->hasCredential('admin')): //and session::getInstance()->hasCredential('emple')):  ?>
        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objReporte)) ? 'update' : 'register')) ?>">
    <?php // endif ?>

    <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('reporte', 'index') ?>"><?php echo i18n::__('return') ?> </a></button>


    </div>

</form>

