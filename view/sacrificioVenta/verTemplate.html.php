<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $id = sacrificiovTableClass::ID ?>
<?php $valor = sacrificiovTableClass::VALOR ?>
<?php $tipoVenta = sacrificiovTableClass::TIPO_VENTA_ID ?>
<?php $idCerdo = sacrificiovTableClass::ID_CERDO?>
<?php $fecha = sacrificiovTableClass::CREATED_AT?>

<div class="container container-fluid">


        <a href="http://localhost/proyecto/web/index.php/sacrificioVenta"><?php echo i18n::__('return') ?> </a>

    </div>



    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        
                        <th>datos de sacrificio</th>
                           
                            
                        
                    </tr>        
                </thead>
                <tbody>
                     <?php foreach ($objSacrificioV as $sacrificio): ?> 
                        <tr >
                           <th><?php echo i18n::__('sale') ?></th>
                            
                            <td><?php echo $sacrificio->$valor ?></td>
                            
                            <th><?php echo i18n::__('type sale') ?></th>
                            
                            <td><?php echo tipovTableClass::getNameTipov($sacrificio->$tipoVenta) ?></td>
                             <tr >
                            <th><?php echo i18n::__('pig weight') ?></th>
                            
                            <td><?php echo $sacrificio-> $idCerdo ?></td>
                            
                            <th><?php echo i18n::__('date_creation') ?></th>
                            
                            <td><?php echo $sacrificio->$fecha ?></td>
                            
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  