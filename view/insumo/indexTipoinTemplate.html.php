
<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\config\configClass as confing ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\session\sessionClass as session ?>


<?php $desc_tipoIn = tipoInsumoTableClass::DESC_TIPOIN ?>
<?php $id = tipoInsumoTableClass::ID ?>
</?php $fecha = tipoInsumoTableClass::CREATED_AT ?>

<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('typeProd') ?></h1>  
    </div>

</div>
<!--fintitulo-->


<div class="container container-fluid">

    <div style="margin-bottom: 10px; margin-top: 30px">

        <a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'insertTipoin') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
        <a href="javascrip:eliminarMasivo()" class="btn btn-danger btn-xs "data-target="#myModalDeleteMasivo" data-toggle="modal" id="btnDeleteMasivo" ><?php echo i18n::__('deleteall') ?></a>
        <button type="button" class="btn btn-primary btn-xs" id="btnFilter"data-toggle="modal" data-target="#myModalFilters" ><?php echo i18n::__('filter') ?></button>


        <a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteFiltersTipoin') ?>" class="btn btn-default btn-xs " id="btndeletefilter" ><?php echo i18n::__('deleteFilter') ?></a>
        <!--            <button type="button" class="btn btn-warning btn-xs"class="" id="btnFilter"data-toggle="modal" data-target="#myModalReport" ></?php echo i18n::__('report') ?></button>
                    <a href="</?php echo routing::getInstance()->getUrlWeb('insumo', 'reportTipoin') ?>"class="btn btn-info btn-xs"></?php echo i18n::__('printOut') ?></a>-->
    </div>




    <!--filtros-->
    <div class="modal fade" id="myModalFilters" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Filtros</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexTipoin') ?>">

                        <?php if (session::getInstance()->hasError('inputDescTipoIn')): ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDescTipoIn') ?><!--esta linea para actualizar demas formularios-->
                            </div>
                        <?php endif ?><!--se agrega antes de cada input-->


                        <div class="form-group">
                            <label for="filterDesc_insumo" class="col-sm-2 control-label"><?php echo i18n::__('describe_product') ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="filter[tipoInsumo]" name="filter[<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true) ?>]" placeholder="desc_tipo_insumo">
                            </div>
                        </div>    <!--PONER CORCHER  EN NAME filter[insumo]-->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                    <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary"><?php echo i18n::__('filter') ?></button>
                </div>
            </div>
        </div>
    </div>
    <!--fin de modal filtro-->


    <?php view::includeHandlerMessage() ?><!--esta linea es para traer mensajes de exito cunado registra-->
    <!--formulario de borrado masivo-->
    <div class="container">
        <div class="table-responsive">
            <form id="frmDeleteAll" id ="filterForm"action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteSelectTipoin') ?>" method="POST">


                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr class="active">
                            <th><input type="checkbox" id="chkAll"></th>
                            <th><?php echo i18n::__('describe_typeProduct') ?></th>
<!--                                <th></?php echo i18n::__('date') ?></th>-->
                            <th><?php echo i18n::__('action') ?></th>
                        </tr>        
                    </thead>
                    <tbody>
                        <?php foreach ($objTipoin as $tipoIn): ?> 
                            <tr class="text-info bg-info">
                                <td><input type="checkbox" name="chk[]" value="<?php echo $tipoIn->$id ?>"></td>
                                <td><?php echo $tipoIn->$desc_tipoIn ?></td>
                                <!--<td></?php echo $tipoIn->$fecha ?></td>-->
                                <td>
                                    <a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'verTipoin', array(tipoInsumoTableClass::ID => $tipoIn->$id)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a>
                                    <a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'editTipoin', array(tipoInsumoTableClass::ID => $tipoIn->$id)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('publish') ?></a>


                                    <!--eliminado individual con ajax-->
                                    <a href="#" data-target="#myModalDelete<?php echo $tipoIn->$id ?>" data-toggle="modal" class="btn btn-danger btn-xs"><?php echo i18n::__('Delete') ?></a>
                                </td>
                            </tr>

                        <div class="modal fade" id="myModalDelete<?php echo $tipoIn->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!--pára que imprima el id en cada ventana-->
                                        <?php i18n::__('confirmDelete') ?> <?php echo $tipoIn->$desc_tipoIn ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                                        <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $tipoIn->$id ?>, '<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteTipoin') ?>')"><?php echo i18n::__('Delete') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </tbody>



                </table>  
            </form><!-- fin formulario de borrado masivo-->
            <div class="text-right">
                página <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexTipoin') ?>')">
                    <?php for ($x = 1; $x <= $cntPages; $x++): ?> 
                        <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option> 

                    <?php endfor; ?>



                </select>de <?php echo $cntPages ?>
            </div>
        </div>
    </div>


    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteTipoin') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID, true) ?>">
    </form>



    <!--eliminado masivo en ajax-->
    <div class="modal fade" id="myModalDeleteMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmar elementos masivo</h4>
                </div>
                <div class="modal-body">

                    <?php i18n::__('confirmDeleteMasivo') ?> <?php echo $tipoIn->$desc_tipoIn ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                    <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('Delete') ?></button>
                </div>
            </div>
        </div>
    </div>

</div>
<!--fin de modal-->