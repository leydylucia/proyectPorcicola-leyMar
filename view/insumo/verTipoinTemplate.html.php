

<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $desc_tipoIn = tipoInsumoTableClass::DESC_TIPOIN ?>
<?php $id = tipoInsumoTableClass::ID ?>
<?php $created_at=  tipoInsumoTableClass::CREATED_AT?>

<div class="container container-fluid">


       
    <button type="button" class="btn btn-info btn-xs"><a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexTipoin') ?>"><?php echo i18n::__('return') ?> </a></button>

 
    </div>



    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                   
                        <th class="info">Datos</th>
                        
                    </tr>        
                </thead>
                <tbody>
                <?php foreach ($objTipoin as $tipoIn): ?>  
                    <tr class="active">
                           <th><?php echo i18n::__('describe_typeProduct') ?></th>
                            
                            <td><?php echo $tipoIn->$desc_tipoIn ?></td>
                            
                             <tr >
                                 <th class="info"><?php echo i18n::__('date_creation') ?></th>
                            
                                 <td class="info"> <?php echo $tipoIn->$created_at ?></td>
                            
                <?php endforeach ?>
                </tbody>



            </table>    
        </div>
    </div>
    
  