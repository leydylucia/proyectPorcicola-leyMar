<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>

<?php $id = partoTableClass::ID ?>
<?php $fecha_nacimiento = partoTableClass::FECHA_NACIMIENTO ?>
<?php $num_nacidos = partoTableClass::NUM_NACIDOS ?>
<?php $num_vivos = partoTableClass::NUM_VIVOS ?>
<?php $num_muertos = partoTableClass::NUM_MUERTOS ?>
<?php $num_hembras = partoTableClass::NUM_HEMBRAS ?>
<?php $num_machos = partoTableClass::NUM_MACHOS ?>
<?php $fecha_montada = partoTableClass::FECHA_MONTADA ?>
<?php $id_padre = partoTableClass::ID_PADRE ?>



<!--esto es boostrap no te el olvides de cerrar el div-->
<div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->
  <form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('parto', ((isset($objParto)) ? 'update' : 'create')) ?>">
    <?php if (isset($objParto) == true): ?>
      <input name="<?php echo partoTableClass::getNameField(partoTableClass::ID, true) ?>" value="<?php echo $objParto[0]->$id ?>" type="hidden">
    <?php endif ?>


    <div class="form-group">
      <label for="fecha_nacimiento" class="control-label col-xs-3"><?php echo i18n::__('fecha_nacimiento') ?>:</label>
      <div class="col-xs-9"><input id="fecha_nacimiento" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$fecha_nacimiento : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true) ?>"> </div>
      </div>
      <div class="form-group">       
        <label for="num_nacidos" class="control-label col-xs-3"><?php echo i18n::__('num_nacidos') ?>:</label>
        <div class="col-xs-9"><input id="num_nacidos" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$num_nacidos : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true) ?>"> </div>
        </div>

        <div class="form-group"> 
          <label for="num_vivos" class="control-label col-xs-3"><?php echo i18n::__('num_vivos') ?>:</label>
          <div class="col-xs-9"><input id="num_vivos" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$num_vivos : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true) ?>"> </div>
          </div>

          <div class="form-group"> 
            <label for="num_muertos" class="control-label col-xs-3"><?php echo i18n::__('num_muertos') ?>:</label>
            <div class="col-xs-9"><input id="num_muertos" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$num_muertos : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true) ?>"> </div>
            </div>

            <div class="form-group"> 
              <label for="num_hembras" class="control-label col-xs-3"><?php echo i18n::__('num_hembras') ?>:</label>
              <div class="col-xs-9"><input id="num_hembras" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$num_hembras : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true) ?>"> </div>
              </div>

              <div class="form-group"> 
                <label for="num_machos" class="control-label col-xs-3"><?php echo i18n::__('num_machos') ?>:</label>
                <div class="col-xs-9"><input id="num_machos" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$num_machos : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true) ?>"> </div>
                </div>

                <div class="form-group"> 
                  <label for="fecha_montada" class="control-label col-xs-3"><?php echo i18n::__('fecha_montada') ?>:</label>
                  <div class="col-xs-9"><input id="fecha_montada" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$fecha_montada : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true) ?>"> </div>
                  </div>

                  <div class="form-group"> 
                    <label for="id_padre" class="control-label col-xs-3"><?php echo i18n::__('id_padre') ?>:</label>
                    <div class="col-xs-9"><input id="id_padre" class="form-control" value="<?php echo ((isset($objParto) == true) ? $objParto[0]->$id_padre : '') ?>" type="text" name="<?php echo partoTableClass::getNameField(partoTableClass::ID_PADRE, true) ?>"> </div>
                    </div>

                    <br>
                    <br>

                    <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objParto)) ? 'update' : 'register')) ?>">

                    <a href="http://localhost/proyectPorcicola-leyMar/web/index.php/parto"><?php echo i18n::__('volver') ?> </a>



                    </form>
                  </div>

