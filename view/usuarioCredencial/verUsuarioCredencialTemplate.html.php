

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>


<?php $usuario = usuarioCredencialTableClass::USUARIO_ID ?>
<?php $credencial=  usuarioCredencialTableClass::CREDENCIAL_ID ?>
<?php $fecha = usuarioCredencialTableClass::CREATED_AT ?>

<div class="container container-fluid">

     <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'indexUsuarioCredencial') ?>"><?php echo i18n::__('return') ?> </a></button>
    
    </div>



    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr class="info">
                        
                        <th>datos de usuario credencial</th>
                           
                            
                        
                    </tr>        
                </thead>
                <tbody>
                     <?php foreach ($objUsuarioCredencial as $usuarioCredencial): ?> 
                    <tr class="active">
                            <th><?php echo i18n::__('user') ?></th>
                            
                            <td><?php echo usuarioTableClass::getNameUsuario($usuarioCredencial->$usuario) ?></td>
                            
                    <tr class="info">
                            <th><?php echo i18n::__('credential') ?></th>
                            
                            <td><?php echo credencialTableClass::getNameCredencial($usuarioCredencial->$credencial) ?></td>
                           
                             <tr class="active">
                            <th><?php echo i18n::__('date_creation') ?></th>
                            
                            <td><?php echo $usuarioCredencial->$fecha ?></td>
                            
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  