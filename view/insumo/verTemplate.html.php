

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

  <a href="http://www.porcicolatapasco.com/index.php/insumo/index"><?php echo i18n::__('return') ?> </a>

    </div>



    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        
                        <th>datos de insumo</th>
                           
                            
                        
                    </tr>        
                </thead>
                <tbody>
                     <?php foreach ($objInsumo as $insumo): ?> 
                        <tr >
                            <th><?php echo i18n::__('describe_product') ?></th>
                            
                            <td><?php echo $insumo->$descInsumo ?></td>
                            
                             <tr >
                            <th><?php echo i18n::__('prise') ?></th>
                            
                            <td><?php echo $insumo->$precio ?></td>
                             <tr >
                            <th><?php echo i18n::__('type_product') ?></th>
                             <td><?php echo tipoInsumoTableClass::getNameTipoin($insumo->$tipoInsumo) ?></td>
                            
                            <!--<td><!?php echo $insumo-> $tipoInsumo ?></td>-->
                             <tr >
                            <th><?php echo i18n::__('date_manufacture') ?></th>
                            
                            <td><?php echo $insumo-> $fechaFabricacion ?></td>
                            <tr >
                            <th><?php echo i18n::__('date_conquering') ?></th>
                            
                            <td><?php echo $insumo-> $fechaVencimiento ?></td>
                             <tr >
                            <tr >
                            <th><?php echo i18n::__('provisioner') ?></th>
                            
                           <td><?php echo proveedorTableClass::getNameProveedor($insumo->$proveedorId) ?></td>
                             <tr>
                            <th><?php echo i18n::__('date_creation') ?></th>
                            
                            <td><?php echo $insumo->$created_at ?></td>
                            
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  