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
<div class="container">
<form   class="form-horizontal" id="filterForm" role="form"  action="<?php echo routing::getInstance()->getUrlWeb('reporte', 'grafica') ?>" method="POST" >

    <div class="container">
     
      <input type="hidden" name="<?php echo reporteTableClass::getNameField(reporteTableClass::ID, TRUE)?>" value="<?php echo $id_reporte?>">
          <div class="row j1" >
          <label class="col-sm-2 control-label" for="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_1' ?>" ><?php echo i18n::__('date') ?></label>
          <div class="col-lg-5">
            <input type="date" class="form-control" id="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_1' ?>" name="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_1' ?>">
          </div>
           </div>
       <br>
       <div class="row j1" >
          <label class="col-sm-2 control-label" for="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_2' ?>" >Fecha Fin</label>
          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
            <input type="date" class="form-control" id="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_2' ?>" name="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::CREATED_AT, true) . '_2' ?>">
          </div>
        </div>
        <br>

        
        
        <div class="form-group">
        <label for="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('pig') ?>:</label>

        <div class="col-xs-9">
            <select class="cerdos" multiple class="form-control" id="<?php sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, TRUE) ?>" name="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, TRUE); ?>[]">
                <option value="0"><?php echo  i18n::__('select_pig')?></option>
                <?php foreach ($objHojaVida as $hojaVida): ?>
                    <option <?php echo (request::getInstance()->hasPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) === true and request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true)) == $hojaVida->$idCerdo) ? 'selected' : (isset($objSacrificioV[0]->$idCerdo_c) === true and $objSacrificioV[0]->$idCerdo_c== $hojaVida->$idCerdo) ? 'selected' : '' ?> value="<?php echo $hojaVida->$idCerdo ?>"><?php echo $hojaVida->$nombre ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>  
        
          
        
           
        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(('register')) ?>">
      
        <button type="reset" class="btn btn-default btn-xs"><a class="btn btn-default btn-xs">Limpiar Formulario </a></button>
        <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('reporte', 'index') ?>"><?php echo i18n::__('return') ?> </a></button>


   

</form>
 </div>
