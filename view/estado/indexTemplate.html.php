<?php

use mvc\routing\routingClass as routing ?>
<?php $desc_estado = estadoTableClass::DESC_ESTADO ?>
<?php $id = estadoTableClass::ID ?>

<div class="container container-fluid">
  <div style="margin-bottom: 10px; margin-top: 30px">
    <a href="<?php echo routing::getInstance()->getUrlWeb('estado', 'insert') ?>"</a>
       <a class="btn btn-success btn-xs">Nuevo</a>
      <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
  </div>



  <div class="container"><!--esto es boostrap no te el olvides de cerrar el div-->
    <div class="table-responsive"><!--esto es boostrap no te el olvides de cerrar el div-->
      <table class="table table-bordered table-striped table-condensed">
        <thead>
          <tr>
            <th><input type="checkbox" id="chkAll"></th>
            <th>Descripcion Estado</th>
            <th>Acciones</th>
          </tr>        
        </thead>
        <tbody>
          <?php foreach ($objEstado as $estado): ?> 
            <tr >
              <td><input type="checkbox" name="chk[]" value="<?php echo $estado->$id ?>"></td>
              <td><?php echo $estado->$desc_estado ?></td>
              <td>
                <a href="#"class="btn btn-warning btn-xs">Ver</a><!--esto es boostrap en el href digo el class se encuentra el botn ver,editar,ymodificar-->
                <a href="<?php echo routing::getInstance()->getUrlWeb('estado', 'edit', array(estadoTableClass::ID => $estado->$id)) ?>" class="btn btn-primary btn-xs">Editar</a>

                <!--eliminado individual con ajax-->
                <a href="#" data-target="#myModalDelete<?php echo $estado->$id ?>" class="btn btn-danger btn-xs">Eliminar</a>
              </td>
            </tr>
          <div class="modal fade" id="myModalDelete<?php echo $estado->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                </div>
                <div class="modal-body">
                  ¿Desea eliminar registro <?php echo $estado->$desc_estado ?>?<!--pára que imprima el id en cada ventana-->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $estado->$id ?>, '<?php echo deptoTableClass::getNameField(estadoTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('estado', 'delete') ?>')">Eliminar</button>
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
<form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('estado', 'delete') ?>" method="POST">
  <input type="hidden" id="idDelete" name="<?php echo estadoTableClass::getNameField(estadoTableClass::ID, true) ?>">
</form>

</div>
