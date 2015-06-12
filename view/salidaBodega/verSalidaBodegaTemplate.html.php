

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>


<?php $id = salidaBodegaTableClass::ID ?>
<?php $empleado = salidaBodegaTableClass::EMPLEADO_ID ?>
<?php $fecha = salidaBodegaTableClass::CREATED_AT ?>

<div class="container container-fluid">

     <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('salidaBodega', 'indexSalidaBodega') ?>"><?php echo i18n::__('return') ?> </a></button>
    
    </div>



    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr class="info">
                        
                        <th>datos de salida bodega</th>
                           
                            
                        
                    </tr>        
                </thead>
                <tbody>
                     <?php foreach ($objSalidaBodega as $salidaBodega): ?> 
                    <tr class="active">
                            <th><?php echo i18n::__('empleyeed') ?></th>
                            
                            <td><?php echo empleadoTableClass::getNameEmpleado($salidaBodega->$empleado) ?></td>
                            
                    
                             <tr class="active">
                            <th><?php echo i18n::__('date_creation') ?></th>
                            
                            <td><?php echo $salidaBodega->$fecha ?></td>
                            
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  