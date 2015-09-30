
<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $idInsumo = insumoTableClass::ID ?>
<?php $descInsumo = insumoTableClass::DESC_INSUMO ?>
<?php $detalleSalida = detalleSalidaTableClass::ID ?>
<?php $detalleEntadar = detalleEntradaTableClass::ID ?>
<?php $tipoInsumo = tipoInsumoTableClass::ID ?>

<div class="container container-fluid inventario">

     
    </div>



    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr class="info">
                        
                      <th colspan="2" class="tituloinventario">Inventario De Insumo</th>
                        </tr>
                    <tr class="info">
                        <th><?php echo i18n::__('describe_product') ?></th>    
                        <th><?php echo i18n::__('cant') ?></th>
                    </tr>        
                </thead>
                <tbody>
                     <?php foreach ($objInsumo as $insumo): ?> 
                    <tr class="active">
                            
                            
                            <td><?php echo $insumo->$descInsumo ?></td>
                            
                            <?php $suma=((detalleSalidaTableClass::getInventario($insumo->$detalleSalida))) ?>
                            <td><?php echo ((insumoTableClass::getInventario($insumo->$idInsumo))-$suma) ?></td>
                    
                           
                            
                            
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  