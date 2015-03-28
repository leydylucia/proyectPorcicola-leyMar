<!--@var $objInsumo
@var $descInsumo,$precio,$tipoInsumo,$fechaFabricacion,$fechaVencimiento,$proveedorId-->

<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>


<?php $id = insumoTableClass::ID ?>
<?php $descInsumo = insumoTableClass::DESC_INSUMO ?>
<?php $precio = insumoTableClass::PRECIO ?>

<?php $tipoInsumo = tipoInsumoTableClass::ID ?>
<?php $desc_tipoIn = tipoinsumoTableClass::DESC_TIPOIN ?><!--manejo de foranea para traer datos-->

<?php $fechaFabricacion = insumoTableClass::FECHA_FABRICACION ?>
<?php $fechaVencimiento = insumoTableClass::FECHA_VENCIMIENTO ?>

<?php $proveedorId = proveedorTableClass::ID ?><!--manejo de foranea para traer datos-->
<?php $nombre = proveedorTableClass::NOMBRE ?>



<div class="container">
    <form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('insumo', ((isset($objInsumo)) ? 'updateInsumo' : 'createInsumo')) ?>">
<?php if (isset($objInsumo) == true): ?>
            <input name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>" value="<?php echo $objInsumo[0]->$id ?>" type="hidden">
<?php endif ?>


        <div class="form-group">
            <label for="desc_insumo" class="control-label col-xs-3"><?php echo i18n::__('describe_product') ?>:</label>

            <div class="col-xs-9"><input id="desc_insumo" class="form-control" value="<?php echo ((isset($objInsumo) == true) ? $objInsumo[0]->$descInsumo : '') ?>" type="text" name="<?php echo insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true) ?>">    </div>
        </div>

        <div class="form-group">
            <label for="precio" class="control-label col-xs-3"><?php echo i18n::__('prise') ?>:</label>

            <div class="col-xs-9"><input id="precio" class="form-control" value="<?php echo ((isset($objInsumo) == true) ? $objInsumo[0]->$precio : '') ?>" type="text" name="<?php echo insumoTableClass::getNameField(insumoTableClass::PRECIO, true) ?>">    </div>

        </div>

        <div class="form-group">
            <label for="<//?php echo insumoTableClass::getNameField(insumoTableClass::ID,true)?>" class="control-label col-xs-3"><?php echo i18n::__('type_product') ?>:</label>

            <div class="col-xs-9">
                <select class="form-control" id="<?php insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, TRUE) ?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, TRUE); ?>">
                    <option>Seleccione el tipo insumo</option>
<?php foreach ($objTipoin as $tipoInsumo): ?>
                        <option value="<?php echo $tipoInsumo->id ?>"><?php echo $tipoInsumo->$desc_tipoIn ?></option>
<?php endforeach; ?>
                </select>
            </div>
        </div>


        <div class="form-group">
            <label for="fechafabricacion" class="control-label col-xs-3"><?php echo i18n::__('date_manufacture') ?>:</label>

            <div class="col-xs-9"><input id="fechafabricacion" class="form-control" value="<?php echo ((isset($objInsumo) == true) ? $objInsumo[0]->$fechaFabricacion : '') ?>" type="datetime-local" name="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true) ?>">    </div>
        </div>

        <div class="form-group">
            <label for="fechavencimiento" class="control-label col-xs-3"><?php echo i18n::__('date_conquering') ?>:</label>

            <div class="col-xs-9"><input id="fechavencimiento" class="form-control" value="<?php echo ((isset($objInsumo) == true) ? $objInsumo[0]->$fechaVencimiento : '') ?>" type="datetime-local" name="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true) ?>">    </div>
        </div>



        <div class="form-group">
            <label for="<//?php echo insumoTableClass::getNameField(insumoTableClass::ID,true)?>" class="control-label col-xs-3"><?php echo i18n::__('provisioner') ?>:</label>

            <div class="col-xs-9">
                <select class="form-control" id="<?php insumoTableClass::getNameField(insumoTableClass::PROVEEDOR_ID, TRUE) ?>" name="<?php echo insumoTableClass::getNameField(insumoTableClass::PROVEEDOR_ID, TRUE); ?>">
                    <option>Seleccione el proveedor</option>
<?php foreach ($objProv as $proveedorId): ?>
                        <option value="<?php echo $proveedorId->id ?>"><?php echo $proveedorId->$nombre ?></option>
<?php endforeach; ?>
                </select>
            </div>
        </div>

        <br>
        <br>



        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objInsumo)) ? 'update' : 'register')) ?>">

        <a href="http://localhost/proyectPorcicola-leyMar/web/index.php/insumo"><?php echo i18n::__('return') ?> </a>



    </form>
</div>

