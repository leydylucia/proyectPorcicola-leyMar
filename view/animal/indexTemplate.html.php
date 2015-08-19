<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php use mvc\routing\routingClass as routing ?> 
<?php use mvc\view\viewClass as view ?> 
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass as session ?>

<?php $id = hojaVidaTableClass::ID ?>
<?php $genero_id = hojaVidaTableClass::GENERO_ID ?>
<?php $genero_id_b = generoTableClass::ID ?>
<?php $descripcion = generoTableClass::DESCRIPCION ?>
<?php $fecha_nacimiento = hojaVidaTableClass::FECHA_NACIMIENTO ?>
<?php $nombre_cerdo = hojaVidaTableClass::NOMBRE_CERDO ?>
<?php $estado_id = hojaVidaTableClass::ESTADO_ID ?>
<?php $lote_id = hojaVidaTableClass::LOTE_ID ?>
<?php $raza_id = hojaVidaTableClass::RAZA_ID ?>
</?php $id_madre = hojaVidaTableClass::ID_MADRE ?>
<?php $fecha = hojaVidaTableClass::CREATED_AT ?>

<!--titulo-->
<div class="container container-fluid">
  <div class="page-header titulo">
    <h1><?php echo i18n::__('curriculum vitae') ?></h1>  
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
            <form class="form-horizontal" role="form" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'index') ?>">

<?php if (session::getInstance()->hasError('inputGenero')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <i class="glyphicon glyphicon-remove-sign"></i> <?php echo session::getInstance()->getError('inputGenero') ?><!--esta linea para actualizar demas formularios-->
                </div>
<?php endif ?> 

              
              <div class="form-group">
                <label for="filtergenero" class="col-sm-2 control-label"><?php echo i18n::__('genre') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="filtergenero" name="filter[genero]">
                    <option value=""><?php echo i18n::__('genre') ?></option>
                    <?php foreach ($objGenero as $genero): ?>
                      <option value="<?php echo $genero->$genero_id_b ?>"><?php echo $genero->$descripcion ?></option>
<?php endforeach; ?>
                  </select>
                </div>
              </div>
              
              
<!--              <div class="form-group">
                <label for="filtergenero" class="col-sm-2 control-label"></?php echo i18n::__('genre') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filter[genero]" name="</?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::GENERO, true) ?>" placeholder="genero">
                </div>
              </div>    PONER CORCHER  EN NAME filter[insumo]-->
<!--              <div class="form-group">
                <label for="filtermadre" class="col-sm-2 control-label"></?php echo i18n::__('mother') ?></label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="filter[madre]" name="filter[madre]" placeholder="madre">
                </div>
              </div>  -->

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
            <form class="form-horizontal" role="form" id="report" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'report') ?>">
              <div class="form-group">
                <label for="filtergenero" class="col-sm-2 control-label"><?php echo i18n::__('genre') ?></label>
                <div class="col-sm-10">
                  <select class="form-control" id="filtergenero" name="filter[genero]">
                    <option value=""><?php echo i18n::__('genre') ?></option>
                    <?php foreach ($objGenero as $genero): ?>
                      <option value="<?php echo $genero->$genero_id_b ?>"><?php echo $genero->$descripcion ?></option>
<?php endforeach; ?>
                  </select>
                </div>
              </div>    <!--PONER CORCHER  EN NAME filter[insumo]-->
              
              <!--              <div class="form-group">
                              <label for="filtermadre" class="col-sm-2 control-label"></?php // echo i18n::__('mother')  ?></label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="filter[madre]" name="filter[madre]" placeholder="madre">
                              </div>
                            </div>  -->

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
      <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insert') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
      <a href="javascrip:eliminarMasivo()" class="btn btn-danger btn-xs " data-target="#myModalDeleteMasivo" data-toggle="modal"id="btnDeleteMasivo" ><?php echo i18n::__('deleteall') ?></a>
      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilters"><?php echo i18n::__('filter') ?></button>
      <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'index') ?>" class="btn btn-default btn-xs " id="btndeletefilter" ><?php echo i18n::__('deleteFilter') ?></a>
      <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModalReport"><?php echo i18n::__('report') ?></button>
      <a target="_NEW" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'report') ?>" class="btn btn-info btn-xs"><?php echo i18n::__('printOut') ?></a>
    </div>


<?php view::includeHandlerMessage() ?>  <!--esta linea es para traer mensajes de exito cunado registra -->

    <div class="container table-responsive"><!--esto es boostrap que no se te el olvides de cerrar el div-->
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteSelect') ?>" method="POST">
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
            <th><?php echo i18n::__('actions') ?></th>

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
              <td>
                <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'ver', array(hojaVidaTableClass::ID => $hojaVida->$id)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'edit', array(hojaVidaTableClass::ID => $hojaVida->$id)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('publish') ?></a>

                <!--eliminado individual con ajax-->
                <a href="#" data-target="#myModalDelete<?php echo $hojaVida->$id ?>" data-toggle="modal" class="btn btn-danger btn-xs"><?php echo i18n::__('delete') ?></a>
              </td>
            </tr>

          <div class="modal fade" id="myModalDelete<?php echo $hojaVida->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                </div>
                <div class="modal-body">
                  <!--pára que imprima el id en cada ventana-->
          <?php i18n::__('confirmDelete') ?> <?php echo $hojaVida->$id ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                  <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $hojaVida->$id ?>, '<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('animal', 'delete') ?>')"><?php echo i18n::__('delete') ?></button>
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


<form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'delete') ?>" method="POST">
  <input type="hidden" id="idDelete" name="<?php echo hojaVidaTableClass::getNameField(hojaVidaTableClass::ID, true) ?>">
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
<?php echo i18n::__('pag') ?><select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('animal', 'index') ?>')">
<?php for ($x = 1; $x <= $cntPages; $x++): ?> 
      <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option> 

<?php endfor; ?>

  </select><?php echo i18n::__('off') ?> <?php echo $cntPages ?>
</div>