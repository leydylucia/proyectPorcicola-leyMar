

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $usu = usuarioTableClass::USER ?>
<?php $id = usuarioTableClass::ID ?>
<?php $created_at=  usuarioTableClass::CREATED_AT?>

<div class="container container-fluid">


       
        <a href="http://localhost/proyectPorcicola-leyMar/web/index.php/usuario"><?php echo i18n::__('return') ?> </a>
 
    </div>



    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                   
                        <th>Datos</th>
                        
                    </tr>        
                </thead>
                <tbody>
                <?php foreach ($objUsuario as $usuario): ?>  
                        <tr >
                           <th><?php echo i18n::__('user') ?></th>
                            
                            <td><?php echo $usuario->$usu ?></td>
                            
                             <tr >
                            <th><?php echo i18n::__('date_creation') ?></th>
                            
                            <td><?php echo $usuario->$created_at ?></td>
                            
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  