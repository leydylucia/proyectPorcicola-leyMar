<!--@var $Insumo 
@var $page paginado mantiene el numero de la pagina -->
<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\config\myConfigClass as confing ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\session\sessionClass as session ?>


<?php $id = sacrificiovTableClass::ID ?>
<?php $valor = sacrificiovTableClass::VALOR ?>
<?php $cantidad = sacrificiovTableClass::CANTIDAD ?>
<?php $unidad_medida = sacrificiovTableClass::UNIDAD_MEDIDA_ID ?>
<?php $tipoVenta = sacrificiovTableClass::TIPO_VENTA_ID ?>
<?php $tipoVenta_t = tipovTableClass::ID ?>
<?php $descripcion = tipovTableClass::DESC_TIPOV ?>
<?php $idCerdo = sacrificiovTableClass::ID_CERDO ?>
<?php $cerdo = hojaVidaTableClass::ID ?>
<?php $nombre = hojaVidaTableClass::NOMBRE_CERDO ?>

<?php $fecha = sacrificiovTableClass::CREATED_AT ?>

<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('Sacrifice_Pig') ?></h1>  
    </div>

</div>
<!--fintitulo-->
<!--cambio de idioma-->
<div class="container container-fluid">
    <div style="margin-bottom: 10px; margin-top: 30px">



        <a href="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'insertSacrificioVenta') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
        <a href="javascrip:eliminarMasivo()" class="btn btn-danger btn-xs " data-target="#myModalDeleteMasivo" data-toggle="modal"id="btnDeleteMasivo" ><?php echo i18n::__('deleteall') ?></a>

        <button type="button" class="btn btn-primary btn-xs" id="btnFilter"data-toggle="modal" data-target="#myModalFilters" ><?php echo i18n::__('filter') ?></button>


        <!--filtros-->
        <a href="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'deleteFilters') ?>" class="btn btn-default btn-xs " id="btndeletefilter" ><?php echo i18n::__('deleteFilter') ?></a>
        <button type="button" class="btn btn-warning btn-xs"class="" id="btnFilter"data-toggle="modal" data-target="#myModalReport" ><?php echo i18n::__('report') ?></button>
<!--        <a href="<?php echo routing::getInstance()->getUrlWeb('reporte', 'insert') ?>" class="btn btn-info btn-xs"><?php echo i18n::__('graphic') ?></a>
       -->

    </div>

    <!--filtro con reporte-->
    <div class="modal fade" id="myModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('report') ?></h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="report" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'reportSacrificioVenta') ?>">
<!--                        <div class="form-group">
                            <label for="filterValor" class="col-sm-2 control-label"><?php echo i18n::__('sale') ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="filter[valor]" name="filter[valor]" placeholder="valor">
                            </div>
                        </div>    PONER CORCHER  EN NAME filter[insumo]

-->                        <div class="form-group">
                            <label for="filterCantidad" class="col-sm-2 control-label"><?php echo i18n::__('quantity') ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="filter[cantidad]" name="filter[cantidad]" placeholder="<?php echo i18n::__('quantity')?>">
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="filterTipo_venta" class="col-sm-2 control-label"><?php echo i18n::__('type_sale') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterTipo_venta" name="filter[Tipo_venta]">
                                    <option value=""><?php echo i18n::__('select_type_sale') ?></option>
                                    <?php foreach ($objTipoV as $venta): ?>
                                        <option value="<?php echo $venta->$tipoVenta_t ?>"><?php echo $venta->$descripcion ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>     

                        <!--                        <div class="form-group">
                                                    <label for="filterCerdo" class="col-sm-2 control-label"><?php // echo i18n::__('pig')  ?></label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="filterCerdo" name="filter[Cerdo]">
                                                            <option value=""><?php // echo i18n::__('pig')  ?></option>
                        <?php // foreach ($objHojaVida as $hojaVida): ?>
                                                                <option value="<?php // echo $hojaVida->$idCerdo  ?>"><?php // echo $hojaVida->$nombre  ?></option>
                        <?php // endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>             -->

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                    <button type="button" onclick="$('#report').submit()" class="btn btn-warning"><?php echo i18n::__('report') ?></button>
                </div>
            </div>
        </div>
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
                    <form class="form-horizontal" role="form" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'indexSacrificioVenta') ?>">
                        <!--                        <div class="form-group">
                                                    <label for="filterValor" class="col-sm-2 control-label"><?php echo i18n::__('sale') ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="filter[valor]" name="filter[valor]" placeholder="valor">
                                                    </div>
                                                </div>  -->

                        <?php if (session::getInstance()->hasError('inputCantidad')): ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputCantidad') ?><!--esta linea para actualizar demas formularios-->
                            </div>
                        <?php endif ?>

                        <div class="form-group">
                            <label for="filterCantidad" class="col-sm-2 control-label"><?php echo i18n::__('quantity') ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="filter[cantidad]" name="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::CANTIDAD, true) ?>" placeholder="<?php echo i18n::__('quantity')?>">
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="filterTipo_venta" class="col-sm-2 control-label"><?php echo i18n::__('select_type_sale') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterTipo_venta" name="filter[Tipo_venta]">
                                    <option value=""><?php echo i18n::__('type_sale') ?></option>
                                    <?php foreach ($objTipoV as $venta): ?>
                                        <option value="<?php echo $venta->$tipoVenta_t ?>"><?php echo $venta->$descripcion ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="filterCerdo" class="col-sm-2 control-label"><?php echo i18n::__('pig') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterCerdo" name="filter[Cerdo]">
                                    <option value=""><?php echo i18n::__('select_pig') ?></option>
                                    <?php foreach ($objHojaVida as $hoja): ?>
                                        <option value="<?php echo $hoja ->$cerdo ?>"><?php echo $hoja-> $nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo i18n::__('date_creation') ?></label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="filter[Date1]" name="filter[Date1]">
                                <br>
                                <input type="date" class="form-control" id="filter[Date2]" name="filter[Date2]">
                            </div>
                        </div>
                    </form>
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


    <div class="container">
        <div class="table-responsive">
            <form id="frmDeleteAll" id ="filterForm"action="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'deleteSelectSacrificioVenta') ?>" method="POST">

                <table class="table table-bordered table-striped table-condensed mitabla">
                    <thead>
                        <tr class="active">
                            <th><input type="checkbox" id="chkAll"></th>
                            <th><?php echo i18n::__('pig') ?></th>
                            <th><?php echo i18n::__('type_sale') ?></th>
                            <th><?php echo i18n::__('quantity') ?></th>
                            <th><?php echo i18n::__('unit_measure') ?></th> 
                            <th><?php echo i18n::__('sale') ?></th>
                            <th><?php echo i18n::__('date') ?></th>
                            <th><?php echo i18n::__('action') ?></th>

                        </tr>        
                    </thead>
                    <tbody>
                        <?php foreach ($objSacrificioV as $sacrificio): ?> 
                            <tr class="text-info bg-info">
                                <td><input type="checkbox" name="chk[]" value="<?php echo $sacrificio->$id ?>"></td>
                                <td><?php echo hojaVidaTableClass::getNameHojaVida($sacrificio->$idCerdo) ?></td>
                                <td><?php echo tipovTableClass::getNameTipov($sacrificio->$tipoVenta) ?></td>
                                <td><?php echo $sacrificio->$cantidad ?></td>
                                <td><?php echo unidadMedidaTableClass::getNameUnidadMedida($sacrificio->$unidad_medida) ?></td>
                                <td><?php echo '$ ' . number_format($sacrificio->$valor, 0, ',', '.'); ?></td>
                                <td><?php echo date('d-m-Y h:i:s a', strtotime($sacrificio->$fecha)) ?></td>
                                <td>
                                    <a href="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'verSacrificioVenta', array(sacrificiovTableClass::ID => $sacrificio->$id)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a>
                                    <a href="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'editSacrificioVenta', array(sacrificiovTableClass::ID => $sacrificio->$id)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('publish') ?></a>

                                    <!--eliminado individual con ajax-->
                                    <a href="#" data-target="#myModalDelete<?php echo $sacrificio->$id ?>" data-toggle="modal" class="btn btn-danger btn-xs"><?php echo i18n::__('Delete') ?></a>
                                </td>
                            </tr>

                        <div class="modal fade" id="myModalDelete<?php echo $sacrificio->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!--pára que imprima el id en cada ventana-->
                                        <?php i18n::__('confirmDelete') ?> <?php echo $sacrificio->$valor ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                                        <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $sacrificio->$id ?>, '<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'deleteSacrificioVenta') ?>')"><?php echo i18n::__('Delete') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </tbody>



                </table>  
            </form>
            <!--paginado-->
            <div class="text-right">
                página <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'indexSacrificioVenta') ?>')">
                    <?php for ($x = 1; $x <= $cntPages; $x++): ?> 
                        <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option> 

                    <?php endfor; ?>



                </select>de <?php echo $cntPages ?>

            </div>
            <!--fin paginado-->
        </div>
    </div>


    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'deleteSacrificioVenta') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo sacrificiovTableClass::getNameField(sacrificiovTableClass::ID, true) ?>">
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


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                    <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('confirm') ?></button>
                </div>
            </div>
        </div>
    </div>

</div>
