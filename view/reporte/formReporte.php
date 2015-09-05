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
<?php $tipoVenta = sacrificiovTableClass::TIPO_VENTA_ID ?>
<?php $tipoVenta_t = tipovTableClass::ID ?>
<?php $descripcion = tipovTableClass::DESC_TIPOV ?>

<?php $cerdo  = sacrificiovTableClass::ID_CERDO ?>
<?php $cerdo_c = hojaVidaTableClass::ID ?>
<?php $nombre = hojaVidaTableClass::NOMBRE_CERDO ?>




<?php view::includeHandlerMessage() ?>

<form  role="form" class="form-horizontal" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('reporte', 'create') ?>">

    <div class="container">
        <?php if (isset($objReporte) == true): ?>
            <input name="<?php echo reporteTableClass::getNameField(reporteTableClass::ID, true) ?>" value="<?php echo $objReporte[0]->$id ?>" type="hidden">
        <?php endif ?>

        <?php if (session::getInstance()->hasError('inputCantidad')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="glyphicon glyphicon-remove-sign"></i> //<?php echo session::getInstance()->getError('inputCantidad') ?>esta linea para actualizar demas formularios
            </div>
        <?php endif ?>

<!--        <div class="form-group">
            <label for="filterCantidad" class="col-sm-2 control-label">//<?php echo i18n::__('type_sale') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="filter[cantidad]" name="//<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, true) ?>" placeholder="venta">
            </div>
        </div> -->
<!--         <div class="form-group">
                            <label for="filterCantidad" class="col-sm-2 control-label">//<?php echo i18n::__('type_product') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterTipo_venta" name="//<?php sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, true) ?>">
                                    <option value="">//<?php echo i18n::__('type_sale') ?></option>
                                    <?php foreach ($objTipoV as $venta): ?>
                                        <option value="//<?php echo $venta->$tipoVenta_t ?>"><?php echo $venta->$descripcion ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>     -->


    
         <div class="form-group">
                            <label for="filterNombre" class="col-sm-2 control-label"><?php echo i18n::__('pig') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="<?php sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true) ?>" name="<?php sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true) ?>">
                                    <option value=""><?php echo i18n::__('pig') ?></option>
                                    <?php foreach ($objHojaVida as $hoja): ?>
                                     <option <?php echo (isset($objSacrificioV[0]->$cerdo) === true and $objSacrificioV[0]->$cerdo == $hoja->$cerdo_c ) ? 'selected' : '' ?> value="<?php echo $hoja->$cerdo_c ?>"> <?php echo $hoja->$nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>     
        
            
        <?php if (session::getInstance()->hasError('inputNombre')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="glyphicon glyphicon-remove-sign"></i> //<?php echo session::getInstance()->getError('inputNombre') ?><!--esta linea para actualizar demas formularios-->
            </div>
        <?php endif ?>

<!--        <div class="form-group">
            <label for="filternombre" class="col-sm-2 control-label">//<?php echo i18n::__('name') ?></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="filter[nombre]" name="//<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true) ?>" placeholder="nombre">
            </div>
        </div>     -->
            
            
         
            
            <!--aqui poner otra casilla de busqueda-->



        <!--linea para poner seguridad-->
        <?php // if (session::getInstance()->hasCredential('admin')): //and session::getInstance()->hasCredential('emple')):  ?>
        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objReporte)) ? 'update' : 'register')) ?>">
        <?php // endif ?>

        <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'indexSacrificioVenta') ?>"><?php echo i18n::__('return') ?> </a></button>


    </div>

</form>

