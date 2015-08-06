

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $cantidad = detalleSalidaTableClass::CANTIDAD ?>
<?php $salida_bodega = detallesalidaTableClass::SALIDA_BODEGA_ID ?>
<?php $insumo = detalleSalidaTableClass::INSUMO_ID ?>

<?php $created_at = detalleSalidaTableClass::CREATED_AT ?>

<div class="container container-fluid">

    
    </div>



    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr class="info">
                        
                        <th>datos de detalle salida</th>
                           
                            
                        
                    </tr>        
                </thead>
                <tbody>
                     <?php foreach ($objDetalleSalida as $detalleSalida): ?> 
                    <tr class="active">
                            <th><?php echo i18n::__('quantity') ?></th>
                            
                            <td><?php echo $detalleSalida->$cantidad ?></td>
                            
                    <tr class="info">
                            <th><?php echo i18n::__('Hold_Out') ?></th>
                            
                            <td><?php echo $detalleSalida->$salida_bodega ?></td>
                             <tr >
                            <th><?php echo i18n::__('describe_product') ?></th>
                            
                           <td><?php echo insumoTableClass::getNameInsumo($detalleSalida->$insumo) ?></td>
                             <tr class="info">
                           
                             <tr class="active">
                            <th><?php echo i18n::__('date_creation') ?></th>
                            
                            <td><?php echo $detalleSalida->$created_at ?></td>
                            
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  