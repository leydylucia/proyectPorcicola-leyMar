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
<?php $tipoVenta_v = sacrificiovTableClass::TIPO_VENTA_ID ?>
<?php $tipoVenta = tipovTableClass::ID ?>
<?php $desc_tipoV = tipovTableClass::DESC_TIPOV ?>

<?php $idCerdo_c = sacrificiovTableClass::ID_CERDO ?>
<?php $idCerdo = hojaVidaTableClass::ID ?>
<?php $nombre = hojaVidaTableClass::NOMBRE_CERDO ?>




<?php view::includeHandlerMessage() ?>

<form   class="form-horizontal" id="filterForm" role="form"  action="<?php echo routing::getInstance()->getUrlWeb('reporte', 'create') ?>" method="POST" >

    <div class="container">
     
<!--
       

-->        
<!--        <div class="form-group">
        <label for="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('type_sale') ?>:</label>

        <div class="col-xs-9">
            <select class="form-control" id="<?php sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, TRUE) ?>" name="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, TRUE); ?>">
                <option value="<?php echo (session::getInstance()->hasFlash('inputTipov') or request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true))) ? request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) : ((isset($objSacrificioV[0])) ? $objSacrificioV[0]->$tipoVenta_v : '') ?>"><?php echo i18n::__('select_type_sale')?></option>
                <?php foreach ($objTipoV as $tipoV): ?>
                   <option <?php echo (request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, true)) === true and request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, true)) == $tipoV->$tipoVenta) ? 'selected' : (isset($objSacrificioV[0]->$tipoVenta_v) === true and $objSacrificioV[0]->$tipoVenta_v== $tipoV->$tipoVenta) ? 'selected' : '' ?> value="<?php echo $tipoV->$tipoVenta ?>"><?php echo $tipoV->$desc_tipoV ?>
                
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>     


    
-->         <div class="form-group">
        <label for="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('pig') ?>:</label>

        <div class="col-xs-9">
            <select class="form-control" id="<?php sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, TRUE) ?>" name="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, TRUE); ?>">
                <option value="<?php echo (session::getInstance()->hasFlash('inputCerdo') or request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true))) ? request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) : ((isset($objSacrificioV[0])) ? $objSacrificioV[0]->$idCerdo_c : '') ?>"><?php  echo  i18n::__('select_pig')?></option>
                <?php foreach ($objHojaVida as $hojaVida): ?>
                    <option <?php echo (request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) === true and request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) == $hojaVida->$idCerdo) ? 'selected' : (isset($objSacrificioV[0]->$idCerdo_c) === true and $objSacrificioV[0]->$idCerdo_c== $hojaVida->$idCerdo) ? 'selected' : '' ?> value="<?php echo $hojaVida->$idCerdo ?>"><?php echo $hojaVida->$nombre ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>    
        
           
        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(('register')) ?>">
      

        <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('reporte', 'index') ?>"><?php echo i18n::__('return') ?> </a></button>


    </div>

</form>

