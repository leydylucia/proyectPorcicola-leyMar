<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\config\configClass as confing ?>
<?php
use mvc\request\requestClass as request ?>

<?php $id = sacrificiovTableClass::ID ?>
<?php $valor = sacrificiovTableClass::VALOR ?>
<?php $cantidad = sacrificiovTableClass::CANTIDAD ?>
<?php $unidad_medida = sacrificiovTableClass::UNIDAD_MEDIDA_ID ?>
<?php $tipoVenta = sacrificiovTableClass::TIPO_VENTA_ID ?>
<?php $tipoVenta_t = tipovTableClass::ID ?>
<?php $descripcion = tipovTableClass::DESC_TIPOV ?>
<?php $idCerdo = sacrificiovTableClass::ID_CERDO ?>
<?php $cerdo = hojaVidaTableClass::ID ?>
<?php $nombre = hojaVidaTableClass::NOMBRE_CERDO ?>

<?php $fecha = sacrificiovTableClass::CREATED_AT ?>

<div class="container-fluid reporte">
    <h1>carne de cerdo</h1>

    <script>

        $(document).ready(function () {
            crearGrafica(<?php echo json_encode($cosPoints) ?>, <?php echo json_encode($labels) ?>, <?php echo $datoMaximo ?>);
        });
    </script> 

    <div id="chart1" style="width: 700px;height: 500px;"></div>

    <a class="btn btn-lg btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('reporte', 'report') ?>" >Importar pdf</a>

    <table class="table table-bordered table-striped table-condensed mitabla">
        <thead>
            <tr class="active">

                <th><?php echo i18n::__('pig') ?></th>
                <th><?php echo i18n::__('date') ?></th>
                <th><?php echo i18n::__('action') ?></th>


            </tr>        
        </thead>
        <tbody>
                <?php foreach ($cerdos as $cerdito): ?> 
                <tr class="text-info bg-info">

                    <td><?php echo $cerdito['nombre'] ?></td>
                    <td><?php echo date('d-m-Y h:i:s a', strtotime($cerdito['fecha'])) ?></td>
                    <td> <a href="<?php echo routing::getInstance()->getUrlWeb('detalleHoja', 'index', array(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID,true) => $cerdito['id'])) ?>" class="btn btn-primary btn-xs">consultar en Hoja de Vida</a></td>
<?php endforeach ?>
        </tbody>



    </table>  

</div>
