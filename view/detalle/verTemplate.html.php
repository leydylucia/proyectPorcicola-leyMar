

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $cantidad = detalleEntradaTableClass::CANTIDAD ?>
<?php $valor = detalleEntradaTableClass::VALOR ?>
<?php $entrada_bodega = detalleEntradaTableClass::ENTRADA_BODEGA_ID ?>
<?php $insumo = detalleEntradaTableClass::INSUMO_ID ?>

<?php $created_at = detalleEntradaTableClass::CREATED_AT ?>

<div class="container container-fluid">

     



    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr class="info">
                        
                        <th>datos de detalle salida</th>
                           
                            
                        
                    </tr>        
                </thead>
                <tbody>
                     <?php foreach ($objDetalle as $detalle): ?> 
                    <tr class="active">
                            <th><?php echo i18n::__('quantity') ?></th>
                            
                            <td><?php echo $detalle->$cantidad ?></td>
                            
                    <tr class="active">
                            <th><?php echo i18n::__('quantity') ?></th>
                            
                            <td><?php echo $detalle->$valor ?></td>
                            
                            
                    <tr class="info">
                            <th><?php echo i18n::__('Hold_Out') ?></th>
                            
                            <td><?php echo $detalle->$entrada_bodega ?></td>
                             <tr >
                            <th><?php echo i18n::__('describe_product') ?></th>
                            
                           <td><?php echo insumoTableClass::getNameInsumo($detalle->$insumo) ?></td>
                             <tr class="info">
                           
                             <tr class="active">
                            <th><?php echo i18n::__('date_creation') ?></th>
                            
                            <td><?php echo $detalle->$created_at ?></td>
                            
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  