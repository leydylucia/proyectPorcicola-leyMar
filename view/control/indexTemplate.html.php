<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php use mvc\routing\routingClass as routing ?> 
<?php use mvc\view\viewClass as view ?> 
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\myConfigClass as config ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass as session ?>

<?php $id = controlTableClass::ID ?>
<?php $unidad = controlTableClass::UNIDAD_MEDIDA_ID ?>
<?php $peso_cerdo = controlTableClass::PESO_CERDO ?>
<?php $empleado_id = controlTableClass::EMPLEADO_ID ?>
<?php $hoja_vida_id = controlTableClass::HOJA_VIDA ?>
<?php $fecha = controlTableClass::CREATED_AT ?>


<!--titulo-->
<div class="container container-fluid">
  <div class="page-header titulo">
    <h1><?php echo i18n::__('weight control') ?></h1>  
  </div>
</div>
<!--fintitulo-->

<div class="container container-fluid">
  <div style="margin-bottom: 10px; margin-top: 30px">

    <!-- FILTROS -->
    <div class="modal fade" id="myModalFilters" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filter') ?></h4>
          </div>

<?php if (session::getInstance()->hasError('inputPeso')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputPeso') ?><!--esta linea para actualizar demas formularios-->
            </div>
<?php endif ?>

          <div class="modal-body">
            <form class="form-horizontal" role="form" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('control', 'index') ?>">
              <div class="form-group">
                <label for="filtercontrol" class="col-sm-2 control-label"><?php echo i18n::__('pig weight') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filter[control]" name="<?php echo controlTableClass::getNameField(controlTableClass::PESO_CERDO, true) ?>" placeholder="control peso">
                </div>
              </div>    <!--PONER CORCHER  EN NAME filter[insumo]-->


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

    <!-- REPORTE CON FILTROS -->
    <div class="modal fade" id="myModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Reporte</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="report" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('control', 'report') ?>">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Control Peso</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filter[control]" name="filter[control]" placeholder="control peso">
                </div>
              </div>
<!--              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha Creaccion</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="filterDate" name="filter[fechaCreacion]">
                  <br>

                </div>
              </div>-->
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" onclick="$('#report').submit()" class="btn btn-warning">Reporte</button>
          </div>
        </div>
      </div>
    </div>

    <!--FIN REPORTE-->

    <div style="margin-bottom: 10px; margin-top: 30px">
      <a href="<?php echo routing::getInstance()->getUrlWeb('control', 'insert') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
      <a href="javascrip:eliminarMasivo()" class="btn btn-danger btn-xs " data-target="#myModalDeleteMasivo" data-toggle="modal"id="btnDeleteMasivo" ><?php echo i18n::__('deleteall') ?></a>
      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilters"><?php echo i18n::__('filter') ?></button>
      <a href="<?php echo routing::getInstance()->getUrlWeb('control', 'index') ?>" class="btn btn-default btn-xs " id="btndeletefilter" ><?php echo i18n::__('deleteFilter') ?></a>
      <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModalReport"><?php echo i18n::__('report') ?></button>
      <a target="_NEW" href="<?php echo routing::getInstance()->getUrlWeb('control', 'report') ?>" class="btn btn-info btn-xs"><?php echo i18n::__('printOut') ?></a>
    </div>


<?php view::includeHandlerMessage() ?>  <!--esta linea es para traer mensajes de exito cunado registra -->

    <div class="container table-responsive"><!--esto es boostrap que no se te el olvides de cerrar el div-->
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('control', 'deleteSelect') ?>" method="POST">
      <table class="table table-bordered table-responsive table-striped table-condensed mitabla">
        <thead>
            <tr class="active">
            <th><input type="checkbox" id="chkAll"></th>
            <th><?php echo i18n::__('pig') ?></th>
            <th><?php echo i18n::__('unit_measure') ?></th>
            <th><?php echo i18n::__('pig weight') ?></th>
            <th><?php echo i18n::__('employee') ?></th>
            <th><?php echo i18n::__('date') ?></th>
            <th><?php echo i18n::__('actions') ?></th>
          </tr>
        </thead>
        <tbody>
<?php foreach ($objControl as $control): ?>
            <tr class="text-info bg-info">
              <td><input type="checkbox" name="chk[]" value="<?php echo $control->$id ?>"></td>
              <td><?php echo hojaVidaTableClass::getNameHojaVida($control->$hoja_vida_id) ?></td>
              <td><?php echo unidadMedidaTableClass::getNameUnidadMedida($control->$unidad) ?></td>
              <td><?php echo $control->$peso_cerdo ?></td>
              <td><?php echo empleadoTableClass::getNameEmpleado($control->$empleado_id) . ' ' . empleadoTableClass::getNameApellido($control->$empleado_id) ?></td>
              <td><?php echo date('d-m-Y h:i:s a', strtotime($control->$fecha)) ?></td>
              <td>
                <a href="<?php echo routing::getInstance()->getUrlWeb('control', 'ver', array(controlTableClass::ID => $control->$id)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('control', 'edit', array(controlTableClass::ID => $control->$id)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('publish') ?></a>

                <!--eliminado individual con ajax-->
                <a href="#" data-target="#myModalDelete<?php echo $control->$id ?>" data-toggle="modal" class="btn btn-danger btn-xs"><?php echo i18n::__('delete') ?></a>
              </td>
            </tr>

          <div class="modal fade" id="myModalDelete<?php echo $control->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                </div>
                <div class="modal-body">
                  <!--pára que imprima el id en cada ventana-->
          <?php i18n::__('confirmDelete') ?> <?php echo $control->$peso_cerdo ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                  <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $control->$id ?>, '<?php echo controlTableClass::getNameField(controlTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('control', 'delete') ?>')"><?php echo i18n::__('delete') ?></button>
                </div>
              </div>
            </div>
          </div>
<?php endforeach ?>
        </tbody>
      </table>  
    </form>
  </div>
</div>


<form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('control', 'delete') ?>" method="POST">
  <input type="hidden" id="idDelete" name="<?php echo controlTableClass::getNameField(controlTableClass::ID, true) ?>">
</form>

<!--eliminado masivo en ajax-->
<div class="modal fade" id="myModalDeleteMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirmar elementos seleccionados</h4>
      </div>
      <div class="modal-body">

<?php i18n::__('confirmDeleteMasivo') ?> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
        <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('confirm') ?></button>
      </div>
    </div>
  </div>
</div>


<div class="text-right container container-fluid">
<?php echo i18n::__('pag') ?><select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('control', 'index') ?>')">
<?php for ($x = 1; $x <= $cntPages; $x++): ?> 
      <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option> 

<?php endfor; ?>

  </select><?php echo i18n::__('off') ?> <?php echo $cntPages ?>
</div>



