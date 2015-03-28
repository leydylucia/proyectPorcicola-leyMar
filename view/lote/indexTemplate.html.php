<?php use mvc\routing\routingClass as routing ?>

<?php $desc_lote = loteTableClass::DESC_LOTE ?>
<?php $ubicacion = loteTableClass::UBICACION ?>
<?php $id = loteTableClass::ID ?>

<div class="container container-fluid">
    <div style="margin-bottom: 10px; margin-top: 30px">
      <a href="<?php echo routing::getInstance()->getUrlWeb('lote', 'insert') ?>" class="btn btn-success btn-xs">Nuevo</a>
      <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
    </div>
    
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th><input type="checkbox" id="chkAll"></th>
                <th>descripcion_lote</th>
                <th>ubicacion</th>
                <th>Acciones</th>
            </tr>        
        </thead>
        <tbody>
<?php foreach ($objLote as $lote): ?> 
            <tr>
            <td><input type="checkbox" name="chk[]" value="<?php echo $lote->$id ?>"></td>
            <td><?php echo $lote->$desc_lote ?></td>
            <td><?php echo $lote->$ubicacion ?></td>
            <td>
              <a href="#" class="btn btn-warning btn-xs">Ver</a>
              <a href="<?php echo routing::getInstance()->getUrlWeb('lote', 'edit', array(loteTableClass::ID => $lote->$id)) ?>" class="btn btn-primary btn-xs">Editar</a>
              <a href="#" onclick="confirmarEliminar(<?php echo $lote->$id ?>)" class="btn btn-danger btn-xs">Eliminar</a>
            </td>
          </tr>
 <?php endforeach ?>
           </tbody>



    </table>    


</div>
