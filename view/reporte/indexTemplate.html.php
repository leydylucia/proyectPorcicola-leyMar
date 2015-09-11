<!--@var $Insumo 
@var $page paginado mantiene el numero de la pagina -->
<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\configClass as confing ?>
<?php use mvc\request\requestClass as request ?>


<?php $id = reporteTableClass::ID ?>
<?php $nombre = reporteTableClass::NOMBRE ?>
<?php $descripcion= reporteTableClass::DESCRIPCION ?>
<?php $direccion = reporteTableClass::DIRECCION ?>
<?php $fecha = reporteTableClass::CREATED_AT ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('Report') ?></h1>  
    </div>

</div>
<!--fintitulo-->
<!--cambio de idioma-->
<div class="container container-fluid">
    <div style="margin-bottom: 10px; margin-top: 30px">

</div>

  

<?php view::includeHandlerMessage() ?><!--esta linea es para traer mensajes de exito cunado registra-->


<div class="container">
    <div class="table-responsive">
       

            <table class="table table-bordered table-striped table-condensed mitabla">
                <thead>
                    <tr class="active">
                        <th><input type="checkbox" id="chkAll"></th>
                        <th><?php echo i18n::__('name') ?></th>
                        <th><?php echo i18n::__('description') ?></th>
<!--                        <th><?php // echo i18n::__('direction') ?></th>-->
                         <th><?php echo i18n::__('date') ?></th>
                        <th><?php echo i18n::__('action') ?></th>

                    </tr>        
                </thead>
                <tbody>
                    <?php foreach ($objReporte as $reporte): ?> 
                        <tr class="text-info bg-info">
                            <td><input type="checkbox" name="chk[]" value="<?php echo $reporte->$id ?>"></td>
                            
                            <td><?php echo $reporte->$nombre ?></td>
                            <td><?php echo $reporte->$descripcion ?></td>
                            <!--<td><?php // echo $reporte->$direccion ?></td>-->
                            <td><?php echo date('d-m-Y h:i:s a', strtotime($reporte->$fecha)) ?></td>
                            <td>
                                <a href="<?php  echo routing::getInstance()->getUrlWeb('reporte', 'insert', array(reporteTableClass::ID => $reporte->$id)) ?>"class="btn btn-warning btn-xs"><?php echo i18n::__('see') ?></a>
                                

                                <!--eliminado individual con ajax-->
                                
                            </td>
                        </tr>

                  
                <?php endforeach ?>
                </tbody>



            </table>  
       
        <!--paginado-->
        <div class="text-right">
            <select id="slqPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('reporte', 'index') ?>')">
                <?php for ($x = 1; $x <= $cntPages; $x++): ?> 
                    <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option> 

                <?php endfor; ?>



            </select><?php echo $cntPages ?>

        </div>
        <!--fin paginado-->
    </div>
</div>




</div>
