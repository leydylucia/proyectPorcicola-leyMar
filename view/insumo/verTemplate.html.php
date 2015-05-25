

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $descInsumo = insumoTableClass::DESC_INSUMO ?>
<?php $precio = insumoTableClass::PRECIO ?>
<?php $tipoInsumo = insumoTableClass::TIPO_INSUMO_ID ?>
<?php $fechaFabricacion = insumoTableClass::FECHA_FABRICACION ?>
<?php $fechaVencimiento = insumoTableClass::FECHA_VENCIMIENTO ?>
<?php $proveedorId = insumoTableClass::PROVEEDOR_ID ?>
<?php $created_at = insumoTableClass::CREATED_AT ?>

<div class="container container-fluid">

     <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>"><?php echo i18n::__('return') ?> </a></button>
    
    </div>



    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr class="info">
                        
                        <th>datos de insumo</th>
                           
                            
                        
                    </tr>        
                </thead>
                <tbody>
                     <?php foreach ($objInsumo as $insumo): ?> 
                    <tr class="active">
                            <th><?php echo i18n::__('describe_product') ?></th>
                            
                            <td><?php echo $insumo->$descInsumo ?></td>
                            
                    <tr class="info">
                            <th><?php echo i18n::__('prise') ?></th>
                            
                            <td><?php echo $insumo->$precio ?></td>
                             <tr >
                            <th><?php echo i18n::__('type_product') ?></th>
                            
                            <td><?php echo $insumo-> $tipoInsumo ?></td>
                             <tr class="info">
                            <th><?php echo i18n::__('date_manufacture') ?></th>
                            
                            <td><?php echo $insumo-> $fechaFabricacion ?></td>
                            <tr >
                            <th><?php echo i18n::__('date_conquering') ?></th>
                            
                            <td><?php echo $insumo-> $fechaVencimiento ?></td>
                             <tr >
                            <tr class="info">
                            <th><?php echo i18n::__('provisioner') ?></th>
                            
                            <td><?php echo $insumo->  $proveedorId ?></td>
                             <tr class="active">
                            <th><?php echo i18n::__('date_creation') ?></th>
                            
                            <td><?php echo $insumo->$created_at ?></td>
                            
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  