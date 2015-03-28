<?php mvc\view\viewClass::includePartial('insumo/menu')?>
<?php use mvc\routing\routingClass as routing ?> 
<?php use mvc\view\viewClass as view ?> 
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\request\requestClass as request ?>

<?php $nomDepto = deptoTableClass::NOM_DEPTO ?>
<?php $id = deptoTableClass::ID ?>


<div class="container container-fluid">
    <div class="page-header titulo">
<h1>DEPTO</h1>
    </div>
</div>

<!-- FILTROS --> 
<div class="modal fade" id="myModalFilters" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Filtros</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="filterForm" role="form" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('depto', 'indexDepto') ?>">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Departamento</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="filterDepto" name="filter[depto]" placeholder="nombre del departamento">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Fecha Creaccion</label>
            <div class="col-sm-10">
              <input type="datetime-local" class="form-control" id="filterDate1" name="filter[fechaCreacion1]">
              <br>
              <input type="datetime-local" class="form-control" id="filterDate2" name="filter[fechaCreacion2]">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary">Filtrar</button>
      </div>
    </div>
  </div>
</div>



<div style="margin-bottom: 10px; margin-top: 30px">
  <a href="<?php echo routing::getInstance()->getUrlWeb('depto', 'insertDepto') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
  <a href="javascrip:eliminarMasivo()" class="btn btn-danger btn-xs " data-target="#myModalDeleteMasivo" data-toggle="modal"id="btnDeleteMasivo" ><?php echo i18n::__('deleteall') ?></a>
  <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilters"><?php echo i18n::__('filter') ?></button>
  <a href="#" class="btn btn-default btn-xs"><?php echo i18n::__('delete filter') ?></a>    
  <div class="text-right">
        <a href="<?php echo routing::getInstance()->getUrlWeb('depto', 'reportDepto') ?>" class="btn btn-info"><?php echo i18n::__('printOut') ?></a>
        </div>
</div>

<!--eliminado individual con ajax-->






<?php view::includeHandlerMessage() ?>

<div class="container">
  <div class="table-responsive">
    <form id="frmDeleteAll" id ="filterForm"action="<?php echo routing::getInstance()->getUrlWeb('depto', 'deleteSelectDepto') ?>" method="POST">


      <table class="table table-bordered table-responsive">
        <thead>
          <tr>
            <th><input type="checkbox" id="chkAll"></th>
            <th><?php echo i18n::__('name_dept') ?></th>
            <th><?php echo i18n::__('actions') ?></th>
          </tr>        
        </thead>
        <tbody>
          <?php foreach ($objDepto as $depto): ?> 
            <tr>
              <td><input type="checkbox" name="chk[]" value="<?php echo $depto->$id ?>"></td>
              <td><?php echo $depto->$nomDepto ?></td>
             

              <td>
                <a href="<?php echo routing::getInstance()->getUrlWeb('depto', 'verDepto', array(deptoTableClass::ID => $depto->$id)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a> 
                <a href="<?php echo routing::getInstance()->getUrlWeb('depto', 'editDepto', array(deptoTableClass::ID => $depto->$id)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('publish') ?></a>
                <a href="#" class="btn btn-xs btn-success">Detalle </a>
                <a href="#" data-target="#myModalDelete<?php echo $depto->$id ?>" data-toggle="modal" class="btn btn-danger btn-xs">Eliminar</a>
              </td>

            </tr>
          <div class="modal fade" id="myModalDelete<?php echo $depto->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                </div>
                <div class="modal-body">
                  ¿Desea eliminar registro ?<!--pára que imprima el id en cada ventana-->
                  <?php i18n::__('confirmDelete') ?> <?php echo $depto->$nomDepto ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $depto->$id ?>, '<?php echo deptoTableClass::getNameField(deptoTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('depto', 'deleteDepto') ?>')"><?php echo i18n::__('delete') ?></button>
                </div>
              </div>
            </div>
          </div>

        <?php endforeach ?>
        </tbody>

      </table> 
      <div class="text-right">
     <?php echo i18n::__('pag') ?> <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('depto', 'indexDepto') ?>')">
     <?php for($x=1; $x<= $cntPages; $x++):?> 
        <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x?>"><?php echo $x?></option> 
         
         <?php endfor;?>
        
    </select>  <?php echo i18n::__('off') ?>  <?php echo $cntPages?>
  </div>

  </div>
  <a href="http://localhost/proyectPorcicola-leyMar/web/index.php/proveedor"><?php echo i18n::__('return') ?> </a>

  <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('depto', 'deleteDepto') ?>" method="POST">
    <input type="hidden" id="idDelete" name="<?php echo deptoTableClass::getNameField(deptoTableClass::ID, true) ?>">
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
</div>        