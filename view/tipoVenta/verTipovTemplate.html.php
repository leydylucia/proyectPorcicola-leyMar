

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $desc_tipoV = tipovTableClass::DESC_TIPOV?>
<?php $id = tipovTableClass::ID ?>
<?php $created_at=  tipovTableClass::CREATED_AT?>

<div class="container container-fluid">


       
        <a href="http://localhost/proyectPorcicola-leyMar/web/index.php/tipoVenta"><?php echo i18n::__('return') ?> </a>
 
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
                <?php foreach ($objTipoV as $tipoV): ?>  
                        <tr >
                           <th><?php echo i18n::__('describe') ?></th>
                            
                            <td><?php echo $tipoV->$desc_tipoV ?></td>
                            
                             <tr >
                            <th><?php echo i18n::__('date_creation') ?></th>
                            
                            <td><?php echo $tipoV->$created_at ?></td>
                            
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  