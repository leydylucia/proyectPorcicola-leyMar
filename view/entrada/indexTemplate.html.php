<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php use mvc\routing\routingClass as routing ?> 
<?php use mvc\view\viewClass as view ?> 
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\request\requestClass as request ?>

<?php $id = entradaTableClass::ID ?>
<?php $empleado_id = entradaTableClass::EMPLEADO_ID ?>
<?php $empleado_id_e = empleadoTableClass::ID?>
<?php $nombre_em = empleadoTableClass::NOMBRE?>
<?php $proveedor_id = entradaTableClass::PROVEEDOR_ID ?>
<?php $proveedor_id_p = proveedorTableClass::ID ?>
<?php $nombre = proveedorTableClass::NOMBRE ?>
<?php $fecha = entradaTableClass::CREATED_AT ?>

<!--titulo-->
<div class="container container-fluid">
  <div class="page-header titulo">
    <h1><?php echo i18n::__('cellar entry') ?></h1>  
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

          <div class="modal-body">
            <form class="form-horizontal" role="form" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('entrada', 'indexEn') ?>">
              <div class="form-group">
                            <label for="filterEmpleado" class="col-sm-2 control-label"><?php echo i18n::__('empleyeed') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterEmpleado" name="filter[Empleado]">
                                    <option value=""><?php echo i18n::__('empleyeed') ?></option>
                                     <?php foreach ($objEmpleado as $trabajador): ?>
                                        <option value="<?php echo $trabajador->$proveedor_id_p ?>"><?php echo $trabajador->$nombre ?></option>
                                     <?php endforeach; ?>
                                </select>
                            </div>
                        </div> 
              
              <div class="form-group">
                            <label for="filterProveedor" class="col-sm-2 control-label"><?php echo i18n::__('supplier') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterProveedor" name="filter[Proveedor]">
                                    <option value=""><?php echo i18n::__('supplier') ?></option>
                                     <?php foreach ($objProv as $prov): ?>
                                        <option value="<?php echo $prov->$empleado_id_e ?>"><?php echo $prov->$nombre_em ?></option>
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

    <!-- REPORTE CON FILTROS -->
    <div class="modal fade" id="myModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('report') ?></h4>
          </div>

          <div class="modal-body">
            <form class="form-horizontal" role="form" id="report" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('entrada', 'reportEn') ?>">
              <div class="form-group">
                <label for="filterempleado" class="col-sm-2 control-label"><?php echo i18n::__('employee') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filter[empleado]" name="filter[empleado]" placeholder="empleado">
                </div>
              </div>    <!--PONER CORCHER  EN NAME filter[insumo]-->
              <div class="form-group">
                <label for="filterproveedor" class="col-sm-2 control-label"><?php echo i18n::__('supplier') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filter[proveedor]" name="filter[proveedor]" placeholder="proveedor">
                </div>
              </div>  
              
               <div class="form-group">
                <label for="filterempleado" class="col-sm-2 control-label"><?php echo i18n::__('employee') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="filterempleado" name="filter[empleado]">
                    <option value=""><?php echo i18n::__('employee') ?></option>
<?php foreach ($objEmpleado as $empleado): ?>
                      <option value="<?php echo $empleado->$empleado_id_e ?>"><?php echo $empleado->$nombre_em ?></option>
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


    <!--FIN REPORTE-->

    <div style="margin-bottom: 10px; margin-top: 30px">
      <a href="<?php echo routing::getInstance()->getUrlWeb('entrada', 'insertEn') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
      <a href="javascrip:eliminarMasivo()" class="btn btn-danger btn-xs " data-target="#myModalDeleteMasivo" data-toggle="modal"id="btnDeleteMasivo" ><?php echo i18n::__('deleteall') ?></a>
      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilters"><?php echo i18n::__('filter') ?></button>
      <a href="<?php echo routing::getInstance()->getUrlWeb('entrada', 'indexEn') ?>" class="btn btn-default btn-xs " id="btndeletefilter" ><?php echo i18n::__('deleteFilter') ?></a>
<!--      <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModalReport"><?php // echo i18n::__('report') ?></button>
      <a target="_NEW" href="<?php echo routing::getInstance()->getUrlWeb('entrada', 'reportEn') ?>" class="btn btn-info btn-xs"><?php // echo i18n::__('printOut') ?></a>-->
    </div>


<?php view::includeHandlerMessage() ?>  <!--esta linea es para traer mensajes de exito cunado registra -->

    <div class="container table-responsive"><!--esto es boostrap que no se te el olvides de cerrar el div-->
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('entrada', 'deleteSelectEn') ?>" method="POST">
      <table class="table table-bordered table-responsive table-striped table-condensed mitabla">  
      <thead>
          <tr class="active">
            <th><input type="checkbox" id="chkAll"></th>
            <th><?php echo i18n::__('employee') ?></th>
            <th><?php echo i18n::__('supplier') ?></th>
            <th><?php echo i18n::__('date') ?></th>
            <th><?php echo i18n::__('actions') ?></th>

          </tr>
        </thead>
        <tbody>
<?php foreach ($objEntrada as $entrada): ?>
            <tr class="text-info bg-info">
              <td><input type="checkbox" name="chk[]" value="<?php echo $entrada->$id ?>"></td>
              <td><?php echo empleadoTableClass::getNameEmpleado($entrada->$empleado_id) . ' ' . empleadoTableClass::getNameApellido($entrada->$empleado_id) ?></td>
              <td><?php echo proveedorTableClass::getNameProveedor($entrada->$proveedor_id) . ' ' .proveedorTableClass::getNameApellido($entrada->$proveedor_id) ?></td>
              <td><?php echo $entrada->$fecha ?></td>
              <td>
                <a href="<?php echo routing::getInstance()->getUrlWeb('entrada', 'verEn', array(entradaTableClass::ID => $entrada->$id)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('entrada', 'editEn', array(entradaTableClass::ID => $entrada->$id)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('publish') ?></a>
                
                <!--eliminado individual con ajax-->
                <a href="#" data-target="#myModalDelete<?php echo $entrada->$id ?>" data-toggle="modal" class="btn btn-danger btn-xs"><?php echo i18n::__('delete') ?></a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('detalle', 'index', array (detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true) => $entrada->$id))?>" class="btn btn-default btn-xs"><?php echo i18n::__('detail') ?></a>
              </td>
            </tr>

          <div class="modal fade" id="myModalDelete<?php echo $entrada->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                </div>
                <div class="modal-body">
                  <!--pára que imprima el id en cada ventana-->
          <?php i18n::__('confirmDelete') ?> <?php echo $entrada->$id ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                  <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $entrada->$id ?>, '<?php echo entradaTableClass::getNameField(entradaTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('entrada', 'deleteEn') ?>')"><?php echo i18n::__('delete') ?></button>
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


<form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('entrada', 'deleteEn') ?>" method="POST">
  <input type="hidden" id="idDelete" name="<?php echo entradaTableClass::getNameField(entradaTableClass::ID, true) ?>">
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


<div class="text-right">
<?php echo i18n::__('pag') ?><select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('entrada', 'indexEn') ?>')">
<?php for ($x = 1; $x <= $cntPages; $x++): ?> 
      <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option> 

<?php endfor; ?>

  </select><?php echo i18n::__('off') ?> <?php echo $cntPages ?>
</div>