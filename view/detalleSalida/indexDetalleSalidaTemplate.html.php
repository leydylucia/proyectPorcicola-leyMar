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

<?php $id = detalleSalidaTableClass::ID ?>
<?php $cantidad = detalleSalidaTableClass::CANTIDAD ?>
<?php $salida_bodega = detalleSalidaTableClass::SALIDA_BODEGA_ID ?>
<?php $idSalida_bodega = salidaBodegaTableClass::ID ?>
<?php $fecha = salidaBodegaTableClass::CREATED_AT ?>
<?php $empleado = salidaBodegaTableClass::EMPLEADO_ID ?>

<?php $insumo = detalleSalidaTableClass::INSUMO_ID ?>
<?php $insumo_i = insumoTableClass::ID ?>
<?php $descInsumo = insumoTableClass::DESC_INSUMO ?>

<?php $unidad_medida = detalleSalidaTableClass::UNIDAD_MEDIDA_ID ?>
<?php $lote = detalleSalidaTableClass::LOTE_ID ?>
<?php $lote_l = loteTableClass::ID ?>
<?php $nombre_lote = loteTableClass::DESC_LOTE ?>
<?php $fecha = detalleSalidaTableClass::CREATED_AT ?>
<!--titulo-->
<div class="container container-fluid">
  <div class="page-header titulo">
    <h1><?php echo i18n::__('Output_detail_winery'); ?></h1>  
  </div>

</div>
<!--fintitulo-->
<!--cambio de idioma-->
<div class="container container-fluid">
  <div style="margin-bottom: 10px; margin-top: 30px">




    <table class="table table-bordered table-striped table-condensed mitabla">
      <thead>
        <tr class="active">
          <th><input type="checkbox" id="chkAll"></th>
          <th><?php echo i18n::__('empleyeed') ?></th>
          <th><?php echo i18n::__('date') ?></th>


        </tr>        
      </thead>
      <tbody>
        <?php foreach ($objSalidaBodega as $salidaBodega): ?> 
          <tr class="text-info bg-info">
            <td><input type="checkbox" name="chk[]" value="<?php echo $salidaBodega->$id ?>"></td>

            <td><?php echo empleadoTableClass::getNameEmpleado($salidaBodega->$empleado) . ' ' . empleadoTableClass::getNameApellido($salidaBodega->$empleado) ?></td>
            <td><?php echo date('d-m-Y h:i:s a', strtotime($salidaBodega->$fecha)) ?></td>

          </tr>

        <?php endforeach ?>




    </table>  



        <!--<a href="<?php // echo routing::getInstance()->getUrlWeb('detalleSalida', 'insertDetalleSalida')      ?>" class="btn btn-success btn-xs"><?php // echo i18n::__('new')      ?></a>-->
    <a href="<?php echo routing::getInstance()->getUrlWeb('detalleSalida', 'insertDetalleSalida', array(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true) => $detalleSalidaId)) ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
    <!--<a href="javascrip:eliminarMasivo()" class="btn btn-danger btn-xs " data-target="#myModalDeleteMasivo" data-toggle="modal"id="btnDeleteMasivo" ><?php echo i18n::__('deleteall') ?></a>-->

    <button type="button" class="btn btn-primary btn-xs" id="btnFilter"data-toggle="modal" data-target="#myModalFilters" ><?php echo i18n::__('filter') ?></button>


    <!--filtros-->
    <a href="<?php echo routing::getInstance()->getUrlWeb('detalleSalida', 'deleteFiltersDetalleSalida', array(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true) => $detalleSalidaId)) ?>" class="btn btn-default btn-xs " id="btndeletefilter" ><?php echo i18n::__('deleteFilter') ?></a>
    <button type="button" class="btn btn-warning btn-xs"class="" id="btnFilter"data-toggle="modal" data-target="#myModalReport" ><?php echo i18n::__('report') ?></button>

    <a href="<?php echo routing::getInstance()->getUrlWeb('detalleSalida', 'reportDetalleSalida') ?>"class="btn btn-info btn-xs"><?php echo i18n::__('printOut') ?></a>
    <a class="btn btn-primary btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('salidaBodega', 'indexSalidaBodega') ?>"><?php echo i18n::__('return') ?> </a>
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
          <form class="form-horizontal" role="form" id="report" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('detalleSalida', 'reportDetalleSalida') ?>">



            <div class="form-group">
              <label for="filterInsumo" class="col-sm-2 control-label"><?php echo i18n::__('describe_product') ?></label>
              <div class="col-sm-10">
                <select class="form-control" id="filterInsumo" name="filter[Insumo]">
                  <option value=""><?php echo i18n::__('select_product') ?></option>
                  <?php foreach ($objInsumo as $producto): ?>
                    <option value="<?php echo $producto->$insumo_i ?>"><?php echo $producto->$descInsumo ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="filterLote" class="col-sm-2 control-label"><?php echo i18n::__('batch') ?></label>
              <div class="col-sm-10">
                <select class="form-control" id="filterLote" name="filter[Lote]">
                  <option value=""><?php echo i18n::__('select_batch') ?></option>
                  <?php foreach ($objLote as $ubicacion): ?>
                    <option value="<?php echo $ubicacion->$lote_l ?>"><?php echo $ubicacion->$nombre_lote ?></option>
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
          <form class="form-horizontal" role="form" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('detalleSalida', 'indexDetalleSalida', array(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true) => $detalleSalidaId)) ?>"><!--aqui poner array para sostener filtro-->

            <?php if (isset($objDetalleSalida) == true): ?>
           <!--<input name="<?php // echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID, true)    ?>" value="<?php // echo $objDetalleSalida[0]->$id    ?>" type="hidden">-->
              <input type="hidden" value="<?php echo $detalleSalidaId ?>" name="filer[<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, TRUE) ?>]"><!--tipo oculto para foranea-->
            <?php endif; ?>




            <div class="form-group">
              <label for="filterInsumo" class="col-sm-2 control-label"><?php echo i18n::__('describe_product') ?></label>
              <div class="col-sm-10">
                <select class="form-control" id="filterInsumo" name="filter[Insumo]">
                  <option value=""><?php echo i18n::__('select_product') ?></option>
                  <?php foreach ($objInsumo as $producto): ?>
                    <option value="<?php echo $producto->$insumo_i ?>"><?php echo $producto->$descInsumo ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="filterLote" class="col-sm-2 control-label"><?php echo i18n::__('batch') ?></label>
              <div class="col-sm-10">
                <select class="form-control" id="filterLote" name="filter[Lote]">
                  <option value=""><?php echo i18n::__('select_batch') ?></option>
                  <?php foreach ($objLote as $ubicacion): ?>
                    <option value="<?php echo $ubicacion->$lote_l ?>"><?php echo $ubicacion->$nombre_lote ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>



            <input type="hidden" value="<?php echo $detalleSalidaId ?>" name="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true) ?>">

            <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo i18n::__('date_creation') ?></label>
              
              <div class="col-sm-10">
                <input type="date" class="form-control" id="filter[Date1]" name="filter[Date1]">
                 </div>
               </div>
              <div class="form-group">
              <label class="col-sm-2 control-label"><?php echo i18n::__('date_end') ?></label>
               <div class="col-sm-10">
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
      <form id="frmDeleteAll" id ="filterForm"action="<?php echo routing::getInstance()->getUrlWeb('detalleSalida', 'deleteSelectDetalleSalida') ?>" method="POST">

        <table class="table table-bordered table-striped table-condensed mitabla">
          <thead>
            <tr class="active">
              <th><input type="checkbox" id="chkAll"></th>
              <th><?php echo i18n::__('quantity') ?></th>
              <th><?php echo i18n::__('unit_measure') ?></th>
              <th><?php echo i18n::__('describe_product') ?></th>  
              <th><?php echo i18n::__('batch') ?></th>
              <th><?php echo i18n::__('date') ?></th>
              <th><?php echo i18n::__('action') ?></th>

            </tr>        
          </thead>
          <tbody>
            <?php foreach ($objDetalleSalida as $detalleSalida): ?> 
              <tr class="text-info bg-info">
                <td><input type="checkbox" name="chk[]" value="<?php echo $detalleSalida->$id ?>"></td>
                <td><?php echo $detalleSalida->$cantidad ?></td>
                <td><?php echo unidadMedidaTableClass::getNameUnidadMedida($detalleSalida->$unidad_medida) ?></td>
                <td><?php echo insumoTableClass::getNameInsumo($detalleSalida->$insumo) ?></td>
                <td><?php echo loteTableClass::getNameLote($detalleSalida->$lote) ?></td>
                <td><?php echo date('d-m-Y h:i:s a', strtotime($detalleSalida->$fecha)) ?></td>
                <td>
                  <a href="<?php echo routing::getInstance()->getUrlWeb('detalleSalida', 'verDetalleSalida', array(detalleSalidaTableClass::ID => $detalleSalida->$id, detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true) => $detalleSalidaId)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a>
                  <a href="<?php echo routing::getInstance()->getUrlWeb('detalleSalida', 'editDetalleSalida', array(detalleSalidaTableClass::ID => $detalleSalida->$id, detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true) => $detalleSalidaId)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('publish') ?></a>

                  <!--eliminado individual con ajax-->
                  <a href="#" data-target="#myModalDelete<?php echo $detalleSalida->$id ?>" data-toggle="modal" class="btn btn-danger btn-xs"><?php echo i18n::__('Delete') ?></a>

                </td>
              </tr>

            <div class="modal fade" id="myModalDelete<?php echo $detalleSalida->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                  </div>
                  <div class="modal-body">
                    <!--pára que imprima el id en cada ventana-->
                    <?php i18n::__('confirmDelete') ?> <?php echo $detalleSalida->$cantidad ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                    <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $detalleSalida->$id ?>, '<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('detalleSalida', 'deleteDetalleSalida') ?>')"><?php echo i18n::__('Delete') ?></button>
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
        página <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('detalleSalida', 'indexDetalleSalida', array(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true) => $detalleSalidaId)) ?>')">
          <?php for ($x = 1; $x <= $cntPages; $x++): ?> 
            <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option> 

          <?php endfor; ?>



        </select>de <?php echo $cntPages ?>

      </div>
      <!--fin paginado-->
    </div>
  </div>


  <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('detalleSalida', 'deleteDetalleSalida') ?>" method="POST">
    <input type="hidden" id="idDelete" name="<?php echo detalleSalidaTableClass::getNameField(insumoTableClass::ID, true) ?>">
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
