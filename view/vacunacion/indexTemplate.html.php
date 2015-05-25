<!--@var $Insumo 
@var $page paginado mantiene el numero de la pagina -->
<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\configClass as confing ?>
<?php use mvc\request\requestClass as request ?>


<?php $id = vacunacionTableClass::ID ?>
<?php $dosis = vacunacionTableClass::DOSIS ?>
<?php $hora = vacunacionTableClass::HORA ?>
<?php $insumoId = vacunacionTableClass::INSUMO_ID ?>
<?php $idCerdo = vacunacionTableClass::ID_CERDO ?>
<?php $fecha = vacunacionTableClass::CREATED_AT ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('Vaccination') ?></h1>  
    </div>

</div>
<!--fintitulo-->
<!--cambio de idioma-->
<div class="container container-fluid">
    <div style="margin-bottom: 10px; margin-top: 30px">

        

    <a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'insertVacunacion') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
    <a href="javascrip:eliminarMasivo()" class="btn btn-danger btn-xs " data-target="#myModalDeleteMasivo" data-toggle="modal"id="btnDeleteMasivo" ><?php echo i18n::__('deleteall') ?></a>

    <button type="button" class="btn btn-primary btn-xs" id="btnFilter"data-toggle="modal" data-target="#myModalFilters" ><?php echo i18n::__('filter') ?></button>


    <!--filtros-->
    <a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteFilters') ?>" class="btn btn-default btn-xs " id="btndeletefilter" ><?php echo i18n::__('deleteFilter') ?></a>
    <button type="button" class="btn btn-warning btn-xs"class="" id="btnFilter"data-toggle="modal" data-target="#myModalReport" ><?php echo i18n::__('report') ?></button>
    
        <a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'reportVacunacion') ?>"class="btn btn-info btn-xs"><?php echo i18n::__('printOut') ?></a>
   
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
                <form class="form-horizontal" role="form" id="report" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'reportVacunacion') ?>">
                    <div class="form-group">
                        <label for="filterDosis" class="col-sm-2 control-label"><?php echo i18n::__('Dose') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="filter[dosis]" name="filter[dosis]" placeholder="dosis">
                        </div>
                    </div>    <!--PONER CORCHER  EN NAME filter[insumo]-->
                    <div class="form-group">
                        <label for="filterHora" class="col-sm-2 control-label"><?php echo i18n::__('Time') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="filter[hora]" name="filter[hora]" placeholder="hora">
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
                <form class="form-horizontal" role="form" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>">
                    <div class="form-group">
                        <label for="filterDosis" class="col-sm-2 control-label"><?php echo i18n::__('Dose') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="filter[dosis]" name="filter[dosis]" placeholder="dosis">
                        </div>
                    </div>    <!--PONER CORCHER  EN NAME filter[insumo]-->
                    <div class="form-group">
                        <label for="filterHora" class="col-sm-2 control-label"><?php echo i18n::__('Time') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="filter[hora]" name="filter[hora]" placeholder="hora">
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
        <form id="frmDeleteAll" id ="filterForm"action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteSelectVacunacion') ?>" method="POST">

            <table class="table table-bordered table-striped table-condensed mitabla">
                <thead>
                    <tr class="active">
                        <th><input type="checkbox" id="chkAll"></th>
                        <th><?php echo i18n::__('Dose') ?></th>
                        <th><?php echo i18n::__('Time') ?></th>
                        <th><?php echo i18n::__('product') ?></th>
                        <th><?php echo i18n::__('pig') ?></th>
                        <th><?php echo i18n::__('date') ?></th>
                        <th><?php echo i18n::__('action') ?></th>

                    </tr>        
                </thead>
                <tbody>
                    <?php foreach ($objVacunacion as $vacunacion): ?> 
                        <tr class="text-info bg-info">
                            <td><input type="checkbox" name="chk[]" value="<?php echo $vacunacion->$id ?>"></td>
                            <td><?php echo $vacunacion->$dosis ?></td>
                             <td><?php echo $vacunacion->$hora ?></td>
                            <!--<td></?php echo time('hh .?[AaPp] .? [Mm] .? [\0\t ]',strtotime($vacunacion->$hora)) ?></td>-->
                            <td><?php echo insumoTableClass::getNameInsumo($vacunacion->$insumoId) ?></td>
                            <td><?php echo $vacunacion->$idCerdo ?></td>
                            <td><?php echo date('d-m-Y h:i:s a', strtotime($vacunacion->$fecha)) ?></td>
                            <td>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'verVacunacion', array(vacunacionTableClass::ID => $vacunacion->$id)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'editVacunacion', array(vacunacionTableClass::ID => $vacunacion->$id)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('publish') ?></a>

                                <!--eliminado individual con ajax-->
                                <a href="#" data-target="#myModalDelete<?php echo $vacunacion->$id ?>" data-toggle="modal" class="btn btn-danger btn-xs"><?php echo i18n::__('Delete') ?></a>
                            </td>
                        </tr>

                    <div class="modal fade" id="myModalDelete<?php echo $vacunacion->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                                </div>
                                <div class="modal-body">
                                    <!--pára que imprima el id en cada ventana-->
                                    <?php i18n::__('confirmDelete') ?> <?php echo $vacunacion->$dosis ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                                    <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $vacunacion->$id ?>, '<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteVacunacion') ?>')"><?php echo i18n::__('Delete') ?></button>
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
            página <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>')">
                <?php for ($x = 1; $x <= $cntPages; $x++): ?> 
                    <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option> 

                <?php endfor; ?>



            </select>de <?php echo $cntPages ?>

        </div>
        <!--fin paginado-->
    </div>
</div>


<form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteVacunacion') ?>" method="POST">
    <input type="hidden" id="idDelete" name="<?php echo vacunacionTableClass::getNameField(vacunacionTableClass::ID, true) ?>">
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