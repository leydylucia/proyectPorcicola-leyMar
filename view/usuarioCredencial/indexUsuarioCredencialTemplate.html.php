<!--@var $Insumo 
@var $page paginado mantiene el numero de la pagina -->
<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\configClass as confing ?>
<?php use mvc\request\requestClass as request ?>


<?php $id = usuarioCredencialTableClass::ID ?>
<?php $usuario = usuarioCredencialTableClass::USUARIO_ID ?>
<?php $usuario_u= usuarioTableClass::ID ?>
<?php $desUsuario = usuarioTableClass::USER ?>

<?php $credencial=  usuarioCredencialTableClass::CREDENCIAL_ID ?>
<?php $credencial_c= credencialTableClass::ID ?>
<?php $nombre = credencialTableClass::NOMBRE ?>
<?php $fecha = usuarioCredencialTableClass::CREATED_AT ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('UserCredential') ?></h1>  
    </div>

</div>
<!--fintitulo-->
<!--cambio de idioma-->
<div class="container container-fluid">
    <div style="margin-bottom: 10px; margin-top: 30px">

        

    <a href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'insertUsuarioCredencial') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>

    <button type="button" class="btn btn-primary btn-xs" id="btnFilter"data-toggle="modal" data-target="#myModalFilters" ><?php echo i18n::__('filter') ?></button>


    <!--filtros-->
    <a href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'deleteFiltersUsuarioCredencial') ?>" class="btn btn-default btn-xs " id="btndeletefilter" ><?php echo i18n::__('deleteFilter') ?></a>
        <button type="button" class="btn btn-warning btn-xs"class="" id="btnFilter"data-toggle="modal" data-target="#myModalReport" ><?php echo i18n::__('report') ?></button>

        <a href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'reportUsuarioCredencial') ?>"class="btn btn-info btn-xs"><?php echo i18n::__('printOut') ?></a>

</div>

  <!--filtro con reporte-->
    <div class="modal fade" id="myModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('report') ?></h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="report" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'reportUsuarioCredencial') ?>">
                        <div class="form-group">
                            <label for="filterUsuario" class="col-sm-2 control-label"><?php echo i18n::__('user') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterUsuario" name="filter[Usuario]">
                                    <option value=""><?php echo i18n::__('user') ?></option>
                                     <?php foreach ($objUsuario as $user): ?>
                                        <option value="<?php echo $user->$usuario_u ?>"><?php echo $user->$desUsuario ?></option>
                                     <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    
                    
                     <div class="form-group">
                            <label for="filterCredencial" class="col-sm-2 control-label"><?php echo i18n::__('credential') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterCredencial" name="filter[Credencial]">
                                    <option value=""><?php echo i18n::__('credential') ?></option>
                                     <?php foreach ($objCredencial as $cred): ?>
                                        <option value="<?php echo $cred->$credencial_c ?>"><?php echo $cred->$nombre ?></option>
                                     <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                    <button type="button" onclick="$('#report').submit()" class="btn btn-warnig"><?php echo i18n::__('report') ?></button>
                </div>
            </div>
        </div>
    </div>
<!--filtros-->
<div class="modal fade" id="myModalFilters" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Filtros</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form" id="filterForm" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'indexUsuarioCredencial') ?>">
                  
                    <div class="form-group">
                            <label for="filterUsuario" class="col-sm-2 control-label"><?php echo i18n::__('user') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterUsuario" name="filter[Usuario]">
                                    <option value=""><?php echo i18n::__('user') ?></option>
                                     <?php foreach ($objUsuario as $user): ?>
                                        <option value="<?php echo $user->$usuario_u ?>"><?php echo $user->$desUsuario ?></option>
                                     <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
               
                    
                     <div class="form-group">
                            <label for="filterCredencial" class="col-sm-2 control-label"><?php echo i18n::__('credential') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterCredencial" name="filter[Credencial]">
                                    <option value=""><?php echo i18n::__('credential') ?></option>
                                     <?php foreach ($objCredencial as $cred): ?>
                                        <option value="<?php echo $cred->$credencial_c ?>"><?php echo $cred->$nombre ?></option>
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
<!--fin de modal filtro-->

<?php view::includeHandlerMessage() ?><!--esta linea es para traer mensajes de exito cunado registra-->


<div class="container">
    <div class="table-responsive">
       

            <table class="table table-bordered table-striped table-condensed mitabla">
                <thead>
                    <tr class="active">
                        <th><input type="checkbox" id="chkAll"></th>
                        <th><?php echo i18n::__('user') ?></th>
                        <th><?php echo i18n::__('credential') ?></th>
                        <th><?php echo i18n::__('date') ?></th>
                        <th><?php echo i18n::__('action') ?></th>

                    </tr>        
                </thead>
                <tbody>
                    <?php foreach ($objUsuarioCredencial as $usuarioCredencial): ?> 
                        <tr class="text-info bg-info">
                            <td><input type="checkbox" name="chk[]" value="<?php echo $usuarioCredencial->$id ?>"></td>
                            
                            <td><?php echo usuarioTableClass::getNameUsuario($usuarioCredencial->$usuario) ?></td>
                            <td><?php echo credencialTableClass::getNameCredencial($usuarioCredencial->$credencial) ?></td>
                            <td><?php echo date('d-m-Y h:i:s a', strtotime($usuarioCredencial->$fecha)) ?></td>
                            <td>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'verUsuarioCredencial', array(usuarioCredencialTableClass::ID => $usuarioCredencial->$id)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'editUsuarioCredencial', array(usuarioCredencialTableClass::ID => $usuarioCredencial->$id)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('publish') ?></a>

                                <!--eliminado individual con ajax-->
                                
                            </td>
                        </tr>

                  
                <?php endforeach ?>
                </tbody>



            </table>  
       
        <!--paginado-->
        <div class="text-right">
            <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'indexUsuarioCredencial') ?>')">
                <?php for ($x = 1; $x <= $cntPages; $x++): ?> 
                    <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option> 

                <?php endfor; ?>



            </select><?php echo $cntPages ?>

        </div>
        <!--fin paginado-->
    </div>
</div>




</div>
