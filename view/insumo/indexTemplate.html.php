<!--@var $Insumo 
@var $page paginado mantiene el numero de la pagina -->
<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\configClass as confing ?>
<?php use mvc\request\requestClass as request ?>


<?php $id = insumoTableClass::ID ?>
<?php $descInsumo = insumoTableClass::DESC_INSUMO ?>
<?php $precio = insumoTableClass::PRECIO ?>
<?php $tipoInsumo = insumoTableClass::TIPO_INSUMO_ID ?>
<?php $fechaFabricacion = insumoTableClass::FECHA_FABRICACION ?>
<?php $fechaVencimiento = insumoTableClass::FECHA_VENCIMIENTO ?>
<?php $proveedorId = insumoTableClass::PROVEEDOR_ID ?>
<?php $fecha = insumoTableClass::CREATED_AT ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('product') ?></h1>  
    </div>

</div>
<!--fintitulo-->
<!--cambio de idioma-->
<div class="container container-fluid">
    <div style="margin-bottom: 10px; margin-top: 30px">

        

    <a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'insertInsumo') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
    <a href="javascrip:eliminarMasivo()" class="btn btn-danger btn-xs " data-target="#myModalDeleteMasivo" data-toggle="modal"id="btnDeleteMasivo" ><?php echo i18n::__('deleteall') ?></a>

    <button type="button" class="btn btn-primary btn-xs" id="btnFilter"data-toggle="modal" data-target="#myModalFilters" ><?php echo i18n::__('filter') ?></button>


    <!--filtros-->
    <a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteFilters') ?>" class="btn btn-default btn-xs " id="btndeletefilter" ><?php echo i18n::__('deleteFilter') ?></a>
    <button type="button" class="btn btn-warning btn-xs"class="" id="btnFilter"data-toggle="modal" data-target="#myModalReport" ><?php echo i18n::__('report') ?></button>
    
        <a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'reportInsumo') ?>"class="btn btn-info btn-xs"><?php echo i18n::__('printOut') ?></a>
   
</div>

<!--filtro con reporte-->
<div class="modal fade" id="myModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('report')?></h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form" id="report" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'reportInsumo') ?>">
                    <div class="form-group">
                        <label for="filterDesc_insumo" class="col-sm-2 control-label"><?php echo i18n::__('describe_product') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="filter[desc_insumo]" name="filter[insumo]" placeholder="desc_insumo">
                        </div>
                    </div>    <!--PONER CORCHER  EN NAME filter[insumo]-->
                    <div class="form-group">
                        <label for="filterprecio" class="col-sm-2 control-label"><?php echo i18n::__('prise') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="filter[Precio]" name="filter[Precio]" placeholder="Precio">
                        </div>
                    </div>  
                    <!--             <div class="form-group">
                                  <label for="filterTipo_insumo" class="col-sm-2 control-label"></?php echo i18n::__('type_product') ?></label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="filter[Tipo_insumo]" name="filter[Tipo_insumo]" placeholder="Tipo_insumo">
                                  </div>
                                </div> -->
                    <div class="form-group">
                        <label for="filterFecha_fabricacion" class="col-sm-2 control-label"><?php echo i18n::__('date_manufacture') ?></label>
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
                <button type="button" onclick="$('#report').submit()" class="btn btn-warnig"><?php echo i18n::__('report') ?></button>
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
                <form class="form-horizontal" role="form" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>">
                    <div class="form-group">
                        <label for="filterDesc_insumo" class="col-sm-2 control-label"><?php echo i18n::__('describe_product') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="filter[desc_insumo]" name="filter[insumo]" placeholder="desc_insumo">
                        </div>
                    </div>    <!--PONER CORCHER  EN NAME filter[insumo]-->
                    <div class="form-group">
                        <label for="filterprecio" class="col-sm-2 control-label"><?php echo i18n::__('prise') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="filter[Precio]" name="filter[Precio]" placeholder="Precio">
                        </div>
                    </div>  
                    <!--             <div class="form-group">
                                  <label for="filterTipo_insumo" class="col-sm-2 control-label"></?php echo i18n::__('type_product') ?></label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="filter[Tipo_insumo]" name="filter[Tipo_insumo]" placeholder="Tipo_insumo">
                                  </div>
                                </div> -->
                    <div class="form-group">
                        <label for="filterFecha_fabricacion" class="col-sm-2 control-label"><?php echo i18n::__('date_manufacture') ?></label>
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
        <form id="frmDeleteAll" id ="filterForm"action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteSelectInsumo') ?>" method="POST">

            <table class="table table-bordered table-striped table-condensed mitabla">
                <thead>
                    <tr class="active">
                        <th><input type="checkbox" id="chkAll"></th>
                        <th><?php echo i18n::__('describe_product') ?></th>
                        <th><?php echo i18n::__('prise') ?></th>
                        <th><?php echo i18n::__('type_product') ?></th>
                        <th><?php echo i18n::__('date_manufacture') ?></th>
                        <th><?php echo i18n::__('date_conquering') ?></th>
                        <th><?php echo i18n::__('provisioner') ?></th>
                        <th><?php echo i18n::__('date') ?></th>
                        <th><?php echo i18n::__('action') ?></th>

                    </tr>        
                </thead>
                <tbody>
                    <?php foreach ($objInsumo as $insumo): ?> 
                        <tr class="text-info bg-info">
                            <td><input type="checkbox" name="chk[]" value="<?php echo $insumo->$id ?>"></td>
                            <td><?php echo $insumo->$descInsumo ?></td>
                            <td><?php echo $insumo->$precio ?></td>
                            <td><?php echo tipoInsumoTableClass::getNameTipoin($insumo->$tipoInsumo) ?></td>
                            <td><?php echo $insumo->$fechaFabricacion ?></td>
                            <td><?php echo $insumo->$fechaVencimiento ?></td>
                            <td><?php echo proveedorTableClass::getNameProveedor($insumo->$proveedorId) ?></td>
                            <td><?php echo $insumo->$fecha ?></td>
                            <td>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'verInsumo', array(insumoTableClass::ID => $insumo->$id)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'editInsumo', array(insumoTableClass::ID => $insumo->$id)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('publish') ?></a>

                                <!--eliminado individual con ajax-->
                                <a href="#" data-target="#myModalDelete<?php echo $insumo->$id ?>" data-toggle="modal" class="btn btn-danger btn-xs">Eliminar</a>
                            </td>
                        </tr>

                    <div class="modal fade" id="myModalDelete<?php echo $insumo->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                                </div>
                                <div class="modal-body">
                                    <!--pára que imprima el id en cada ventana-->
                                    <?php i18n::__('confirmDelete') ?> <?php echo $insumo->$descInsumo ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                                    <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $insumo->$id ?>, '<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteInsumo') ?>')"><?php echo i18n::__('Delete') ?></button>
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
            página <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>')">
                <?php for ($x = 1; $x <= $cntPages; $x++): ?> 
                    <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option> 

                <?php endfor; ?>



            </select>de <?php echo $cntPages ?>

        </div>
        <!--fin paginado-->
    </div>
</div>


<form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteInsumo') ?>" method="POST">
    <input type="hidden" id="idDelete" name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>">
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
