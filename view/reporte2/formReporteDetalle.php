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

<form  role="form" class="form-horizontal" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('reporte2', 'createDetalle') ?>">

    <div class="container">
        <?php if (isset($objReporte) == true): ?>
            <input name="<?php echo reporteTableClass::getNameField(reporteTableClass::ID, true) ?>" value="<?php echo $objReporte[0]->$id ?>" type="hidden">
        <?php endif ?>

        <?php if (session::getInstance()->hasError('inputInsumo')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputInsumo') ?><!--esta linea para actualizar demas formularios-->
            </div>
        <?php endif ?>

        <div class="form-group">
            <label for="filterInsumo" class="col-sm-2 control-label"><?php echo i18n::__('type_sale') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="filter[insumo]" name="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::INSUMO_ID, true) ?>" placeholder="insumo">
            </div>
        </div> 
            
            
       
            
         
            
            <!--aqui poner otra casilla de busqueda-->



        <!--linea para poner seguridad-->
        <?php // if (session::getInstance()->hasCredential('admin')): //and session::getInstance()->hasCredential('emple')):  ?>
        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objReporte)) ? 'update' : 'register')) ?>">
        <?php // endif ?>

        <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('reporte2', 'index') ?>"><?php echo i18n::__('return') ?> </a></button>


    </div>

</form>

