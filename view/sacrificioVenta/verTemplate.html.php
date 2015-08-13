<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>

<?php $id = sacrificiovTableClass::ID ?>
<?php $valor = sacrificiovTableClass::VALOR ?>
<?php $tipoVenta = sacrificiovTableClass::TIPO_VENTA_ID ?>
<?php $idCerdo = sacrificiovTableClass::ID_CERDO ?>
<?php $cantidad = sacrificiovTableClass::CANTIDAD ?>
<?php $unidad_medida = sacrificiovTableClass::UNIDAD_MEDIDA_ID ?>
<?php $fecha = sacrificiovTableClass::CREATED_AT ?>

<div class="container container-fluid">


    <a href="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'indexSacrificioVenta') ?>"><?php echo i18n::__('return') ?> </a>

</div>



<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <tr>

                    <th class="active">datos de sacrificio</th>



                </tr>        
            </thead>
            <tbody>
<?php foreach ($objSacrificioV as $sacrificio): ?> 
                <tr class="info">
                        <th><?php echo i18n::__('pig weight') ?></th>

                        <td><?php echo $sacrificio->$idCerdo ?></td>
                <tr class="active">  
                         <th><?php echo i18n::__('type_sale') ?></th>

                        <td><?php echo tipovTableClass::getNameTipov($sacrificio->$tipoVenta) ?></td>
                <tr class="info"> 
                         <th><?php echo i18n::__('quantity') ?></th>

                        <td><?php echo $sacrificio->$cantidad ?></td>
                <tr class="active"> 
                         <th><?php echo i18n::__('unit_measure') ?></th>

                        <td><?php echo $sacrificio->$unidad_medida ?></td>
                <tr class="info">  
                        <th><?php echo i18n::__('sale') ?></th>

                        <td><?php echo $sacrificio->$valor ?></td>

                       
                <tr class="active">
                    

                        <th><?php echo i18n::__('date_creation') ?></th>

                        <td><?php echo $sacrificio->$fecha ?></td>

<?php endforeach ?>
            </tbody>



        </table>    
    </div>
</div>

