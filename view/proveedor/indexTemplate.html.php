<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php use mvc\routing\routingClass as routing ?> 
<?php use mvc\view\viewClass as view ?> 
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\myConfigClass as config ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass as session ?>

<?php $id = proveedorTableClass::ID ?>
<?php $nombre = proveedorTableClass::NOMBRE ?>
<?php $apellido = proveedorTableClass::APELLIDO ?>
<?php $direccion = proveedorTableClass::DIRECCION ?>
<?php $correo = proveedorTableClass::CORREO ?>
<?php $telefono = proveedorTableClass::TELEFONO ?>
<?php $ciudad_id = proveedorTableClass::CIUDAD_ID ?>
<?php $ciudad_id_p = ciudadTableClass::ID ?>
<?php $nom_ciudad = ciudadTableClass::NOM_CIUDAD ?>
<?php $fecha = proveedorTableClass::CREATED_AT ?>

<!--titulo-->
<div class="container container-fluid">
  <div class="page-header titulo">
    <h1><?php echo i18n::__('supplier') ?></h1>  
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
            <form class="form-horizontal" role="form" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'indexProv') ?>">

<?php if (session::getInstance()->hasError('inputNombre')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputNombre') ?><!--esta linea para actualizar demas formularios-->
                </div>
<?php endif ?>

              <div class="form-group">
                <label for="filternombre" class="col-sm-2 control-label"><?php echo i18n::__('name') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filter[nombre]" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true) ?>" placeholder="nombre">
                </div>
              </div>    <!--PONER CORCHER  EN NAME filter[insumo]-->

            <?php if (session::getInstance()->hasError('inputApellido')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputApellido') ?><!--esta linea para actualizar demas formularios-->
                </div>
            <?php endif ?>

              <div class="form-group">
                <label for="filterapellido" class="col-sm-2 control-label"><?php echo i18n::__('lastname') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filter[apellido]" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true) ?>" placeholder="apellido">
                </div>
              </div>  

              <div class="form-group">
                <label for="filterciudad" class="col-sm-2 control-label"><?php echo i18n::__('name_city') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="filterciudad" name="filter[ciudad]">
                    <option value=""><?php echo i18n::__('city') ?></option>
                    <?php foreach ($objCiudad as $ciudad): ?>
                      <option value="<?php echo $ciudad->$ciudad_id_p ?>"><?php echo $ciudad->$nom_ciudad ?></option>
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
            <form class="form-horizontal" role="form" id="report" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'reportProv') ?>">
              <div class="form-group">
                <label for="filternombre" class="col-sm-2 control-label"><?php echo i18n::__('name') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filter[nombre]" name="filter[nombre]" placeholder="nombre">
                </div>
              </div>    <!--PONER CORCHER  EN NAME filter[insumo]-->
              <div class="form-group">
                <label for="filterapellido" class="col-sm-2 control-label"><?php echo i18n::__('lastname') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filter[apellido]" name="filter[apellido]" placeholder="apellido">
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
      <a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'insertProv') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
      <a href="javascrip:eliminarMasivo()" class="btn btn-danger btn-xs " data-target="#myModalDeleteMasivo" data-toggle="modal"id="btnDeleteMasivo" ><?php echo i18n::__('deleteall') ?></a>
      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilters"><?php echo i18n::__('filter') ?></button>
      <a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'indexProv') ?>" class="btn btn-default btn-xs " id="btndeletefilter" ><?php echo i18n::__('deleteFilter') ?></a>
      <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModalReport"><?php echo i18n::__('report') ?></button>
      <a target="_NEW" href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'reportProv') ?>" class="btn btn-info btn-xs"><?php echo i18n::__('printOut') ?></a>
    </div>


<?php view::includeHandlerMessage() ?>  <!--esta linea es para traer mensajes de exito cunado registra -->

    <div class="container table-responsive"><!--esto es boostrap que no se te el olvides de cerrar el div-->
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'deleteSelectProv') ?>" method="POST">
      <table class="table table-bordered table-responsive table-striped table-condensed mitabla">
        <thead>
          <tr class="active">
            <th><input type="checkbox" id="chkAll"></th>
            <th><?php echo i18n::__('name') ?></th>
<!--            <th><?php echo i18n::__('lastname') ?></th>-->
            <th><?php echo i18n::__('direction') ?></th>
            <th><?php echo i18n::__('email') ?></th>
            <th><?php echo i18n::__('telephone') ?></th>
            <th><?php echo i18n::__('city_id') ?></th>
            <th><?php echo i18n::__('date') ?></th>
            <th><?php echo i18n::__('actions') ?></th>

          </tr>
        </thead>
        <tbody>
<?php foreach ($objProveedor as $proveedor): ?>
            <tr class="text-info bg-info">
              <td><input type="checkbox" name="chk[]" value="<?php echo $proveedor->$id ?>"></td>
              <td><?php echo $proveedor->$nombre. ' ' . $proveedor->$apellido ?></td>
<!--              <td><?php echo $proveedor->$apellido ?></td>-->
              <td><?php echo $proveedor->$direccion ?></td>
              <td><?php echo $proveedor->$correo ?></td>
              <td><?php echo $proveedor->$telefono ?></td>
              <td><?php echo ciudadTableClass::getNameCiudad($proveedor->$ciudad_id) ?></td>
              <td><?php echo date('d-m-Y h:i:s a', strtotime($proveedor->$fecha)) ?></td>
              <td>
                <a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'verProv', array(proveedorTableClass::ID => $proveedor->$id)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'editProv', array(proveedorTableClass::ID => $proveedor->$id)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('publish') ?></a>

                <!--eliminado individual con ajax-->
                <a href="#" data-target="#myModalDelete<?php echo $proveedor->$id ?>" data-toggle="modal" class="btn btn-danger btn-xs"><?php echo i18n::__('delete') ?></a>
              </td>
            </tr>

          <div class="modal fade" id="myModalDelete<?php echo $proveedor->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                </div>
                <div class="modal-body">
                  <!--pára que imprima el id en cada ventana-->
  <?php i18n::__('confirmDelete') ?> <?php echo $proveedor->$nombre ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                  <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $proveedor->$id ?>, '<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('proveedor', 'deleteProv') ?>')"><?php echo i18n::__('delete') ?></button>
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


<form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'deleteProv') ?>" method="POST">
  <input type="hidden" id="idDelete" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID, true) ?>">
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
    <?php echo i18n::__('pag') ?><select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('proveedor', 'indexProv') ?>')">
<?php for ($x = 1; $x <= $cntPages; $x++): ?> 
      <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option> 

<?php endfor; ?>

  </select><?php echo i18n::__('off') ?> <?php echo $cntPages ?>
</div>



