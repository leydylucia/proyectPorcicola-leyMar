<?php

use mvc\routing\routingClass as routing ?>

<?php $fecha_nacimiento = partoTableClass::FECHA_NACIMIENTO ?>
<?php $num_nacidos = partoTableClass::NUM_NACIDOS ?>
<?php $num_vivos = partoTableClass::NUM_VIVOS ?>
<?php $num_muertos = partoTableClass::NUM_MUERTOS ?>
<?php $num_hembras = partoTableClass::NUM_HEMBRAS ?>
<?php $num_machos = partoTableClass::NUM_MACHOS ?>
<?php $fecha_montada = partoTableClass::FECHA_MONTADA ?>
<?php $id_padre = partoTableClass::ID_PADRE ?>
<?php $idParto = partoTableClass::ID ?>

<div class="container container-fluid">
    <div style="margin-bottom: 10px; margin-top: 30px">
        <a href="<?php echo routing::getInstance()->getUrlWeb('parto', 'insert') ?>" class="btn btn-success btn-xs">Nuevo</a>
        <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
    </div>



    <div class="container"><!--esto es boostrap no te el olvides de cerrar el div-->
        <div class="table-responsive"><!--esto es boostrap no te el olvides de cerrar el div-->
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="chkAll"></th>
                        <th>Fecha Nacimiento</th>
                        <th>Numero de Nacidos</th>
                        <th>Numero de Vivos</th>
                        <th>Numero de Muertos</th>
                        <th>Numero de Hembras</th>
                        <th>Numero de Machos</th>
                        <th>Fecha Montada</th>
                        <th>Id del Padre</th>
                        <th>Acciones</th>
                    </tr>        
                </thead>
                <tbody>
                    <?php foreach ($objParto as $parto): ?> 
                        <tr >
                            <td><input type="checkbox" name="chk[]" value="<?php echo $parto->$id ?>"></td>
                            <td><?php echo $parto->$fecha_nacimiento ?></td>
                            <td><?php echo $parto->$num_nacidos ?></td>
                            <td><?php echo $parto->$num_vivos ?></td>
                            <td><?php echo $parto->$num_muertos ?></td>
                            <td><?php echo $parto->$num_hembras ?></td>
                            <td><?php echo $parto->$num_machos ?></td>
                            <td><?php echo $parto->$fecha_montada ?></td>
                            <td><?php echo $parto->$id_padre ?></td>
                            <td>
                                <a href="#"class="btn btn-warning btn-xs">Ver</a><!--esto es boostrap en el href digo el class se encuentra el botn ver,editar,y modificar-->
                                <a href="<?php echo routing::getInstance()->getUrlWeb('parto', 'edit', array(partoTableClass::ID => $parto->$id)) ?>" class="btn btn-primary btn-xs">Editar</a>

                                <!--eliminado individual con ajax-->
                                <a href="#" data-target="#myModalDelete<?php echo $parto->$id?>" class="btn btn-danger btn-xs">Eliminar</a>
                            </td>
                        </tr>
                    <div class="modal fade" id="myModalDelete<?php echo $parto>$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                                </div>
                                <div class="modal-body">
                                ¿Desea eliminar registro <?php echo $parto->$fecha_nacimiento ?>?<!--pára que imprima el id en cada ventana-->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-danger" onclick="eliminar( <?php echo $parto->$id ?>,'<?php echo partoTableClass::getNameField(partoTableClass::ID, true)?>','<?php echo routing::getInstance()->getUrlWeb('parto', 'delete')?>')">Eliminar</button>
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
  <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('parto', 'delete') ?>" method="POST">
    <input type="hidden" id="idDelete" name="<?php echo partoTableClass::getNameField(partoTableClass::ID, true) ?>">
  </form>

</div>
