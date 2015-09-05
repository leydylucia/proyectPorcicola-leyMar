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
<?php
use mvc\session\sessionClass as session ?>


<?php $id = detalleHojaTableClass::ID ?>
<?php $peso_cerdo = detalleHojaTableClass::PESO_CERDO ?>

<?php $tipoInsumo = detalleHojaTableClass::TIPO_INSUMO_ID ?>
<?php $idTipoInsumo = tipoInsumoTableClass::ID ?>
<?php $desTipoInsumo = tipoInsumoTableClass::DESC_TIPOIN ?>
<?php $dosis = detalleHojaTableClass::DOSIS ?>
<?php $unidad_medida = detalleHojaTableClass::UNIDAD_MEDIDA_ID ?>
<?php $insumo = detalleHojaTableClass::INSUMO_ID ?>
<?php $idinsumo = insumoTableClass::ID ?>
<?php $nominsumo = insumoTableClass::DESC_INSUMO ?>
<?php $fecha = detalleHojaTableClass::CREATED_AT ?>


<?php $id = hojaVidaTableClass::ID ?>
<?php $genero_id = hojaVidaTableClass::GENERO_ID ?>
<?php $nombre_cerdo = hojaVidaTableClass::NOMBRE_CERDO ?>
<?php $fecha_nacimiento = hojaVidaTableClass::FECHA_NACIMIENTO ?>
<?php $estado_id = hojaVidaTableClass::ESTADO_ID ?>
<?php $lote_id = hojaVidaTableClass::LOTE_ID ?>
<?php $raza_id = hojaVidaTableClass::RAZA_ID ?>


<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('detail_curriculum_vitae') ?></h1>  
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
                    <th><?php echo i18n::__('genre') ?></th>
                    <th><?php echo i18n::__('name_pig') ?></th>
                    <th><?php echo i18n::__('date_birth') ?></th>
                    <th><?php echo i18n::__('state') ?></th>
                    <th><?php echo i18n::__('batch') ?></th>
                    <th><?php echo i18n::__('race') ?></th>
                   <!-- <th></?php echo i18n::__('mother') ?></th> -->
                    <th><?php echo i18n::__('date') ?></th>
                   

                </tr>
            </thead>
            <tbody>
                <?php foreach ($objHojaVida as $hojaVida): ?>
                    <tr class="text-info bg-info">
                        <td><input type="checkbox" name="chk[]" value="<?php echo $hojaVida->$id ?>"></td>
                        <td><?php echo generoTableClass::getNameGenero($hojaVida->$genero_id) ?></td>
                        <td><?php echo $hojaVida->$nombre_cerdo ?></td>
                        <td><?php echo $hojaVida->$fecha_nacimiento ?></td>
                        <td><?php echo estadoTableClass::getNameEstado($hojaVida->$estado_id) ?></td>
                        <td><?php echo loteTableClass::getNameLote($hojaVida->$lote_id) ?></td>
                        <td><?php echo razaTableClass::getNameRaza($hojaVida->$raza_id) ?></td>
                      <!-- <td></?php echo hojaVidaTableClass::getNameHojaVida($hojaVida->$id_madre) ?></td> -->
                        <td><?php echo $hojaVida->$fecha ?></td>
                    </tr>
                <?php endforeach ?>

        </table>  





        </table>  


        <a href="<?php echo routing::getInstance()->getUrlWeb('detalleHoja', 'insert', array(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true) => $detalleHojaId)) ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
        <!--<a href="javascrip:eliminarMasivo()" class="btn btn-danger btn-xs " data-target="#myModalDeleteMasivo" data-toggle="modal"id="btnDeleteMasivo" ><?php // echo i18n::__('deleteall') ?></a>-->

        <!--<button type="button" class="btn btn-primary btn-xs" id="btnFilter"data-toggle="modal" data-target="#myModalFilters" ><?php // echo i18n::__('filter') ?></button>-->


        <!--filtros-->
        <!--<a href="<?php // echo routing::getInstance()->getUrlWeb('detalleHoja', 'deleteFilters') ?>" class="btn btn-default btn-xs " id="btndeletefilter" ><?php // echo i18n::__('deleteFilter') ?></a>-->
        <button type="button" class="btn btn-warning btn-xs"class="" id="btnFilter"data-toggle="modal" data-target="#myModalReport" ><?php echo i18n::__('report') ?></button>

        <a href="<?php echo routing::getInstance()->getUrlWeb('detalleHoja', 'report') ?>"class="btn btn-info btn-xs"><?php echo i18n::__('printOut') ?></a>
        <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'index') ?>"><?php echo i18n::__('return') ?> </a>
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
                    <form class="form-horizontal" role="form" id="report" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('detalleHoja', 'report') ?>">
                   
                       <div class="form-group">
                            <label for="filterCantidad" class="col-sm-2 control-label"><?php echo i18n::__('cant') ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="filter[Cantidad]" name="filter[Cantidad]" placeholder="cantidad">
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="filterTipo_insumo" class="col-sm-2 control-label"><?php echo i18n::__('type_product') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterTipo_insumo" name="filter[Tipo_insumo]">
                                    <option value=""><?php echo i18n::__('type_product') ?></option>
                                    <?php foreach ($objTipoin as $ciudad): ?>
                                        <option value="<?php echo $ciudad->$idTipoInsumo ?>"><?php echo $ciudad->$desTipoInsumo ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="filterProveedo" class="col-sm-2 control-label"><?php echo i18n::__('provisioner') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterTipo_insumo" name="filter[Proveedor]">
                                    <option value=""><?php echo i18n::__('provisioner') ?></option>
                                    <?php foreach ($objProv as $proveedor): ?>
                                        <option value="<?php echo $proveedor->$idproveedor ?>"><?php echo $proveedor->$nomproveedor ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="filterFecha_fabricacion" class="col-sm-2 control-label"><?php echo i18n::__('Date_of_manufacture_or_purchase') ?></label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="filter[Fecha_fabricacion]" name="filter[Fecha_fabricacion]" placeholder="Fecha_fabricacion">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="filterFecha_vencimiento" class="col-sm-2 control-label"><?php echo i18n::__('date_conquering') ?></label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="filter[Fecha_vencimiento]" name="filter[Fecha_vencimiento]" placeholder="Fecha_vencimiento">
                            </div>
                        </div> 
                        <!-- <div class="form-group">
                           <label for="filterProveedor" class="col-sm-2 control-label"></?php echo i18n::__('provisioner') ?></label>
                           <div class="col-sm-10">
                             <input type="text" class="form-control" id="filter[Proveedor]" name="filter[Proveedor]" placeholder="Proveedor">
                           </div>
                         </div> -->


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
                    <form class="form-horizontal" role="form" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('detalleHoja', 'index') ?>">

                        <?php if (session::getInstance()->hasError('inputDescInsumo')): ?><!--inicio de validaciones-->
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputDescInsumo') ?><!--esta linea para actualizar demas formularios-->
                            </div>
                        <?php endif ?> 

                        <!--                        <div class="form-group">
                                                    <label for="filterDesc_insumo" class="col-sm-2 control-label"><?php echo i18n::__('describe_product') ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="filter[desc_insumo]" name="filter[<?php echo insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true) ?>]" placeholder="desc_insumo">
                                                    </div>
                                                </div>    PONER CORCHER  EN NAME filter[insumo]-->



                        <div class="form-group">
                            <label for="filterTipo_insumo" class="col-sm-2 control-label"><?php echo i18n::__('type_product') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterTipo_insumo" name="filter[Tipo_insumo]">
                                    <option value=""><?php echo i18n::__('type_product') ?></option>
                                    <?php foreach ($objTipoin as $ciudad): ?>
                                        <option value="<?php echo $ciudad->$idTipoInsumo ?>"><?php echo $ciudad->$desTipoInsumo ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="filterProveedo" class="col-sm-2 control-label"><?php echo i18n::__('provisioner') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterTipo_insumo" name="filter[Proveedor]">
                                    <option value=""><?php echo i18n::__('provisioner') ?></option>
                                    <?php foreach ($objProv as $proveedor): ?>
                                        <option value="<?php echo $proveedor->$idproveedor ?>"><?php echo $proveedor->$nomproveedor ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="filterFecha_fabricacion" class="col-sm-2 control-label"><?php echo i18n::__('Date_of_manufacture_or_purchase') ?></label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="filter[Fecha_fabricacion]" name="filter[Fecha_fabricacion]" placeholder="Fecha_fabricacion">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="filterFecha_vencimiento" class="col-sm-2 control-label"><?php echo i18n::__('date_conquering') ?></label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="filter[Fecha_vencimiento]" name="filter[Fecha_vencimiento]" placeholder="Fecha_vencimiento">
                            </div>
                        </div> 


                        <!--                        <div class="form-group">
                                                    <label class="col-sm-2 control-label"><?php echo i18n::__('date_creation') ?></label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="filter[Date1]" name="filter[Date1]">
                                                        <br>
                                                        <input type="date" class="form-control" id="filter[Date2]" name="filter[Date2]">
                                                    </div>
                                                </div>-->
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                    <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary"><?php echo i18n::__('filter') ?></button>
                </div>
            </div>
        </div>
    </div>

    <?php if (session::getInstance()->hasFlash('modalFilters') === true): ?>

        <script>
            $(document).ready(function () {
                $('#myModalFilters').modal('toogle');
            });
        </script>
    <?php endif ?>
    <!--fin de modal filtro-->

    <?php view::includeHandlerMessage() ?><!--esta linea es para traer mensajes de exito cunado registra-->


    <div class="container">
        <div class="table-responsive">
            <form id="frmDeleteAll" id ="filterForm"action="<?php echo routing::getInstance()->getUrlWeb('detalleHoja', 'deleteSelect') ?>" method="POST">

                <table class="table table-bordered table-striped table-condensed mitabla">
                    <thead>
                        <tr class="active">
                            <th><input type="checkbox" id="chkAll"></th>
                            <th><?php echo i18n::__('pig_weight') ?></th>
                            <th><?php echo i18n::__('unit_measure') ?></th>
                            <th><?php echo i18n::__('Dose') ?></th>
                            <th><?php echo i18n::__('product') ?></th>
                            <th><?php echo i18n::__('type_product') ?></th>
                            <th><?php echo i18n::__('date') ?></th>
                            <th><?php echo i18n::__('action') ?></th>

                        </tr>        
                    </thead>
                    <tbody>
                        <?php foreach ($objDetalleHoja as $detalle): ?> 
                            <tr class="text-info bg-info">
                                <td><input type="checkbox" name="chk[]" value="<?php echo $detalle->$id ?>"></td>
                                <td><?php echo $detalle->$peso_cerdo ?></td>
                                <td> <?php echo unidadMedidaTableClass::getNameUnidadMedida($detalle->$unidad_medida); ?></td>
                                <td><?php echo $detalle->$dosis ?></td>
                                <td><?php echo insumoTableClass::getNameInsumo($detalle->$insumo) ?></td>
                                <td><?php echo tipoInsumoTableClass::getNameTipoin($detalle->$tipoInsumo) ?></td>
                                <td><?php echo date('d-m-Y h:i:s a', strtotime($detalle->$fecha)) ?></td>
                                <td>
                                    <a href="<?php echo routing::getInstance()->getUrlWeb('detalleHoja', 'ver', array(detalleHojaTableClass::ID => $detalle->$id)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a>
                                    <a href="<?php echo routing::getInstance()->getUrlWeb('detalleHoja', 'edit', array(detalleHojaTableClass::ID => $detalle->$id, detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true) => $detalleHojaId)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('publish') ?></a>

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
                                        <?php i18n::__('confirmDelete') ?> <?php echo $detalle->$peso_cerdo ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                                        <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $detalle->$id ?>, '<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('detalleHoja', 'delete') ?>')"><?php echo i18n::__('Delete') ?></button>
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
               página <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('detalleHoja', 'index', array(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true) => $detalleHojaId)) ?>')">
                    <?php for ($x = 1; $x <= $cntPages; $x++): ?> 
                        <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option> 

                    <?php endfor; ?>



                </select>de <?php echo $cntPages ?>

            </div>
            <!--fin paginado-->
        </div>
    </div>


    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('detalleHoja', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo detalleHojaTableClass::getNameField(detalleHojaTableClass::ID, true) ?>">
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
