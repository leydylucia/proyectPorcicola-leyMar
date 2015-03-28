<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $nomDepto = deptoTableClass::NOM_DEPTO ?>
<?php $id = deptoTableClass::ID ?>

<div class="container container-fluid">
  <div style="margin-bottom: 10px; margin-top: 30px">
    <a href="<?php echo routing::getInstance()->getUrlWeb('depto', 'insertDepto') ?>" class="btn btn-success btn-xs">Nuevo</a>
    <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
    <a href="#" class="btn btn-primary btn-xs"> Filtros</a> 
    <a href="#" class="btn btn-default btn-xs"> Eliminar filtros</a>
  </div>



  <div class="container"><!--esto es boostrap no te el olvides de cerrar el div-->
    <div class="table-responsive"><!--esto es boostrap no te el olvides de cerrar el div-->
      
      <?php view::includeHandlerMessage() ?>
      
      <table class="table table-bordered table-striped table-condensed">
        <thead>
          <tr>
            <th><input type="checkbox" id="chkAll"></th>
            <th>Nombre Departamento</th>
            <th>Acciones</th>
          </tr>        
        </thead>
        <tbody>
          <?php foreach ($objDepto as $depto): ?> 
            <tr >
              <td><input type="checkbox" name="chk[]" value="<?php echo $depto->$id ?>"></td>
              <td><?php echo $depto->$nomDepto ?></td>
              <td>
                <a href="#"class="btn btn-warning btn-xs">Ver</a><!--esto es boostrap en el href digo el class se encuentra el botn ver,editar,ymodificar-->
                <a href="<?php echo routing::getInstance()->getUrlWeb('depto', 'editDepto', array(deptoTableClass::ID => $depto->$id)) ?>" class="btn btn-primary btn-xs">Editar</a>

                <!--eliminado individual con ajax-->
                <a href="#" data-toggle="modal" data-target="#myModalDelete<?php echo $depto->$id ?>" class="btn btn-danger btn-xs">Eliminar</a>
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
                  ¿Desea eliminar registro <?php echo $depto->$nomDepto ?>?<!--pára que imprima el id en cada ventana-->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $depto->$id ?>, '<?php echo deptoTableClass::getNameField(deptoTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('depto', 'deleteDepto') ?>')">Eliminar</button>
                </div>
              </div>
            </div>
          </div> 
        <?php endforeach ?>
        </tbody>



      </table>    
    </div>
  </div>

</form>
<form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('depto', 'deleteDepto') ?>" method="POST">
  <input type="hidden" id="idDelete" name="<?php echo deptoTableClass::getNameField(deptoTableClass::ID, true) ?>">
</form>

</div>
<a href="http://localhost/proyectPorcicola-leyMar/web/index.php/proveedor"><?php echo i18n::__('inicio') ?> </a> 