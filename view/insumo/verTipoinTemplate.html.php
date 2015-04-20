

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $desc_tipoIn = tipoInsumoTableClass::DESC_TIPOIN ?>
<?php $id = tipoInsumoTableClass::ID ?>
<?php $created_at=  tipoInsumoTableClass::CREATED_AT?>

<div class="container container-fluid">


       
         <a href="http://www.porcicolatapasco.com/index.php/tipoInsumo/index"><?php echo i18n::__('return') ?> </a>

 
    </div>



    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                   
                        <th>Datos</th>
                        
                    </tr>        
                </thead>
                <tbody>
                <?php foreach ($objTipoin as $tipoIn): ?>  
                        <tr >
                           <th><?php echo i18n::__('describe_typeProduct') ?></th>
                            
                            <td><?php echo $tipoIn->$desc_tipoIn ?></td>
                            
                             <tr >
                            <th><?php echo i18n::__('date_creation') ?></th>
                            
                            <td><?php echo $tipoIn->$created_at ?></td>
                            
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  