
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $id = vacunacionTableClass::ID ?>
<?php $dosis = vacunacionTableClass::DOSIS ?>
<?php $hora = vacunacionTableClass::HORA ?>
<?php $insumoId = vacunacionTableClass::INSUMO_ID ?>
<?php $idCerdo = vacunacionTableClass::ID_CERDO ?>
<?php $fecha = vacunacionTableClass::CREATED_AT ?>

<div class="container container-fluid">

     <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>"><?php echo i18n::__('return') ?> </a></button>
    
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
                     <?php foreach ($objVacunacion as $vacunacion): ?> 
                    <tr class="active">
                            <th><?php echo i18n::__('Dose') ?></th>
                            
                            <td><?php echo $vacunacion->$dosis ?></td>
                            
                    <tr class="info">
                            <th><?php echo i18n::__('Time') ?></th>
                            
                            <td><?php echo $vacunacion->$hora ?></td>
                             <tr >
                            <th><?php echo i18n::__('product') ?></th>
                            
                            <td><?php echo $vacunacion-> $insumoId ?></td>
                             <tr class="info">
                            <th><?php echo i18n::__('pig') ?></th>
                            
                            <td><?php echo $vacunacion-> $idCerdo ?></td>
                            <tr >
                            
                             <tr class="active">
                            <th><?php echo i18n::__('date_creation') ?></th>
                            
                            <td><?php echo $vacunacion->$fecha ?></td>
                            
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  