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
use mvc\config\configClass as confing ?>
<?php
use mvc\request\requestClass as request ?>

<?php $id = detalleEntradaTableClass::ID ?>
<?php $cantidad = detalleEntradaTableClass::CANTIDAD ?>
<?php $valor = detalleEntradaTableClass::VALOR ?>
<?php $entrada_bodega = detalleEntradaTableClass::ENTRADA_BODEGA_ID ?>
<?php $identrada_bodega = entradaTableClass::ID ?>
<?php $fecha = entradaTableClass::CREATED_AT ?>
<?php $empleado = entradaTableClass::EMPLEADO_ID ?>
<?php $proveedor = entradaTableClass::PROVEEDOR_ID ?>


<?php $insumo = detalleEntradaTableClass::INSUMO_ID ?>
<?php $insumo_i = insumoTableClass::ID ?>
<?php $descInsumo = insumoTableClass::DESC_INSUMO ?>
<?php $fecha = detalleEntradaTableClass::CREATED_AT ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('detail_entry'); ?></h1>  
    </div>

</div>
<!--fintitulo-->
<!--cambio de idioma-->
<div class="container container-fluid">
    <div style="margin-bottom: 10px; margin-top: 30px">




        <table class="table table-bordered table-responsive table-striped table-condensed mitabla">  
            <thead>
                <tr class="active">
                    <th><input type="checkbox" id="chkAll"></th>
                    <th><?php echo i18n::__('employee') ?></th>
                    <th><?php echo i18n::__('supplier') ?></th>
                    <th><?php echo i18n::__('date') ?></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($objEntrada as $entrada): ?>
                    <tr class="text-info bg-info">
                        <td><input type="checkbox" name="chk[]" value="<?php echo $entrada->$id ?>"></td>
                        <td><?php echo empleadoTableClass::getNameEmpleado($entrada->$empleado) ?></td>
                        <td><?php echo proveedorTableClass::getNameProveedor($entrada->$proveedor) ?></td>
                        <td><?php echo $entrada->$fecha ?></td>

                    </tr>
                <?php endforeach ?>

        </table>  





        </table>  




        <a href="<?php echo routing::getInstance()->getUrlWeb('detalle', 'insert', array(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true) => $detalleEntradaId)) ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
        <!--<a href="javascrip:eliminarMasivo()" class="btn btn-danger btn-xs " data-target="#myModalDeleteMasivo" data-toggle="modal"id="btnDeleteMasivo" ><?php echo i18n::__('deleteall') ?></a>-->

        <button type="button" class="btn btn-primary btn-xs" id="btnFilter"data-toggle="modal" data-target="#myModalFilters" ><?php echo i18n::__('filter') ?></button>


        <!--filtros-->
        <a href="<?php echo routing::getInstance()->getUrlWeb('detalle', 'deleteFilters', array(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true) => $detalleEntradaId)) ?>" class="btn btn-default btn-xs " id="btndeletefilter" ><?php echo i18n::__('deleteFilter') ?></a>
        <button type="button" class="btn btn-warning btn-xs"class="" id="btnFilter"data-toggle="modal" data-target="#myModalReport" ><?php echo i18n::__('report') ?></button>

        <a href="<?php echo routing::getInstance()->getUrlWeb('detalle', 'report') ?>"class="btn btn-info btn-xs"><?php echo i18n::__('printOut') ?></a>

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
                    <form class="form-horizontal" role="form" id="report" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('detalle', 'report') ?>">

                        <div class="form-group">
                            <label for="filterCantidad" class="col-sm-2 control-label"><?php echo i18n::__('describe_product') ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="filter[Cantidad]" name="filter[Cantidad]" placeholder="cantidad">
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label for="filterValor" class="col-sm-2 control-label"><?php echo i18n::__('describe_product') ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="filter[Valor]" name="filter[Valor]" placeholder="Valor">
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="filterInsumo" class="col-sm-2 control-label"><?php echo i18n::__('describe_product') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterInsumo" name="filter[Insumo]">
                                    <option value=""><?php echo i18n::__('describe_product') ?></option>
                                    <?php foreach ($objInsumo as $producto): ?>
                                        <option value="<?php echo $producto->$insumo_i ?>"><?php echo $producto->$descInsumo ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>





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
                    <form class="form-horizontal" role="form" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('detalle', 'index', array(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true) => $detalleEntradaId)) ?>"><!--aqui poner array para sostener filtro-->

                         <?php if (isset($objDetalle) == true): ?>
                            <!--<input name="<?php // echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID, true) ?>" value="<?php // echo $objDetalleSalida[0]->$id ?>" type="hidden">-->
                            <input type="hidden" value="<?php echo $detalleEntradaId ?>" name="filer[<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, TRUE) ?>]"><!--tipo oculto para foranea-->
                        <?php endif; ?>

                        
                        <div class="form-group">
                            <label for="filterCantidad" class="col-sm-2 control-label"><?php echo i18n::__('describe_product') ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="filter[Cantidad]" name="filter[Cantidad]" placeholder="cantidad">
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label for="filterValor" class="col-sm-2 control-label"><?php echo i18n::__('describe_product') ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="filter[Valor]" name="filter[Valor]" placeholder="Valor">
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="filterInsumo" class="col-sm-2 control-label"><?php echo i18n::__('describe_product') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterInsumo" name="filter[Insumo]">
                                    <option value=""><?php echo i18n::__('describe_product') ?></option>
                                    <?php foreach ($objInsumo as $producto): ?>
                                        <option value="<?php echo $producto->$insumo_i ?>"><?php echo $producto->$descInsumo ?></option>
                                    <?php endforeach; ?>
                                </select>
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
            <form id="frmDeleteAll" id ="filterForm"action="<?php echo routing::getInstance()->getUrlWeb('detalle', 'deleteSelect', array(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true) => $detalleEntradaId)) ?>" method="POST">

                <table class="table table-bordered table-striped table-condensed mitabla">
                    <thead>
                        <tr class="active">
                            <th><input type="checkbox" id="chkAll"></th>
                            <th><?php echo i18n::__('cant') ?></th>
                            <th><?php echo i18n::__('value') ?></th>
                            <!--<th><?php // echo i18n::__('cellar entry') ?></th>-->
                            <th><?php echo i18n::__('product') ?></th>
                            <th><?php echo i18n::__('date') ?></th>
                            <th><?php echo i18n::__('action') ?></th>

                        </tr>        
                    </thead>
                    <tbody>
                        <?php foreach ($objDetalle as $detalle): ?> 
                            <tr class="text-info bg-info">
                                <td><input type="checkbox" name="chk[]" value="<?php echo $detalle->$id ?>"></td>
                                <td><?php echo $detalle->$cantidad ?></td>
                                <td><?php echo $detalle->$valor ?></td>
                                <!--<td><?php // echo $detalle->$entrada_bodega ?></td>-->
                                <td><?php echo insumoTableClass::getNameInsumo($detalle->$insumo) ?></td>
                                <td><?php echo date('d-m-Y h:i:s a', strtotime($detalle->$fecha)) ?></td>
                                <td>
                                    <a href="<?php echo routing::getInstance()->getUrlWeb('detalle', 'ver', array(detalleEntradaTableClass::ID => $detalle->$id, detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true) => $detalleEntradaId)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a>
                                    <a href="<?php echo routing::getInstance()->getUrlWeb('detalle', 'edit', array(detalleEntradaTableClass::ID => $detalle->$id, detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true) => $detalleEntradaId)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('publish') ?></a>

                                    <!--eliminado individual con ajax-->
                                    <a href="#" data-target="#myModalDelete<?php echo $detalle->$id ?>" data-toggle="modal" class="btn btn-danger btn-xs"><?php echo i18n::__('Delete') ?></a>

                                </td>
                            </tr>

                        <div class="modal fade" id="myModalDelete<?php echo $detalle->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!--pára que imprima el id en cada ventana-->
                                        <?php i18n::__('confirmDelete') ?> <?php echo $detalle->$cantidad ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                                        <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $detalle->$id ?>, '<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('detalle', 'delete') ?>')"><?php echo i18n::__('Delete') ?></button>
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
                página <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('detalle', 'index', array(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true) => $detalleEntradaId)) ?>')">
                    <?php for ($x = 1; $x <= $cntPages; $x++): ?> 
                        <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option> 

                    <?php endfor; ?>



                </select>de <?php echo $cntPages ?>

            </div>
            <!--fin paginado-->
        </div>
    </div>


    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('detalle', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo detalleEntradaTableClass::getNameField(insumoTableClass::ID, true) ?>">
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
