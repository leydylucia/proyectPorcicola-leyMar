<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\config\configClass as confing ?>
<?php
use mvc\request\requestClass as request ?>



    <?php $usu = usuarioTableClass::USER ?>
    <?php $id = usuarioTableClass::ID ?>

<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1>usuario</h1>  
    </div>
<?php view::includeHandlerMessage() ?><!--esta linea es para traer mensajes de exito cunado registra-->
</div>
<div class="container container-fluid">
    <form id="frmDeleteAll" id ="filterForm"action="<?php echo routing::getInstance()->getUrlWeb('default', 'deleteSelect') ?>" method="POST">

        <div style="margin-bottom: 10px; margin-top: 30px">
            <a href="<?php echo routing::getInstance()->getUrlWeb('default', 'insert') ?>" class="btn btn-success btn-xs">Nuevo</a>
            <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
        </div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th><input type="checkbox" id="chkAll"></th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($objUsuarios as $usuario): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $usuario->$id ?>"></td>
                        <td><?php echo $usuario->$usu ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-xs">Ver</a>
                            <a href="<?php echo routing::getInstance()->getUrlWeb('default', 'edit', array(usuarioTableClass::ID => $usuario->$id)) ?>" class="btn btn-primary btn-xs">Editar</a>
                            <!-- eliminado en ajax modal-->
                            <a href="#" data-target="#myModalDelete<?php echo $usuario->$id ?>" data-toggle="modal" class="btn btn-danger btn-xs">Eliminar</a>
                        </td>
                    </tr>

                <div class="modal fade" id="myModalDelete<?php echo $usuario->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">CONFIRMAR ELIMINACION</h4>
                            </div>
                            <div class="modal-body">
                                <!--pára que imprima el id en cada ventana-->
    <?php i18n::__('confirmDelete') ?> <?php echo $usuario->$usu ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                                <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $usuario->$id ?>, '<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('default', 'delete') ?>')"><?php echo i18n::__('Delete') ?></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin eliminado en ajax modal-->
<?php endforeach ?>
            </tbody>
        </table>
          </form>
        <!--formulario eliminado individual-->
<form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('default', 'delete') ?>" method="POST">
    <input type="hidden" id="idDelete" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>">
</form>
<!--fin formulario eliminado individual-->

<!--eliminado masivo en ajax-->
<div class="modal fade" id="myModalDeleteMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmar elementos masivo</h4>
            </div>
            <div class="modal-body">

                <?php i18n::__('confirmDeleteMasivo') ?> <?php echo $usuario->$usu ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('confirm') ?></button>
            </div>
        </div>
    </div>
</div>
<!--fin eliminado masivo en ajax-->
</div>