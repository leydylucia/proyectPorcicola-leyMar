<!--@var $objInsumo
@var $descInsumo,$precio,$tipoInsumo,$fechaFabricacion,$fechaVencimiento,$insumoId-->

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



<?php $id = detalleHojaTableClass::ID ?>
<?php $peso_cerdo = detalleHojaTableClass::PESO_CERDO ?>
<?php $dosis = detalleHojaTableClass::DOSIS ?>


<?php $hoja_vida_s = detalleHojaTableClass::HOJA_VIDA_ID ?>
<?php $hoja_vida = hojaVidaTableClass::ID ?>
<?php $id_hoja_vida = detalleHojaTableClass::HOJA_VIDA_ID ?>
<?php $insumoId_p = detalleHojaTableClass::INSUMO_ID ?>
<?php $insumoId = insumoTableClass::ID ?><!--manejo de foranea para traer datos-->
<?php $descripcion = insumoTableClass::DESC_INSUMO ?>

<?php $tipoInsumoId_p = detalleHojaTableClass::TIPO_INSUMO_ID ?>
<?php $tipoInsumoId = tipoInsumoTableClass::ID ?><!--manejo de foranea para traer datos-->
<?php $descripcionTipo = tipoInsumoTableClass::DESC_TIPOIN ?>


<?php $unidad_medida_u = detalleHojaTableClass::UNIDAD_MEDIDA_ID ?>
<?php $unidad_medida = unidadMedidaTableClass::ID ?>
<?php $desc_unidad = unidadMedidaTableClass::DESCRIPCION ?>

<?php view::includeHandlerMessage() ?>

<form  role="form" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('detalleHoja', ((isset($objDetalleHoja)) ? 'update' : 'create')) ?>">

    <div class="container">
        <?php if (isset($objDetalleHoja) == true): ?>
            <input name="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::ID, true) ?>" value="<?php echo $objDetalleHoja[0]->$id ?>" type="hidden">
            <input type="hidden" value="<?php echo $objDetalleHoja[0]->$id_hoja_vida ?>" name="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, TRUE) ?>"><!--tipo oculto para foranea-->
        <?php else: ?>
            <?php $id_hoja = request::getInstance()->getGet(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true)) ?>
            <input type="hidden" value="<?php echo$id_hoja ?>" name="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, TRUE) ?>"><!--tipo oculto para foranea-->
        <?php endif; ?>



        <?php if (session::getInstance()->hasError('inputCantidad')): ?><!--inicio de validaciones-->
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputCantidad') ?><!--esta linea para actualizar demas formularios-->
            </div>
        <?php endif ?>    


        <div class="form-group <?php echo (session::getInstance()->hasFlash(detalleHojaTableClass::getNameField(detalleHojaTableClass::PESO_CERDO, true)) === true) ? 'has-error has-feedback' : '' ?>">
            <label for="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::PESO_CERDO, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('pig_weight') ?>:</label>
            <div class="col-xs-9">
                <input id="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::PESO_CERDO, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::PESO_CERDO, true)) ? request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::PESO_CERDO, true)) : ((isset($objDetalleHoja) == true) ? $objDetalleHoja[0]->$peso_cerdo : '') ?>" type="text" name="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::PESO_CERDO, true) ?>">
                <?php if (session::getInstance()->hasFlash(detalleHojaTableClass::getNameField(detalleHojaTableClass::PESO_CERDO, true)) === true): ?>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <?php endif ?>
            </div>
        </div>

        <?php if (session::getInstance()->hasError('inputUnidadMedida')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputUnidadMedida') ?><!--esta linea para actualizar demas formularios-->
            </div>
        <?php endif ?><!--se agrega antes de cada input-->

        <div class="form-group">
            <label for="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('unit_measure') ?>:</label>

            <div class="col-xs-9">
                <select class="form-control" id="<?php detalleHojaTableClass::getNameField(detalleHojaTableClass::UNIDAD_MEDIDA_ID, TRUE) ?>" name="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::UNIDAD_MEDIDA_ID, TRUE); ?>">
                    <option value="<?php echo (session::getInstance()->hasFlash('inputUnidadMedida') or request::getInstance()->hasPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::UNIDAD_MEDIDA_ID, true))) ? request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::UNIDAD_MEDIDA_ID, true)) : ((isset($objDetalleHoja[0])) ? $objDetalleHoja[0]->$unidad_medida_u  : '') ?>"><?php echo i18n::__('select_unit_measure')?></option>
                    <?php foreach ($objUnidadMedida as $unidad): ?><!--validacion para traer dato  de foranea en editar-->
                        <option <?php echo (request::getInstance()->hasPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::UNIDAD_MEDIDA_ID, true)) === true and request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::UNIDAD_MEDIDA_ID, true)) == $unidad->$unidad_medida) ? 'selected' : (isset($objDetalleHoja[0]->$unidad_medida_u) === true and $objDetalleHoja[0]->$unidad_medida_u == $unidad->$unidad_medida) ? 'selected' : '' ?> value="<?php echo $unidad->$unidad_medida ?>"><?php echo $unidad->$desc_unidad ?></option><!--sostenimiento de dato en foranea-->
                            <?php echo $unidad->$desc_unidad ?><!--validacion para traer dato  de foranea en editar-->
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>


 <?php if (session::getInstance()->hasError('inputValor')): ?><!--inicio de validaciones-->
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputValor') ?><!--esta linea para actualizar demas formularios-->
            </div>
        <?php endif ?>  


        <div class="form-group <?php echo (session::getInstance()->hasFlash(detalleHojaTableClass::getNameField(detalleHojaTableClass::DOSIS, true)) === true) ? 'has-error has-feedback' : '' ?>">
            <label for="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::DOSIS, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('Dose') ?>:</label>
            <div class="col-xs-9">
                <input id="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::DOSIS, true) ?>" class="form-control" value="<?php echo request::getInstance()->hasPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::DOSIS, true)) ? request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::DOSIS, true)) : ((isset($objDetalleHoja) == true) ? $objDetalleHoja[0]->$dosis : '') ?>" type="text" name="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::DOSIS, true) ?>">
                <?php if (session::getInstance()->hasFlash(detalleHojaTableClass::getNameField(detalleHojaTableClass::DOSIS, true)) === true): ?>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <?php endif ?>
            </div>
        </div>            

        <?php if (session::getInstance()->hasError('inputInsumo')): ?><!--inicio de validaciones-->
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputInsumo') ?><!--esta linea para actualizar demas formularios-->
            </div>
        <?php endif ?>  


        <div class="form-group">
            <label for="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('product') ?>:</label>

            <div class="col-xs-9">
                <select class="form-control" id="<?php detalleHojaTableClass::getNameField(detalleHojaTableClass::INSUMO_ID, TRUE) ?>" name="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::INSUMO_ID, TRUE); ?>">
                    <option value="<?php echo (session::getInstance()->hasFlash('inputInsumo') or request::getInstance()->hasPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::INSUMO_ID, true))) ? request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::INSUMO_ID, true)) : ((isset($objDetalleHoja[0])) ? $objDetalleHoja[0]->$insumoId_p  : '') ?>"><?php echo i18n::__('select_product')?></option>
                    <?php foreach ($objInsumo as $insumo): ?><!--validacion para traer dato  de foranea en editar-->
                        <option <?php echo (request::getInstance()->hasPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::INSUMO_ID, true)) === true and request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::INSUMO_ID, true)) == $insumo->$insumoId) ? 'selected' : (isset($objDetalleHoja[0]->$insumoId_p) === true and $objDetalleHoja[0]->$insumoId_p == $insumo->$insumoId) ? 'selected' : '' ?> value="<?php echo $insumo->$insumoId ?>"><?php echo $insumo->$descripcion ?></option><!--sostenimiento de dato en foranea-->
                            <?php echo $insumo->$descripcion ?><!--validacion para traer dato  de foranea en editar-->
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
         <?php if (session::getInstance()->hasError('inputTipoInsumo')): ?><!--inicio de validaciones-->
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputTipoInsumo') ?><!--esta linea para actualizar demas formularios-->
            </div>
        <?php endif ?> 
        
         <div class="form-group">
            <label for="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::ID, true) ?>" class="control-label col-xs-3"><?php echo i18n::__('type_product') ?>:</label>

            <div class="col-xs-9">
                <select class="form-control" id="<?php detalleHojaTableClass::getNameField(detalleHojaTableClass::TIPO_INSUMO_ID, TRUE) ?>" name="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::TIPO_INSUMO_ID, TRUE); ?>">
                    <option value="<?php echo (session::getInstance()->hasFlash('inputTipoInsumo') or request::getInstance()->hasPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::TIPO_INSUMO_ID, true))) ? request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::TIPO_INSUMO_ID, true)) : ((isset($objDetalleHoja[0])) ? $objDetalleHoja[0]->$tipoInsumoId_p  : '') ?>"><?php echo i18n::__('select_product')?></option>
                    <?php foreach ($objTipoin as $tipo): ?><!--validacion para traer dato  de foranea en editar-->
                        <option <?php echo (request::getInstance()->hasPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::TIPO_INSUMO_ID, true)) === true and request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::TIPO_INSUMO_ID, true)) == $tipo->$tipoInsumoId) ? 'selected' : (isset($objDetalleHoja[0]->$tipoInsumoId_p) === true and $objDetalleHoja[0]->$tipoInsumoId_p == $tipo->$tipoInsumoId) ? 'selected' : '' ?> value="<?php echo $tipo->$tipoInsumoId ?>"><?php echo $tipo->$descripcionTipo ?></option><!--sostenimiento de dato en foranea-->
                            <?php echo $tipo->$descripcionTipo ?><!--validacion para traer dato  de foranea en editar-->
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>




        <!--linea para poner seguridad-->
        <!-- </?php if (session::getInstance()->hasCredential('admin')): //and session::getInstance()->hasCredential('emple')):  ?>-->
        <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objDetalleHoja)) ? 'update' : 'register')) ?>">
        </?php endif ?>
        <?php // if(isset($objDetalleSalida)): ?>
            <!--<button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleHoja', 'index', array(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true) => request::getInstance()->getGet('id'))) ?>"><?php echo i18n::__('return') ?> </a></button>-->
        <?php // else: ?>
        <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalleHoja', 'index', array(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true) => request::getInstance()->getGet(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true)))) ?>"><?php echo i18n::__('return') ?> </a></button>
        <?php // endif; ?>


    </div>
</form>

